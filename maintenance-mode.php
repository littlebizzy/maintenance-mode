<?php
/*
Plugin Name: Maintenance Mode
Plugin URI: https://www.littlebizzy.com/plugins/maintenance-mode
Description: Minimalistic plugin with a simple one-click on/off switch and zero settings to worry about, featuring default WordPress styling without any images.
Version: 1.0.6
Author: LittleBizzy
Author URI: https://www.littlebizzy.com
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
Text Domain: maintenance-mode-littlebizzy
Prefix: MTNCMD
*/

// Admin Notices module
require_once dirname(__FILE__).'/admin-notices.php';
MTNCMD_Admin_Notices::instance(__FILE__);

/**
 * Admin Notices Multisite check
 * Uncomment //return to disable this plugin on Multisite installs
 */
require_once dirname(__FILE__).'/admin-notices-ms.php';
if (false !== \LittleBizzy\MaintenanceMode\Admin_Notices_MS::instance(__FILE__)) {
	//return;
}

// Plugin constants
 define('MML_VERSION', '1.0.6');
 define('MML_FILE', __FILE__);
 define('MML_DIR', plugin_dir_path(__FILE__));
 define('MML_URL', plugin_dir_url(__FILE__));
 define('MML_PLUGIN_BASENAME', plugin_basename(__FILE__));


 register_activation_hook(__FILE__, 'mml_activation');
 register_deactivation_hook(__FILE__, 'mml_deactivation');

 function mml_activation() {
   //Activation
   mml_set_content();

 }

 function mml_set_content()
 {
   // If content is not set, set the default content.
  //  $content = get_option('mml-content');
  //  if (empty($content)) :
       $content = "<h1>We'll be back online as soon as possible.</h1><p>Our website is undergoing some important maintenance updates at the moment. Please check back shortly, and sincere apologies for any inconvenience. Thank you!</p><p><a id='jslink' style='display:none;' href='javascript:window.location.reload(true)'>Refresh page</a><noscript><a href='.'>Refresh page</a></noscript></p><script>document.getElementById('jslink').style.display='inline-block';</script>";
       /**
       * f you are trying to ensure that a given option is created,
       * use update_option() instead, which bypasses the option name check
       * and updates the option with the desired value whether or not it exists.
       */
       update_option('mml-content', stripslashes($content));
  //  endif;

   // If content is not set, set the default content.
   $mode = get_option('mml-mode');
   if (empty($mode)) :
       update_option('mml-mode', 'default');
   endif;
 }

 function mml_deactivation() {
    // Deactivation
 }

 /**
  * Class for Maintenance mode
  */
 class mmlMaintenance
 {

   function __construct()
   {
     add_action('admin_init', array( $this, 'settings' ));
     add_action('admin_menu', array( $this, 'link' ));

     // maintenance mode
     add_action('get_header', array( $this, 'maintenance' ));
   }

   /**
    * Register link in admin options bar
    *
    * @since 1.0.1
   */
   public function link()
   {
     add_submenu_page('options-general.php', 'Maintenance Mode', 'Maintenance Mode', 'delete_plugins', 'maintenance', array($this, 'settingsPage'));
   }

   /**
    * Register Settings
    *
    * @since 1.0
   */
   public function settings()
   {
       register_setting('mml', 'mml-enabled');
       register_setting('mml', 'mml-mode');

       //set the content
       mml_set_content();
   }

   /**
    * Settings page (admin)
    *
    * @since 1.0.1
   */
   public function settingsPage()
   {
       ?>
       <div class="wrap">
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
                           <?php $mml_enabled = esc_attr(get_option('mml-enabled')); ?>
                           <input type="checkbox" id="mml_enabled" name="mml-enabled" value="1" <?php checked($mml_enabled, 1); ?>>
                           <?php if ($mml_enabled) : ?>
                               <p class="description"><?php echo "Maintenance Mode is currently active."; ?></p>
                           <?php endif; ?>
                       </td>
                   </tr>
                   <tr>
                       <th scope="row"><?php echo 'Mode'; ?></th>
                       <td>
                           <?php $mml_mode = esc_attr(get_option('mml-mode')); ?>
                           <?php $mode_default = $mml_mode == 'default' ? true: false; ?>
                           <?php $mode_cs = $mml_mode == 'cs' ? true : false; ?>
                           <label>
                               <input name="mml-mode" type="radio" value="default" <?php checked($mode_default, 1); ?>>
                               <?php echo 'Maintenance Mode'; ?> (<?php echo 'Default'; ?>)
                           </label>
                           <label>
                               <input name="mml-mode" type="radio" value="cs" <?php checked($mode_cs, 1); ?>>
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
       </div>
   <?php
   }

   /**
    * Site title for Maintenance mode
    *
    * @since 1.0
    * @return string
    */
   public function site_title()
   {
       return apply_filters('mml_site_title', get_bloginfo('name') . ' - Website Under Maintenance');
   }

   /**
    * Get Maimtenance content
    *
    * @since 1.0
    * @return mixed
    */
   public function get_content()
   {
       $mode = get_option('mml-mode');
       if ($mode == 'cs') {
         $content = "<h1>Coming soon!</h1><p>Our website will launch very soon. Please check back shortly!</p>";
       }else {
        $content = "<h1>We'll be back online as soon as possible.</h1><p>Our website is undergoing some important maintenance updates at the moment. Please check back shortly, and sincere apologies for any inconvenience. Thank you!</p><p><a id='jslink' style='display:none;' href='javascript:window.location.reload(true)'>Refresh page</a><noscript><a href='.'>Refresh page</a></noscript></p><script>document.getElementById('jslink').style.display='inline-block';</script>";
       }
       $content = apply_filters('the_content', $content);
       $content = apply_filters('mml_content', $content);

       return $content;
   }

   /**
    * get mode
    *
    * @since 1.0
    * @return int
    */
   public function get_mode()
   {
       $mode = get_option('mml-mode');
       if ($mode == 'cs') {
           // coming soon page
           return 200;
       }

       // maintenance mode
       return 503;
   }

   /**
    * is maintenance enabled?
    *
    * @since 1.0
    * @return boolean
    */
   public function enabled()
   {
       // enabled
       if (get_option('mml-enabled') || isset($_GET['maintenance']) && $_GET['maintenance'] == 'true') :
           return true;
       endif;

       // disabled
       return false;
   }

   /**
    * Maintenance Mode
    *
    * @since 1.0.1
   */
   public function maintenance()
   {
       if (!$this->enabled()) {
           return false;
       }

      //  do_action('mml_before_mm');

       if (!(current_user_can('super admin')) || (isset($_GET['maintenance']) && $_GET['maintenance'] == 'true')) {
           wp_die($this->get_content(), $this->site_title(), array('response' => $this->get_mode()));
       }
   }

 }

 // Initialising.
 $MaintenanceMode = new mmlMaintenance();


 ?>
