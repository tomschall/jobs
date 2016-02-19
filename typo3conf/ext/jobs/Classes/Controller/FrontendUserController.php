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
	 * insosMemberRepository
	 *
	 * @var \Sozialinfo\Jobs\Domain\Repository\InsosMemberRepository
	 * @inject
	 */
	protected $insosMemberRepository = NULL;

	/**
	 * Sessions
	 *
	 * @var \Sozialinfo\Jobs\Persistence\Session
	 * @inject
	 */
	protected $session = NULL;

	
	public function initializeAction() {
		$action = $this->request->getControllerActionName();
		
		// pruefen, ob eine andere Action ausser "show" aufgerufen wurde
		if($action != 'new' AND $action != 'continue' AND $action != 'create' AND $action != 'previous' AND $action != 'list' AND $action != 'show'){
			// Redirect zur Login Seite (UID=21) falls nicht eingeloggt
			if (!$GLOBALS['TSFE']->fe_user->user['uid']) {
				//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($GLOBALS['TSFE']->fe_user->user['uid']);
				//$this->redirect(NULL, NULL, NULL, NULL, $this->settings['activity']['redirectLoginUid']);
				$this->redirect(NULL, NULL, NULL, NULL, 71);
			}
		}elseif($GLOBALS['TSFE']->fe_user->user['uid'] AND $action == 'listUserSpecificData'){
			$this->redirect('listUserSpecificData', NULL, NULL, NULL);
		}
	}
	

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
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($GLOBALS['TCA']['fe_users']);

		$this->view->assign('frontendUser', $frontendUser);
		$this->view->assign('salutations', $this->getSalutation());
		$this->view->assign('countries', $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Repository\\CountryRepository')->findAll());

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
			// @var \TYPO3\CMS\Extbase\Validation\ValidatorResolver 
	        $validatorResolver = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Validation\\ValidatorResolver');
	        $arguments['frontendUser']['step'] == 0 ? $extendedValidator = $validatorResolver->getBaseValidatorConjunction('\Sozialinfo\Jobs\Domain\Model\FrontendUserDynamicValidation0') : '';
	        $arguments['frontendUser']['step'] == 1 ? $extendedValidator = $validatorResolver->getBaseValidatorConjunction('\Sozialinfo\Jobs\Domain\Model\FrontendUserDynamicValidation1') : '';
	        $arguments['frontendUser']['step'] == 2 ? $extendedValidator = $validatorResolver->getBaseValidatorConjunction('\Sozialinfo\Jobs\Domain\Model\FrontendUserDynamicValidation2') : '';
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
		$this->hydrateFromSession($frontendUser);
		$this->checkMember($frontendUser,$arguments);
		$frontendUser->increaseProcessStep();
		$this->session->setSerialized('frontendUser', $frontendUser);
		if ($frontendUser->getProcessStep() >= \Sozialinfo\Jobs\Domain\Model\FrontendUser::PROCESS_STEP_MAXIMUM) {
			$this->forward('create');
		}else{
			$this->redirect('new');
		}
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
			// @var \TYPO3\CMS\Extbase\Validation\ValidatorResolver 
            $validatorResolver = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Validation\\ValidatorResolver');
            $arguments['frontendUser']['step'] == 2 ? $extendedValidator = $validatorResolver->getBaseValidatorConjunction('\Sozialinfo\Jobs\Domain\Model\FrontendUser') : '';
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
					if(!is_object($value) AND $value != ''){
						$properties[$key] = $value; 
					}elseif($value instanceof \TYPO3\CMS\Extbase\Persistence\ObjectStorage) {
						$tmp = $value->toArray();
						if(!empty($tmp)){
							$properties[$key] = $value;		
						}
					}elseif($value instanceof \TYPO3\CMS\Extbase\Domain\Model\FileReference) {
						$tmp = (array) $value;
						if(!empty($tmp)){
							$properties[$key] = $value;		
						}
					}elseif($value instanceof \Sozialinfo\Jobs\Domain\Model\CompanyFrontendUser) {
						$tmp = (array) $value;
						if(!empty($tmp)){
							$properties[$key] = $value;		
						}

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
	 * action listUserSpecificData
	 *
	 * @return void
	 */
	public function listUserSpecificDataAction() {
		$frontendUsers = $this->frontendUserRepository->findUserSpecificData();
		$actualFeUser = $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Repository\\FrontendUserRepository')->findOneByUid($GLOBALS['TSFE']->fe_user->user['uid']);
		//$frontendUsers = $this->frontendUserRepository->findAll();
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($frontendUsers,'frontendUser found in Repository');
		//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($actualFeUser,'actual logged in user');
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
		$this->view->assign('salutations', $this->getSalutation());
		$this->view->assign('countries', $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Repository\\CountryRepository')->findAll());
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
		$frontendUser->setUsername($frontendUser->getEmail());
		$this->frontendUserRepository->update($frontendUser);
		$this->addFlashMessage('Ihre Benutzerdaten wurden aktualisiert', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
		$this->redirect('listUserSpecificData');
	}

	/**
	 * action delete
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\FrontendUser $frontendUser
	 * @return void
	 */
	public function deleteAction(\Sozialinfo\Jobs\Domain\Model\FrontendUser $frontendUser) {
		$this->addFlashMessage('Der Datensatz wurde gelöscht', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
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

	/**
	 * check member action.
	 *
	 * Proof if there exists at least one Object of Type \Sozialinfo\Jobs\Domain\Model\CompanyFrontendUser 
	 * or \Sozialinfo\Jobs\Domain\Model\InsosMember. If not, member validation will be executed, if there 
	 * exists one, validation will be passed and a success message will be generated.
	 *
	 * @return void
	 */
	public function checkMember($frontendUser,$arguments) {
		if(($frontendUser->getCompanyFrontendUser() instanceof \Sozialinfo\Jobs\Domain\Model\CompanyFrontendUser != TRUE) AND ($frontendUser->getInsosMember() instanceof \Sozialinfo\Jobs\Domain\Model\InsosMember != TRUE)){
			if(array_key_exists('sozialinfoMemberUsername', $arguments['frontendUser']) OR array_key_exists('insosMemberId', $arguments['frontendUser'])){
				$proofResult = $this->validateMember($arguments);
				if($proofResult[0] instanceof \Sozialinfo\Jobs\Domain\Model\CompanyFrontendUser){
					$frontendUser->setCompanyFrontendUser($proofResult[0]);	
				}elseif($proofResult[0] instanceof \Sozialinfo\Jobs\Domain\Model\InsosMember){
					$frontendUser->setInsosMember($proofResult[0]);	
				}
			}
		}elseif(($frontendUser->getCompanyFrontendUser() instanceof \Sozialinfo\Jobs\Domain\Model\CompanyFrontendUser == TRUE) AND ($frontendUser->getInsosMember() instanceof \Sozialinfo\Jobs\Domain\Model\InsosMember != TRUE)){
			if((array_key_exists('sozialinfoMemberUsername', $arguments['frontendUser']) AND $arguments['frontendUser']['sozialinfoMemberUsername'] != '') OR (array_key_exists('sozialinfoMemberUsername', $arguments['frontendUser']) AND $arguments['frontendUser']['insosMemberId'] != '')){
				$this->sozialinfoMemberHasAlreadyBeenAssigned();	
			}			
		}elseif(($frontendUser->getCompanyFrontendUser() instanceof \Sozialinfo\Jobs\Domain\Model\CompanyFrontendUser != TRUE) AND ($frontendUser->getInsosMember() instanceof \Sozialinfo\Jobs\Domain\Model\InsosMember == TRUE)){
			if((array_key_exists('insosMemberId', $arguments['frontendUser']) AND $arguments['frontendUser']['insosMemberId'] != '') OR (array_key_exists('insosMemberId', $arguments['frontendUser']) AND $arguments['frontendUser']['sozialinfoMemberUsername'] != '')){
				$this->insosMemberHasAlreadyBeenAssigned();
			}			
		}
	}

	/**
	 * prepare salutations for select box
	 *
	 * @return array
	 */
	public function getSalutation() {
		$salutation = array();
		$entries = array('0','1');
		foreach ($entries as $entry) {
			$salutation = new \stdClass;
			$salutation->key = $entry;
			$salutation->value = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_jobs_domain_model_frontenduser.salutation.options.I.'.$entry, 'jobs');
			$salutations[] = $salutation;
		}
		return $salutations;
	}

	public function sozialinfoMemberHasAlreadyBeenAssigned() {
		$this->addFlashMessage(
			\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_jobs_domain_model_frontenduser.sozialinfo_member.already_assigned','jobs'),
			'',
			\TYPO3\CMS\Core\Messaging\AbstractMessage::OK,
			TRUE
		);
	}

	public function insosMemberHasAlreadyBeenAssigned() {
		$this->addFlashMessage(
			\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_jobs_domain_model_frontenduser.insos_member.already_assigned','jobs'),
			'',
			\TYPO3\CMS\Core\Messaging\AbstractMessage::OK,
			TRUE
		);
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
			//Proof for Sozialinfo Membership
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
						\TYPO3\CMS\Core\Messaging\AbstractMessage::OK,
						TRUE
					);
					$companyFrontendUser = $this->companyFrontendUserRepository->findCompanyFrontendUser($arguments);
					return $companyFrontendUser;
				}
			}
		}elseif($arguments['frontendUser']['insosMemberId'] != '' AND $arguments['frontendUser']['sozialinfoMemberUsername'] == '' AND $arguments['frontendUser']['sozialinfoMemberPassword'] == ''){
			//Proof for Insos Membership
			if($this->insosMemberRepository->findInsosMemberId($arguments,TRUE) != TRUE){
					$this->addFlashMessage(
						\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_jobs_domain_model_frontenduser.insos_member_password.insos_member_wrong_id','jobs'),
						'',
						\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR,
						TRUE
					);
					$this->redirect('new');
			}else{
				$this->addFlashMessage(
					\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_jobs_domain_model_frontenduser.insos_member_password.insos_member_validation_pass','jobs'),
					'',
					\TYPO3\CMS\Core\Messaging\AbstractMessage::OK,
					TRUE
				);
				$insosMemberId = $this->insosMemberRepository->findInsosMemberId($arguments);
				return $insosMemberId;
			}	
		}
		//$frontendUsers = $this->frontendUserRepository->findAll();
	}
}