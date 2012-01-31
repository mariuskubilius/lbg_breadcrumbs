<?php
/**
 * lbg_breadcrumbs plugin for Lithium: the most rad php framework.
 * @author	Marius Kubilius
 * @copyright     Copyright 2012, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace lbg_breadcrumbs\extensions\template;

class BreadcrumbsItem {
	
	protected $_name;
	protected $_uri;
	protected $_options;
	
	
	public function __construct($name, $uri = null, array $options = array()) {
		$this->_name = $name;
		$this->_uri = $uri;
		$this->_options = $options;
	}
	
	public function getName() {
		return $this->_name;
	}
	
	public function getUri() {
		return $this->_uri;
	}
	
	public function getOptions() {
		return $this->_options;
	}
}
?>