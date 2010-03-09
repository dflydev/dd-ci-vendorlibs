<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Placeholder for future configuration of the dd_ci_vendorlibs package.
 */

// Include site-specific vendorlibs configuration if it exists.
$siteConfig = APPPATH.'config/dd_ci_vendorlibs_site'.EXT;
if ( file_exists($siteConfig) ) include($siteConfig);

?>
