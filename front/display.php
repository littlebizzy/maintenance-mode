<?php

// Subpackage namespace
namespace LittleBizzy\MaintenanceMode\Front;

// Aliased namespaces
use \LittleBizzy\MaintenanceMode\Helpers;

/**
 * Display class
 *
 * @package Maintenance Mode
 * @subpackage Front
 */
class Display extends Helpers\Singleton {



	/**
	 * Maintenance mode
	 */
	private $mode;



	/**
	 * Plugin config file
	 */
	private $config;



	/**
	 * Pseudo constructor
	 */
	protected function onConstruct() {
		add_action('template_redirect', [$this, 'show'], 0);
	}



	/**
	 * Show the maintenance mode page
	 */
	public function show() {

		// Core object
		$maintenance = $this->plugin->factory->maintenance;

		// Check if enabled
		if (!$maintenance->enabled()) {

			// Check preview exception
			if (empty($_GET['maintenance']) || 'true' != $_GET['maintenance'] || !current_user_can($this->plugin->capability)) {
				return;
			}
		}

		// Set the maintenance mode
		$this->mode = $maintenance->mode();

		// Load the config file
		$this->config = @include $this->plugin->root.'/config.php';

		// Done
		wp_die($this->content(), $this->title(), ['response' => $this->statusCode()]);
	}



	/**
	 * Compose page title
	 */
	private function title() {

		// Title from config
		$title = $this->config['maintenance-mode']['title'];

		// Variable replacement
		$title = str_replace('%blogname%', get_bloginfo('name'), $title);

		// Apply custom filter
		$title = apply_filters('mml_site_title', $title);

		// Done
		return $title;
	}



	/**
	 * Compose the page content
	 */
	private function content() {

		// Initialize
		$content = '';

		// Coming-soon mode
		if ('cs' == $this->mode || 'comingsoon' == $this->mode) {
			$content = $this->config['maintenance-mode']['coming-soon'];

		// Default maintenance mode
		} elseif ('default' == $this->mode || 'maintenance' == $this->mode) {
			$content = $this->config['maintenance-mode']['default-maintenance'];
		}

		// Apply WP content and custom filter
		$content = apply_filters('the_content', $content);
		$content = apply_filters('mml_content', $content);

		// Done
		return $content;
	}



	/**
	 * Check the proper response code
	 */
	private function statusCode() {

		// Decide response code
		$statusCode = ('cs' == $this->mode || 'comingsoon' == $this->mode)? 200 : 503;

		// Done
		return $statusCode;
	}



}