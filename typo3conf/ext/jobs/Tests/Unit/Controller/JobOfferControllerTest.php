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
 * Test case for class Sozialinfo\Jobs\Controller\JobOfferController.
 *
 * @author Thomas Schallert <programmierung@sozialinfo.ch>
 */
class JobOfferControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \Sozialinfo\Jobs\Controller\JobOfferController
	 */
	protected $subject = NULL;

	public function setUp() {
		$this->subject = $this->getMock('Sozialinfo\\Jobs\\Controller\\JobOfferController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllJobOffersFromRepositoryAndAssignsThemToView() {

		$allJobOffers = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$jobOfferRepository = $this->getMock('Sozialinfo\\Jobs\\Domain\\Repository\\JobOfferRepository', array('findAll'), array(), '', FALSE);
		$jobOfferRepository->expects($this->once())->method('findAll')->will($this->returnValue($allJobOffers));
		$this->inject($this->subject, 'jobOfferRepository', $jobOfferRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('jobOffers', $allJobOffers);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenJobOfferToView() {
		$jobOffer = new \Sozialinfo\Jobs\Domain\Model\JobOffer();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('jobOffer', $jobOffer);

		$this->subject->showAction($jobOffer);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenJobOfferToJobOfferRepository() {
		$jobOffer = new \Sozialinfo\Jobs\Domain\Model\JobOffer();

		$jobOfferRepository = $this->getMock('Sozialinfo\\Jobs\\Domain\\Repository\\JobOfferRepository', array('add'), array(), '', FALSE);
		$jobOfferRepository->expects($this->once())->method('add')->with($jobOffer);
		$this->inject($this->subject, 'jobOfferRepository', $jobOfferRepository);

		$this->subject->createAction($jobOffer);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenJobOfferToView() {
		$jobOffer = new \Sozialinfo\Jobs\Domain\Model\JobOffer();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('jobOffer', $jobOffer);

		$this->subject->editAction($jobOffer);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenJobOfferInJobOfferRepository() {
		$jobOffer = new \Sozialinfo\Jobs\Domain\Model\JobOffer();

		$jobOfferRepository = $this->getMock('Sozialinfo\\Jobs\\Domain\\Repository\\JobOfferRepository', array('update'), array(), '', FALSE);
		$jobOfferRepository->expects($this->once())->method('update')->with($jobOffer);
		$this->inject($this->subject, 'jobOfferRepository', $jobOfferRepository);

		$this->subject->updateAction($jobOffer);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenJobOfferFromJobOfferRepository() {
		$jobOffer = new \Sozialinfo\Jobs\Domain\Model\JobOffer();

		$jobOfferRepository = $this->getMock('Sozialinfo\\Jobs\\Domain\\Repository\\JobOfferRepository', array('remove'), array(), '', FALSE);
		$jobOfferRepository->expects($this->once())->method('remove')->with($jobOffer);
		$this->inject($this->subject, 'jobOfferRepository', $jobOfferRepository);

		$this->subject->deleteAction($jobOffer);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenJobOfferFromJobOfferRepository() {
		$jobOffer = new \Sozialinfo\Jobs\Domain\Model\JobOffer();

		$jobOfferRepository = $this->getMock('Sozialinfo\\Jobs\\Domain\\Repository\\JobOfferRepository', array('remove'), array(), '', FALSE);
		$jobOfferRepository->expects($this->once())->method('remove')->with($jobOffer);
		$this->inject($this->subject, 'jobOfferRepository', $jobOfferRepository);

		$this->subject->deleteAction($jobOffer);
	}
}
