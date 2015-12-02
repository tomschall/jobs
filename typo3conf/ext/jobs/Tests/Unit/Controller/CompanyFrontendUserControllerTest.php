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
 * Test case for class Sozialinfo\Jobs\Controller\CompanyFrontendUserController.
 *
 * @author Thomas Schallert <programmierung@sozialinfo.ch>
 */
class CompanyFrontendUserControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \Sozialinfo\Jobs\Controller\CompanyFrontendUserController
	 */
	protected $subject = NULL;

	public function setUp() {
		$this->subject = $this->getMock('Sozialinfo\\Jobs\\Controller\\CompanyFrontendUserController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllCompanyFrontendUsersFromRepositoryAndAssignsThemToView() {

		$allCompanyFrontendUsers = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$companyFrontendUserRepository = $this->getMock('Sozialinfo\\Jobs\\Domain\\Repository\\CompanyFrontendUserRepository', array('findAll'), array(), '', FALSE);
		$companyFrontendUserRepository->expects($this->once())->method('findAll')->will($this->returnValue($allCompanyFrontendUsers));
		$this->inject($this->subject, 'companyFrontendUserRepository', $companyFrontendUserRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('companyFrontendUsers', $allCompanyFrontendUsers);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenCompanyFrontendUserToView() {
		$companyFrontendUser = new \Sozialinfo\Jobs\Domain\Model\CompanyFrontendUser();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('companyFrontendUser', $companyFrontendUser);

		$this->subject->showAction($companyFrontendUser);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenCompanyFrontendUserToCompanyFrontendUserRepository() {
		$companyFrontendUser = new \Sozialinfo\Jobs\Domain\Model\CompanyFrontendUser();

		$companyFrontendUserRepository = $this->getMock('Sozialinfo\\Jobs\\Domain\\Repository\\CompanyFrontendUserRepository', array('add'), array(), '', FALSE);
		$companyFrontendUserRepository->expects($this->once())->method('add')->with($companyFrontendUser);
		$this->inject($this->subject, 'companyFrontendUserRepository', $companyFrontendUserRepository);

		$this->subject->createAction($companyFrontendUser);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenCompanyFrontendUserToView() {
		$companyFrontendUser = new \Sozialinfo\Jobs\Domain\Model\CompanyFrontendUser();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('companyFrontendUser', $companyFrontendUser);

		$this->subject->editAction($companyFrontendUser);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenCompanyFrontendUserInCompanyFrontendUserRepository() {
		$companyFrontendUser = new \Sozialinfo\Jobs\Domain\Model\CompanyFrontendUser();

		$companyFrontendUserRepository = $this->getMock('Sozialinfo\\Jobs\\Domain\\Repository\\CompanyFrontendUserRepository', array('update'), array(), '', FALSE);
		$companyFrontendUserRepository->expects($this->once())->method('update')->with($companyFrontendUser);
		$this->inject($this->subject, 'companyFrontendUserRepository', $companyFrontendUserRepository);

		$this->subject->updateAction($companyFrontendUser);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenCompanyFrontendUserFromCompanyFrontendUserRepository() {
		$companyFrontendUser = new \Sozialinfo\Jobs\Domain\Model\CompanyFrontendUser();

		$companyFrontendUserRepository = $this->getMock('Sozialinfo\\Jobs\\Domain\\Repository\\CompanyFrontendUserRepository', array('remove'), array(), '', FALSE);
		$companyFrontendUserRepository->expects($this->once())->method('remove')->with($companyFrontendUser);
		$this->inject($this->subject, 'companyFrontendUserRepository', $companyFrontendUserRepository);

		$this->subject->deleteAction($companyFrontendUser);
	}
}
