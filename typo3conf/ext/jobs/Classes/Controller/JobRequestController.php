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
	}

	public function initializeContinueAction() {

		$arguments = $this->request->getArguments();
		//$this->setTypeConverterConfigurationForImageUpload('jobOffer');

		/** @var \TYPO3\CMS\Extbase\Mvc\Controller\MvcPropertyMappingConfiguration */
		$propertyMappingConfiguration = $this->arguments['jobRequest']->getPropertyMappingConfiguration();

		$propertyMappingConfiguration->allowProperties('canton');
		$propertyMappingConfiguration->allowCreationForSubProperty('canton.*');
		$propertyMappingConfiguration->forProperty('canton')->allowAllPropertiesExcept('uid', 'pid');

		$propertyMappingConfiguration->skipProperties('step');		

		if(isset($this->arguments['jobRequest'])) {
			if($arguments['jobRequest']['step'] == 0){
				$this->arguments['jobRequest']
				->getPropertyMappingConfiguration()
				->forProperty('startDate')
				->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');

				$this->arguments['jobRequest']
				->getPropertyMappingConfiguration()
				->forProperty('endDate')
				->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');

				$this->arguments['jobRequest']
				->getPropertyMappingConfiguration()
				->forProperty('entryDate')
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
		$this->hydrateFromSession($jobRequest);
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

		//$this->setTypeConverterConfigurationForImageUpload('jobOffer');
		
		/*
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
	    */
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
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($jobRequest,'after hydrate');
		$this->hydrateFromSession($jobRequest);
		$this->jobRequestRepository->add($jobRequest);
		$this->persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
		$this->persistenceManager->persistAll();
		$this->session->remove('jobRequest');
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
		$jobRequest = $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Model\\JobRequest');
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
					}elseif($value instanceof \DateTime) {
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
	public function editAction(\Sozialinfo\Jobs\Domain\Model\JobRequest $jobRequest=NULL) {
		$this->hydrateEditFromSession($jobRequest);
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($jobRequest,'after hydrate');
		$this->view->assign('canton', $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Repository\\CantonRepository')->findAll());
		$this->view->assign('jobRequest', $jobRequest);
	}

	public function initializeContinueEditAction() {

		/** @var \TYPO3\CMS\Extbase\Mvc\Controller\MvcPropertyMappingConfiguration */
		$propertyMappingConfiguration = $this->arguments['jobRequest']->getPropertyMappingConfiguration();
		$propertyMappingConfiguration->skipProperties('step');
		
		$this->setTypeConverterConfigurationForImageUpload('jobRequest');

		if(isset($this->arguments['jobRequest'])) {
			if($arguments['jobRequest']['step'] == 0){
				$this->arguments[$jobRequest]
				->getPropertyMappingConfiguration()
				->forProperty('startDate')
				->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');

				$this->arguments[$jobRequest]
				->getPropertyMappingConfiguration()
				->forProperty('endDate')
				->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');

				$this->arguments[$jobRequest]
				->getPropertyMappingConfiguration()
				->forProperty('entryDate')
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
		$this->hydrateEditFromSession($jobRequest);
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
		$this->redirect('list', NULL, NULL, NULL);
	}

	/**
	 * Previous Edit action.
	 * 
	 * Takes model a step back.
	 *
	 * @return void
	 */
	public function previousEditAction() {
		$jobRequest = $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Model\\JobRequest');
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
				//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($properties,'properties');
				//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($propertiesToMerge,'propertiesToMerge');

				// !!!!IMPORTANT!!!!
				// Check if the Object is empty, if it's is empty, merge not, otherwise it would be merged everytime
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
					}elseif($value instanceof \DateTime) {
						$tmp = (array) $value;
						if(!empty($tmp)){
							$properties[$key] = $value;		
						}
					}

				}
			}		
			//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($properties,'properties end');	
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

}