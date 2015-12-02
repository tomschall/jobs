<?php
namespace SJBR\SrFreecap\Utility;
/***************************************************************
 * Copyright notice
 *
 * 2010 Daniel Lienert <daniel@lienert.cc>, Michael Knoll <mimi@kaktusteam.de>
 * 2012-2015 Stanislas Rolland <typo3(arobas)sjbr.ca>
 * All rights reserved
 *
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\VersionNumberUtility;

/**
 * Utility to dispatch the eid request
 *
 * @author Daniel Lienert <daniel@lienert.cc>
 * @author Stanislas Rolland <typo3(arobas)sjbr.ca>
*/
class EidUtility {

	/**
	 * Array of all request Arguments
	 *
	 * @var array
	 */
	protected $requestArguments = array();

	/**
	 * Extbase Object Manager
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManager
	 */
	protected $objectManager;

	/**
	 * @var string
	 */
	protected $vendorName;

	/**
	 * @var string
	 */
	protected $extensionName;

	/**
	 * @var string
	 */
	protected $pluginName;

	/**
	 * @var string
	 */
	protected $controllerName;

	/**
	 * @var string
	 */
	protected $actionName;

	/**
	 * @var string
	 */
	protected $formatName;

	/**
	 * @var array
	 */
	protected $arguments = array();

	/**
	 * @var integer
	 */
	protected $pageUid;

	/**
	 * Constructor
	 *
	 */
	public function __construct() {
		$this->objectManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
	}

	/**
	 * Initializes and dispatches actions
	 *
	 * Call this function if you want to use this dispatcher "standalone"
	 */
	public function initAndDispatch() {
		return $this->initTypoScriptFrontendController()
			->initTypoScriptConfiguration()
			->initLanguage()
			->initCallArguments()
			->dispatch();
	}

	/**
	 * Builds an extbase context and returns the response
	 *
	 */
	protected function dispatch() {
		/* @var $bootstrap \TYPO3\CMS\Extbase\Core\Bootstrap */
		$bootstrap = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Core\\Bootstrap');
		$configuration['vendorName'] = $this->vendorName;
		$configuration['extensionName'] = $this->extensionName;
		$configuration['pluginName'] = $this->pluginName;
		$bootstrap->initialize($configuration);
		$request = $this->buildRequest();
		/* @var $response \TYPO3\CMS\Extbase\Mvc\Web\Response */
		$response = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Mvc\\Web\\Response');
		/* @var $dispatcher \TYPO3\CMS\Extbase\Mvc\Dispatcher */
		$dispatcher = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Mvc\\Dispatcher');
		$dispatcher->dispatch($request, $response);
		if ($GLOBALS ['TSFE']->fe_user) {
			$GLOBALS ['TSFE']->fe_user->storeSessionData();
		}
		return $response->getContent();
	}

	/**
	 * Create a TypoScript Frontend Controller
	 *
	 * @return \SJBR\SrFreecap\Utility\EidDispatcher
	 */
	protected function initTypoScriptFrontendController() {
		// Get page uid and mount point, if any
		$this->pageUid = GeneralUtility::_GET('id');
		if (!isset($this->pageUid)) {
			$this->pageUid = 0;
		}
		$this->pageUid = htmlspecialchars($this->pageUid);
		$MP = htmlspecialchars(GeneralUtility::_GET('MP'));
		$GLOBALS['TSFE'] = $this->objectManager->get('TYPO3\\CMS\\Frontend\\Controller\\TypoScriptFrontendController', $GLOBALS['TYPO3_CONF_VARS'], $this->pageUid, '0', TRUE, '', '', $MP, '');
		\TYPO3\CMS\Frontend\Utility\EidUtility::initTCA();
		$GLOBALS['TSFE']->sys_page = $this->objectManager->get('TYPO3\\CMS\\Frontend\\Page\\PageRepository');
		$GLOBALS['TSFE']->initFeUser();
		$GLOBALS['TSFE']->determineId();
		return $this;
	}

	/**
	 * Get the TypoScript configuration
	 *
	 * @return \SJBR\SrFreecap\Utility\EidDispatcher
	 */
	protected function initTypoScriptConfiguration() {
		$GLOBALS['TSFE']->getPageAndRootline();
		$GLOBALS['TSFE']->initTemplate();
		$GLOBALS['TSFE']->tmpl->getFileName_backPath = PATH_site;
		$GLOBALS['TSFE']->getConfigArray();
		return $this;
	}

	/**
	 * Set  language and locale
	 *
	 * @return \SJBR\SrFreecap\Utility\EidDispatcher
	 */
	protected function initLanguage() {
		$GLOBALS['TSFE']->settingLanguage();
		$GLOBALS['TSFE']->settingLocale();
		return $this;
	}

	/**
	 * Build a request object
	 *
	 * @return \TYPO3\CMS\Extbase\Mvc\Web\Request $request
	 */
	protected function buildRequest() {
		/* @var $request \TYPO3\CMS\Extbase\Mvc\Web\Request */
		$request = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Mvc\\Web\\Request');
		$request->setControllerVendorName($this->vendorName);
		$request->setControllerExtensionName($this->extensionName);
		$request->setPluginName($this->pluginName);
		$request->setControllerName($this->controllerName);
		$request->setControllerActionName($this->actionName);
		$request->setFormat($this->formatName);
		$request->setArguments($this->arguments);
		return $request;
	}

	/**
	 * Prepare the call arguments
	 *
	 * @return \SJBR\SrFreecap\Utility\EidDispatcher
	 */
	public function initCallArguments() {
		$request = GeneralUtility::_GP('request');
		if ($request) {
			$this->setRequestArgumentsFromJSON($request);
		} else {
			$this->setRequestArgumentsFromGetPost();
		}
		return $this->setVendorName($this->requestArguments['vendorName'])
			->setExtensionName($this->requestArguments['extensionName'])
			->setPluginName($this->requestArguments['pluginName'])
			->setControllerName($this->requestArguments['controllerName'])
			->setActionName($this->requestArguments['actionName'])
			->setFormatName($this->requestArguments['formatName'])
			->setArguments($this->requestArguments['arguments']);
	}

	/**
	 * Set the request array from JSON
	 *
	 * @param string $request
	 */
	protected function setRequestArgumentsFromJSON($request) {
		$requestArray = json_decode($request, TRUE);
		if (is_array($requestArray)) {
			\TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule($this->requestArguments, $requestArray);
		}
	}

	/**
	 * Set the request array from the getPost array
	 */
	protected function setRequestArgumentsFromGetPost() {
		$validArguments = array('vendorName', 'extensionName', 'pluginName', 'controllerName', 'actionName', 'formatName', 'arguments');
		foreach ($validArguments as $argument) {
			if (GeneralUtility::_GP($argument)) {
				$this->requestArguments[$argument] = GeneralUtility::_GP($argument);
			} else if (GeneralUtility::_GP('amp;' . $argument)) {
				// Something went wrong...
				$this->requestArguments[$argument] = GeneralUtility::_GP('amp;' . $argument);
			}
		}
	}

	/**
	 * @param string $vendorName
	 * @return \SJBR\SrFreecap\Utility\EidDispatcher
	 */
	protected function setVendorName($vendorName) {
		$this->vendorName = htmlspecialchars((string)$vendorName);
		return $this;
	}

	/**
	 * @param string $extensionName
	 * @return \SJBR\SrFreecap\Utility\EidDispatcher
	 */
	protected function setExtensionName($extensionName) {
		$this->extensionName = htmlspecialchars((string)$extensionName);
		return $this;
	}

	/**
	 * @param string $pluginName
	 * @return \SJBR\SrFreecap\Utility\EidDispatcher
	 */
	protected function setPluginName($pluginName = '') {
		$this->pluginName = htmlspecialchars((string)$pluginName);
		return $this;
	}

	/**
	 * @param string $controllerName
	 * @return \SJBR\SrFreecap\Utility\EidDispatcher
	 */
	protected function setControllerName($controllerName = '') {
		$this->controllerName = htmlspecialchars((string)$controllerName);
		return $this;
	}

	/**
	 * @param string $actionName
	 * @return \SJBR\SrFreecap\Utility\EidDispatcher
	 */
	protected function setActionName($actionName = 'index') {
		$this->actionName = htmlspecialchars((string)$actionName);
		return $this;
	}

	/**
	 * @param string $formatName
	 * @return \SJBR\SrFreecap\Utility\EidDispatcher
	 */
	protected function setFormatName($formatName = 'txt') {
		$this->formatName = htmlspecialchars((string)$formatName);
		return $this;
	}

	/**
	 * @param array $arguments
	 * @return \SJBR\SrFreecap\Utility\EidDispatcher
	 */
	protected function setArguments($arguments) {
		if (!is_array($arguments)) {
			$this->arguments = array();
		} else {
			$this->arguments = $arguments;
		}
		return $this;
	}
}