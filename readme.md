# Maintenance Mode

## Changelog

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
