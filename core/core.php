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
final class Core extends Helpers\Singleton {



	/**
	 * Needed admin capability
	 */
	const CAPABILITY = 'delete_plugins';



	/**
	 * Pseudo constructor
	 */
	protected function onConstruct() {

		// Factory object
		$this->plugin->factory = new Factory($this->plugin);

		// Set admin capability
		$this->plugin->capability = self::CAPABILITY;

		// Check admin context
		if ($this->plugin->context()->admin()) {
			$this->plugin->factory->admin();

		// Front area display
		} elseif ($this->plugin->context()->front()) {
			$this->plugin->factory->display();
		}
	}



}