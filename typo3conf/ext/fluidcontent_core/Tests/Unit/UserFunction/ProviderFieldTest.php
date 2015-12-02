<?php
namespace FluidTYPO3\FluidcontentCore\Tests\Unit\UserFunction;

/*
 * This file is part of the FluidTYPO3/FluidcontentCore project under GPLv2 or later.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use FluidTYPO3\FluidcontentCore\Provider\CoreContentProvider;
use FluidTYPO3\FluidcontentCore\Tests\Fixtures\Service\AccessibleConfigurationService;
use FluidTYPO3\FluidcontentCore\UserFunction\ProviderField;
use TYPO3\CMS\Core\Tests\BaseTestCase;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class ProviderFieldTest
 */
class ProviderFieldTest extends BaseTestCase {

	/**
	 * @return void
	 */
	public function testPerformsInjections() {
		$instance = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager')
			->get('FluidTYPO3\\FluidcontentCore\\UserFunction\\ProviderField');
		$this->assertAttributeInstanceOf('TYPO3\\CMS\\Extbase\\Object\\ObjectManagerInterface', 'objectManager', $instance);
		$this->assertAttributeInstanceOf('FluidTYPO3\\FluidcontentCore\\Service\\ConfigurationService', 'configurationService', $instance);
	}

	/**
	 * @dataProvider getCreateVariantsFieldTestValues
	 * @param array $variants
	 * @param array $defaults
	 * @param array $parameters
	 * @param array $mustContain
	 */
	public function testCreateVariantsField(array $variants, array $defaults, array $parameters, array $mustContain) {
		$service = new AccessibleConfigurationService();
		$service->setVariants($variants);
		$service->setDefaults($defaults);
		$instance = new ProviderField();
		$instance->injectConfigurationService($service);
		$result = $instance->createVariantsField($parameters);
		foreach ($mustContain as $requiredContent) {
			$this->assertContains($requiredContent, $result);
		}
	}

	/**
	 * @return array
	 */
	public function getCreateVariantsFieldTestValues() {
		return array(
			array(array(), array(), array(), array('<select', '<option selected="selected" value="">Standard</option>')),
			array(
				array('test' => array(array('fluidcontent_core', 'label', 'icon'))),
				array(),
				array('row' => array('CType' => 'not-test')),
				array('<select', '<option')
			),
			array(
				array('test' => array('fluidcontent_core' => array('fluidcontent_core', 'label', 'icon'))),
				array('mode' => CoreContentProvider::MODE_PRESELECT, 'variant' => 'fluidcontent_core'),
				array('row' => array('CType' => 'test')),
				array('<select', '<option', 'value="fluidcontent_core"')
			),
			array(
				array('test' => array(array('fluidcontent_core', 'label', 'icon'))),
				array(),
				array('row' => array('CType' => 'test', 'content_variant' => 'test')),
				array('<select', '<option', 'value="fluidcontent_core"')
			),
			array(
				array('test' => array(array('fluidcontent_core', 'label', 'icon'))),
				array(),
				array('row' => array('CType' => 'test', 'content_variant' => 'invalid')),
				array('<select', '<option', 'INVALID: ')
			),
		);
	}

	/**
	 * @dataProvider getCreateVersionsFieldTestValues
	 * @param array $variants
	 * @param array $versions
	 * @param array $defaults
	 * @param array $parameters
	 * @param array $mustContain
	 */
	public function testCreateVersionsField(array $variants, array $versions, array $defaults, array $parameters, array $mustContain) {
		$service = new AccessibleConfigurationService();
		$service->setVariants($variants);
		$service->setVersions($versions);
		$service->setDefaults($defaults);
		$instance = new ProviderField();
		$instance->injectConfigurationService($service);
		$result = $instance->createVersionsField($parameters);
		foreach ($mustContain as $requiredContent) {
			$this->assertContains($requiredContent, $result);
		}
	}

	/**
	 * @return array
	 */
	public function getCreateVersionsFieldTestValues() {
		return array(
			array(array(), array(), array(), array(), array('<select', '<option selected="selected" value="">Standard</option>')),
			array(
				array('test' => array(array('fluidcontent_core', 'label', 'icon'))),
				array(),
				array(),
				array('row' => array('CType' => 'not-test')),
				array('<select', '<option')
			),
			array(
				array('test' => array('ver' => array('ver', 'label', 'icon'))),
				array('test' => array('ver' => array('Test'))),
				array('mode' => CoreContentProvider::MODE_PRESELECT, 'version' => 'ver'),
				array('row' => array('CType' => 'test', 'content_variant' => 'ver', 'content_version' => 'Test')),
				array('<select', '<option', 'value="Test"', 'selected="selected"')
			),
			array(
				array('test' => array(array('fluidcontent_core', 'label', 'icon'))),
				array('test' => array('ver' => array('Test'))),
				array('mode' => CoreContentProvider::MODE_PRESELECT, 'version' => 'Test', 'variant' => 'ver'),
				array('row' => array('CType' => 'test', 'content_variant' => '', 'content_version' => '')),
				array('<select', '<option', 'value="Test"', 'selected="selected"')
			),
		);
	}

}
