<?php
defined('TYPO3_MODE') or die();

if (TYPO3_MODE == 'BE' && !(TYPO3_REQUESTTYPE & TYPO3_REQUESTTYPE_INSTALL)) {
	/**
	 * Registers a Backend Module
	 */
	// GDlib is a requirement for the Font Maker module
	if ($GLOBALS['TYPO3_CONF_VARS']['GFX']['gdlib']) {
		// SJBR\SrFreecap\Domain\Model\Font uses declare(encoding='ISO-8859-2') which, since PHP 5.4 requires zend.multibyte to be set to On'.
		// However, this has to be set in php.ini, .htaccess, httpd.conf or .user.ini, because the setting zend.multibyte is of type PHP_INI_PERDIR
		// See http://php.net/manual/en/configuration.changes.modes.php
		\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
			'SJBR.' . $_EXTKEY,
			// Make module a submodule of 'tools'
			'tools',
			// Submodule key
			'FontMaker',
			// Position
			'',
			// An array holding the controller-action combinations that are accessible
			array(
				'FontMaker' => 'new,create'
			),
			array(
				'access' => 'user,group',
				'icon' => 'EXT:' . $_EXTKEY . '/Resources/Public/Images/moduleicon.gif',
				'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_mod.xlf'
			)
		);
	}
}