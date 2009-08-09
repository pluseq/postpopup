<?php
/**
 * Edit this file to fit your needs
 */

return array(
    'width' => 500,
    'height' => 500,
    'minWidth' => 200,
    'minHeight' => 300,
    
    // stick popup to the view port
    'sticky' => true,
    
    // hide scrollbars on the main window
    'hideScrolling' => false,

    /*
     * Where to take javascripts from:
     * 
     * - "auto" will use wp_enqueue_script - which is the default behavior
     * 
     * - "plugin" will use this plugin scripts, discarding WP built-in scripts
     *    (this is good for outdated WP, but may conflict with other plugins)
     * 
     * - "remote" will use the scripts from JQuery official site, thus taking
     *    the most fresh ones (not implemeted yet)
     */
    'jsMode' => 'auto',

    /*
     * JQuery dialog doesn't work without the appropriate theme. The options are:
     * 
     * - "no" - you add a theme yourself
     * - "bundled" - use bundled "Start" theme, which comes with the plugin
     */
    'theme' => 'bundled'
);