<?php
namespace In2code\Powermail\Domain\Validator;

use In2code\Powermail\Domain\Model\Field;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Validation\Exception\InvalidValidationOptionsException;
use TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator as ExtbaseAbstractValidator;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Thorsten Boock <thorsten@nerdcenter.de>
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
 * AbstractValidator
 *
 * @package powermail
 * @license http://www.gnu.org/licenses/lgpl.html
 * 			GNU Lesser General Public License, version 3 or later
 */
abstract class AbstractValidator extends ExtbaseAbstractValidator {

	/**
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
	 * @inject
	 */
	protected $objectManager;

	/**
	 * @var \In2code\Powermail\Domain\Repository\FormRepository
	 * @inject
	 */
	protected $formRepository;

	/**
	 * @var \TYPO3\CMS\Extbase\SignalSlot\Dispatcher
	 * @inject
	 */
	protected $signalSlotDispatcher;

	/**
	 * @var string
	 */
	protected $pluginVariablesPrefix = 'tx_powermail_pi1';

	/**
	 * Return variable
	 *
	 * @var bool
	 */
	protected $validState = TRUE;

	/**
	 * @var array
	 */
	protected $settings;

	/**
	 * @var array
	 */
	protected $flexForm;

	/**
	 * @param boolean $validState
	 * @return void
	 */
	public function setValidState($validState) {
		$this->validState = $validState;
	}

	/**
	 * @return boolean
	 */
	public function isValidState() {
		return $this->validState;
	}

	/**
	 * Set Error
	 *
	 * @param Field $field
	 * @param string $label
	 * @return void
	 */
	public function setErrorAndMessage(Field $field, $label) {
		$this->setValidState(FALSE);
		$this->addError($label, $field->getMarker());
	}

	/**
	 * Check if javascript validation is activated
	 *
	 * @return bool
	 */
	public function isServerValidationEnabled() {
		return $this->settings['validation.']['server'] === '1';
	}

	/**
	 * Get TypoScript and FlexForm
	 *
	 * @param ConfigurationManagerInterface $configurationManager
	 * @return void
	 */
	public function injectTypoScript(ConfigurationManagerInterface $configurationManager) {
		$typoScriptSetup = $configurationManager->getConfiguration(
			ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT
		);
		$this->settings = $typoScriptSetup['plugin.']['tx_powermail.']['settings.']['setup.'];

		$flexFormXml = $configurationManager->getContentObject()->data['pi_flexform'];
		$flexForm = GeneralUtility::xml2array($flexFormXml, 'data');
		$this->flexForm = $flexForm[0];
	}

	/**
	 * Constructs the validator and sets validation options
	 *
	 * @param array $options Options for the validator
	 * @throws InvalidValidationOptionsException
	 */
	public function __construct(array $options = array()) {
		parent::__construct($options);
	}

}