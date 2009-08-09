<?php
define(POPUP_HOME, dirname(dirname(__FILE__)));
define(POPUP_URL, get_bloginfo('url') . '/wp-content/plugins/postpopup');
define(POPUP_JS, POPUP_URL . '/js/');
/**
 * The class is named after the initial name of the plugin (PagePopup)
 */
class PagePopup {
    /**
     * @see config.php
     * @var array
     */
	protected static $config; 
	
    /**
     * @var string
     */
    protected $text;

    /**
     * @var array ('pageId' => content)
     */
    protected $content = array();
    
    protected $replaceHappened = false;
    
    protected function __construct($text) {
        $this->text = $text;
    }
    
    protected function addPopupByURL($matches) {
    	global $wp_query;
    	
        $pageId = $matches[1];
        if (is_numeric($pageId)) {
            $post = get_post($pageId);
        } else {
        	$query = new WP_Query();
        	
        	//simulate category query in order to fool ACE
        	$temp = $wp_query->is_category;
            $wp_query->is_category = true;

        	$posts = $query->query(array('name' => $pageId));

        	$wp_query->is_category = $temp;
        	
        	if (empty($posts)) {
        		return "#error-popup-$pageId";
        	}
        	$post = $posts[0];
        }
                
        if (!$post) return "#error-popup-$pageId";      
        
        $this->replaceHappened = true;        
        $this->content[$post->ID]='<div class="popup-content">' .
                                  apply_filters('the_content', $post->post_content) .
                                  '</div>'; 
        return '#popup" onclick="javascript:return showPopup(\''. $post->ID . '\')';
    }
    
    /**
     * @var $id post_id (page_id)
     */
    public static function getContentById($id) {
		$page = get_post($id);
		if ($page) {
		    return $page->post_content;
		}    	
		return null;
    }
    
    protected function getConfig() {
    	if (!isset(self::$config)) {
    		self::$config = include POPUP_HOME . '/config.php';
    	}
    	return self::$config;
    }
    
    protected function getExtraContent() {
    	$this->getConfig();
    	ob_start();
        include dirname(__FILE__) . '/jqdialog_view.php';
        $viewStr = ob_get_contents();
        ob_end_clean();
        return $viewStr;
    }
    
    protected function makeReplace() {
    	$this->text = preg_replace_callback('#popup://([^"]+)#msi', array($this, 'addPopupByURL'), $this->text);
    }
    
    public static function processContent($text) {
        $pagePoup = new PagePopup($text);
        $pagePoup->makeReplace();
        return ($pagePoup->replaceHappened)?
            $pagePoup->getExtraContent() :
            $pagePoup->text;
    }
    
    public static function enqueueScripts() {
        $config = self::getConfig();
        
        $prefix = '';
        switch ($config['jsMode']) {
        	case 'plugin':
        		$prefix = 'pagepopup'; 

        	default:
        		wp_enqueue_script($prefix . 'jquery', POPUP_URL . '/js/jquery.js', false, '1.3.2');
                wp_enqueue_script($prefix . 'jquery-ui', POPUP_URL . '/js/jquery-ui.js', array($prefix . 'jquery'), '1.3.2');
                break;
        }
                
        if (!empty($config['sticky'])) {
            wp_enqueue_script('jquery-ui-dialog-sticky', POPUP_URL . '/js/ui.dialog.sticky.js', array($prefix . 'jquery'), '1.3.2');
        }
        
        if ($config['theme'] == 'bundled') {
            wp_enqueue_style('pagepopup-theme', POPUP_URL . '/theme/start.css');
        }
    }
}
