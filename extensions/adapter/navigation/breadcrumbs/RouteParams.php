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
		'router' => '\lithium\net\http\Router',
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
		$result = $this->_getTrail($url);
		if(!$result) {
			$result = $this->_setTrail($url, $params);
		}
		return (function($result){
			return $result;
		});
	}
	
	/**
	 * retrieves trail for current url
	 * @param string $url - an url of current request
	 * @return array breadcrumb trail for current url. or false if no results found 
	 */
	protected function _getTrail($url) {
		$conditions = array('url' => $url);
		$breadcrumbs = $this->_classes['breadcrumbs'];
		$breadcrumbs = $breadcrumbs::first(compact('conditions'));
		$result = isset($breadcrumbs->data) ? $breadcrumbs->data() : false; 
		return $result;
	}
	
	
	protected function _setTrail($url, $params) {
		$router = $this->_classes['router'];
		$trailComponents = $this->_getTrailComponents($params);
		$trailParams = $this->_getCleanParams($trailComponents, $params);
		$notFound = array();
		$trailComponents = array_reverse($trailComponents, true);
		foreach ($trailComponents as $key => $trailComponent){
			$trailComponent['params'] = $this->_getCleanParams($trailComponent['params'], $trailParams);
			$result = $this->_getTrail($router::match($trailComponent['params']));
			if($result) {
				break;
			}
			else{
				$notFound[$key] = $trailComponent;
			}
		}
		var_dump($notFound);
	}

	/**
	 * Return used trail components.
	 */
	protected function _getTrailComponents($params) {
		$match = $this->_config['trail'];
		return array_intersect_key($match, $params);
	}
	
	/**
	 * Get params which are being used in query and are set in trail
	 */
	protected function _getCleanParams($trail, $params) {
		return array_merge($trail, array_intersect_key($params, $trail));
	}
	
	/**
	 * generates trail for Home item
	 * @return array trail item for home.
	 */
	protected function _getHome() {
		
	}
	
	protected function _retrieveElements($notFound){
		foreach($notFound as $key => $crumb) {
			$model = $crumb['model'];
			$conditions = array('slug'=>$crumb['params'][$key]);
			$fields = array('title');
			$result = $model::first(compact('conditions', 'fields'));
			var_dump($result->data());
		}
	}
	
	protected function _getCrumb($crumb, $key){
		$model = $crumb['model'];
		$conditions = array('slug' => $crumb['params'][$key]);
		$fields = array('title');
	}
}
?>