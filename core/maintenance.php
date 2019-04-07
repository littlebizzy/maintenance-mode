<?php

// Subpackage namespace
namespace LittleBizzy\MaintenanceMode\Core;

// Aliased namespaces
use \LittleBizzy\MaintenanceMode\Helpers;

/**
 * Core class
 *
 * @package Maintenance Mode
 * @subpackage Core
 */
class Maintenance extends Helpers\Singleton {



	/**
	 * Check maintenance mode enabled
	 */
	public function enabled() {

		// Check constant
		if ($this->enabledByConstant()) {
			return true;
		}

		// Check option
		$enabled = (1 === (int) get_option('mml-enabled'));

		// Done
		return $enabled;
	}



	/**
	 * Check if forced by constant
	 */
	public function enabledByConstant() {
		return $this->plugin->enabled('MAINTENANCE_MODE');
	}



	/**
	 * Inspects maintenance mode value
	 */
	public function mode() {

		// Check constant value
		if (false !== ($mode = $this->modeByConstant())) {
			return $mode;
		}

		// Retrieve option
		$mode = get_option('mml-mode');

		// Done
		return $mode;
	}



	/**
	 * Check if mode is defined by constant
	 */
	public function modeByConstant() {

		// Check constant
		if (defined('MAINTENANCE_MODE_STATUS') &&
			('maintenance' == MAINTENANCE_MODE_STATUS || 'comingsoon' == MAINTENANCE_MODE_STATUS)) {

			// By constant
			return MAINTENANCE_MODE_STATUS;
		}

		// Not force
		return false;
	}



}