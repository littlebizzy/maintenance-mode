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
	 * Form helpers
	 */
	private $paramNonce;
	private $paramAction;
	private $errorNonce;
	private $errorReferer;



	/**
	 * Pseudo constructor
	 */
	protected function onConstruct() {
		add_action('admin_init', [$this, 'init'], 0);
		add_action('admin_menu', [$this, 'menu']);
	}



	/**
	 * Checks the form submit at the admin initialization
	 */
	public function init() {

		// Avoid unauthorized updates
		if (!current_user_can($this->plugin->capability)) {
			return;
		}

		// Prepare form param
		$this->paramNonce = $this->plugin->prefix.'-nonce';
		$this->paramAction = $this->plugin->file.'-update';

		// Check form submit
		if (isset($_POST[$this->paramNonce])) {

			// Check nonce
			if (!wp_verify_nonce($_POST[$this->paramNonce], $this->paramAction)) {
				$this->errorNonce = true;

			// Check referer
			} elseif (!check_admin_referer($this->paramAction, $this->paramNonce)) {
				$this->errorReferer = true;

			// Correct
			} else {

				// Prepare values
				$inputEnabled = empty($_POST['mml-enabled'])? 0 : 1;
				$inputMode = (empty($_POST['mml-mode']) || !in_array($_POST['mml-mode'], ['default', 'cs']))? 'default' : $_POST['mml-mode'];

				// Update non-autoload options
				update_option('mml-enabled', $inputEnabled, false);
				update_option('mml-mode', $inputMode, false);

				// Flush the cache
				if (function_exists('wp_cache_flush')) {
					wp_cache_flush();
				}
			}
		}
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


		/* Validation */

		// Exit on unauthorized access
		if (!current_user_can($this->plugin->capability)) {
			die;
		}


		/* Read */

		// Core maintenance object
		$maintenance = $this->plugin->factory->maintenance;

		// Maintenance data
		$mode = $maintenance->mode();
		$enabled = $maintenance->enabled();

		// Mode forced by constant
		$modeDisabled = (false !== $maintenance->modeByConstant());


		/* Output */

		// Plugin admin page
		?><div class="wrap">

			<h2><?php echo 'Maintenance Mode'; ?></h2>

			<?php if (!empty($this->errorNonce)) : ?><div class="notice notice-error"><p>Security verification error, please try to submit the form again.</p></div>
			<?php elseif (!empty($this->errorReferer)) : ?><div class="notice notice-error"><p>Security referer error, please try to submit the form again.</p></div><?php endif; ?>

			<form method="post" action="options-general.php?page=maintenance">

				<?php wp_nonce_field($this->paramAction, $this->paramNonce); ?>

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
								<input type="radio" <?php if ($modeDisabled) echo 'disabled'; ?> name="mml-mode" value="default" <?php checked(empty($mode) || 'default' == $mode || 'maintenance' == $mode); ?>>Maintenance Mode (Default)
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