<?php
/**
 * lbg_breadcrumbs plugin for Lithium: the most rad php framework.
 * @author	Marius Kubilius
 * @copyright     Copyright 2012, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
namespace lbg_breadcrumbs\tests\cases\extensions\template;

use lbg_breadcrumbs\extensions\template\BreadcrumbsItem;

class BreadcrumbsItemTest extends \lithium\test\Unit {
	
	protected $_result;
	
	public function setUp() {
		
	}

	public function tearDown() {
		
	}
	
	public function testBreadcrumbsItem(){
		$result = new BreadcrumbsItem('name', 'uri', array('options'));
		$this->assertEqual($result->getName(), 'name');
		$this->assertEqual($result->getUri(), 'uri');
		$this->assertTrue(is_array($result->getOptions()));
		$this->assertEqual($result->getOptions(), array('options'));
	}
}
?>