<?php
namespace FluidTYPO3\FluidcontentCore\Tests\Unit\Provider;

/*
 * This file is part of the FluidTYPO3/FluidcontentCore project under GPLv2 or later.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use FluidTYPO3\FluidcontentCore\Provider\CoreContentProvider;
use FluidTYPO3\FluidcontentCore\Service\ConfigurationService;
use FluidTYPO3\Flux\Form;
use FluidTYPO3\Flux\Service\ContentService;
use TYPO3\CMS\Core\DataHandling\DataHandler;
use TYPO3\CMS\Core\Tests\UnitTestCase;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class CoreContentProviderTest
 */
class CoreContentProviderTest extends UnitTestCase {

	/**
	 * @param array $row
	 * @param string $table
	 * @param string $field
	 * @param boolean $expected
	 * @test
	 * @dataProvider getTriggerTestValues
	 */
	public function testTrigger(array $row, $table, $field, $expected) {
		$instance = new CoreContentProvider();
		$result = $instance->trigger($row, $table, $field);
		$this->assertEquals($expected, $result);
	}

	/**
	 * @return array
	 */
	public function getTriggerTestValues() {
		return array(
			array(array(), 'tt_content', 'content_options', TRUE),
			array(array(), 'tt_content', NULL, TRUE),
			array(array(), 'tt_content', 'pi_flexform', FALSE),
		);
	}

	/**
	 * @dataProvider getFormTestValues
	 * @param array $record
	 */
	public function testGetForm(array $record) {
		/** @var CoreContentProvider $instance */
		$instance = $this->getMock(
			'FluidTYPO3\\FluidcontentCore\\Provider\\CoreContentProvider',
			array('resolveFormClassName', 'setDefaultValuesInFieldsWithInheritedValues')
		);
		/** @var Form $form */
		$form = Form::create();
		$instance->setForm($form);
		$result = $instance->getForm($record);
		$this->assertInstanceOf('FluidTYPO3\\Flux\\Form', $result);
	}

	/**
	 * @return array
	 */
	public function getFormTestValues() {
		return array(
			array(array()),
			array(array(CoreContentProvider::CTYPE_FIELDNAME => CoreContentProvider::CTYPE_MENU)),
			array(array(CoreContentProvider::CTYPE_FIELDNAME => CoreContentProvider::CTYPE_TABLE))
		);
	}

	/**
	 * @dataProvider getExtensionKeyTestValues
	 * @param array $row
	 * @param string|NULL $expected
	 */
	public function testGetExtensionKey(array $row, $expected) {
		$instance = new CoreContentProvider();
		$result = $instance->getExtensionKey($row);
		$this->assertEquals($expected, $result);
	}

	/**
	 * @return array
	 */
	public function getExtensionKeyTestValues() {
		return array(
			array(array(), 'fluidcontent_core'),
			array(array('content_variant' => 'test'), 'test'),
			array(array('content_variant' => 'Vendor.Test'), 'test')
		);
	}

	/**
	 * @dataProvider getControllerExtensionKeyTestValues
	 * @param array $row
	 * @param string|NULL $expected
	 */
	public function testGetControllerExtensionKeyFromRecord(array $row, $expected) {
		$instance = new CoreContentProvider();
		$result = $instance->getControllerExtensionKeyFromRecord($row);
		$this->assertEquals($expected, $result);
	}

	/**
	 * @return array
	 */
	public function getControllerExtensionKeyTestValues() {
		return array(
			array(array(), 'FluidTYPO3.FluidcontentCore'),
			array(array('content_variant' => 'test'), 'test'),
			array(array('content_variant' => 'Vendor.Test'), 'Vendor.Test')
		);
	}

	/**
	 * @dataProvider getVariantVersionTestValues
	 * @param array $row
	 * @param string $expected
	 */
	public function testGetVariant(array $row, $expected) {
		$defaults = array('version' => 'version', 'variant' => 'variant');
		$instance = new CoreContentProvider();
		/** @var ConfigurationService|\PHPUnit_Framework_MockObject_MockObject $service */
		$service = $this->getMock('FluidTYPO3\\FluidcontentCore\\Service\\ConfigurationService', array('getDefaults'));
		$service->expects($this->once())->method('getDefaults')->willReturn($defaults);
		$instance->injectConfigurationService($service);
		$result = $this->callInaccessibleMethod($instance, 'getVariant', $row);
		$this->assertEquals(NULL === $expected ? $defaults['variant'] : $expected, $result);
	}

	/**
	 * @dataProvider getVariantVersionTestValues
	 * @param array $row
	 * @param string $expected
	 */
	public function testGetVersion(array $row, $expected) {
		$defaults = array('version' => 'version', 'variant' => 'variant');
		$instance = new CoreContentProvider();
		/** @var ConfigurationService|\PHPUnit_Framework_MockObject_MockObject $service */
		$service = $this->getMock('FluidTYPO3\\FluidcontentCore\\Service\\ConfigurationService', array('getDefaults'));
		$service->expects($this->once())->method('getDefaults')->willReturn($defaults);
		$instance->injectConfigurationService($service);
		$result = $this->callInaccessibleMethod($instance, 'getVersion', $row);
		$this->assertEquals(NULL === $expected ? $defaults['version'] : $expected, $result);
	}

	/**
	 * @return array
	 */
	public function getVariantVersionTestValues() {
		return array(
			array(array(), NULL),
			array(array('content_version' => '1', 'content_variant' => '1'), '1'),
		);
	}

	/**
	 * @dataProvider getControllerActionFromRecordTestValues
	 * @param array $row
	 * @param string|NULL $expected
	 */
	public function testGetControllerActionFromRecord(array $row, $expected) {
		$instance = new CoreContentProvider();
		$result = $instance->getControllerActionFromRecord($row);
		$this->assertEquals($expected, $result);
	}

	/**
	 * @return array
	 */
	public function getControllerActionFromRecordTestValues() {
		return array(
			array(array(), NULL),
			array(array('CType' => 'test'), 'test'),
			array(array('CType' => 'Test'), 'test'),
			array(array('CType' => 'CamelCase'), 'camelcase'),
			array(array('CType' => 'under_scored'), 'under_scored'),
		);
	}

	/**
	 * @dataProvider getPostProcessRecordTestValues
	 * @param array $row
	 * @param array $defaults
	 * @param array $expected
	 */
	public function testPostProcessRecord(array $row, array $defaults, $expected) {
		$instance = new CoreContentProvider();
		/** @var ConfigurationService|\PHPUnit_Framework_MockObject_MockObject $service */
		$service = $this->getMock('FluidTYPO3\\FluidcontentCore\\Service\\ConfigurationService', array('getDefaults'));
		/** @var ContentService|\PHPUnit_Framework_MockObject_MockObject $contentService */
		$contentService = $this->getMock('FluidTYPO3\\Flux\\Service\\ContentService', array('affectRecordByRequestParameters'));
		$contentService->expects($this->any())->method('affectRecordByRequestParameters');
		$service->expects($this->once())->method('getDefaults')->willReturn($defaults);
		$instance->injectConfigurationService($service);
		$instance->injectContentService($contentService);
		$copy = $row;
		$handler = new DataHandler();
		$instance->postProcessRecord('anything', 1, $copy, $handler);
		$this->assertEquals($expected, $copy);
	}

	/**
	 * @return array
	 */
	public function getPostProcessRecordTestValues() {
		return array(
			array(array(), array(), array()),
			array(array(), array('version' => 'test'), array()),
			array(array(), array('variant' => 'test'), array()),
			array(
				array(),
				array('version' => 'test', 'variant' => 'test2', 'mode' => CoreContentProvider::MODE_RECORD),
				array('content_version' => 'test', 'content_variant' => 'test2')
			),
			array(
				array(),
				array('variant' => 'test', 'version' => 'test2', 'mode' => CoreContentProvider::MODE_RECORD),
				array('content_variant' => 'test', 'content_version' => 'test2')
			),
		);
	}

	/**
	 * @dataProvider getTemplatePathsTestValues
	 * @param array $row
	 * @param array $expected
	 */
	public function testGetTemplatePaths(array $row, array $expected) {
		/** @var CoreContentProvider $instance */
		$instance = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager')
			->get('FluidTYPO3\\FluidcontentCore\\Provider\\CoreContentProvider');
		$instance->setTemplatePaths(array());
		$result = $instance->getTemplatePaths($row);
		$this->assertEquals($expected, $result);
	}

	/**
	 * @return array
	 */
	public function getTemplatePathsTestValues() {
		$paths1 = array(
			'templateRootPaths' => array('EXT:test/Resources/Private/Templates/'),
			'partialRootPaths' => array('EXT:test/Resources/Private/Partials/'),
			'layoutRootPaths' => array('EXT:test/Resources/Private/Layouts/'),
		);
		$paths2 = array(
			'templateRootPaths' => array('EXT:test2/Resources/Private/Templates/'),
			'partialRootPaths' => array('EXT:test2/Resources/Private/Partials/'),
			'layoutRootPaths' => array('EXT:test2/Resources/Private/Layouts/'),
		);
		return array(
			array(array(), array()),
			array(array('content_variant' => 'test'), $paths1),
			array(array('content_variant' => 'test2'), $paths2),
		);
	}

}
