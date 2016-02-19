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
 * JobOfferController
 */
class JobOfferController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * jobOfferRepository
	 *
	 * @var \Sozialinfo\Jobs\Domain\Repository\JobOfferRepository
	 * @inject
	 */
	protected $jobOfferRepository = NULL;

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
	 * @param \Sozialinfo\Jobs\Domain\Model\JobOffer $jobOffer
	 * @ignorevalidation $jobOffer
	 * @return void
	  */
	public function newAction($jobOffer = NULL) {
		$this->hydrateFromSession($jobOffer);
		
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($jobOffer,'newAction jobOffer');
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->frontendUserRepository->findByUid($GLOBALS['TSFE']->fe_user->user['uid']),'frontendUser');
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->getSalutation(),'salutation');
		
		$this->view->assign('jobOffer', $jobOffer);
		$this->view->assign('canton', $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Repository\\CantonRepository')->findAll());
		$this->view->assign('employmentRelationships', $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Repository\\EmploymentRelationshipRepository')->findAll());
		$this->view->assign('position', $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Repository\\PositionRepository')->findAll());
		$this->view->assign('qualification', $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Repository\\QualificationRepository')->findAll());
		$this->view->assign('areasOfWork', $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Repository\\AreasOfWorkRepository')->findAll());
		$this->view->assign('qualificationChecked', $this->getCheckedQualifications($jobOffer));
		$this->view->assign('areasOfWorkChecked', $this->getCheckedAreasOfWork($jobOffer));
		$this->view->assign('cantonSelected', $this->getCheckedCantons($jobOffer));
		$this->view->assign('frontendUser', $this->frontendUserRepository->findByUid($GLOBALS['TSFE']->fe_user->user['uid']));
		$this->view->assign('postalAddressTitles', $this->getSalutation());
		$this->view->assign('postalAddressCountries', $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Repository\\CountryRepository')->findAll());
		
	}

	/**
	 * initialize continue action.
	 *
	 */
	public function initializeContinueAction() {

		$arguments = $this->request->getArguments();

		/** @var \TYPO3\CMS\Extbase\Mvc\Controller\MvcPropertyMappingConfiguration */
		$propertyMappingConfiguration = $this->arguments['jobOffer']->getPropertyMappingConfiguration();
		
		// these are multiple select fields, if they are empty, you have to set property mapper to skip property, otherwise validation will not work correct
		$arguments['jobOffer']['qualification'] == '' ? $propertyMappingConfiguration->skipProperties('qualification') : '';
		$arguments['jobOffer']['areasOfWork'] == '' ? $propertyMappingConfiguration->skipProperties('areasOfWork') : '';
		$arguments['jobOffer']['canton'] == '' ? $propertyMappingConfiguration->skipProperties('canton') : '';

		$propertyMappingConfiguration->skipProperties('step');

		$this->setTypeConverterConfigurationForImageUpload('jobOffer');

		if(isset($this->arguments['jobOffer'])) {
			if($arguments['jobOffer']['step'] == 0){
				$this->arguments[$jobOffer]
				->getPropertyMappingConfiguration()
				->forProperty('entryDate')
				->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');

				$this->arguments[$jobOffer]
				->getPropertyMappingConfiguration()
				->forProperty('applicationDeadline')
				->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');
			}elseif($arguments['jobOffer']['step'] == 3){
				$this->arguments[$jobOffer]
				->getPropertyMappingConfiguration()
				->forProperty('startDate')
				->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');
			}
		}

		
		// dynamic validation because of different steps
		// @var \TYPO3\CMS\Extbase\Validation\ValidatorResolver 
        $validatorResolver = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Validation\\ValidatorResolver');
        $arguments['jobOffer']['step'] == 0 ? $extendedValidator = $validatorResolver->getBaseValidatorConjunction('\Sozialinfo\Jobs\Domain\Model\JobOfferDynamicValidation0') : '';
        $arguments['jobOffer']['step'] == 1 ? $extendedValidator = $validatorResolver->getBaseValidatorConjunction('\Sozialinfo\Jobs\Domain\Model\JobOfferDynamicValidation1') : '';
        $arguments['jobOffer']['step'] == 2 ? $extendedValidator = $validatorResolver->getBaseValidatorConjunction('\Sozialinfo\Jobs\Domain\Model\JobOfferDynamicValidation2') : '';
        $arguments['jobOffer']['step'] == 3 ? $extendedValidator = $validatorResolver->getBaseValidatorConjunction('\Sozialinfo\Jobs\Domain\Model\JobOfferDynamicValidation3') : '';
        $arguments['jobOffer']['step'] == 4 ? $extendedValidator = $validatorResolver->getBaseValidatorConjunction('\Sozialinfo\Jobs\Domain\Model\JobOfferDynamicValidation4') : '';

        // @var \TYPO3\CMS\Extbase\Validation\Validator\ConjunctionValidator
        $conjunctionValidator = $this->arguments->getArgument('jobOffer')->getValidator();
        // remove old validator
        foreach ($conjunctionValidator->getValidators() as $validator) {
            $conjunctionValidator->removeValidator($validator);
        }
        // add validators of model ItemDynamicValidation
        $conjunctionValidator->addValidator($extendedValidator);
    }

	/**
	 * Continue action.
	 *
	 * Validates the object, stores data inside session and continues to the next step.
	 *
	 * Remember that data coming from the $model parameter only contains data from the
	 * current step (unless you put a lot of hidden fields inside your view for each step).
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\jobOffer $jobOffer
	 * @return void
	 */
	public function continueAction(\Sozialinfo\Jobs\Domain\Model\JobOffer $jobOffer) {
		$arguments = $this->request->getArguments();

		if(array_key_exists('useAgreements', $arguments['jobOffer'])){
			$arguments['jobOffer']['useAgreements'] != 1 ? $this->useAgreementsErrorMessage() : '';
		}
		$this->hydrateFromSession($jobOffer);
		if($jobOffer->getProcessStep() == 3){
			$endDate = new \DateTime();
			$endDate->setTimestamp($jobOffer->getStartDate()->getTimestamp());
			$endDate->modify('+'.$jobOffer->getNumberDaysPublication().'days');
			$jobOffer->setEndDate($endDate);
		}
		$jobOffer->increaseProcessStep();
		$this->session->setSerialized('jobOffer', $jobOffer);
		
		if ($jobOffer->getProcessStep() >= \Sozialinfo\Jobs\Domain\Model\JobOffer::PROCESS_STEP_MAXIMUM) {
			$this->forward('create');
		}else{
			$this->redirect('new');
		}
	}

	public function initializeCreateAction() {
		/** @var \TYPO3\CMS\Extbase\Mvc\Controller\MvcPropertyMappingConfiguration */
		$propertyMappingConfiguration = $this->arguments['jobOffer']->getPropertyMappingConfiguration();
		$propertyMappingConfiguration->skipProperties('step');

		//$this->setTypeConverterConfigurationForImageUpload('jobOffer');
		
		if($this->arguments->hasArgument('jobOffer')){
			$arguments = $this->request->getArguments();
			if($arguments['jobOffer']['step'] == 5){
				// @var \TYPO3\CMS\Extbase\Validation\ValidatorResolver 
	            $validatorResolver = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Validation\\ValidatorResolver');
	            $extendedValidator = $validatorResolver->getBaseValidatorConjunction('\Sozialinfo\Jobs\Domain\Model\JobOffer');
	            // @var \TYPO3\CMS\Extbase\Validation\Validator\ConjunctionValidator
	            $conjunctionValidator = $this->arguments->getArgument('jobOffer')->getValidator();
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
	 * @param \Sozialinfo\Jobs\Domain\Model\JobOffer $jobOffer
	 * @return void
	 */
	public function createAction(\Sozialinfo\Jobs\Domain\Model\JobOffer $jobOffer) {
		$this->hydrateFromSession($jobOffer);
		$this->jobOfferRepository->add($jobOffer);
		$frontendUser = $this->frontendUserRepository->findByUid($GLOBALS['TSFE']->fe_user->user['uid']);
		if($frontendUser instanceof \Sozialinfo\Jobs\Domain\Model\FrontendUser){
			$frontendUser->addJobOffer($jobOffer);
			$this->frontendUserRepository->update($frontendUser);
		}else{
			$this->addFlashMessage('User war nicht eingeloggt, Object JobOffer konnte somit nicht dem FeUser hinzugefügt werden.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
			$this->session->remove('jobOffer');
			$this->redirect('list', NULL, NULL, NULL);	
		}		
		$this->persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
		$this->persistenceManager->persistAll();
		$this->session->remove('jobOffer');

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
		//$jobOffer = $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Model\\JobOffer');
		$this->hydrateFromSession($jobOffer);
		$jobOffer->decreaseProcessStep();
		$this->session->setSerialized('jobOffer', $jobOffer);
		$this->redirect('new');
	}

	/**
	 * Hydrate given object with data stored inside session.
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\JobOffer $jobOffer
	 * @return void
	 */
	protected function hydrateFromSession(\Sozialinfo\Jobs\Domain\Model\JobOffer &$jobOffer = NULL) {
		$newJobOffer = FALSE;
		if(!$jobOffer){
			$jobOffer = $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Model\\JobOffer');
			//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($jobOffer,'newJobOffer');
			$newJobOffer = TRUE;
		}
		$currentJobOffer = $this->session->getUnserialized('jobOffer');
		
		if($currentJobOffer){
			if($newJobOffer){
				// Do not process properties on a plain new object,
				// as no new properties are given. If you do process it,
				// default properties are used for overriding in array_merge
				// and you will never leave step 0.
				$properties = array_filter(
					$currentJobOffer->_getPublicProperties(),
					'\\Sozialinfo\\Jobs\\Utility\\FunctionUtility::isNotNull'
				);
			}else{
				$properties = array_filter(
						$currentJobOffer->_getPublicProperties(),
						'\\Sozialinfo\\Jobs\\Utility\\FunctionUtility::isNotNull'
					);
				$propertiesToMerge = array_filter(
						$jobOffer->_getPublicProperties(),
						'\\Sozialinfo\\Jobs\\Utility\\FunctionUtility::isNotNull'
					);
				//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($properties,'properties');
				//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($propertiesToMerge,'propertiesToMerge');
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
			$jobOffer->_setProperties($properties);
			//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($properties,'properties');
			
		}
	}

	/**
	 * edit action.
	 *
	 * Displays edit form in its current step.
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\JobOffer $jobOffer
	 * @ignorevalidation $jobOffer
	 * @return void
	  */
	public function editAction($jobOffer=NULL) {
		$this->hydrateEditFromSession($jobOffer);
		
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($currentJobOffer,'currentJobOffer');
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($jobOffer,'after hydrate');
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($_SESSION);

		$this->view->assign('jobOffer', $jobOffer);
		$this->view->assign('canton', $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Repository\\CantonRepository')->findAll());
		$this->view->assign('employmentRelationships', $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Repository\\EmploymentRelationshipRepository')->findAll());
		$this->view->assign('position', $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Repository\\PositionRepository')->findAll());
		$this->view->assign('qualification', $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Repository\\QualificationRepository')->findAll());
		$this->view->assign('areasOfWork', $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Repository\\AreasOfWorkRepository')->findAll());
		$this->view->assign('qualificationChecked', $this->getCheckedQualifications($jobOffer));
		$this->view->assign('areasOfWorkChecked', $this->getCheckedAreasOfWork($jobOffer));
		$this->view->assign('cantonSelected', $this->getCheckedCantons($jobOffer));
		$this->view->assign('frontendUser', $this->frontendUserRepository->findByUid($GLOBALS['TSFE']->fe_user->user['uid']));
		$this->view->assign('postalAddressTitles', $this->getSalutation());
		$this->view->assign('postalAddressCountries', $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Repository\\CountryRepository')->findAll());
	}

	/**
	 * initialize the edit continue action.
	 *
	 */
	public function initializeContinueEditAction() {

		$arguments = $this->request->getArguments();

		/** @var \TYPO3\CMS\Extbase\Mvc\Controller\MvcPropertyMappingConfiguration */
		$propertyMappingConfiguration = $this->arguments['jobOffer']->getPropertyMappingConfiguration();

		$arguments['jobOffer']['qualification'] == '' ? $propertyMappingConfiguration->skipProperties('qualification') : '';
		$arguments['jobOffer']['areasOfWork'] == '' ? $propertyMappingConfiguration->skipProperties('areasOfWork') : '';
		$arguments['jobOffer']['canton'] == '' ? $propertyMappingConfiguration->skipProperties('canton') : '';
		//$arguments['jobOffer']['documents'] != '' ? $propertyMappingConfiguration->skipProperties('documents') : '';

		$propertyMappingConfiguration->skipProperties('step');

		$this->setTypeConverterConfigurationForImageUpload('jobOffer');

		if(isset($this->arguments['jobOffer'])) {
			if($arguments['jobOffer']['step'] == 0){
				$this->arguments[$jobOffer]
				->getPropertyMappingConfiguration()
				->forProperty('entryDate')
				->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');

				$this->arguments[$jobOffer]
				->getPropertyMappingConfiguration()
				->forProperty('applicationDeadline')
				->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');
			}elseif($arguments['jobOffer']['step'] == 3){
				$this->arguments[$jobOffer]
				->getPropertyMappingConfiguration()
				->forProperty('startDate')
				->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');
			}
		}

		// dynamic validation because of different steps
		// @var \TYPO3\CMS\Extbase\Validation\ValidatorResolver 
        $validatorResolver = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Validation\\ValidatorResolver');
        $arguments['jobOffer']['step'] == 0 ? $extendedValidator = $validatorResolver->getBaseValidatorConjunction('\Sozialinfo\Jobs\Domain\Model\JobOfferDynamicValidation0') : '';
        $arguments['jobOffer']['step'] == 1 ? $extendedValidator = $validatorResolver->getBaseValidatorConjunction('\Sozialinfo\Jobs\Domain\Model\JobOfferDynamicValidation1') : '';
        $arguments['jobOffer']['step'] == 2 ? $extendedValidator = $validatorResolver->getBaseValidatorConjunction('\Sozialinfo\Jobs\Domain\Model\JobOfferDynamicValidation2') : '';
        $arguments['jobOffer']['step'] == 3 ? $extendedValidator = $validatorResolver->getBaseValidatorConjunction('\Sozialinfo\Jobs\Domain\Model\JobOfferDynamicValidation3') : '';
        $arguments['jobOffer']['step'] == 4 ? $extendedValidator = $validatorResolver->getBaseValidatorConjunction('\Sozialinfo\Jobs\Domain\Model\JobOfferDynamicValidation4') : '';
        // @var \TYPO3\CMS\Extbase\Validation\Validator\ConjunctionValidator
        $conjunctionValidator = $this->arguments->getArgument('jobOffer')->getValidator();
        // remove old validator
        foreach ($conjunctionValidator->getValidators() as $validator) {
            $conjunctionValidator->removeValidator($validator);
        }
        // add validators of model ItemDynamicValidation
        $conjunctionValidator->addValidator($extendedValidator);
    }
	
	/**
	 * Continue edit action.
	 *
	 * shows current object data, Validates the object and
	 * stores data inside session and continues to the next step.
	 *
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\jobOffer $jobOffer
	 * @return void
	 */
	public function continueEditAction(\Sozialinfo\Jobs\Domain\Model\JobOffer $jobOffer) {
		$arguments = $this->request->getArguments();

		if(array_key_exists('useAgreements', $arguments['jobOffer'])){
			$arguments['jobOffer']['useAgreements'] != 1 ? $this->useAgreementsErrorMessage() : '';
		}
		$this->hydrateEditFromSession($jobOffer);
		if($jobOffer->getProcessStep() == 3){
			$endDate = new \DateTime();
			$endDate->setTimestamp($jobOffer->getStartDate()->getTimestamp());
			$endDate->modify('+'.$jobOffer->getNumberDaysPublication().'days');
			$jobOffer->setEndDate($endDate);
		}		
		$this->jobOfferRepository->update($jobOffer);
		$jobOffer->increaseProcessStep();
		$this->session->setSerialized('jobOfferEdit', $jobOffer);

		if ($jobOffer->getProcessStep() >= \Sozialinfo\Jobs\Domain\Model\JobOffer::PROCESS_STEP_MAXIMUM) {
			$this->forward('update');
		}else{
			$this->redirect('edit');
		}
	}

	public function initializeUpdateAction() {
		/** @var \TYPO3\CMS\Extbase\Mvc\Controller\MvcPropertyMappingConfiguration */
		$propertyMappingConfiguration = $this->arguments['jobOffer']->getPropertyMappingConfiguration();
		$propertyMappingConfiguration->skipProperties('step');

		//$this->setTypeConverterConfigurationForImageUpload('jobOffer');

		if($this->arguments->hasArgument('jobOffer')){
			$arguments = $this->request->getArguments();
			if($arguments['jobOffer']['step'] == 5){
				// @var \TYPO3\CMS\Extbase\Validation\ValidatorResolver 
	            $validatorResolver = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Validation\\ValidatorResolver');
	            $extendedValidator = $validatorResolver->getBaseValidatorConjunction('\Sozialinfo\Jobs\Domain\Model\JobOffer');
	            // @var \TYPO3\CMS\Extbase\Validation\Validator\ConjunctionValidator
	            $conjunctionValidator = $this->arguments->getArgument('jobOffer')->getValidator();
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
	 * @param \Sozialinfo\Jobs\Domain\Model\JobOffer $jobOffer
	 * @return void
	 */
	public function updateAction(\Sozialinfo\Jobs\Domain\Model\JobOffer $jobOffer) {
		$this->hydrateEditFromSession($jobOffer);
		$this->jobOfferRepository->update($jobOffer);
		$this->persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
		$this->persistenceManager->persistAll();
		$this->session->remove('jobOfferEdit');
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
		//$jobOffer = $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Model\\JobOffer');
		$this->hydrateEditFromSession($jobOffer);
		$jobOffer->decreaseProcessStep();
		$this->session->setSerialized('jobOfferEdit', $jobOffer);
		$this->redirect('edit');
	}

	/**
	 * Hydrate given object with data stored inside session.
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\JobOffer $jobOffer
	 * @return void
	 */
	protected function hydrateEditFromSession(\Sozialinfo\Jobs\Domain\Model\JobOffer &$jobOffer = NULL) {
		$newJobOffer = FALSE;
		if (!$jobOffer) {
			$jobOffer = $this->objectManager->get('Sozialinfo\\Jobs\\Domain\\Model\\JobOffer');
			$newJobOffer = TRUE;
		}
		$currentJobOffer = $this->session->getUnserialized('jobOfferEdit');
		if ($currentJobOffer) {
			if ($newJobOffer) {
				// Do not process properties on a plain new object,
				// as no new properties are given. If you do process it,
				// default properties are used for overriding in array_merge
				// and you will never leave step 0.
				$properties = array_filter(
					$currentJobOffer->_getPublicProperties(),
					'\\Sozialinfo\\Jobs\\Utility\\FunctionUtility::isNotNull'
				);
				//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($properties,'properties new job offer');
			} else {
				// If the form for corporate or documents is on a higher step than step1, 
				// there needs to be generated an ObjectStorage/FileReference, 
				// otherwise the merging process will not work properly
				 
				if($currentJobOffer->getProcessStep() == 0){
					$currentJobOffer->setDocuments(new \TYPO3\CMS\Extbase\Persistence\ObjectStorage());
					$currentJobOffer->setCorporate(new \TYPO3\CMS\Extbase\Domain\Model\FileReference());
				}
				
				$properties = array_filter(
					$currentJobOffer->_getPublicProperties(),
					'\\Sozialinfo\\Jobs\\Utility\\FunctionUtility::isNotNull'
				);
				
				$propertiesToMerge = array_filter(
					$jobOffer->_getPublicProperties(),
					'\\Sozialinfo\\Jobs\\Utility\\FunctionUtility::isNotNull'
				);
				//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($properties,'properties');
				//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($propertiesToMerge,'propertiesToMerge');
				
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
			//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($properties,'properties end');	
			$jobOffer->_setProperties($properties);
		}
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$jobOffers = $this->jobOfferRepository->findAll();
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($jobOffers);
		$this->view->assign('jobOffers', $jobOffers);
	}

	/**
	 * action show
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\JobOffer $jobOffer
	 * @return void
	 */
	public function showAction(\Sozialinfo\Jobs\Domain\Model\JobOffer $jobOffer) {
		$this->view->assign('jobOffer', $jobOffer);
	}

	

	/**
	 * action delete
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\JobOffer $jobOffer
	 * @ignorevalidation $jobOffer
	 * @return void
	 */
	public function deleteAction(\Sozialinfo\Jobs\Domain\Model\JobOffer $jobOffer) {
		$this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->jobOfferRepository->remove($jobOffer);
		$this->redirect('listUserSpecificData', 'FrontendUser', NULL, NULL, 110);
	}

	/**
	 * cancel action
	 *
	 * Cancels the Job Offer Form Process and clears the Session 
	 *
	 */
	public function cancelAction() {
		$this->session->remove('jobOffer');
		$this->redirect('listUserSpecificData', 'FrontendUser', NULL, NULL, 110);
	}

	/**
	 * cancelEdit action
	 *
	 * Cancels the Job Offer Edit Form Process and clears the Session 
	 *
	 */
	public function cancelEditAction() {
		$this->session->remove('jobOfferEdit');
		$this->redirect('listUserSpecificData', 'FrontendUser', NULL, NULL, 110);
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
			UploadedFileReferenceConverter::CONFIGURATION_ALLOWED_FILE_EXTENSIONS => 'gif,jpg,jpeg,png',
			UploadedFileReferenceConverter::CONFIGURATION_UPLOAD_FOLDER => '1:/content/'
		);

		$uploadConfigurationVideo = array(
			UploadedFileReferenceConverter::CONFIGURATION_ALLOWED_FILE_EXTENSIONS => $GLOBALS['TYPO3_CONF_VARS']['SYS']['mediafile_ext'],
			UploadedFileReferenceConverter::CONFIGURATION_UPLOAD_FOLDER => '1:/content/'
		);

		/** @var PropertyMappingConfiguration $newJobOfferConfiguration */
		$newJobOfferConfiguration = $this->arguments[$argumentName]->getPropertyMappingConfiguration();

		$newJobOfferConfiguration->forProperty('corporate')
			->setTypeConverterOptions(
				'Sozialinfo\\Jobs\\Property\\TypeConverter\\UploadedFileReferenceConverter',
				$uploadConfiguration
			);

		$newJobOfferConfiguration->forProperty('documents.0')
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
	public function getCheckedQualifications($jobOffer){
		$qualifications = $jobOffer->getQualification();
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
	public function getCheckedAreasOfWork($jobOffer){
		$areasOfWork = $jobOffer->getAreasOfWork();
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
	public function getCheckedCantons($jobOffer){
		$canton = $jobOffer->getCanton();
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