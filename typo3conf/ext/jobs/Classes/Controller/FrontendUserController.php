<?php
namespace Sozialinfo\Jobs\Controller;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Thomas Schallert <programmierung@sozialinfo.ch>, Sozialinfo
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
use Sozialinfo\Jobs\Property\TypeConverter\UploadedFileReferenceConverter;
use TYPO3\CMS\Extbase\Property\PropertyMappingConfiguration;

/**
 * FrontendUserController
 */
class FrontendUserController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * frontendUserRepository
	 *
	 * @var \Sozialinfo\Jobs\Domain\Repository\FrontendUserRepository
	 * @inject
	 */
	protected $frontendUserRepository = NULL;

	/**
	 * companyFrontendUserRepository
	 *
	 * @var \Sozialinfo\Jobs\Domain\Repository\CompanyFrontendUserRepository
	 * @inject
	 */
	protected $companyFrontendUserRepository = NULL;

	/**
	 * Sessions
	 *
	 * @var \Sozialinfo\Jobs\Persistence\Session
	 * @inject
	 */
	protected $session = NULL;

	/*
	public function initializeAction() {
		$action = $this->request->getControllerActionName();
		// pruefen, ob eine andere Action ausser "show" aufgerufen wurde
		if ($action != 'show' AND $action != 'list' AND $action != 'listFilterCategory'){
			// Redirect zur Login Seite (UID=21) falls nicht eingeloggt
			if (!$GLOBALS['TSFE']->fe_user->user['uid']) {
				//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($GLOBALS['TSFE']->fe_user->user['uid']);
				$this->redirect(NULL, NULL, NULL, NULL, $this->settings['activity']['redirectLoginUid']);
			}
		}elseif($GLOBALS['TSFE']->fe_user->user['uid'] AND $action == 'listAdmin'){
			$this->redirect('listAdmin');
		}
	}
	*/

	/**
	 * New action.
	 *
	 * Displays form in its current step.
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\FrontendUser $frontendUser
	 * @ignorevalidation $frontendUser
	 * @return void
	  */
	public function newAction($frontendUser = NULL) {
		$this->hydrateFromSession($frontendUser);
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($frontendUser);
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->settings['jobregistration']['usergroupJobOffers']);
		$this->view->assign('frontendUser', $frontendUser);
	}

	public function initializeContinueAction() {
		/** @var \TYPO3\CMS\Extbase\Mvc\Controller\MvcPropertyMappingConfiguration */
		$propertyMappingConfiguration = $this->arguments['frontendUser']->getPropertyMappingConfiguration();
		$propertyMappingConfiguration->allowProperties('documents','jobOffers','jobRequests');
		$propertyMappingConfiguration->allowCreationForSubProperty('documents.*','jobOffers.*','jobRequests.*');
		$propertyMappingConfiguration->forProperty('documents.*','jobOffers.*','jobRequests.*')->allowAllPropertiesExcept('uid', 'pid');
		$propertyMappingConfiguration->skipProperties('step','sozialinfoMemberUsername','sozialinfoMemberPassword','insosMemberId');

		$this->setTypeConverterConfigurationForImageUpload('frontendUser');

		if($this->arguments->hasArgument('frontendUser')){
			$arguments = $this->request->getArguments();
			if($arguments['frontendUser']['step'] == 0){
				// @var \TYPO3\CMS\Extbase\Validation\ValidatorResolver 
	            $validatorResolver = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Validation\\ValidatorResolver');
	            $extendedValidator = $validatorResolver->getBaseValidatorConjunction('\Sozialinfo\Jobs\Domain\Model\FrontendUserDynamicValidation0');
	            // @var \TYPO3\CMS\Extbase\Validation\Validator\ConjunctionValidator
	            $conjunctionValidator = $this->arguments->getArgument('frontendUser')->getValidator();
	            // Alle alten Validatoren entfernen
	            foreach ($conjunctionValidator->getValidators() as $validator) {
	                $conjunctionValidator->removeValidator($validator);
	            }
	            // Validatoren des Models ItemDynamicValidation hinzufuegen
	            $conjunctionValidator->addValidator($extendedValidator);
	        }elseif($arguments['frontendUser']['step'] == 1){
	        	// @var \TYPO3\CMS\Extbase\Validation\ValidatorResolver 
	            $validatorResolver = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Validation\\ValidatorResolver');
	            $extendedValidator = $validatorResolver->getBaseValidatorConjunction('\Sozialinfo\Jobs\Domain\Model\FrontendUserDynamicValidation1');
	            // @var \TYPO3\CMS\Extbase\Validation\Validator\ConjunctionValidator
	            $conjunctionValidator = $this->arguments->getArgument('frontendUser')->getValidator();
	            // Alle alten Validatoren entfernen
	            foreach ($conjunctionValidator->getValidators() as $validator) {
	                $conjunctionValidator->removeValidator($validator);
	            }
	            // Validatoren des Models ItemDynamicValidation hinzufuegen
	            $conjunctionValidator->addValidator($extendedValidator);
	        }elseif($arguments['frontendUser']['step'] == 2){
	        	// @var \TYPO3\CMS\Extbase\Validation\ValidatorResolver 
	            $validatorResolver = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Validation\\ValidatorResolver');
	 	        $extendedValidator = $validatorResolver->getBaseValidatorConjunction('\Sozialinfo\Jobs\Domain\Model\FrontendUserDynamicValidation2');
	            // @var \TYPO3\CMS\Extbase\Validation\Validator\ConjunctionValidator
	            $conjunctionValidator = $this->arguments->getArgument('frontendUser')->getValidator();
	            // Alle alten Validatoren entfernen
	            foreach ($conjunctionValidator->getValidators() as $validator) {
	                $conjunctionValidator->removeValidator($validator);
	            }
	            // Validatoren des Models ItemDynamicValidation hinzufuegen
	            $conjunctionValidator->addValidator($extendedValidator);
	        }
	    }
	}
	
	/**
	 * Continue action.
	 *
	 * Validates the object, stores data inside session and continues to the next step.
	 *
	 * Remember that data coming from the $model parameter only contains data from the
	 * current step (unless you put a lot of hidden fields inside your view for each step).
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\FrontendUser $frontendUser
	 * @return void
	 */
	public function continueAction(\Sozialinfo\Jobs\Domain\Model\FrontendUser $frontendUser) {
		$arguments = $this->request->getArguments();
		//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($arguments);
		if(array_key_exists('sozialinfoMemberUsername', $arguments['frontendUser']) OR array_key_exists('insosMemberId', $arguments['frontendUser'])){
			$companyFrontendUser = $this->validateMember($arguments);
			if(is_object($companyFrontendUser)){
				$frontendUser->setCompanyFrontendUser($companyFrontendUser[0]);	
			}
		}
		$this->hydrateFromSession($frontendUser);
		$frontendUser->increaseProcessStep();
		$this->session->setSerialized('frontendUser', $frontendUser);
		if ($frontendUser->getProcessStep() >= \Sozialinfo\Jobs\Domain\Model\FrontendUser::PROCESS_STEP_MAXIMUM) {
			$this->forward('create');
		}else{
			$this->redirect('new');
		}
	}

	public function validateMember($arguments) {
		if($arguments['frontendUser']['sozialinfoMemberUsername'] == '' AND $arguments['frontendUser']['sozialinfoMemberPassword'] == '' AND $arguments['frontendUser']['insosMemberId'] == ''){
			$this->addFlashMessage(
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_jobs_domain_model_frontenduser.sozialinfo_member_password.error_message','jobs'),
				'',
				\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR,
				TRUE
			);
			$this->redirect('new');
		}elseif($arguments['frontendUser']['sozialinfoMemberUsername'] == '' AND $arguments['frontendUser']['sozialinfoMemberPassword'] != '' AND $arguments['frontendUser']['insosMemberId'] == ''){
			$this->addFlashMessage(
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_jobs_domain_model_frontenduser.sozialinfo_member_password.error_message_no_sozialinfo_member','jobs'),
				'',
				\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR,
				TRUE
			);
			$this->redirect('new');	
		}elseif(($arguments['frontendUser']['insosMemberId'] != '' AND $arguments['frontendUser']['sozialinfoMemberUsername'] != '' AND $arguments['frontendUser']['sozialinfoMemberPassword'] != '') OR ($arguments['frontendUser']['insosMemberId'] != '' AND $arguments['frontendUser']['sozialinfoMemberUsername'] == '' AND $arguments['frontendUser']['sozialinfoMemberPassword'] != '') OR ($arguments['frontendUser']['insosMemberId'] != '' AND $arguments['frontendUser']['sozialinfoMemberUsername'] != '' AND $arguments['frontendUser']['sozialinfoMemberPassword'] == '')){
			$this->addFlashMessage(
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_jobs_domain_model_frontenduser.sozialinfo_member_password.error_message_only_one_member','jobs'),
				'',
				\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR, 
				TRUE
			);
			$this->redirect('new');	
		}elseif($arguments['frontendUser']['sozialinfoMemberUsername'] != '' AND $arguments['frontendUser']['insosMemberId'] == ''){
			if($arguments['frontendUser']['sozialinfoMemberPassword'] == ''){
				$this->addFlashMessage(
					\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_jobs_domain_model_frontenduser.sozialinfo_member_password.error_message_no_password','jobs'),
					'',
					\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR,
					TRUE
				);
				$this->redirect('new');	
			}else{
				if($this->companyFrontendUserRepository->findCompanyFrontendUser($arguments,TRUE) != TRUE){
					$this->addFlashMessage(
						\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_jobs_domain_model_frontenduser.sozialinfo_member_password.sozialinfo_member_wrong_user_password','jobs'),
						'',
						\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR,
						TRUE
					);
					$this->redirect('new');
				}else{
					$this->addFlashMessage(
						\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_jobs_domain_model_frontenduser.sozialinfo_member_password.sozialinfo_member_validation_pass','jobs'),
						'',
						\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR,
						TRUE
					);
					$companyFrontendUser = $this->companyFrontendUserRepository->findCompanyFrontendUser($arguments);
					return $companyFrontendUser;
				}
			}
		}elseif($arguments['frontendUser']['insosMemberId'] != '' AND $arguments['frontendUser']['sozialinfoMemberUsername'] == '' AND $arguments['frontendUser']['sozialinfoMemberPassword'] == ''){
			$this->addFlashMessage(
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_jobs_domain_model_frontenduser.sozialinfo_member_password.sozialinfo_member_validation_pass','jobs'),
				'',
				\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR,
				TRUE
			);	
		}
		//$frontendUsers = $this->frontendUserRepository->findAll();

	}
	
	public function initializeCreateAction() {
		/** @var \TYPO3\CMS\Extbase\Mvc\Controller\MvcPropertyMappingConfiguration */
		$propertyMappingConfiguration = $this->arguments['frontendUser']->getPropertyMappingConfiguration();
		$propertyMappingConfiguration->allowProperties('documents','jobOffers','jobRequests');
		$propertyMappingConfiguration->allowCreationForSubProperty('documents.*','jobOffers.*','jobRequests.*');
		$propertyMappingConfiguration->forProperty('documents.*','jobOffers.*','jobRequests.*')->allowAllPropertiesExcept('uid', 'pid');
		$propertyMappingConfiguration->skipProperties('step');

		$this->setTypeConverterConfigurationForImageUpload('frontendUser');
		
		if($this->arguments->hasArgument('frontendUser')){
			$arguments = $this->request->getArguments();
			if($arguments['frontendUser']['step'] == 2){
				// @var \TYPO3\CMS\Extbase\Validation\ValidatorResolver 
	            $validatorResolver = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Validation\\ValidatorResolver');
	            $extendedValidator = $validatorResolver->getBaseValidatorConjunction('\Sozialinfo\Jobs\Domain\Model\FrontendUser');
	            // @var \TYPO3\CMS\Extbase\Validation\Validator\ConjunctionValidator
	            $conjunctionValidator = $this->arguments->getArgument('frontendUser')->getValidator();
	            // Alle alten Validatoren entfernen
	            foreach ($conjunctionValidator->getValidators() as $validator) {
	                $conjunctionValidator->removeValidator($validator);
	            }
	            // Validatoren des Models ItemDynamicValidation hinzufuegen
	            $conjunctionValidator->addValidator($extendedValidator);
	        }
	    }
	}
	
	/**
	 * Create action.
	 *
	 * Last step of the form, persists the record.
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\FrontendUser $frontendUser
	 * @return void
	 */
	public function createAction(\Sozialinfo\Jobs\Domain\Model\FrontendUser $frontendUser) {
		$this->hydrateFromSession($frontendUser);
		$frontendUser->setUsername($frontendUser->getEmail());
		$frontendUser->setUsergroup($this->settings['jobregistration']['usergroupJobOffers']);
		$this->frontendUserRepository->add($frontendUser);
		$this->persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
		$this->persistenceManager->persistAll();
		$this->session->remove('frontendUser');
		$this->redirect('list', NULL, NULL, NULL);
		//$this->redirect('createConfirm', NULL, NULL, array('frontendUser' => $frontendUser));
	}

	/**
	 * Previous action.
	 * 
	 * Takes model a step back.
	 *
	 * @return void
	 */
	public function previousAction() {
		$frontendUser = $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Model\\FrontendUser');
		$this->hydrateFromSession($frontendUser);
		$frontendUser->decreaseProcessStep();
		$this->session->setSerialized('frontendUser', $frontendUser);
		$this->redirect('new');
	}

	/**
	 * Hydrate given object with data stored inside session.
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\FrontendUser $frontendUser
	 * @return void
	 */
	protected function hydrateFromSession(\Sozialinfo\Jobs\Domain\Model\FrontendUser &$frontendUser = NULL) {
		$newFrontendUser = FALSE;
		if (!$frontendUser) {
			$frontendUser = $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Model\\FrontendUser');
			$newFrontendUser = TRUE;
		}
		$currentFrontendUser = $this->session->getUnserialized('frontendUser');
		
		if ($currentFrontendUser) {
			if ($newFrontendUser) {
				// Do not process properties on a plain new object,
				// as no new properties are given. If you do process it,
				// default properties are used for overriding in array_merge
				// and you will never leave step 0.
				$properties = array_filter(
					$currentFrontendUser->_getPublicProperties(),
					'\\Sozialinfo\\Jobs\\Utility\\FunctionUtility::isNotNull'
				);
			} else {
				$properties = array_filter(
						$currentFrontendUser->_getPublicProperties(),
						'\\Sozialinfo\\Jobs\\Utility\\FunctionUtility::isNotNull'
					);
				$propertiesToMerge = array_filter(
						$frontendUser->_getPublicProperties(),
						'\\Sozialinfo\\Jobs\\Utility\\FunctionUtility::isNotNull'
					);
				foreach($propertiesToMerge as $key => $value){
					if($value != ''){
						$properties[$key] = $value; 
					}
				}
			}			
			$frontendUser->_setProperties($properties);
		}
	}	

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$frontendUsers = $this->frontendUserRepository->findAll();
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($frontendUsers);
		$this->view->assign('frontendUsers', $frontendUsers);
	}

	/**
	 * action show
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\FrontendUser $frontendUser
	 * @return void
	 */
	public function showAction(\Sozialinfo\Jobs\Domain\Model\FrontendUser $frontendUser) {
		$this->view->assign('frontendUser', $frontendUser);
	}

	/**
	 * action edit
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\FrontendUser $frontendUser
	 * @ignorevalidation $frontendUser
	 * @return void
	 */
	public function editAction(\Sozialinfo\Jobs\Domain\Model\FrontendUser $frontendUser) {
		$this->view->assign('frontendUser', $frontendUser);
	}

	/**
	 * action initializeUpdateAction
	 *
	 */
	public function initializeUpdateAction() {
		$this->setTypeConverterConfigurationForImageUpload('frontendUser');
	}

	/**
	 * action update
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\FrontendUser $frontendUser
	 * @return void
	 */
	public function updateAction(\Sozialinfo\Jobs\Domain\Model\FrontendUser $frontendUser) {
		$this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$frontendUser->setUsername($frontendUser->getEmail());
		$this->frontendUserRepository->update($frontendUser);
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\FrontendUser $frontendUser
	 * @return void
	 */
	public function deleteAction(\Sozialinfo\Jobs\Domain\Model\FrontendUser $frontendUser) {
		$this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->frontendUserRepository->remove($frontendUser);
		$this->redirect('list');
	}

	/**
	 * Cancel action
	 *
	 * Cancels the Registration Process and clears the Session 
	 *
	 */
	public function cancelAction() {
		$this->session->remove('frontendUser');
		$this->redirect('list', NULL, NULL, NULL);
	}

	/**
	 * action preview
	 *
	 * @return void
	 */
	public function previewAction() {
		
	}

	/**
	 * action deleteConfirm
	 *
	 * @return void
	 */
	public function deleteConfirmAction() {
		
	}

	/**
	 *
	 */
	protected function setTypeConverterConfigurationForImageUpload($argumentName) {

		// \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']);

		$uploadConfiguration = array(
			UploadedFileReferenceConverter::CONFIGURATION_ALLOWED_FILE_EXTENSIONS => 'gif,jpg,jpeg,png',
			UploadedFileReferenceConverter::CONFIGURATION_UPLOAD_FOLDER => '1:/content/'
		);

		// \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($uploadConfiguration);

		/** @var PropertyMappingConfiguration $newFrontendUserConfiguration */
		$newFrontendUserConfiguration = $this->arguments[$argumentName]->getPropertyMappingConfiguration();

		$newFrontendUserConfiguration->forProperty('corporate')
			->setTypeConverterOptions(
				'Sozialinfo\\Jobs\\Property\\TypeConverter\\UploadedFileReferenceConverter',
				$uploadConfiguration
			);

		$newFrontendUserConfiguration->forProperty('documents.0')
			->setTypeConverterOptions(
				'Sozialinfo\\Jobs\\Property\\TypeConverter\\UploadedFileReferenceConverter',
				$uploadConfiguration
			);
	}

}