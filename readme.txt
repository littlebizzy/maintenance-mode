=== Maintenance Mode ===

Contributors: littlebizzy
Donate link: https://www.patreon.com/littlebizzy
Tags: maintenance, mode, coming, soon, page
Requires at least: 4.4
Tested up to: 5.1
Requires PHP: 7.2
Multisite support: No
Stable tag: 1.1.1
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
Prefix: MTNCMD

Minimalistic plugin with a simple one-click on/off switch and zero settings to worry about, featuring default WordPress styling without any images.

== Description ==

One click activation!! Very easy to activate (single click) and lightweight design.

Very simple design with minimal database involvement. Only database usage is saving a few options to the wp_options table using transients which are cached in the Options API cache in WordPress.

Simply install the plugin, then go to Settings page and click Enable checkbox. Next, choose either Maintenance Mode (default) which issues a 503 HTTP header (site temporarily unavailable) or Coming Soon option wih 200 HTTP code.

Uninstalling this plugin will deleting all data from the database to avoid conflicts.

No images or heavy styling, simple default WordPress styling only.

For versions 1.0.X no WYSIWIG or customization of the messages, we may add in next version though.

Code inspiration:

* [Lukas Juhas Maintenance Mode](https://wordpress.org/plugins/lj-maintenance-mode/)

== FAQ ==

= What HTTP header codes does this plugin send? =

It issues a 503 for Maintenance Mode and also for Coming Soon (after version 1.1.1).

= Any custom CSS or images loaded in this plugin? =

No, it's very light and minimal, using default WordPress styling only.

= How can I change this plugin's settings? =

Visit the settings page to enable maintenance mode or preview how it will look.

    `/wp-admin/options-general.php?page=maintenance`

== Changelog ==

= 1.1.1 =
* tweaked language in drop-down shortcut
* tweaked CSS (colors) in drop-down shortcut
* non-dismissable admin notice when Maintenance Mode "enabled"
* hard-coded 503 HTTP header when Maintenance Mode "enabled" regardless of mode
* added custom nonce and referer checks to avoid other plugins inferences
* added previous missing validation of user permissions at the update moment
* now saves both options with the autoload value off
* selectively avoids to save the values that are defined by constants
* shows a green admin notice message when any value is saved
* clears the object cache on save using the `wp_cache_flush` function if available

= 1.1.0 =
* PBP v1.2.0
* added drop-down shortcut in WP Admin Toolbar
* constant `MAINTENANCE_MODE`
* constant `MAINTENANCE_MODE_STATUS`
* if constants defined they will "gray out" the settings page options
* frontend uses the early hook template_redirect instead of get_header to avoid conflicts with other plugins

= 1.0.7 =
* updated plugin meta

= 1.0.6 =
* added "Refresh" hyperlink to splash page (works with or without javascript enabled)
* tweaked splash page language
* updated plugin meta

= 1.0.5 =
* fixed splash page language error

= 1.0.4 =
* tweaked splash page language
* added warning for Multisite installations
* updated recommended plugins

= 1.0.3 =
* tested with WP 4.9
* added support for `DISABLE_NAG_NOTICES`
* updated recommended plugins
* added rating request notice
* optimized plugin code

= 1.0.2 =
* added recommended plugins notice

= 1.0.1 =
* tweaked settings page URI for simplicity
* tweaked preview link URI to avoid query string conflicts
* optimized plugin code

= 1.0.0 =
* initial release
