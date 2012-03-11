<?php
/**
 * Breadcrumbs module for breadcrumbs generation from query parameters, it links query parameters with
 * models so it can easily generate, cache and use cached breadcrumbs later. So it should be flexible 
 * and fast.
 */
namespace mg_breadcrumbs\breadcrumbs;
/**
 * The `BreadCrumbs` static class provides a consistent interface to configure and utilize the different
 * breadcrumbs handling adatpers included, as well as your own adapters.
 *
 * In most cases, you will configure various named Breadcrumbs configurations in your bootstrap process,
 * which will then be available to you in all other parts of your application.
 *
 * A simple example configuration:
 *
 *	{{{BreadCrumbs::config(array(
 *		'frontend' => array(
 *			'separator' => '/',
 *			'home' => array(
 *			'enabled' => true,
 *			'title' => 'Home',
 *			'url' => 'resorts',
 *		),
 *		'params' => array(
 *			'location' => array('model' => 'taxonomies\models\Locations'),
 *			'resort' => array('model' =>'resorts\models\Nodes'),
 *			'category' => array('model' => 'taxonomies\models\Categories'),
 *			'entry' => array('model' => 'entry\models\Nodes'),
 *		),
 *	));}}}
 *
 * @see lithium\core\Adaptable
 * @see mg_breadcrumbs\extensions\breacrumbs\adapter
 */

//use app\models\BreadCrumbs;

class BreadCrumbs extends \lithium\core\Adaptable {
		
	/**
	 * Stores configurations for FileSystem adapters
	 *
	 * @var array
	 */
	protected static $_configurations = array();

	/**
	 * Libraries::locate() compatible path to adapters for this class.
	 *
	 * @var string Dot-delimited path.
	 */
	protected static $_adapters = 'adapter.breadcrumbs';
	
	/**
	 * Libraries::locate() compatible path to strategies for this class.
	 *
	 * @var string Dot-delimited path.
	 */
	protected static $_strategies = 'strategy.breadcrumbs';
	/**
	 * Writes file from tmp to the specified filesystem configuration.
	 *
	 * @param string $name Configuration to be used for writing
	 * @param string $filename a full path with filename and extension to be written
	 * @param mixed $data usualy an output of file field
	 * @param mixed $options Options for the method, filters and strategies.
	 * @return boolean True on successful FileSystem write, false otherwise
	 * @filter This method may be filtered.
	 * @TODO implement configurations
	 */
	
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
	
	/**
	 * Logic to set crumb item for current set of params
	 */
	public function setCrumb() {
		
	}
	
	public function removeUnusedVars() {
		$new_array_without_nulls = array_filter($array_with_nulls);
		
	}
	
	public function removeValues($params){
		var_dump(array_intersect_key($this->_config, $params));
	}
}
?>