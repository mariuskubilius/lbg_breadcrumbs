<?php
namespace mg_breadcrumbs\extensions\helper;

class BreadCrumbs extends \lithium\template\Helper {
	
	protected $_classes = array(
		'breadcrumbs' => '\mg_breadcrumbs\navigation\BreadCrumbs',
	);
	
	/**
	 * render breadcrumbs in layout. Calls adapter for breadcrumbs and retrieves them.
	 */
	public function show($key = 'default', array $options = array()) {
		$options += array(
			'type' => 'element',
			'template' => 'breadcrumbs',
			'data' => array(),
			'options' => array(),
			'showHome' => true,
			'home' => array('title' => 'Home', 'url' => '/'),
			'separator' => '/',
		);
		$request = $this->_context->request();
		$url = $request->url;
		$params = $request->params;
		$breadcrumbs = $this->_classes['breadcrumbs'];
		$view = $this->_context->view();
		$output = '';
		$type = array($options['type'] => $options['template']);
		$trail = $breadcrumbs::get($key, $url, $params, $options['options']);

		if ($trail) {
			$trail = $options['showHome'] ? array_merge(array($options['home']), $trail['trail']) : $trail['trail'];
			$data = $options['data'] + array('trail' => $trail, 'separator' => $options['separator']);
					
			try {
				$output = $view->render($type, $data, array());
			} catch (\Exception $e) {
				$output = $view->render($type, $data, array('library' => 'mg_breadcrumbs'));
			}
		}
		return $output;
		 
				
	}
}

?>