<?php
/*
Plugin Name: Maintenance Mode
Plugin URI: https://www.littlebizzy.com/plugins/maintenance-mode
Description: Minimalistic plugin with a simple one-click on/off switch and zero settings to worry about, featuring default WordPress styling without any images.
Version: 1.1.0
Author: LittleBizzy
Author URI: https://www.littlebizzy.com
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
PBP Version: 1.2.0
WC requires at least: 3.3
WC tested up to: 3.5
Prefix: MTNCMD
*/

// Plugin namespace
namespace LittleBizzy\MaintenanceMode;

// Plugin constants
const FILE = __FILE__;
const PREFIX = 'mtncmd';
const VERSION = '1.1.0';
const REPO = 'littlebizzy/maintenance-mode';

// Boot
require_once dirname(FILE).'/helpers/boot.php';
Helpers\Boot::instance(FILE);