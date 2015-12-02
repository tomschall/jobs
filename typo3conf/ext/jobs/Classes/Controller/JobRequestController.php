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
	 * action new
	 *
	 * @return void
	 */
	public function newAction() {
		
	}

	/**
	 * action create
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\JobRequest $newJobRequest
	 * @return void
	 */
	public function createAction(\Sozialinfo\Jobs\Domain\Model\JobRequest $newJobRequest) {
		$this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->jobRequestRepository->add($newJobRequest);
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\JobRequest $jobRequest
	 * @ignorevalidation $jobRequest
	 * @return void
	 */
	public function editAction(\Sozialinfo\Jobs\Domain\Model\JobRequest $jobRequest) {
		$this->view->assign('jobRequest', $jobRequest);
	}

	/**
	 * action update
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\JobRequest $jobRequest
	 * @return void
	 */
	public function updateAction(\Sozialinfo\Jobs\Domain\Model\JobRequest $jobRequest) {
		$this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->jobRequestRepository->update($jobRequest);
		$this->redirect('list');
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