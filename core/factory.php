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
	 * Core Maintenance object
	 */
	protected function createMaintenance() {
		return Maintenance::instance($this->plugin);
	}



	/**
	 * Admin object
	 */
	protected function createAdmin() {
		return Admin\Admin::instance($this->plugin);
	}



	/**
	 * Toolbar object
	 */
	protected function createToolbar() {
		return Admin\Toolbar::instance($this->plugin);
	}



	/**
	 * Display object
	 */
	protected function createDisplay() {
		return Front\Display::instance($this->plugin);
	}



	/**
	 * Registrar object
	 */
	protected function createRegistrar() {
		return new Helpers\Registrar($this->plugin);
	}



}