<?php
namespace In2code\Powermail\Utility;

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 in2code.de
 *  Alex Kellner <alexander.kellner@in2code.de>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Class TypoScriptUtility
 *
 * @package In2code\In2publish\Utility
 */
class TypoScriptUtility {

	/**
	 * Overwrite a string if a TypoScript cObject is available
	 *
	 * @param string $string Value to overwrite
	 * @param array $conf TypoScript Configuration Array
	 * @param string $key Key for TypoScript Configuration
	 * @return void
	 */
	public static function overwriteValueFromTypoScript(&$string = NULL, $conf, $key) {
		/** @var ConfigurationManager $configurationManager */
		$configurationManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager')
			->get('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManager');
		$contentObject = $configurationManager->getContentObject();
		if ($contentObject->cObjGetSingle($conf[$key], $conf[$key . '.'])) {
			$string = $contentObject->cObjGetSingle($conf[$key], $conf[$key . '.']);
		}
	}

	/**
	 * Parse TypoScript from path like lib.blabla
	 *
	 * @param $typoScriptObjectPath
	 * @return string
	 */
	public static function parseTypoScriptFromTypoScriptPath($typoScriptObjectPath) {
		if (empty($typoScriptObjectPath)) {
			return '';
		}
		$setup = $GLOBALS['TSFE']->tmpl->setup;
		/** @var ConfigurationManager $configurationManager */
		$configurationManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager')
			->get('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManager');
		$contentObject = $configurationManager->getContentObject();
		$pathSegments = GeneralUtility::trimExplode('.', $typoScriptObjectPath);
		$lastSegment = array_pop($pathSegments);
		foreach ($pathSegments as $segment) {
			$setup = $setup[$segment . '.'];
		}
		return $contentObject->cObjGetSingle($setup[$lastSegment], $setup[$lastSegment . '.']);
	}

	/**
	 * Return configured captcha extension
	 *
	 * @param array $settings
	 * @return string
	 */
	public static function getCaptchaExtensionFromSettings($settings) {
		$allowedExtensions = array(
			'captcha'
		);
		if (
			in_array($settings['captcha.']['use'], $allowedExtensions) &&
			ExtensionManagementUtility::isLoaded($settings['captcha.']['use'])
		) {
			return $settings['captcha.']['use'];
		}
		return 'default';
	}
}
