<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Automatically scan vendor directory
 *
 * If set to true (default), APPPATH . 'vendors' and BASEDIR . 'vendors'
 * are scanned and added to the include path automatically.
 *
 * This has the potential to impact performance so disabling this may be
 * appropriate in some cases if other vendorlibs features are used instead.
 */
$config['vendorlibs_scan'] = true;

/**
 * Paths, Maps and Vendors
 *
 * In general, there are three types of settings for vendorlibs.
 *
 * Paths are used when specifying an array of paths to third-party libraries.
 * This is a good general case, though in development enviornment this could
 * lead to potential bloat of the include path if many vendor libraries are
 * used and many or all of them have site overrides.
 *
 * Maps are used if there is a preference to specify paths in such a way
 * that the site configuration can override specific paths based on names.
 * This can be useful if there are many vendor libraries specified and
 * it is not desired to have the include path bloated in dev environment
 * with many overrides.
 *
 * Vendors are used if scanning has been disabled ('vendorlibs_scan' = false)
 * and a fixed list of vendor entries are desired. The values on this array
 * will have APPPATH . 'vendors' and BASEDIR . 'vendors' appended to them.
 *
 * Include paths will be built in the following order:
 *
 *  - .
 *  - paths 
 *  - maps 
 *  - vendors (scanned or specified)
 *  - original include path
 *
 */

/**
 * Site paths
 *
 * These should generally only be set in the vendorlibs_site.php file
 * on a site-by-site basis.
 */
$config['vendorlibs_site_paths'] = array();

/**
 * Paths
 *
 * In general, it would be good to set specific paths here for the
 * "usual" case (i.e., production environment) and in special cases
 * (i.e., dev enviornment) add their override paths to the
 * 'vendorlibs_site_paths' configuration.
 *
 * Example:
 *
 * $config['vendorlibs_paths'] = array(
 *     '/opt/rmccue-SimplePie-9a1ebc0',
 *     '/opt/safsi-1.2/lib',
 *     '/opt/repose-0.5b/lib'
 * );
 *
 */
$config['vendorlibs_paths'] = array();

/**
 * Vendor library map
 *
 * Maps a name to a path. Useful for adding specific paths for specific
 * projects that can be easily overridden in a development environment.
 */
$config['vendorlibs_map'] = array();

/**
 * Individual path maps
 */
// $config['vendorlibs_map']['simplepie'] = '/opt/rmccue-SimplePie-9a1ebc0';
// $config['vendorlibs_map']['safsi'] = '/opt/safsi-1.2/lib';
// $config['vendorlibs_map']['repose'] = '/opt/repose-0.5b/lib';

/**
 * Vendor paths
 *
 * This configuration is ignored unless 'vendorlibs_scan' is set to false
 * as it would not make sense.
 *
 * These values will have APPPATH . 'vendors' and BASEDIR . 'vendors'
 * prepended. This is useful if it is perceived that scanning the vendors
 * folder would take too much time.
 */
$config['vendorlibs_vendors'] = array();

// Include site-specific vendorlibs configuration if it exists.
$siteConfig = APPPATH.'config/vendorlibs_site'.EXT;
if ( file_exists($siteConfig) ) include($siteConfig);

?>
