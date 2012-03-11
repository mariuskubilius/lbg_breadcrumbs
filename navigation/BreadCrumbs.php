<?php
/**
 * Breadcrumbs module for breadcrumbs generation from query parameters, it links query parameters with
 * models so it can easily generate, cache and use cached breadcrumbs later. So it should be flexible 
 * and fast.
 */
namespace mg_breadcrumbs\navigation;
/**
 * The `BreadCrumbs` static class provides a consistent interface to configure and utilize the different
 * breadcrumbs handling adatpers included, as well as your own adapters.
 *
 * In most cases, you will configure various named Breadcrumbs configurations in your bootstrap process,
 * which will then be available to you in all other parts of your application.
 *
 * @see lithium\core\Adaptable
 * @see mg_breadcrumbs\extensions\navigation\breacrumbs\adapter
 */

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
	protected static $_adapters = 'adapter.navigation.breadcrumbs';
	
	/**
	 * Libraries::locate() compatible path to strategies for this class.
	 *
	 * @var string Dot-delimited path.
	 */
	//protected static $_strategies = 'strategy.navigation.breadcrumbs';
	
	/**
	 * Reads file from the specified filesystem configuration
	 *
	 * @param string $name Configuration to be used for reading
	 * @param string $url an url retrieved from request used to determine breadcrumb trail
	 * @param array $params params retrieved from request->params to create breadcrumb trail if non existent.
	 * @param mixed $options Options for the method and strategies.
	 * @return array an array of breadcrumb trail
	 * @filter This method may be filtered.
	 */
	public static function get($name, $url, array $params, array $options = array()) {
		$settings = static::config();
		if(!isset($settings[$name])) {
			return false;
		}

		$method = static::adapter($name)->get($url, $params);
		$params = compact('url', 'params', 'options');
		return static::_filter(__FUNCTION__, $params, $method, $settings[$name]['filters']);
	}
	
}
?>