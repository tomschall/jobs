<?php
namespace Sozialinfo\Jobs\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Thomas Schallert <programmierung@sozialinfo.ch>, Sozialinfo
 *  			
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class Sozialinfo\Jobs\Controller\JobRequestController.
 *
 * @author Thomas Schallert <programmierung@sozialinfo.ch>
 */
class JobRequestControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \Sozialinfo\Jobs\Controller\JobRequestController
	 */
	protected $subject = NULL;

	public function setUp() {
		$this->subject = $this->getMock('Sozialinfo\\Jobs\\Controller\\JobRequestController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllJobRequestsFromRepositoryAndAssignsThemToView() {

		$allJobRequests = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$jobRequestRepository = $this->getMock('Sozialinfo\\Jobs\\Domain\\Repository\\JobRequestRepository', array('findAll'), array(), '', FALSE);
		$jobRequestRepository->expects($this->once())->method('findAll')->will($this->returnValue($allJobRequests));
		$this->inject($this->subject, 'jobRequestRepository', $jobRequestRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('jobRequests', $allJobRequests);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenJobRequestToView() {
		$jobRequest = new \Sozialinfo\Jobs\Domain\Model\JobRequest();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('jobRequest', $jobRequest);

		$this->subject->showAction($jobRequest);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenJobRequestToJobRequestRepository() {
		$jobRequest = new \Sozialinfo\Jobs\Domain\Model\JobRequest();

		$jobRequestRepository = $this->getMock('Sozialinfo\\Jobs\\Domain\\Repository\\JobRequestRepository', array('add'), array(), '', FALSE);
		$jobRequestRepository->expects($this->once())->method('add')->with($jobRequest);
		$this->inject($this->subject, 'jobRequestRepository', $jobRequestRepository);

		$this->subject->createAction($jobRequest);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenJobRequestToView() {
		$jobRequest = new \Sozialinfo\Jobs\Domain\Model\JobRequest();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('jobRequest', $jobRequest);

		$this->subject->editAction($jobRequest);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenJobRequestInJobRequestRepository() {
		$jobRequest = new \Sozialinfo\Jobs\Domain\Model\JobRequest();

		$jobRequestRepository = $this->getMock('Sozialinfo\\Jobs\\Domain\\Repository\\JobRequestRepository', array('update'), array(), '', FALSE);
		$jobRequestRepository->expects($this->once())->method('update')->with($jobRequest);
		$this->inject($this->subject, 'jobRequestRepository', $jobRequestRepository);

		$this->subject->updateAction($jobRequest);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenJobRequestFromJobRequestRepository() {
		$jobRequest = new \Sozialinfo\Jobs\Domain\Model\JobRequest();

		$jobRequestRepository = $this->getMock('Sozialinfo\\Jobs\\Domain\\Repository\\JobRequestRepository', array('remove'), array(), '', FALSE);
		$jobRequestRepository->expects($this->once())->method('remove')->with($jobRequest);
		$this->inject($this->subject, 'jobRequestRepository', $jobRequestRepository);

		$this->subject->deleteAction($jobRequest);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenJobRequestFromJobRequestRepository() {
		$jobRequest = new \Sozialinfo\Jobs\Domain\Model\JobRequest();

		$jobRequestRepository = $this->getMock('Sozialinfo\\Jobs\\Domain\\Repository\\JobRequestRepository', array('remove'), array(), '', FALSE);
		$jobRequestRepository->expects($this->once())->method('remove')->with($jobRequest);
		$this->inject($this->subject, 'jobRequestRepository', $jobRequestRepository);

		$this->subject->deleteAction($jobRequest);
	}
}
