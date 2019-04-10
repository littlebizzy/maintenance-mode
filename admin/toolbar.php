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
		add_action('admin_init', [$this, 'init']);
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
				'title'  => '<strong style="color: #ca4a1f;">Maintenance Enabled</strong>',
				'href'   => admin_url('options-general.php?page=maintenance'),
				'meta'   => [
					'title' => 'Maintenance Mode Enabled',
					'tabindex' => -1,
				],
			];

		// Disabled
		} else {

			$menuItems[] = [
				'id'     => $this->plugin->prefix.'-menu',
				'parent' => 'top-secondary',
				'title'  => 'Maintenance Disabled',
				'href'   => admin_url('options-general.php?page=maintenance'),
				'meta'   => [
					'title' => 'Maintenance Mode Disabled',
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