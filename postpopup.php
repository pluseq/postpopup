<?php
/*
Plugin Name: PostPopup
Plugin URI: http://or.pluseq.com/wp-plugins/postpopup
Description: Allows inserting popups localted in separate posts. IMORTANT!!! You need to use some <a href="http://jqueryui.com/themeroller/#themeGallery">JQuery UI theme</a>, in order to see the popups. Also see pagepop/config.php for fine plugin tuning.
Version: 1.0.1.
Author: Constantin Pogorelov
Author URI: http://or.pluseq.com/

You can use Advanced Category Excluder to hide the popup posts from homepage
See http://wordpress.org/extend/plugins/advanced-category-excluder/
*/

require_once dirname(__FILE__) . '/include/PagePopup.class.php';

add_filter('the_content', array('PagePopup', 'processContent'));
add_action('wp', array('PagePopup', 'enqueueScripts'));