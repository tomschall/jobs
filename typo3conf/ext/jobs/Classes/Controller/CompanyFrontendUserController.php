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
 * CompanyFrontendUserController
 */
class CompanyFrontendUserController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * companyFrontendUserRepository
	 *
	 * @var \Sozialinfo\Jobs\Domain\Repository\CompanyFrontendUserRepository
	 * @inject
	 */
	protected $companyFrontendUserRepository = NULL;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$companyFrontendUsers = $this->companyFrontendUserRepository->findAll();
		$this->view->assign('companyFrontendUsers', $companyFrontendUsers);
	}

	/**
	 * action show
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\CompanyFrontendUser $companyFrontendUser
	 * @return void
	 */
	public function showAction(\Sozialinfo\Jobs\Domain\Model\CompanyFrontendUser $companyFrontendUser) {
		$this->view->assign('companyFrontendUser', $companyFrontendUser);
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
	 * @param \Sozialinfo\Jobs\Domain\Model\CompanyFrontendUser $newCompanyFrontendUser
	 * @return void
	 */
	public function createAction(\Sozialinfo\Jobs\Domain\Model\CompanyFrontendUser $newCompanyFrontendUser) {
		$this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->companyFrontendUserRepository->add($newCompanyFrontendUser);
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\CompanyFrontendUser $companyFrontendUser
	 * @ignorevalidation $companyFrontendUser
	 * @return void
	 */
	public function editAction(\Sozialinfo\Jobs\Domain\Model\CompanyFrontendUser $companyFrontendUser) {
		$this->view->assign('companyFrontendUser', $companyFrontendUser);
	}

	/**
	 * action update
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\CompanyFrontendUser $companyFrontendUser
	 * @return void
	 */
	public function updateAction(\Sozialinfo\Jobs\Domain\Model\CompanyFrontendUser $companyFrontendUser) {
		$this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->companyFrontendUserRepository->update($companyFrontendUser);
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\CompanyFrontendUser $companyFrontendUser
	 * @return void
	 */
	public function deleteAction(\Sozialinfo\Jobs\Domain\Model\CompanyFrontendUser $companyFrontendUser) {
		$this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->companyFrontendUserRepository->remove($companyFrontendUser);
		$this->redirect('list');
	}

}