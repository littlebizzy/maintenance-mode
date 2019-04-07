<?php

// Subpackage namespace
namespace LittleBizzy\MaintenanceMode\Core;

// Aliased namespaces
use \LittleBizzy\MaintenanceMode\Helpers;
use \LittleBizzy\MaintenanceMode\Admin;
use \LittleBizzy\MaintenanceMode\Front;

/**
 * Object Factory class
 *
 * @package Maintenance Mode
 * @subpackage Core
 */
class Factory extends Helpers\Factory {



	/**
	 * Admin object
	 */
	protected function createAdmin() {
		return Admin\Admin::instance($this->plugin);
	}


	/**
	 * Maintenance object
	 */
	protected function createMaintenance() {
		return Front\Maintenance::instance($this->plugin);
	}



}