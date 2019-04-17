<?php

// Subpackage namespace
namespace LittleBizzy\MaintenanceMode\Admin;

// Aliased namespaces
use \LittleBizzy\MaintenanceMode\Helpers;

/**
 * Toolbar class
 *
 * @package Maintenance Mode
 * @subpackage Admin
 */
final class Toolbar extends Helpers\Singleton {



	/**
	 * Pseudo constructor
	 */
	protected function onConstruct() {
		add_action('init', [$this, 'init']);
	}



	/**
	 * WP init hook
	 */
	public function init() {

		// Check current user permissions
		if (!current_user_can($this->plugin->capability)) {
			return;
		}

		// Add the admin bar
		add_action('admin_bar_menu', [$this, 'add']);
	}



	/**
	 * Adds the admin bar link
	 */
	public function add(&$wp_admin_bar) {

		// Initialize
		$menuItems = [];

		// Check maintenance enabled
		if ($this->plugin->factory->maintenance->enabled()) {

			$menuItems[] = [
				'id'     => $this->plugin->prefix.'-menu',
				'parent' => 'top-secondary',
				'title'  => '<span style="color: #fff; background: #dc3232; padding: 0 12px 0 11px; display: inline-block;">Maintenance: ON</span>',
				'href'   => admin_url('options-general.php?page=maintenance'),
				'meta'   => [
					'title' => '',
					'tabindex' => -1,
				],
			];

		// Disabled
		} else {

			$menuItems[] = [
				'id'     => $this->plugin->prefix.'-menu',
				'parent' => 'top-secondary',
				'title'  => 'Maintenance: OFF',
				'href'   => admin_url('options-general.php?page=maintenance'),
				'meta'   => [
					'title' => '',
					'tabindex' => -1,
				],
			];
		}

		// Add menus
		foreach ($menuItems as $menuItem) {
			$wp_admin_bar->add_menu($menuItem);
		}
	}



}
