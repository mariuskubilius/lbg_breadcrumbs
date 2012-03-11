<?php
namespace mg_breadcrumbs\models;

class BreadCrumbs extends \lithium\data\model {
	
	protected $_shchema = array(
		'_id' => array('type' => 'id'),
		'url' => array('type' => 'string'),
		'params' => array('type' => 'string', 'array' => true, 'default' => array()),
		'trail' => array('type' => 'string', 'array' => true, 'default' => array()),
	);
}
?>