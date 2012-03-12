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
			$result = $this->_setTrail($params, $url);
		}
		var_dump($result);
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
		$result = $breadcrumbs ? $breadcrumbs->data() : false; 
		return $result;
		
	}
	
	
	protected function _setTrail($params, $url) {
		$router = $this->_classes['router'];
		$trailComponents = $this->_getTrailComponents($params);
		$trailParams = $this->_getCleanParams($trailComponents, $params);
		$notFound = array();
		$trailComponents = array_reverse($trailComponents, true);
		foreach ($trailComponents as $key => $trailComponent){
			$trailComponent['params'] = $this->_getCleanParams($trailComponent['params'], $trailParams);
			$routeUrl = $router::match($trailComponent['params']);
			$trailComponent['url'] = $routeUrl;
			$result = $this->_getTrail($url);
			if($result) {
				break;
			}
			else{
				$notFound[$key] = $trailComponent;
			}
		}
		if(!isset($result)){
			$result = array();
			$result['trail'] = array(); 
		}
		var_dump($result);
		$result['url'] = $url;
		$notFound = array_reverse($notFound);
		foreach($notFound as $key => $crumb) {
			$trail = $this->_getCrumb($crumb, $key);
			$trail['url'] = $crumb['url'];
			$result['trail'][] = $trail; 
		}
		if($result['trail']){
			return $this->_saveTrail($result)? $result : false;
		}
		else return false;
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
	
	protected function _getCrumb($crumb, $key){
		$model = $crumb['model'];
		$conditions = array('slug' => $crumb['params'][$key]);
		$fields = array('_id'=>false, 'title');
		$result = $model::first(compact('conditions', 'fields'));
		$result = $result ? $result->data() : false;
		return $result;
	}
	
	protected function _saveTrail($data){
		$breadcrumbs = $this->_classes['breadcrumbs'];
		$result = $breadcrumbs::create($data);
		return $result->save()?true:false;
	}
}
?>