<?php
namespace FluidTYPO3\FluidcontentCore\Tests\Unit\Controller;

/*
 * This file is part of the FluidTYPO3/FluidcontentCore project under GPLv2 or later.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use FluidTYPO3\FluidcontentCore\Controller\CoreContentController;
use FluidTYPO3\FluidcontentCore\Provider\CoreContentProvider;
use FluidTYPO3\Flux\Service\FluxService;
use TYPO3\CMS\Core\Tests\Unit\Resource\BaseTestCase;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Fluid\View\StandaloneView;

/**
 * Class CoreContentControllerTest
 */
class CoreContentControllerTest extends BaseTestCase {

	/**
	 * @return void
	 */
	public function testInitializeProvider() {
		/** @var CoreContentController $instance */
		$instance = $this->getMock('FluidTYPO3\\FluidcontentCore\\Controller\\CoreContentController', array('dummy'));
		/** @var ObjectManager $objectManager */
		$objectManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
		$instance->injectObjectManager($objectManager);
		$this->callInaccessibleMethod($instance, 'initializeProvider');
		$this->assertAttributeInstanceOf('FluidTYPO3\\FluidcontentCore\\Provider\\CoreContentProvider', 'provider', $instance);
	}

	/**
	 * @return void
	 */
	public function testInitializeViewVariables() {
		/** @var CoreContentController|\PHPUnit_Framework_MockObject_MockObject $instance */
		$instance = $this->getMock(
			'FluidTYPO3\\FluidcontentCore\\Controller\\CoreContentController',
			array('getRecord', 'initializeSettings', 'initializeViewObject')
		);
		$instance->expects($this->atLeastOnce())->method('getRecord')->willReturn(array('uid' => 0));
		$instance->expects($this->once())->method('initializeSettings');
		$instance->expects($this->once())->method('initializeViewObject');
		/** @var FluxService|\PHPUnit_Framework_MockObject_MockObject $service */
		$service = $this->getMock('FluidTYPO3\\Flux\\Service\\FluxService', array('convertFlexFormContentToArray'));
		$service->expects($this->exactly(2))->method('convertFlexFormContentToArray')->willReturn(array());
		/** @var ObjectManager $objectManager */
		$objectManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
		$instance->injectObjectManager($objectManager);
		$instance->injectConfigurationService($service);
		$instance->initializeView(new StandaloneView());
	}

	/**
	 * @dataProvider getNoopActionNames
	 * @param string $action
	 */
	public function testNoopAction($action) {
		$instance = new CoreContentController();
		$actionMethod = $action . 'Action';
		$result = $instance->$actionMethod();
		$this->assertNull($result);
	}

	/**
	 * @return array
	 */
	public function getNoopActionNames() {
		return array(
			array('default'),
			array('header'),
			array('text'),
			array('image'),
			array('bullets'),
			array('uploads'),
			array('table'),
			array('media'),
			array('div'),
			array('html')
		);
	}

	/**
	 * @dataProvider getMenuActionTestValues
	 * @param array $record
	 * @param array $expectsVariables
	 * @return void
	 */
	public function testMenuAction(array $record, array $expectsVariables) {
		$GLOBALS['TYPO3_DB'] = $this->getMock('TYPO3\\CMS\\Core\\Database\\DatabaseConnection', array('exec_SELECTgetRows'), array(), '', FALSE);
		$GLOBALS['TYPO3_DB']->expects($this->any())->method('exec_SELECTgetRows')->willReturn(array());
		/** @var CoreContentController|\PHPUnit_Framework_MockObject_MockObject $instance */
		$instance = $this->getMock(
			'FluidTYPO3\\FluidcontentCore\\Controller\\CoreContentController',
			array('getRecord', 'initializeViewVariables', 'initializeViewSettings', 'initializeViewObject', 'initializeSettings')
		);
		$instance->expects($this->any())->method('getRecord')->willReturn($record);
		/** @var StandaloneView|\PHPUnit_Framework_MockObject_MockObject $view */
		$view = $this->getMock('TYPO3\\CMS\\Fluid\\View\\StandaloneView', array('assign'));
		foreach ($expectsVariables as $index => $expectedVariable) {
			$view->expects($this->at($index))->method('assign')->with($expectedVariable, $this->anything());
		}
		/** @var ObjectManager $objectManager */
		$objectManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
		$instance->injectObjectManager($objectManager);
		$this->callInaccessibleMethod($instance, 'initializeProvider');
		$instance->initializeView($view);
		$result = $instance->menuAction();
		$this->assertNull($result);
	}

	/**
	 * @return array
	 */
	public function getMenuActionTestValues() {
		return array(
			array(array(), array()),
			array(array(CoreContentProvider::MENUTYPE_FIELDNAME => CoreContentProvider::MENU_CATEGORIZEDPAGES), array('pageUids')),
			array(array(CoreContentProvider::MENUTYPE_FIELDNAME => CoreContentProvider::MENU_CATEGORIZEDCONTENT), array('contentUids')),
			array(array(CoreContentProvider::MENUTYPE_FIELDNAME => CoreContentProvider::MENU_RELATEDPAGES), array('pageUids')),
		);
	}

	/**
	 * The shortcut action should throw away all non tt_content rows that are associated
	 * to avoid collisions and have a minimal working sample.
	 *
	 * @return void
	 */
	public function testShortcutAction() {

		/** @var CoreContentController|\PHPUnit_Framework_MockObject_MockObject $instance */
		$instance = $this->getMock(
			'FluidTYPO3\\FluidcontentCore\\Controller\\CoreContentController',
			array('getRecord', 'initializeViewVariables', 'initializeViewSettings', 'initializeViewObject', 'initializeSettings')
		);

		$mockView = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$mockView->expects($this->once())->method('assign')->with('contentUids', '45,45,54,87');

		$instance->expects($this->once())
			->method('getRecord')
			->willReturn([
				'uid' => 1234,
				'pid' => 456,
				'records' => 'tt_content_45,45,tt_content_54,87,tt_blafoo_45'
			]);
		$this->inject($instance, 'view', $mockView);

		$instance->shortcutAction();
	}
}
