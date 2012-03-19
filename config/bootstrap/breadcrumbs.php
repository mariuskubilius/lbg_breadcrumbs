<?php
/**
 * Configuration for breadcrumbs generation should come with minimal controller, to manualy delete 
 * indvidual items or to flush all breadcrumbs if something went wrong.
 */
use mg_breadcrumbs\navigation\BreadCrumbs;

BreadCrumbs::config(array(
	'frontend' => array(
		'adapter' => 'RouteParams',
		'trail' => array(
			'location' => array(
				'params' => array(
					'controller' => 'Resorts', 
					'action' => 'index',
					'location' => null,
				),
				'model' => 'taxonomy\models\Locations',
			),
			
			'resort' => array(
				'params' => array(
					'controller' => 'Resorts', 
					'action' => 'view',
					'location' => null,
					'resort' => null,
				),
				'model' => 'entry\models\Resorts', 
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

