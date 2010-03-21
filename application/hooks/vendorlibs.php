<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter VendorLibs Add-on
 * @package vendorlibs
 */

/**
 * CodeIgniter Vendor Libs
 * @package vendorlibs
 */
class dd_ci_VendorLibs {

    /**
     * Read directories at path
     * @param string $path Path
     * @return array Paths
     */
    function readDirs($path) {
        $paths = array();
        $vendorsPath = $path . 'vendors';
        if ( $vendorsPath and file_exists($vendorsPath) ) {
            $handle = opendir($vendorsPath);
            while (false !== ($file = readdir($handle))) {
                if ( preg_match('/\.+$/', $file) ) continue;
                $subPath = $vendorsPath . '/' . $file;
                if ( is_dir($subPath) ) {
                    $paths[] = $subPath;
                }
            }
            closedir($handle);
            $paths[] = $vendorsPath;
        }
        return $paths;
    }

    /**
     * Pre System hook
     *
     * Will scan the vendors directories for additional directories
     * to be added to the include_path.
     *
     * http://codeigniter.com/user_guide/general/hooks.html
     */
    function preSystem() {

        $CFG =& load_class('Config');
        $CFG->load('vendorlibs', null, true);

        $allPaths = array();

        $allPaths[] = $CFG->item('vendorlibs_site_paths');
        $allPaths[] = $CFG->item('vendorlibs_paths');

        $allPaths[] = array_values($CFG->item('vendorlibs_map'));

        if ( $CFG->item('vendorlibs_scan') ) {
            $allPaths[] = $this->readDirs(APPPATH);
            $allPaths[] = $this->readDirs(BASEPATH);
        } else {
            $staticVendors = array();
            foreach ( $CFG->item('vendorlibs_vendors') as $vendor ) {
                $vendorApp = APPPATH . 'vendors/' . $vendor;
                $vendorBase = BASEPATH . 'vendors/' . $vendor;
                if ( file_exists($vendorApp) ) $staticVendors[] = $vendorApp;
                if ( file_exists($vendorBase) ) $staticVendors[] = $vendorBase;
            }
            $allPaths[] = $staticVendors;
        }

        $allPaths[] = explode(PATH_SEPARATOR, get_include_path());
        $allPathsFinal = array('.');
        foreach ( $allPaths as $allPathsPart ) {
            foreach ( $allPathsPart as $path ) {
                if ( $path != '.' ) $allPathsFinal[] = $path;
            }
        }

        set_include_path(implode(PATH_SEPARATOR, $allPathsFinal));

    }

}
?>
