<?php
/**
 * Breadcrumbs module for breadcrumbs generation from query parameters, it links query parameters with
 * models so it can easily generate, cache and use cached breadcrumbs later. So it should be flexible 
 * and fast.
 */
namespace mg_breadcrumbs\extensions;

//use app\models\BreadCrumbs;

class BreadCrumbs extends \lithium\core\StaticObject {
		
	protected static $_config = array();
	protected $_params = array();
	protected $_url = NULL;
	
	/**
	 * sets some defaults if config is required.
	 * @var array $config an array of config parameters 
	 * @see app\bootstrap\BreadCrumbs
	 */
	public function config(array $config = array()){
		$config += array(
			'home' => true,
			'homeTitle' => 'Home',
			'homeLink' => '',
			'separator' => '/',
		);
		static::$_config = $config; 
	}
	
	public static function getConfig() {
		return static::$_config;
	}
	/**
	 * Generates home link if home is set to true.
	 */
	protected function _setHome() {
		
	}
	
	/**
	 * Tries to get breadcrumbs using URL
	 */
	public function getBreadcrumbs ($url, array $params) {
		$conditions = array('url' => $url);
		$breadcrumbs = Breadcrumbs::find('first', compact('conditions'));
		if(!$breadcrumbs) {
			$breadcrumbs = $this->setBreadcrumbs($url, $params);
		}
		return $breadcrumbs;
	}
	
	/**
	 * Generates breadcrumb trail from given parameters, 
	 * checks whether some breadcrumbs are already generated
	 */
	public function setBreadcrumbs ($url, array $params) {
		
	}
	
	public function removeUnusedVars() {
		$new_array_without_nulls = array_filter($array_with_nulls);
		
	}
	
	public function removeValues($params){
		var_dump(array_intersect_key($this->_config, $params));
	}
}
?>