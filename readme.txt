=== Maintenance Mode ===

Contributors: littlebizzy
Tags: maintenance, mode, splash, page, coming, soon, http, header, code, 503, 200
Requires at least: 4.4
Tested up to: 4.8
Stable tag: 1.0.2
License: GPL3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Minimalistic plugin with a simple one-click on/off switch and zero settings to worry about, featuring default WordPress styling without any images.

== Description ==

> Minimalistic plugin with a simple one-click on/off switch and zero settings to worry about, featuring default WordPress styling without any images.

Very simple design with minimal database involvement. Only database usage is saving a few options to the wp_options table using transients.

Simply install the plugin, then go to Settings page and click Enable checkbox. Next, choose either Maintenance Mode (default) which issues a 503 HTTP header (site temporarily unavailable) or Coming Soon option wih 200 HTTP code.

Uninstalling this plugin will deleting all data from the database to avoid conflicts.

No images or heavy styling, simple default WordPress styling only.

For version 1.0 no WYSIWIG or customization of the messages, we may add in next version though.

Compatibility:

* Meant for Linux servers
* Minimum PHP version: 5.5
* Designed for: PHP 7+ and MySQL 5.7+
* Can be used as a "Must Use" plugin (mu-plugins)

Future plugin goals:

* Localization (translation support)
* Transient experimentation
* More features (based on user suggestions)
* Code maintenance/improvements

Code inspiration:

* [Lukas Juhas Maintenance Mode](https://wordpress.org/plugins/lj-maintenance-mode/)


*NOTE: We released this plugin in response to our managed hosting clients asking for better access to their server environment, and our primary goal will likely remain supporting that purpose. Although we are 100% open to fielding requests from the WordPress community, we kindly ask that you consider all of the above mentioned goals before leaving reviews of this plugin, thanks!*

== Installation ==

1. Upload the plugin files to `/wp-content/plugins/`
2. Activate the plugin within the WP Admin
3. Visit Settings page to enable the maintenance mode (or coming soon mode)

== FAQ ==

= What HTTP header codes does this plugin send? =

It issues a 503 for Maintenance Mode and a 200 for Coming Soon.

= Any custom CSS or images loaded in this plugin? =

No, it's very light and minimal, using default WordPress styling only.

= How can I change this plugin's settings? =

Visit the settings page to enable maintenance mode or preview how it will look.

= I have a suggestion, how can I let you know? =

Please avoid leaving negative reviews in order to get a feature implemented. Instead, we kindly ask that you post your feedback on the wordpress.org support forums by tagging this plugin in your post. If needed, you may also contact our homepage.

== Changelog ==

= 1.0.2 =
* recommended plugins

= 1.0.1 =
* simplified settings page URI
* tweaked preview link URI for better stability
* minor code tweaks

= 1.0.0 =
* initial release