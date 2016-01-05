<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

// here we register "PasswordEvaluator"
// for editing by tca form
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tce']['formevals']['SpoonerWeb\\BeSecurePw\\Evaluation\\PasswordEvaluator'] = 'EXT:be_secure_pw/Classes/Evaluation/PasswordEvaluator.php';

// for editing per "user settings"
$version7 = \TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionNumberToInteger('7.0.0');
$currentVersion = \TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionNumberToInteger(TYPO3_version);
if ($currentVersion < $version7) {
	$TYPO3_CONF_VARS['SC_OPTIONS']['typo3/template.php']['preStartPageHook'][] = 'SpoonerWeb\\BeSecurePw\\Hook\\UserSetupHook->preStartPageHook';
} else {
	$TYPO3_CONF_VARS['SC_OPTIONS']['ext/setup/mod/index.php']['setupScriptHook'][] = 'SpoonerWeb\\BeSecurePw\\Hook\\UserSetupHook->setupScriptHook';
}
$TYPO3_CONF_VARS['SC_OPTIONS']['typo3/template.php']['moduleBodyPostProcess'][] = 'SpoonerWeb\\BeSecurePw\\Hook\\UserSetupHook->moduleBodyPostProcess';

// password reminder
$TYPO3_CONF_VARS['SC_OPTIONS']['typo3/backend.php']['constructPostProcess'][] = 'SpoonerWeb\\BeSecurePw\\Hook\\BackendHook->constructPostProcess';
$TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass']['be_secure_pw'] = 'SpoonerWeb\\BeSecurePw\\Hook\\BackendHook';

?>
