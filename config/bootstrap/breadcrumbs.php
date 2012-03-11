<?php
/**
 * Configuration for breadcrumbs generation should come with minimal controller, to manualy delete 
 * indvidual items or to flush all breadcrumbs if something went wrong.
 */
use mg_breadcrumbs\navigation\BreadCrumbs;

BreadCrumbs::config(array(
	'frontend' => array(
		'adapter' => 'RouteParams',
		'separator' => '/',
		'home' => array(
			'enabled' => true,
			'title' => 'Home',
			'url' => 'resorts',
		),
		'trail' => array(
			'location' => array(
				'params' => array(
					'controller' => 'Resorts', 
					'action' => 'index',
					'location' => null,
				),
				'model' => 'taxonomy\models\Locations',
				'hierarchical' => true, 
			),
			
			'resort' => array(
				'params' => array(
					'controller' => 'Resorts', 
					'action' => 'view',
					'location' => null,
					'resort' => null,
				),
				'model' => 'resorts\models\Nodes', 
			),
			'category' => array(
				'params' => array(
					'controller' => 'Resorts', 
					'action' => 'view',
					'location' => null,
					'resort' => null,
					'category' => null,
				),
				'model' => 'taxonomy\models\Categories',
				'hierarchical' => true 
			),
			'entry' => array(
				'params' => array(
					'controller' => 'Entries', 
					'action' => 'view',
					'location' => null,
					'resort' => null,
					'category' => null,
					'entry' => null, 
				),
				'model' => 'entry\models\Nodes', 
			),
		),
)));
/**
 * 'location' => string 'switzerland' (length=11)
 *	'resort' => string 'gstaad' (length=6)
 *	'category' => string 'tourist-information' (length=19)
 *	'entry' => string 'gstaad-info' (length=11)
 */

