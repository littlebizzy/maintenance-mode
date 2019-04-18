<?php

// Subpackage namespace
namespace LittleBizzy\MaintenanceMode\Admin;

// Aliased namespaces
use \LittleBizzy\MaintenanceMode\Helpers;

/**
 * Notice class
 *
 * @package Maintenance Mode
 * @subpackage Admin
 */
final class Notice extends Helpers\Singleton {



	/**
	 * Pseudo constructor
	 */
	protected function onConstruct() {
		add_action('admin_notices', [$this, 'show']);
	}



	/**
	 * Shows the maintenance mode notice warning
	 */
	public function show() {

		// Check maintenance mode
		if (!$this->plugin->factory->maintenance->enabled()) {
			return;
		}

		// Notice
		?><div class="notice notice-error">

			<p><strong>Notice:</strong> Maintenance Mode is currently enabled, and the frontend is inaccessible to unprivileged users. <a href="../wp-admin/options-general.php?page=maintenance">View Settings</a></p>

		</div><?php
	}



}
