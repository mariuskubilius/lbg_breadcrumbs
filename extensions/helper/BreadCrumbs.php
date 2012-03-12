<?php
namespace mg_breadcrumbs\extensions\helper;

class BreadCrumbs extends \lithium\template\Helper {
	
	protected $_classes = array(
		'breadcrumbs' => '\mg_breadcrumbs\navigation\BreadCrumbs',
	);
	
	public function output($key = 'default', array $options = array()) {
		
	}
}

?>