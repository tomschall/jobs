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
 * Test case for class Sozialinfo\Jobs\Controller\FrontendUserController.
 *
 * @author Thomas Schallert <programmierung@sozialinfo.ch>
 */
class FrontendUserControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \Sozialinfo\Jobs\Controller\FrontendUserController
	 */
	protected $subject = NULL;

	public function setUp() {
		$this->subject = $this->getMock('Sozialinfo\\Jobs\\Controller\\FrontendUserController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllFrontendUsersFromRepositoryAndAssignsThemToView() {

		$allFrontendUsers = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$frontendUserRepository = $this->getMock('Sozialinfo\\Jobs\\Domain\\Repository\\FrontendUserRepository', array('findAll'), array(), '', FALSE);
		$frontendUserRepository->expects($this->once())->method('findAll')->will($this->returnValue($allFrontendUsers));
		$this->inject($this->subject, 'frontendUserRepository', $frontendUserRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('frontendUsers', $allFrontendUsers);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenFrontendUserToView() {
		$frontendUser = new \Sozialinfo\Jobs\Domain\Model\FrontendUser();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('frontendUser', $frontendUser);

		$this->subject->showAction($frontendUser);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenFrontendUserToFrontendUserRepository() {
		$frontendUser = new \Sozialinfo\Jobs\Domain\Model\FrontendUser();

		$frontendUserRepository = $this->getMock('Sozialinfo\\Jobs\\Domain\\Repository\\FrontendUserRepository', array('add'), array(), '', FALSE);
		$frontendUserRepository->expects($this->once())->method('add')->with($frontendUser);
		$this->inject($this->subject, 'frontendUserRepository', $frontendUserRepository);

		$this->subject->createAction($frontendUser);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenFrontendUserToView() {
		$frontendUser = new \Sozialinfo\Jobs\Domain\Model\FrontendUser();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('frontendUser', $frontendUser);

		$this->subject->editAction($frontendUser);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenFrontendUserInFrontendUserRepository() {
		$frontendUser = new \Sozialinfo\Jobs\Domain\Model\FrontendUser();

		$frontendUserRepository = $this->getMock('Sozialinfo\\Jobs\\Domain\\Repository\\FrontendUserRepository', array('update'), array(), '', FALSE);
		$frontendUserRepository->expects($this->once())->method('update')->with($frontendUser);
		$this->inject($this->subject, 'frontendUserRepository', $frontendUserRepository);

		$this->subject->updateAction($frontendUser);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenFrontendUserFromFrontendUserRepository() {
		$frontendUser = new \Sozialinfo\Jobs\Domain\Model\FrontendUser();

		$frontendUserRepository = $this->getMock('Sozialinfo\\Jobs\\Domain\\Repository\\FrontendUserRepository', array('remove'), array(), '', FALSE);
		$frontendUserRepository->expects($this->once())->method('remove')->with($frontendUser);
		$this->inject($this->subject, 'frontendUserRepository', $frontendUserRepository);

		$this->subject->deleteAction($frontendUser);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenFrontendUserFromFrontendUserRepository() {
		$frontendUser = new \Sozialinfo\Jobs\Domain\Model\FrontendUser();

		$frontendUserRepository = $this->getMock('Sozialinfo\\Jobs\\Domain\\Repository\\FrontendUserRepository', array('remove'), array(), '', FALSE);
		$frontendUserRepository->expects($this->once())->method('remove')->with($frontendUser);
		$this->inject($this->subject, 'frontendUserRepository', $frontendUserRepository);

		$this->subject->deleteAction($frontendUser);
	}
}
