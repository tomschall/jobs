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
 * JobRequestController
 */
class JobRequestController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * jobRequestRepository
	 *
	 * @var \Sozialinfo\Jobs\Domain\Repository\JobRequestRepository
	 * @inject
	 */
	protected $jobRequestRepository = NULL;

	/**
	 * Sessions
	 *
	 * @var \Sozialinfo\Jobs\Persistence\Session
	 * @inject
	 */
	protected $session = NULL;

	/**
	 * frontendUserRepository
	 *
	 * @var \Sozialinfo\Jobs\Domain\Repository\FrontendUserRepository
	 * @inject
	 */
	protected $frontendUserRepository = NULL;

	/**
	 * New action.
	 *
	 * Displays form in its current step.
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\JobRequest $jobRequest
	 * @ignorevalidation $jobRequest
	 * @return void
	  */
	public function newAction($jobRequest = NULL) {
		$this->hydrateFromSession($jobRequest);
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($jobRequest);
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($_SESSION);

		$this->view->assign('jobRequest', $jobRequest);
		$this->view->assign('canton', $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Repository\\CantonRepository')->findAll());
		$this->view->assign('employmentRelationship', $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Repository\\EmploymentRelationshipRepository')->findAll());
		$this->view->assign('position', $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Repository\\PositionRepository')->findAll());
		$this->view->assign('qualification', $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Repository\\QualificationRepository')->findAll());
		//$this->view->assign('areasOfWork', $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Repository\\AreasOfWorkRepository')->findAll());
		$this->view->assign('qualificationChecked', $this->getCheckedQualifications($jobRequest));
		//$this->view->assign('areasOfWorkChecked', $this->getCheckedAreasOfWork($jobRequest));
		$this->view->assign('cantonSelected', $this->getCheckedCantons($jobRequest));
		$this->view->assign('frontendUser', $this->frontendUserRepository->findByUid($GLOBALS['TSFE']->fe_user->user['uid']));
		$this->view->assign('postalAddressTitles', $this->getSalutation());
		$this->view->assign('postalAddressCountries', $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Repository\\CountryRepository')->findAll());
	}

	public function initializeContinueAction() {

		$arguments = $this->request->getArguments();
		//$this->setTypeConverterConfigurationForImageUpload('jobRequest');

		/** @var \TYPO3\CMS\Extbase\Mvc\Controller\MvcPropertyMappingConfiguration */
		$propertyMappingConfiguration = $this->arguments['jobRequest']->getPropertyMappingConfiguration();

		// these are multiple select fields, if they are empty, you have to set property mapper to skip property, otherwise validation will not work correct
		$arguments['jobRequest']['qualification'] == '' ? $propertyMappingConfiguration->skipProperties('qualification') : '';
		$arguments['jobRequest']['areasOfWork'] == '' ? $propertyMappingConfiguration->skipProperties('areasOfWork') : '';
		$arguments['jobRequest']['canton'] == '' ? $propertyMappingConfiguration->skipProperties('canton') : '';

		$propertyMappingConfiguration->skipProperties('step');		

		if(isset($this->arguments['jobRequest'])) {
			if($arguments['jobRequest']['step'] == 0){
				$this->arguments[$jobRequest]
				->getPropertyMappingConfiguration()
				->forProperty('entryDate')
				->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');
			}elseif($arguments['jobRequest']['step'] == 3){
				$this->arguments[$jobRequest]
				->getPropertyMappingConfiguration()
				->forProperty('startDate')
				->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');
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
	 * @param \Sozialinfo\Jobs\Domain\Model\jobRequest $jobRequest
	 * @return void
	 */
	public function continueAction(\Sozialinfo\Jobs\Domain\Model\JobRequest $jobRequest) {
		$arguments = $this->request->getArguments();

		if(array_key_exists('useAgreements', $arguments['jobRequest'])){
			$arguments['jobRequest']['useAgreements'] != 1 ? $this->useAgreementsErrorMessage() : '';
		}
		$this->hydrateFromSession($jobRequest);
		if($jobRequest->getProcessStep() == 3){
			$endDate = new \DateTime();
			$endDate->setTimestamp($jobRequest->getStartDate()->getTimestamp());
			$endDate->modify('+'.$jobRequest->getNumberDaysPublication().'days');
			$jobRequest->setEndDate($endDate);
		}
		$jobRequest->increaseProcessStep();
		$this->session->setSerialized('jobRequest', $jobRequest);
		
		if ($jobRequest->getProcessStep() >= \Sozialinfo\Jobs\Domain\Model\JobRequest::PROCESS_STEP_MAXIMUM) {
			$this->forward('create');
		}else{
			$this->redirect('new');
		}
	}

	public function initializeCreateAction() {
		/** @var \TYPO3\CMS\Extbase\Mvc\Controller\MvcPropertyMappingConfiguration */
		$propertyMappingConfiguration = $this->arguments['jobRequest']->getPropertyMappingConfiguration();
		$propertyMappingConfiguration->skipProperties('step');

		//$this->setTypeConverterConfigurationForImageUpload('jobRequest');
		
		if($this->arguments->hasArgument('jobRequest')){
			$arguments = $this->request->getArguments();
			if($arguments['jobRequest']['step'] == 5){
				// @var \TYPO3\CMS\Extbase\Validation\ValidatorResolver 
	            $validatorResolver = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Validation\\ValidatorResolver');
	            $extendedValidator = $validatorResolver->getBaseValidatorConjunction('\Sozialinfo\Jobs\Domain\Model\JobOffer');
	            // @var \TYPO3\CMS\Extbase\Validation\Validator\ConjunctionValidator
	            $conjunctionValidator = $this->arguments->getArgument('jobRequest')->getValidator();
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
	 * @param \Sozialinfo\Jobs\Domain\Model\JobRequest $jobRequest
	 * @return void
	 */
	public function createAction(\Sozialinfo\Jobs\Domain\Model\JobRequest $jobRequest) {
		$this->hydrateFromSession($jobRequest);
		$this->jobRequestRepository->add($jobRequest);
		$frontendUser = $this->frontendUserRepository->findByUid($GLOBALS['TSFE']->fe_user->user['uid']);
		if($frontendUser instanceof \Sozialinfo\Jobs\Domain\Model\FrontendUser){
			$frontendUser->addJobRequest($jobRequest);
			$this->frontendUserRepository->update($frontendUser);
		}else{
			$this->addFlashMessage('User war nicht eingeloggt, Object JobOffer konnte somit nicht dem FeUser hinzugefügt werden.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
			$this->session->remove('jobRequest');
			$this->redirect('list', NULL, NULL, NULL);	
		}
		$this->persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
		$this->persistenceManager->persistAll();
		$this->session->remove('jobRequest');
		$this->redirect('listUserSpecificData', 'FrontendUser', NULL, NULL, 110);
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
		//$jobRequest = $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Model\\JobRequest');
		$this->hydrateFromSession($jobRequest);
		$jobRequest->decreaseProcessStep();
		$this->session->setSerialized('jobRequest', $jobRequest);
		$this->redirect('new');
	}

	/**
	 * Hydrate given object with data stored inside session.
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\JobRequest $jobRequest
	 * @return void
	 */
	protected function hydrateFromSession(\Sozialinfo\Jobs\Domain\Model\JobRequest &$jobRequest = NULL) {
		$newJobRequest = FALSE;
		if(!$jobRequest){
			$jobRequest = $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Model\\JobRequest');
			$newJobRequest = TRUE;
		}
		$currentJobRequest = $this->session->getUnserialized('jobRequest');
		
		if($currentJobRequest){
			if($newJobRequest){
				// Do not process properties on a plain new object,
				// as no new properties are given. If you do process it,
				// default properties are used for overriding in array_merge
				// and you will never leave step 0.
				$properties = array_filter(
					$currentJobRequest->_getPublicProperties(),
					'\\Sozialinfo\\Jobs\\Utility\\FunctionUtility::isNotNull'
				);
			}else{
				$properties = array_filter(
						$currentJobRequest->_getPublicProperties(),
						'\\Sozialinfo\\Jobs\\Utility\\FunctionUtility::isNotNull'
					);
				$propertiesToMerge = array_filter(
						$jobRequest->_getPublicProperties(),
						'\\Sozialinfo\\Jobs\\Utility\\FunctionUtility::isNotNull'
					);
				foreach($propertiesToMerge as $key => $value){
					if(!is_object($value) AND (($value != '') OR ($value === TRUE) OR ($value === FALSE))){
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
					}elseif($value instanceof \Sozialinfo\Jobs\Domain\Model\EmploymentRelationship) {
						$tmp = (array) $value;
						if(!empty($tmp)){
							$properties[$key] = $value;		
						}
					}elseif($value instanceof \Sozialinfo\Jobs\Domain\Model\Position) {
						$tmp = (array) $value;
						if(!empty($tmp)){
							$properties[$key] = $value;		
						}
					}elseif($value instanceof \DateTime) {
						$tmp = (array) $value;
						if(!empty($tmp)){
							$properties[$key] = $value;		
						}
					}elseif($value instanceof \Sozialinfo\Jobs\Domain\Model\Country) {
						$tmp = (array) $value;
						if(!empty($tmp)){
							$properties[$key] = $value;		
						}
					}elseif($value instanceof \Sozialinfo\Jobs\Domain\Model\AdvertisementType) {
						$tmp = (array) $value;
						if(!empty($tmp)){
							$properties[$key] = $value;		
						}
					}
				}
			}			
			$jobRequest->_setProperties($properties);
		}
	}

	/**
	 * edit action.
	 *
	 * Displays edit form in its current step.
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\JobRequest $jobRequest
	 * @ignorevalidation $jobRequest
	 * @return void
	  */
	public function editAction($jobRequest=NULL) {
		$this->hydrateEditFromSession($jobRequest);
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($currentJobRequest,'currentJobOffer');
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($jobRequest,'after hydrate');
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($_SESSION);

		$this->view->assign('jobRequest', $jobRequest);
		$this->view->assign('canton', $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Repository\\CantonRepository')->findAll());
		$this->view->assign('employmentRelationships', $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Repository\\EmploymentRelationshipRepository')->findAll());
		$this->view->assign('position', $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Repository\\PositionRepository')->findAll());
		$this->view->assign('qualification', $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Repository\\QualificationRepository')->findAll());
		//$this->view->assign('areasOfWork', $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Repository\\AreasOfWorkRepository')->findAll());
		$this->view->assign('qualificationChecked', $this->getCheckedQualifications($jobRequest));
		//$this->view->assign('areasOfWorkChecked', $this->getCheckedAreasOfWork($jobRequest));
		$this->view->assign('cantonSelected', $this->getCheckedCantons($jobRequest));
		$this->view->assign('frontendUser', $this->frontendUserRepository->findByUid($GLOBALS['TSFE']->fe_user->user['uid']));
		$this->view->assign('postalAddressTitles', $this->getSalutation());
		$this->view->assign('postalAddressCountries', $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Repository\\CountryRepository')->findAll());
	}

	public function initializeContinueEditAction() {

		$arguments = $this->request->getArguments();

		/** @var \TYPO3\CMS\Extbase\Mvc\Controller\MvcPropertyMappingConfiguration */
		$propertyMappingConfiguration = $this->arguments['jobRequest']->getPropertyMappingConfiguration();

		$arguments['jobRequest']['qualification'] == '' ? $propertyMappingConfiguration->skipProperties('qualification') : '';
		$arguments['jobRequest']['areasOfWork'] == '' ? $propertyMappingConfiguration->skipProperties('areasOfWork') : '';
		$arguments['jobRequest']['canton'] == '' ? $propertyMappingConfiguration->skipProperties('canton') : '';
		//$arguments['jobRequest']['documents'] != '' ? $propertyMappingConfiguration->skipProperties('documents') : '';

		$propertyMappingConfiguration->skipProperties('step');
		
		//$this->setTypeConverterConfigurationForImageUpload('jobRequest');

		if(isset($this->arguments['jobRequest'])) {
			if($arguments['jobRequest']['step'] == 0){
				$this->arguments[$jobRequest]
				->getPropertyMappingConfiguration()
				->forProperty('entryDate')
				->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');
			}elseif($arguments['jobRequest']['step'] == 3){
				$this->arguments[$jobRequest]
				->getPropertyMappingConfiguration()
				->forProperty('startDate')
				->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');
			}
		}
	}
	
	/**
	 * Continue edit action.
	 *
	 * shows current object data, Validates the object and
	 * stores data inside session and continues to the next step.
	 *
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\jobRequest $jobRequest
	 * @return void
	 */
	public function continueEditAction(\Sozialinfo\Jobs\Domain\Model\JobRequest $jobRequest) {
		$arguments = $this->request->getArguments();

		if(array_key_exists('useAgreements', $arguments['jobRequest'])){
			$arguments['jobRequest']['useAgreements'] != 1 ? $this->useAgreementsErrorMessage() : '';
		}
		$this->hydrateEditFromSession($jobRequest);
		if($jobRequest->getProcessStep() == 3){
			$endDate = new \DateTime();
			$endDate->setTimestamp($jobRequest->getStartDate()->getTimestamp());
			$endDate->modify('+'.$jobRequest->getNumberDaysPublication().'days');
			$jobRequest->setEndDate($endDate);
		}
		$this->jobRequestRepository->update($jobRequest);
		$jobRequest->increaseProcessStep();
		$this->session->setSerialized('jobRequestEdit', $jobRequest);

		if ($jobRequest->getProcessStep() >= \Sozialinfo\Jobs\Domain\Model\JobRequest::PROCESS_STEP_MAXIMUM) {
			$this->forward('update');
		}else{
			$this->redirect('edit');
		}
	}

	public function initializeUpdateAction() {
		/** @var \TYPO3\CMS\Extbase\Mvc\Controller\MvcPropertyMappingConfiguration */
		$propertyMappingConfiguration = $this->arguments['jobRequest']->getPropertyMappingConfiguration();
		$propertyMappingConfiguration->skipProperties('step');

		//$this->setTypeConverterConfigurationForImageUpload('jobRequest');

		if($this->arguments->hasArgument('jobRequest')){
			$arguments = $this->request->getArguments();
			if($arguments['jobRequest']['step'] == 5){
				// @var \TYPO3\CMS\Extbase\Validation\ValidatorResolver 
	            $validatorResolver = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Validation\\ValidatorResolver');
	            $extendedValidator = $validatorResolver->getBaseValidatorConjunction('\Sozialinfo\Jobs\Domain\Model\JobRequest');
	            // @var \TYPO3\CMS\Extbase\Validation\Validator\ConjunctionValidator
	            $conjunctionValidator = $this->arguments->getArgument('jobRequest')->getValidator();
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
	 * Update action.
	 *
	 * Last step of the edit form, updates the record.
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\JobRequest $jobRequest
	 * @return void
	 */
	public function updateAction(\Sozialinfo\Jobs\Domain\Model\JobRequest $jobRequest) {
		$this->hydrateEditFromSession($jobRequest);
		$this->jobRequestRepository->update($jobRequest);
		$this->persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
		$this->persistenceManager->persistAll();
		$this->session->remove('jobRequestEdit');
		$this->redirect('listUserSpecificData', 'FrontendUser', NULL, NULL, 110);
	}

	/**
	 * Previous Edit action.
	 * 
	 * Takes model a step back.
	 *
	 * @return void
	 */
	public function previousEditAction() {
		//$jobRequest = $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Model\\JobRequest');
		$this->hydrateEditFromSession($jobRequest);
		$jobRequest->decreaseProcessStep();
		$this->session->setSerialized('jobRequestEdit', $jobRequest);
		$this->redirect('edit');
	}

	/**
	 * Hydrate given object with data stored inside session.
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\JobRequest $jobRequest
	 * @return void
	 */
	protected function hydrateEditFromSession(\Sozialinfo\Jobs\Domain\Model\JobRequest &$jobRequest = NULL) {
		$newJobRequest = FALSE;
		if (!$jobRequest) {
			$jobRequest = $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Model\\JobRequest');
			$newJobRequest = TRUE;
		}
		$currentJobRequest = $this->session->getUnserialized('jobRequestEdit');
		
		if ($currentJobRequest) {
			if ($newJobRequest) {
				// Do not process properties on a plain new object,
				// as no new properties are given. If you do process it,
				// default properties are used for overriding in array_merge
				// and you will never leave step 0.
				$properties = array_filter(
					$currentJobRequest->_getPublicProperties(),
					'\\Sozialinfo\\Jobs\\Utility\\FunctionUtility::isNotNull'
				);
				//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($properties,'properties new job offer');
			} else {
				$properties = array_filter(
					$currentJobRequest->_getPublicProperties(),
					'\\Sozialinfo\\Jobs\\Utility\\FunctionUtility::isNotNull'
				);
								
				$propertiesToMerge = array_filter(
						$jobRequest->_getPublicProperties(),
						'\\Sozialinfo\\Jobs\\Utility\\FunctionUtility::isNotNull'
					);
				\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($properties,'properties');
				\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($propertiesToMerge,'propertiesToMerge');

				// !!!!IMPORTANT!!!!
				// Check if the Object is empty, if it's is empty, merge not, otherwise it would be merged everytime
				foreach($propertiesToMerge as $key => $value){
					if(!is_object($value) AND (($value != '') OR ($value === TRUE) OR ($value === FALSE))){
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
					}elseif($value instanceof \Sozialinfo\Jobs\Domain\Model\EmploymentRelationship) {
						$tmp = (array) $value;
						if(!empty($tmp)){
							$properties[$key] = $value;		
						}
					}elseif($value instanceof \Sozialinfo\Jobs\Domain\Model\Position) {
						$tmp = (array) $value;
						if(!empty($tmp)){
							$properties[$key] = $value;		
						}
					}elseif($value instanceof \DateTime) {
						$tmp = (array) $value;
						if(!empty($tmp)){
							$properties[$key] = $value;		
						}
					}elseif($value instanceof \Sozialinfo\Jobs\Domain\Model\Country) {
						$tmp = (array) $value;
						if(!empty($tmp)){
							$properties[$key] = $value;		
						}
					}elseif($value instanceof \Sozialinfo\Jobs\Domain\Model\AdvertisementType) {
						$tmp = (array) $value;
						if(!empty($tmp)){
							$properties[$key] = $value;		
						}
					}					
				}
			}		
			\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($properties,'properties end');	

			$jobRequest->_setProperties($properties);
		}
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$jobRequests = $this->jobRequestRepository->findAll();
		$this->view->assign('jobRequests', $jobRequests);
	}

	/**
	 * action show
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\JobRequest $jobRequest
	 * @return void
	 */
	public function showAction(\Sozialinfo\Jobs\Domain\Model\JobRequest $jobRequest) {
		$this->view->assign('jobRequest', $jobRequest);
	}

	/**
	 * action delete
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\JobRequest $jobRequest
	 * @return void
	 */
	public function deleteAction(\Sozialinfo\Jobs\Domain\Model\JobRequest $jobRequest) {
		$this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->jobRequestRepository->remove($jobRequest);
		$this->redirect('list');
	}

	/**
	 * cancel action
	 *
	 * Cancels the Job Request Form Process and clears the Session 
	 *
	 */
	public function cancelAction() {
		$this->session->remove('jobRequest');
		$this->redirect('list', NULL, NULL, NULL);
	}

	/**
	 * cancelEdit action
	 *
	 * Cancels the Job Request Edit Form Process and clears the Session 
	 *
	 */
	public function cancelEditAction() {
		$this->session->remove('jobRequestEdit');
		$this->redirect('list', NULL, NULL, NULL);
	}

	/**
	 * action confirmDelete
	 *
	 * @return void
	 */
	public function confirmDeleteAction() {
		
	}

	/**
	 * action preview
	 *
	 * @return void
	 */
	public function previewAction() {
		
	}

	/**
	 *
	 */
	protected function setTypeConverterConfigurationForImageUpload($argumentName) {

		$uploadConfiguration = array(
			UploadedFileReferenceConverter::CONFIGURATION_ALLOWED_FILE_EXTENSIONS => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
			UploadedFileReferenceConverter::CONFIGURATION_UPLOAD_FOLDER => '1:/content/'
		);

		$uploadConfigurationVideo = array(
			UploadedFileReferenceConverter::CONFIGURATION_ALLOWED_FILE_EXTENSIONS => $GLOBALS['TYPO3_CONF_VARS']['SYS']['mediafile_ext'],
			UploadedFileReferenceConverter::CONFIGURATION_UPLOAD_FOLDER => '1:/content/'
		);

		/** @var PropertyMappingConfiguration $newJobRequestConfiguration */
		$newJobRequestConfiguration = $this->arguments[$argumentName]->getPropertyMappingConfiguration();

		$newJobRequestConfiguration->forProperty('corporate')
			->setTypeConverterOptions(
				'Sozialinfo\\Jobs\\Property\\TypeConverter\\UploadedFileReferenceConverter',
				$uploadConfiguration
			);

		$newJobRequestConfiguration->forProperty('documents.0')
			->setTypeConverterOptions(
				'Sozialinfo\\Jobs\\Property\\TypeConverter\\UploadedFileReferenceConverter',
				$uploadConfigurationVideo
			);
	}

	/**
	 * get selected qualifications for form
	 *
	 * @return array
	 */
	public function getCheckedQualifications($jobRequest){
		$qualifications = $jobRequest->getQualification();
		$qualificationChecked = array();
		foreach($qualifications as $key => $value){
			$qualificationChecked[$value->getUid()] = $value->getUid();
		}
		return $qualificationChecked;
	}

	/**
	 * get selected areasOfWork for form
	 *
	 * @return array
	 */
	public function getCheckedAreasOfWork($jobRequest){
		$areasOfWork = $jobRequest->getAreasOfWork();
		$areasOfWorkChecked = array();
		foreach($areasOfWork as $key => $value){
			$areasOfWorkChecked[$value->getUid()] = $value->getUid();
		}
		return $areasOfWorkChecked;
	}

	/**
	 * get selected cantons for form
	 *
	 * @return array
	 */
	public function getCheckedCantons($jobRequest){
		$canton = $jobRequest->getCanton();
		$cantonsChecked = array();
		foreach($canton as $key => $value){
			$cantonsChecked[$value->getUid()] = $value->getUid();
		}
		return $cantonsChecked;
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

	/**
	 * generate flash message if useAgreements are not confirmed
	 *
	 */
	public function useAgreementsErrorMessage() {
		$this->addFlashMessage(
			\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_jobs_domain_model_joboffer.use_agreements_error_message','jobs'),
			'',
			\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR,
			TRUE
		);
		$action = $this->request->getControllerActionName();
		$action == 'continue' ? $this->redirect('new') : $this->redirect('edit');		
	}

}