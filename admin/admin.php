<?php

// Subpackage namespace
namespace LittleBizzy\MaintenanceMode\Admin;

// Aliased namespaces
use \LittleBizzy\MaintenanceMode\Helpers;

/**
 * Admin class
 *
 * @package Maintenance Mode
 * @subpackage Admin
 */
final class Admin extends Helpers\Singleton {



	/**
	 * Needed user capability
	 */
	const CAPABILITY = 'delete_plugins';



	/**
	 * Pseudo constructor
	 */
	protected function onConstruct() {
		add_action('admin_init', [$this, 'init']);
		add_action('admin_menu', [$this, 'menu']);
	}



	/**
	 * Admin initialization
	 */
	public function init() {

		// Previous plugin version compatibility
		register_setting('mml', 'mml-enabled');
		register_setting('mml', 'mml-mode');
	}



	/**
	 * Display menu
	 */
	public function menu() {
		add_submenu_page('options-general.php', 'Maintenance Mode', 'Maintenance Mode', self::CAPABILITY, 'maintenance', [$this, 'page']);
	}



	/**
	 * Admin page
	 */
	public function page() {

		// Exit on unauthorized access
		if (!current_user_can(self::CAPABILITY)) {
			die;
		}

		// Prepare options
		$mode = get_option('mml-mode');
		$enabled = get_option('mml-enabled');

		// Plugin admin page
		?><div class="wrap">

			<h2><?php echo 'Maintenance Mode'; ?></h2>

			<form method="post" action="options.php">

				<?php settings_fields('mml'); ?>
				<?php do_settings_sections('mml'); ?>

				<table class="form-table">

					<tr valign="top">
						<th scope="row">
							<label for="mml_enabled"><?php echo 'Enabled'; ?></label>
						</th>
						<td>
							<input type="checkbox" id="mml_enabled" name="mml-enabled" value="1" <?php checked($enabled, 1); ?>>
							<?php if ($enabled) : ?>
								<p class="description"><?php echo "Maintenance Mode is currently active."; ?></p>
							<?php endif; ?>
						</td>
					</tr>

					<tr>
						<th scope="row"><?php echo 'Mode'; ?></th>
						<td>
							<label>
								<input name="mml-mode" type="radio" value="default" <?php checked('default' == $mode, 1); ?>>
								<?php echo 'Maintenance Mode'; ?> (<?php echo 'Default'; ?>)
							</label>
							<label>
								<input name="mml-mode" type="radio" value="cs" <?php checked('cs' == $mode, 1); ?>>
								<?php echo 'Coming Soon Page'; ?>
							</label>
						</td>
					</tr>

					<tr>
						<th>
							<a href="<?php echo esc_url(add_query_arg('maintenance', 'true', bloginfo('url'))); ?>" target="_blank" class="button button-secondary"><?php echo 'Preview'; ?></a>
						</th>
					</tr>
				</table>

				<?php submit_button(); ?>

			</form>

		</div><?php
	}



}