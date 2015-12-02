<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

if (FALSE === isset($GLOBALS['TYPO3_CONF_VARS']['FE']['contentRenderingTemplates'])) {
	\TYPO3\CMS\Core\Utility\GeneralUtility::sysLog('FluidcontentCore requires an additional configuration file in typo3conf/AdditionalConfiguration.php - '
		. 'you can have FluidcontentCore generate this file for you from the extension manager by running the FluidcontentCore update script. A dummy '
		. 'has been created, but you will only be able to render content (not plugins!) until the file is created',
		'fluidcontent_core',
		\TYPO3\CMS\Core\Utility\GeneralUtility::SYSLOG_SEVERITY_WARNING
	);
	$GLOBALS['TYPO3_CONF_VARS']['FE']['contentRenderingTemplates'] = array(
		'fluidcontentcore/Configuration/TypoScript/',
	);
}

$GLOBALS['TYPO3_CONF_VARS']['FluidTYPO3.FluidcontentCore']['types'] = array(
	'header', 'text', 'image', 'bullets', 'uploads', 'table', 'media', 'menu', 'shortcut', 'div', 'html', 'default'
);

\FluidTYPO3\Flux\Core::registerConfigurationProvider('FluidTYPO3\FluidcontentCore\Provider\CoreContentProvider');
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms']['db_new_content_el']['wizardItemsHook']['fluidcontent_core'] = 'FluidTYPO3\FluidcontentCore\Hooks\WizardItemsHookSubscriber';

// Prepare a global variants registration array indexed by CType value.
// To add your own, do fx: $GLOBALS['TYPO3_CONF_VARS']['FluidTYPO3.FluidcontentCore']['variants']['textpic'][] = 'myextensionkey';
$GLOBALS['TYPO3_CONF_VARS']['FluidTYPO3.FluidcontentCore']['variants'] = array_combine(
	array_values($GLOBALS['TYPO3_CONF_VARS']['FluidTYPO3.FluidcontentCore']['types']),
	array_fill(0, count($GLOBALS['TYPO3_CONF_VARS']['FluidTYPO3.FluidcontentCore']['types']), array())
);

$types = count($GLOBALS['TYPO3_CONF_VARS']['FluidTYPO3.FluidcontentCore']['types']);
for ($i = 0; $i < $types; $i++) {
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'FluidTYPO3.FluidcontentCore',
		ucfirst($GLOBALS['TYPO3_CONF_VARS']['FluidTYPO3.FluidcontentCore']['types'][$i]),
		array('CoreContent' => 'render,error'),
		array());
}
unset($types, $i);

// Include new content elements to modWizards
if (TRUE === version_compare(TYPO3_version, '7.3', '>')) {
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:fluidcontent_core/Configuration/PageTS/modWizards.ts">');
}
