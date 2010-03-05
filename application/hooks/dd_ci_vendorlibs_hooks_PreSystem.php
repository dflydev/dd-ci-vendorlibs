<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter VendorLibs Add-on
 * @package dd_ci_vendorlibs
 */

/**
 * CodeIgniter PreSystem Hook
 * @package dd_ci_vendorlibs
 */
class dd_ci_vendorlibs_hooks_PreSystem {

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

        // TODO We should eventually try to implement some
        //      cache mechanism so that we do not have to
        //      read these directories every time.
        //$CFG =& load_class('Config');
        //$CFG->load('dd_ci_vendorlibs', null, true);

        $paths = array_merge(
            $this->readDirs(APPPATH),
            $this->readDirs(BASEPATH)
        );

        set_include_path(
            implode(PATH_SEPARATOR, $paths) .
            PATH_SEPARATOR .
            get_include_path()
        );

    }

}
?>
