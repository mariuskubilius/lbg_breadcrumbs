<?php
/**
 * Lithium Filesystem: managing file uploads the easy way
 *
 * @copyright     Copyright 2012, Little Boy Genius (http://www.littleboygenius.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace lbg_breadcrumbs\tests\cases\extensions\template;

use lbg_breadcrumbs\extensions\template\Breadcrumbs;

class BreadcrumbsTest extends \lithium\test\Unit {
	
	protected $_configuration = array(
		'home' => array(
			'name' => 'testName',
			'uri' => 'testURI',
			'options' => array('testOptions'),
		),
	);
	
	public function setUp() {
		$this->breadcrumbs = new Breadcrumbs($this->_configuration);
	}

	public function tearDown() {
		unset($this->breadcrumbs);
	}
	
	public function testInit(){
		
	}
	
	public function testaddItem(){
		$this->breadcrumbs->clear(); 
		$this->breadcrumbs->addItem('testName', 'testURI', array('testOptions'));
		$result = $this->breadcrumbs->getItems();
		$this->assertTrue(is_array($result));
		$this->assertTrue(is_object($result[0]));
		$this->assertEqual($result[0]->getName(), 'testName');
		$this->assertEqual($result[0]->getUri(), 'testURI');
		$this->assertEqual($result[0]->getOptions(), array('testOptions'));
	}
	
	public function testclear(){
		$result = $this->breadcrumbs->getItems();
		$this->assertFalse(empty($result));
		$this->breadcrumbs->clear();
		$result = $this->breadcrumbs->getItems();
		$this->assertTrue(empty($result));
	}
	
	public function testsetRoot(){
		$this->breadcrumbs->setRoot('changedName', 'changedURI', array('changedOptions'));
		$result = $this->breadcrumbs->getItems();
		$this->assertEqual($result[0]->getName(), 'changedName');
		$this->assertEqual($result[0]->getUri(), 'changedURI');
		$this->assertEqual($result[0]->getOptions(), array('changedOptions'));
		
	}
}
?>