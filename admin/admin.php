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
	 * Add the Settings menu page
	 */
	public function menu() {
		add_submenu_page('options-general.php', 'Maintenance Mode', 'Maintenance Mode', $this->plugin->capability, 'maintenance', [$this, 'page']);
	}



	/**
	 * Admin page
	 */
	public function page() {

		// Exit on unauthorized access
		if (!current_user_can($this->plugin->capability)) {
			die;
		}

		// Core object
		$maintenance = $this->plugin->factory->maintenance;

		// Maintenance data
		$mode = $maintenance->mode();
		$enabled = $maintenance->enabled();

		// Mode forced by constant
		$modeDisabled = (false !== $maintenance->modeByConstant());

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
							<input type="checkbox" <?php if ($maintenance->enabledByConstant()) echo 'disabled'; ?> id="mml_enabled" name="mml-enabled" value="1" <?php checked($enabled); ?>>
							<?php if ($enabled) : ?><p class="description" style="padding-top: 10px;">Maintenance Mode is currently active.</p><?php endif; ?>
						</td>
					</tr>

					<tr>
						<th scope="row"><?php echo 'Mode'; ?></th>
						<td>
							<label>
								<input type="radio" <?php if ($modeDisabled) echo 'disabled'; ?> name="mml-mode" value="default" <?php checked('default' == $mode || 'maintenance' == $mode); ?>>Maintenance Mode (Default)
							</label>
							&nbsp; &nbsp;
							<label>
								<input type="radio" <?php if ($modeDisabled) echo 'disabled'; ?> name="mml-mode" value="cs" <?php checked('cs' == $mode || 'comingsoon' == $mode); ?>>Coming Soon Page
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