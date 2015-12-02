<?php
namespace In2code\Powermail\Domain\Validator;

use In2code\Powermail\Domain\Model\Field;
use In2code\Powermail\Domain\Model\Form;
use In2code\Powermail\Domain\Model\Mail;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * PasswordValidator
 *
 * @package powermail
 * @license http://www.gnu.org/licenses/lgpl.html
 * 			GNU Lesser General Public License, version 3 or later
 */
class PasswordValidator extends AbstractValidator {

	/**
	 * Validation of given Params
	 *
	 * @param Mail $mail
	 * @return bool
	 */
	public function isValid($mail) {
		if (!$this->formHasPassword($mail->getForm()) || $this->ignoreValidationIfConfirmation()) {
			return TRUE;
		}

		foreach ($mail->getAnswers() as $answer) {
			if ($answer->getField()->getType() !== 'password') {
				continue;
			}
			if ($answer->getValue() !== $this->getMirroredValueOfPasswordField($answer->getField())) {
				$this->setErrorAndMessage($answer->getField(), 'password');
			}

		}

		return $this->isValidState();
	}

	/**
	 * Get mirror value from POST params
	 *
	 * @param Field $field
	 * @return string
	 */
	protected function getMirroredValueOfPasswordField(Field $field) {
		$piVars = GeneralUtility::_GP($this->pluginVariablesPrefix);
		$mirroredValue = $piVars['field'][$field->getMarker() . '_mirror'];
		return $mirroredValue;
	}

	/**
	 * Checks if given form has a password field
	 *
	 * @param Form $form
	 * @return boolean
	 */
	protected function formHasPassword(Form $form) {
		$form = $this->formRepository->hasPassword($form);
		return count($form) ? TRUE : FALSE;
	}

	/**
	 * Stop validation if confirmation step is active on create
	 *
	 * @return bool
	 */
	protected function ignoreValidationIfConfirmation() {
		$piVars = GeneralUtility::_GP($this->pluginVariablesPrefix);
		$piVarsGet = GeneralUtility::_GET($this->pluginVariablesPrefix);
		if ($piVars['__referrer']['@action'] === 'confirmation' && $piVarsGet['action'] === 'create') {
			return TRUE;
		}
		return FALSE;
	}
}