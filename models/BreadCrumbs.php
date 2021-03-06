<?php
namespace mg_breadcrumbs\models;

class BreadCrumbs extends \lithium\data\Model {
	
	protected $_shchema = array(
		'_id' => array('type' => 'id'),
		'adapter' => array('type' => 'string'),
		'url' => array('type' => 'string'),
		'params' => array('type' => 'string', 'array' => true, 'default' => array()),
		'trail' => array('type' => 'string', 'array' => true, 'default' => array()),
	);
}
?>