<?php
namespace FluidTYPO3\FluidcontentCore\Tests\Unit\Service;

/*
 * This file is part of the FluidTYPO3/FluidcontentCore project under GPLv2 or later.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use FluidTYPO3\FluidcontentCore\Service\ConfigurationService;
use FluidTYPO3\FluidcontentCore\Tests\Fixtures\Service\AccessibleConfigurationService;
use FluidTYPO3\Flux\View\TemplatePaths;
use TYPO3\CMS\Core\Tests\UnitTestCase;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

/**
 * Class ConfigurationServiceTest
 */
class ConfigurationServiceTest extends UnitTestCase {

	/**
	 * @var array
	 */
	protected $defaultTypes = array(
		'Bullets', 'Default', 'Div', 'Header', 'Html', 'Image', 'Media', 'Menu', 'Shortcut', 'Table', 'Text', 'Uploads'
	);

	/**
	 * @return void
	 */
	public function testGetAllRegisteredVariants() {
		$GLOBALS['TYPO3_CONF_VARS']['FluidTYPO3.FluidcontentCore']['variants'] = array('foo' => 'bar');
		$instance = new ConfigurationService();
		$result = $instance->getAllRegisteredVariants();
		unset($GLOBALS['TYPO3_CONF_VARS']['FluidTYPO3.FluidcontentCore']['variants']);
		$this->assertEquals(array('foo' => 'bar'), $result);
	}

	/**
	 * @dataProvider getInitializeVariantsTestValues
	 * @param array $variants
	 * @param array $expectedVariants
	 * @param array $expectedVersions
	 */
	public function testInitializeVariants(array $variants, array $expectedVariants, array $expectedVersions) {
		$templatePaths = new TemplatePaths('fluidcontent_core');
		$templatePaths->setTemplateRootPaths(array(ExtensionManagementUtility::extPath('fluidcontent_core', 'Tests/Fixtures/Templates/')));
		$paths = $templatePaths->toArray();
		$instance = new AccessibleConfigurationService();
		$instance->setRegisteredVariants($variants);
		$instance->setViewConfiguration($paths);
		$instance->initializeVariants();
		$this->assertEquals($expectedVariants, $instance->getVariants());
		$this->assertEquals($expectedVersions, $instance->getVersions());
	}

	/**
	 * @return array
	 */
	public function getInitializeVariantsTestValues() {
		return array(
			array(array(), array(), array()),
			array(array(array()), array(), array()),
			array(
				array('test' => array('fluidcontent_core')),
				array('test' => array(array('fluidcontent_core', 'fluidcontent_core.variantLabel', NULL))),
				array('test' => array('fluidcontent_core' => array('Text')))
			),
			array(
				array('test' => array(array('fluidcontent_core', 'customlabel'))),
				array('test' => array(array('fluidcontent_core', 'customlabel', NULL))),
				array('test' => array('fluidcontent_core' => array('Text')))
			),
			array(
				array('test' => array(array('fluidcontent_core', 'customlabel', 'customicon'))),
				array('test' => array(array('fluidcontent_core', 'customlabel', 'customicon'))),
				array('test' => array('fluidcontent_core' => array('Text')))
			),
			array(
				array('test' => array('otherext')),
				array('test' => array(array('otherext', 'fluidcontent_core.variantLabel', NULL))),
				array('test' => array('otherext' => array('Text')))
			),
		);
	}

	/**
	 * @dataProvider getVariantExtensionKeysForContentTypeTestValues
	 * @param array $variants
	 * @param string $contentType
	 * @param array $expected
	 */
	public function testGetVariantExtensionKeysForContentType(array $variants, $contentType, array $expected) {
		$instance = new AccessibleConfigurationService();
		$instance->setVariants($variants);
		$result = $instance->getVariantExtensionKeysForContentType($contentType);
		$this->assertEquals($expected, $result);
	}

	/**
	 * @return array
	 */
	public function getVariantExtensionKeysForContentTypeTestValues() {
		$config = array('fluidcontent_core', 'label', 'icon');
		return array(
			array(array(), 'default', array()),
			array(array('test' => array($config)), 'test', array($config)),
		);
	}

	/**
	 * @dataProvider getVariantVersionsTestValues
	 * @param array $variants
	 * @param array $versions
	 * @param string $contentType
	 * @param string $variant
	 * @param array $expected
	 */
	public function testGetVariantVersions(array $variants, array $versions, $contentType, $variant, array $expected) {
		$instance = new AccessibleConfigurationService();
		$instance->setVariants($variants);
		$instance->setVersions($versions);
		$result = $instance->getVariantVersions($contentType, $variant);
		$this->assertEquals($expected, $result);
	}

	/**
	 * @return array
	 */
	public function getVariantVersionsTestValues() {
		return array(
			array(array(), array(), 'default', 'default', array()),
			array(array('test' => array(array('fluidcontent_core', 'label', 'icon'))), array(), 'test', 'test', array()),
			array(
				array('test' => array(array('fluidcontent_core', 'label', 'icon'))),
				array('test' => array('fluidcontent_core' => array('foo'))),
				'test',
				'fluidcontent_core',
				array('foo')
			),
		);
	}

}
