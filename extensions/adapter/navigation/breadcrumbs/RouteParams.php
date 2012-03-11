<?php
/**
 * MG BreadCrumbs: displaying breadcrumbs easy way
 *
 * @copyright     Copyright 2012, Little Boy Genius
 * @author		  Marius Kubilius
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
namespace mg_breadcrumbs\extensions\adapter\navigation\breadcrumbs;

class RouteParams extends \lithium\core\Object {
	
	protected $_config = array();
	
	protected $_classes = array(
		'breadcrumbs' => 'mg_breadcrumbs\models\BreadCrumbs',
	);
	
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
		parent::__construct($config);
	}

    /**
	 * returns breadcrumb trail also it is gatekeeper for breadcrumb generation if they do not exist
     * @param string $url an url of current request usualy $this->request->url
	 * @param array $params parameters of current request used to determine crumbs if none is existing.
	 * @param array $options additional options to be passed for breadcrumb processing.
     * @return array|boolean returns breadcrumb trail array or false on failure.
     */
	public function get($url, array $params) {
		return (function($url, $params){
			return false;
		});
	}
	
	/**
	 * generates trail for Home item
	 * @return array trail item for home.
	 */
	protected function _getHome() {
		
	}
	
	/**
	 * retrieves trail for current url
	 * @param string $url - an url of current request
	 * @return array breadcrumb trail for current url. or false if no results found 
	 */
	protected function _retrieve($url) {
		
	}
	
	/**
	 * gets breadcrumb trails for current set of params.
	 */
	protected function _getTrail($params) {
		
	}
}
?>