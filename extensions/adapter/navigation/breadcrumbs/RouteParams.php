<?php
/**
 * MG BreadCrumbs: displaying breadcrumbs easy way
 *
 * @copyright     Copyright 2012, Little Boy Genius
 * @author		  Marius Kubilius
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
namespace mg_breadcrumbs\extensions\adapter\breadcrumbs

class RouteParams extends \lithium\core\Object {
	
	
	/**
	 * Class constructor.
	 *
	 * @see mg_breadcrumbs\navigation\BreadCrumbs::config()
	 * @param array $config Configuration parameters for this filesystem adapter. These settings are
	 *        indexed by name and queryable through `BreadCrumbs::config('name')`.
	 *        The defaults are:
	 *        - 'path' : Path where uploaded files live `LITHIUM_APP_PATH . '/webroot/uploads'`.
	 */
	public function __construct(array $config = array()) {
		$defaults = array(
			'path' => Libraries::get(true, 'path') . '/webroot/uploads',
		);
		parent::__construct($config + $defaults);
	}

    /**
	 * returns breadcrumb trail also it is gatekeeper for breadcrumb generation if they do not exist
     * @param string $url an url of current request usualy $this->request->url
	 * @param array $params parameters of current request used to determine crumbs if none is existing.
	 * @param array $options additional options to be passed for breadcrumb processing.
     * @return array|boolean returns breadcrumb trail array or false on failure.
     */
	public function get($url, array $params, array $options = array()) {
        $path = $this->_config['path'];
        return function($self, $params) use (&$path) {
            $path = "{$path}/{$params['filename']}";
	        if(file_exists($path)) {
                return file_get_contents($path);
	        }
	        return false;
	    };
	}
}
?>