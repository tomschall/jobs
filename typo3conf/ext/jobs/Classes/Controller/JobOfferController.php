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
	 * action new
	 * @param \Sozialinfo\Jobs\Domain\Model\JobOffer $newJobOffer
	 *
	 * @return void
	 */
	public function newAction(\Sozialinfo\Jobs\Domain\Model\JobOffer $newJobOffer = NULL) {
		
	}

	public function initializeCreateAction() {
		if(isset($this->arguments['newJobOffer'])) {
			$this->arguments[$newJobOffer]
			->getPropertyMappingConfiguration()
			->forProperty('startDate')
			->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');

			$this->arguments[$newActivity]
			->getPropertyMappingConfiguration()
			->forProperty('endDate')
			->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');

			$this->arguments[$newActivity]
			->getPropertyMappingConfiguration()
			->forProperty('entryDate')
			->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');
		}
	}

	/**
	 * action create
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\JobOffer $newJobOffer
	 * @return void
	 */
	public function createAction(\Sozialinfo\Jobs\Domain\Model\JobOffer $newJobOffer) {
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($newJobOffer);
		$this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->jobOfferRepository->add($newJobOffer);
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\JobOffer $jobOffer
	 * @ignorevalidation $jobOffer
	 * @return void
	 */
	public function editAction(\Sozialinfo\Jobs\Domain\Model\JobOffer $jobOffer) {
		$this->view->assign('jobOffer', $jobOffer);
	}

	/**
	 * action update
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\JobOffer $jobOffer
	 * @return void
	 */
	public function updateAction(\Sozialinfo\Jobs\Domain\Model\JobOffer $jobOffer) {
		$this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->jobOfferRepository->update($jobOffer);
		$this->redirect('list');
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
		$this->redirect('list');
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

}