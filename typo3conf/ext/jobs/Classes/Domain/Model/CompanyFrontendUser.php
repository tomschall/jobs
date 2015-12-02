<?php
namespace Sozialinfo\Jobs\Domain\Model;

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
 * CompanyFrontendUser
 */
class CompanyFrontendUser extends \TYPO3\CMS\Extbase\Domain\Model\FrontendUser {

	/**
	 * isFrontendAdmin
	 *
	 * @var bool
	 */
	protected $isFrontendAdmin = FALSE;

	/**
	 * additive
	 *
	 * @var string
	 */
	protected $additive = '';

	/**
	 * department
	 *
	 * @var string
	 */
	protected $department = '';

	/**
	 * poBox
	 *
	 * @var string
	 */
	protected $poBox = '';

	/**
	 * corporate
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $corporate = NULL;

	/**
	 * documents
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
	 * @cascade remove
	 */
	protected $documents = NULL;

	/**
	 * country
	 *
	 * @var \Sozialinfo\Jobs\Domain\Model\Country
	 */
	protected $country = NULL;

	/**
	 * insosMember
	 *
	 * @var \Sozialinfo\Jobs\Domain\Model\InsosMember
	 */
	protected $insosMember = NULL;

	/**
	 * sozialinfoMember
	 *
	 * @var \Sozialinfo\Jobs\Domain\Model\SozialinfoMember
	 */
	protected $sozialinfoMember = NULL;

	/**
	 * __construct
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties
	 * Do not modify this method!
	 * It will be rewritten on each save in the extension builder
	 * You may modify the constructor of this class instead
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		$this->documents = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the isFrontendAdmin
	 *
	 * @return bool $isFrontendAdmin
	 */
	public function getIsFrontendAdmin() {
		return $this->isFrontendAdmin;
	}

	/**
	 * Sets the isFrontendAdmin
	 *
	 * @param bool $isFrontendAdmin
	 * @return void
	 */
	public function setIsFrontendAdmin($isFrontendAdmin) {
		$this->isFrontendAdmin = $isFrontendAdmin;
	}

	/**
	 * Returns the boolean state of isFrontendAdmin
	 *
	 * @return bool
	 */
	public function isIsFrontendAdmin() {
		return $this->isFrontendAdmin;
	}

	/**
	 * Returns the additive
	 *
	 * @return string $additive
	 */
	public function getAdditive() {
		return $this->additive;
	}

	/**
	 * Sets the additive
	 *
	 * @param string $additive
	 * @return void
	 */
	public function setAdditive($additive) {
		$this->additive = $additive;
	}

	/**
	 * Returns the department
	 *
	 * @return string $department
	 */
	public function getDepartment() {
		return $this->department;
	}

	/**
	 * Sets the department
	 *
	 * @param string $department
	 * @return void
	 */
	public function setDepartment($department) {
		$this->department = $department;
	}

	/**
	 * Returns the poBox
	 *
	 * @return string $poBox
	 */
	public function getPoBox() {
		return $this->poBox;
	}

	/**
	 * Sets the poBox
	 *
	 * @param string $poBox
	 * @return void
	 */
	public function setPoBox($poBox) {
		$this->poBox = $poBox;
	}

	/**
	 * Returns the boolean state of isMember
	 *
	 * @return bool
	 */
	public function isIsMember() {
		return $this->isMember;
	}

	/**
	 * Returns the corporate
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $corporate
	 */
	public function getCorporate() {
		return $this->corporate;
	}

	/**
	 * Sets the corporate
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $corporate
	 * @return void
	 */
	public function setCorporate(\TYPO3\CMS\Extbase\Domain\Model\FileReference $corporate) {
		$this->corporate = $corporate;
	}

	/**
	 * Adds a FileReference
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $document
	 * @return void
	 */
	public function addDocument(\TYPO3\CMS\Extbase\Domain\Model\FileReference $document) {
		$this->documents->attach($document);
	}

	/**
	 * Removes a FileReference
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $documentToRemove The FileReference to be removed
	 * @return void
	 */
	public function removeDocument(\TYPO3\CMS\Extbase\Domain\Model\FileReference $documentToRemove) {
		$this->documents->detach($documentToRemove);
	}

	/**
	 * Returns the documents
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $documents
	 */
	public function getDocuments() {
		return $this->documents;
	}

	/**
	 * Sets the documents
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $documents
	 * @return void
	 */
	public function setDocuments(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $documents) {
		$this->documents = $documents;
	}

	/**
	 * Returns the country
	 *
	 * @return \Sozialinfo\Jobs\Domain\Model\Country $country
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * Sets the country
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\Country $country
	 * @return void
	 */
	public function setCountry(\Sozialinfo\Jobs\Domain\Model\Country $country) {
		$this->country = $country;
	}

	/**
	 * Returns the insosMember
	 *
	 * @return \Sozialinfo\Jobs\Domain\Model\InsosMember $insosMember
	 */
	public function getInsosMember() {
		return $this->insosMember;
	}

	/**
	 * Sets the insosMember
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\InsosMember $insosMember
	 * @return void
	 */
	public function setInsosMember(\Sozialinfo\Jobs\Domain\Model\InsosMember $insosMember) {
		$this->insosMember = $insosMember;
	}

	/**
	 * Returns the sozialinfoMember
	 *
	 * @return \Sozialinfo\Jobs\Domain\Model\SozialinfoMember $sozialinfoMember
	 */
	public function getSozialinfoMember() {
		return $this->sozialinfoMember;
	}

	/**
	 * Sets the sozialinfoMember
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\SozialinfoMember $sozialinfoMember
	 * @return void
	 */
	public function setSozialinfoMember(\Sozialinfo\Jobs\Domain\Model\SozialinfoMember $sozialinfoMember) {
		$this->sozialinfoMember = $sozialinfoMember;
	}

}