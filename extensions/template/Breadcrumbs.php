<?php
/**
 * lbg_breadcrumbs plugin for Lithium: the most rad php framework.
 * @author	Marius Kubilius
 * @copyright     Copyright 2012, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace lbg_breadcrumbs\extensions\template;

use lbg_breadcrumbs\extensions\template\BreadcrumbsItem;

class Breadcrumbs extends \lithium\core\Object {
	
	/**
	 * @var array stores all breadcrumbs items
	 */
	protected $_items = array();
		
	protected $_config = array();
	
	public function __construct(array $config = array()) {
		$defaults = array(
			'home' => array(
				'name' => 'Home',
				'uri' => '',
				'options' => array(),
			),
		);
		return parent::__construct($config + $defaults);
	}
	
	public function _init(){
		extract($this->_config['home']);
		$this->setRoot($name, $uri, $options);
	}
	/**
	 * Add item or multiple items to breadcrumbs trail
	 * @param string $name name of breadcrumb
	 * @param string $uri uri of breadcrumb
	 * @param array $options options for breadcrumb
	 */
	
	public function addItem($name, $uri = null, Array $options = array())
	{
		$this->_items[] = new BreadcrumbsItem($name, $uri, $options);
	}
	
	/**
	 * Clear breadcrumbs items array
	 */
	public function clear() {
		$this->_items = array();
	}
	
	/*
	 * Retrieve items of breadcrumb
	 * @param int Offset get the offset in breadcrumbs
	 */
	public function getItems($offset = 0) {
		$items = $this->_items;
		return array_slice($items, $offset);
	}
	
	public function setRoot($name, $uri, Array $options = array())
	{
		$this->_items[0] = new BreadcrumbsItem($name, $uri, $options);
	}

}
?>