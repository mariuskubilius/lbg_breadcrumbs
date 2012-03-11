<?php
/**
 * Configuration for breadcrumbs generation should come with minimal controller, to manualy delete 
 * indvidual items or to flush all breadcrumbs if something went wrong.
 */
use mg_breadcrumbs\navigation\BreadCrumbs;

BreadCrumbs::config(array(
	'default' => array(
		'adapter' => 'RouteParams',
		'separator' => '/',
		'home' => array(
			'enabled' => true,
			'title' => 'Home',
			'url' => 'resorts',
		),
		'params' => array(
			'location' => array('model' => 'taxonomies\models\Locations'),
			'resort' => array('model' =>'resorts\models\Nodes'),
			'category' => array('model' => 'taxonomies\models\Categories'),
			'entry' => array('model' => 'entry\models\Nodes'),
		),
	),
));
/**
 * 'location' => string 'switzerland' (length=11)
 *	'resort' => string 'gstaad' (length=6)
 *	'category' => string 'tourist-information' (length=19)
 *	'entry' => string 'gstaad-info' (length=11)
 */

