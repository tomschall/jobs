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
 * JobRequest
 */
class JobRequestDynamicValidation2 extends \Sozialinfo\Jobs\DomainObject\AbstractEntityJobRequest implements \Serializable {

	const PROCESS_STEP_MAXIMUM = 5;

	/**
	 * processStep
	 *
	 * @var int
	 */
	protected $processStep = 0;

	/**
	 * startDate
	 *
	 * @var \DateTime
	 */
	protected $startDate = NULL;

	/**
	 * endDate
	 *
	 * @var \DateTime
	 */
	protected $endDate = NULL;

	/**
	 * percentOf
	 *
	 * @var string
	 */
	protected $percentOf = '';

	/**
	 * percentUp
	 *
	 * @var string
	 */
	protected $percentUp = '';

	/**
	 * jobTitle
	 *
	 * @var string
	 */
	protected $jobTitle = '';

	/**
	 * entryDate
	 *
	 * @var \DateTime
	 */
	protected $entryDate = NULL;

	/**
	 * entryAgreement
	 *
	 * @var bool
	 */
	protected $entryAgreement = '';

	/**
	 * entryImmediately
	 *
	 * @var bool
	 */
	protected $entryImmediately = '';

	/**
	 * jobLocation
	 *
	 * @var string
	 */
	protected $jobLocation = '';

	/**
	 * jobDescription
	 *
	 * @var string
	 */
	protected $jobDescription = '';

	/**
	 * contactTo
	 *
	 * @var string
	 */
	protected $contactTo = '';

	/**
	 * emailTo
	 *
	 * @var string
	 */
	protected $emailTo = '';

	/**
	 * postalAddresEqualToRegistrationAddress
	 *
	 * @var bool
	 */
	protected $postalAddresEqualToRegistrationAddress = '';

	/**
	 * postalAddressTitle
	 *
	 * @var bool
	 */
	protected $postalAddressTitle = '';

	/**
	 * postalAddressFirstName
	 *
	 * @var string
	 */
	protected $postalAddressFirstName = '';

	/**
	 * postalAddressName
	 *
	 * @var string
	 */
	protected $postalAddressName = '';

	/**
	 * postalAddressAdditive
	 *
	 * @var string
	 */
	protected $postalAddressAdditive = '';

	/**
	 * postalAddressStreetNr
	 *
	 * @var int
	 */
	protected $postalAddressStreetNr = 0;

	/**
	 * postalAddressPoBox
	 *
	 * @var string
	 */
	protected $postalAddressPoBox = '';

	/**
	 * postalAddressZip
	 *
	 * @var int
	 */
	protected $postalAddressZip = 0;

	/**
	 * postalAddressCity
	 *
	 * @var string
	 */
	protected $postalAddressCity = '';

	/**
	 * numberDaysPublication
	 *
	 * @var int
	 */
	protected $numberDaysPublication = 0;

	/**
	 * publicationDate
	 *
	 * @var \DateTime
	 */
	protected $publicationDate = NULL;

	/**
	 * comments
	 *
	 * @var string
	 */
	protected $comments = '';

	/**
	 * deleteDate
	 *
	 * @var \DateTime
	 */
	protected $deleteDate = NULL;

	/**
	 * deletedHow
	 *
	 * @var int
	 */
	protected $deletedHow = 0;

	/**
	 * useAgreements
	 *
	 * @var bool
	 */
	protected $useAgreements = '';

	/**
	 * requestIsGerman
	 *
	 * @var bool
	 */
	protected $requestIsGerman = '';

	/**
	 * requestIsFrench
	 *
	 * @var bool
	 */
	protected $requestIsFrench = '';

	/**
	 * requestIsItalian
	 *
	 * @var bool
	 */
	protected $requestIsItalian = '';

	/**
	 * employmentRelationship
	 *
	 * @var \Sozialinfo\Jobs\Domain\Model\EmploymentRelationship
	 */
	protected $employmentRelationship = NULL;

	/**
	 * position
	 *
	 * @var \Sozialinfo\Jobs\Domain\Model\Position
	 */
	protected $position = NULL;

	/**
	 * qualification
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\Jobs\Domain\Model\Qualification>
	 */
	protected $qualification = NULL;

	/**
	 * areasOfWork
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\Jobs\Domain\Model\AreasOfWork>
	 */
	protected $areasOfWork = NULL;

	/**
	 * advertisementType
	 *
	 * @var \Sozialinfo\Jobs\Domain\Model\AdvertisementType
	 */
	protected $advertisementType = NULL;

	/**
	 * canton
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\Jobs\Domain\Model\Canton>
	 */
	protected $canton = NULL;

	/**
	 * region
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\Jobs\Domain\Model\Region>
	 */
	protected $region = NULL;

	/**
	 * postalAddressCountry
	 *
	 * @var \Sozialinfo\Jobs\Domain\Model\Country
	 */
	protected $postalAddressCountry = NULL;

	/**
	 * typeOfInstitution
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\Jobs\Domain\Model\TypeOfInstitution>
	 */
	protected $typeOfInstitution = NULL;

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
		$this->qualification = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->areasOfWork = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->canton = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->region = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->typeOfInstitution = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the startDate
	 *
	 * @return \DateTime $startDate
	 */
	public function getStartDate() {
		return $this->startDate;
	}

	/**
	 * Sets the startDate
	 *
	 * @param \DateTime $startDate
	 * @return void
	 */
	public function setStartDate($startDate) {
		$this->startDate = $startDate;
	}

	/**
	 * Returns the endDate
	 *
	 * @return \DateTime $endDate
	 */
	public function getEndDate() {
		return $this->endDate;
	}

	/**
	 * Sets the endDate
	 *
	 * @param \DateTime $endDate
	 * @return void
	 */
	public function setEndDate($endDate) {
		$this->endDate = $endDate;
	}

	/**
	 * Returns the percentOf
	 *
	 * @return string $percentOf
	 */
	public function getPercentOf() {
		return $this->percentOf;
	}

	/**
	 * Sets the percentOf
	 *
	 * @param string $percentOf
	 * @return void
	 */
	public function setPercentOf($percentOf) {
		$this->percentOf = $percentOf;
	}

	/**
	 * Returns the percentUp
	 *
	 * @return string $percentUp
	 */
	public function getPercentUp() {
		return $this->percentUp;
	}

	/**
	 * Sets the percentUp
	 *
	 * @param string $percentUp
	 * @return void
	 */
	public function setPercentUp($percentUp) {
		$this->percentUp = $percentUp;
	}

	/**
	 * Returns the jobTitle
	 *
	 * @return string $jobTitle
	 */
	public function getJobTitle() {
		return $this->jobTitle;
	}

	/**
	 * Sets the jobTitle
	 *
	 * @param string $jobTitle
	 * @return void
	 */
	public function setJobTitle($jobTitle) {
		$this->jobTitle = $jobTitle;
	}

	/**
	 * Returns the entryDate
	 *
	 * @return \DateTime $entryDate
	 */
	public function getEntryDate() {
		return $this->entryDate;
	}

	/**
	 * Sets the entryDate
	 *
	 * @param \DateTime $entryDate
	 * @return void
	 */
	public function setEntryDate($entryDate) {
		$this->entryDate = $entryDate;
	}

	/**
	 * Returns the entryAgreement
	 *
	 * @return bool $entryAgreement
	 */
	public function getEntryAgreement() {
		return $this->entryAgreement;
	}

	/**
	 * Sets the entryAgreement
	 *
	 * @param bool $entryAgreement
	 * @return void
	 */
	public function setEntryAgreement($entryAgreement) {
		$this->entryAgreement = $entryAgreement;
	}

	/**
	 * Returns the boolean state of entryAgreement
	 *
	 * @return bool
	 */
	public function isEntryAgreement() {
		return $this->entryAgreement;
	}

	/**
	 * Returns the entryImmediately
	 *
	 * @return bool $entryImmediately
	 */
	public function getEntryImmediately() {
		return $this->entryImmediately;
	}

	/**
	 * Sets the entryImmediately
	 *
	 * @param bool $entryImmediately
	 * @return void
	 */
	public function setEntryImmediately($entryImmediately) {
		$this->entryImmediately = $entryImmediately;
	}

	/**
	 * Returns the boolean state of entryImmediately
	 *
	 * @return bool
	 */
	public function isEntryImmediately() {
		return $this->entryImmediately;
	}

	/**
	 * Returns the jobLocation
	 *
	 * @return string $jobLocation
	 */
	public function getJobLocation() {
		return $this->jobLocation;
	}

	/**
	 * Sets the jobLocation
	 *
	 * @param string $jobLocation
	 * @return void
	 */
	public function setJobLocation($jobLocation) {
		$this->jobLocation = $jobLocation;
	}

	/**
	 * Returns the jobDescription
	 *
	 * @return string $jobDescription
	 */
	public function getJobDescription() {
		return $this->jobDescription;
	}

	/**
	 * Sets the jobDescription
	 *
	 * @param string $jobDescription
	 * @return void
	 */
	public function setJobDescription($jobDescription) {
		$this->jobDescription = $jobDescription;
	}

	/**
	 * Returns the contactTo
	 *
	 * @return string $contactTo
	 */
	public function getContactTo() {
		return $this->contactTo;
	}

	/**
	 * Sets the contactTo
	 *
	 * @param string $contactTo
	 * @return void
	 */
	public function setContactTo($contactTo) {
		$this->contactTo = $contactTo;
	}

	/**
	 * Returns the emailTo
	 *
	 * @return string $emailTo
	 */
	public function getEmailTo() {
		return $this->emailTo;
	}

	/**
	 * Sets the emailTo
	 *
	 * @param string $emailTo
	 * @return void
	 */
	public function setEmailTo($emailTo) {
		$this->emailTo = $emailTo;
	}

	/**
	 * Returns the postalAddresEqualToRegistrationAddress
	 *
	 * @return bool $postalAddresEqualToRegistrationAddress
	 */
	public function getPostalAddresEqualToRegistrationAddress() {
		return $this->postalAddresEqualToRegistrationAddress;
	}

	/**
	 * Sets the postalAddresEqualToRegistrationAddress
	 *
	 * @param bool $postalAddresEqualToRegistrationAddress
	 * @return void
	 */
	public function setPostalAddresEqualToRegistrationAddress($postalAddresEqualToRegistrationAddress) {
		$this->postalAddresEqualToRegistrationAddress = $postalAddresEqualToRegistrationAddress;
	}

	/**
	 * Returns the boolean state of postalAddresEqualToRegistrationAddress
	 *
	 * @return bool
	 */
	public function isPostalAddresEqualToRegistrationAddress() {
		return $this->postalAddresEqualToRegistrationAddress;
	}

	/**
	 * Returns the postalAddressTitle
	 *
	 * @return bool $postalAddressTitle
	 */
	public function getPostalAddressTitle() {
		return $this->postalAddressTitle;
	}

	/**
	 * Sets the postalAddressTitle
	 *
	 * @param bool $postalAddressTitle
	 * @return void
	 */
	public function setPostalAddressTitle($postalAddressTitle) {
		$this->postalAddressTitle = $postalAddressTitle;
	}

	/**
	 * Returns the boolean state of postalAddressTitle
	 *
	 * @return bool
	 */
	public function isPostalAddressTitle() {
		return $this->postalAddressTitle;
	}

	/**
	 * Returns the postalAddressFirstName
	 *
	 * @return string $postalAddressFirstName
	 */
	public function getPostalAddressFirstName() {
		return $this->postalAddressFirstName;
	}

	/**
	 * Sets the postalAddressFirstName
	 *
	 * @param string $postalAddressFirstName
	 * @return void
	 */
	public function setPostalAddressFirstName($postalAddressFirstName) {
		$this->postalAddressFirstName = $postalAddressFirstName;
	}

	/**
	 * Returns the postalAddressName
	 *
	 * @return string $postalAddressName
	 */
	public function getPostalAddressName() {
		return $this->postalAddressName;
	}

	/**
	 * Sets the postalAddressName
	 *
	 * @param string $postalAddressName
	 * @return void
	 */
	public function setPostalAddressName($postalAddressName) {
		$this->postalAddressName = $postalAddressName;
	}

	/**
	 * Returns the postalAddressAdditive
	 *
	 * @return string $postalAddressAdditive
	 */
	public function getPostalAddressAdditive() {
		return $this->postalAddressAdditive;
	}

	/**
	 * Sets the postalAddressAdditive
	 *
	 * @param string $postalAddressAdditive
	 * @return void
	 */
	public function setPostalAddressAdditive($postalAddressAdditive) {
		$this->postalAddressAdditive = $postalAddressAdditive;
	}

	/**
	 * Returns the postalAddressStreetNr
	 *
	 * @return int $postalAddressStreetNr
	 */
	public function getPostalAddressStreetNr() {
		return $this->postalAddressStreetNr;
	}

	/**
	 * Sets the postalAddressStreetNr
	 *
	 * @param int $postalAddressStreetNr
	 * @return void
	 */
	public function setPostalAddressStreetNr($postalAddressStreetNr) {
		$this->postalAddressStreetNr = $postalAddressStreetNr;
	}

	/**
	 * Returns the postalAddressPoBox
	 *
	 * @return string $postalAddressPoBox
	 */
	public function getPostalAddressPoBox() {
		return $this->postalAddressPoBox;
	}

	/**
	 * Sets the postalAddressPoBox
	 *
	 * @param string $postalAddressPoBox
	 * @return void
	 */
	public function setPostalAddressPoBox($postalAddressPoBox) {
		$this->postalAddressPoBox = $postalAddressPoBox;
	}

	/**
	 * Returns the postalAddressZip
	 *
	 * @return int $postalAddressZip
	 */
	public function getPostalAddressZip() {
		return $this->postalAddressZip;
	}

	/**
	 * Sets the postalAddressZip
	 *
	 * @param int $postalAddressZip
	 * @return void
	 */
	public function setPostalAddressZip($postalAddressZip) {
		$this->postalAddressZip = $postalAddressZip;
	}

	/**
	 * Returns the postalAddressCity
	 *
	 * @return string $postalAddressCity
	 */
	public function getPostalAddressCity() {
		return $this->postalAddressCity;
	}

	/**
	 * Sets the postalAddressCity
	 *
	 * @param string $postalAddressCity
	 * @return void
	 */
	public function setPostalAddressCity($postalAddressCity) {
		$this->postalAddressCity = $postalAddressCity;
	}

	/**
	 * Returns the numberDaysPublication
	 *
	 * @return int $numberDaysPublication
	 */
	public function getNumberDaysPublication() {
		return $this->numberDaysPublication;
	}

	/**
	 * Sets the numberDaysPublication
	 *
	 * @param int $numberDaysPublication
	 * @return void
	 */
	public function setNumberDaysPublication($numberDaysPublication) {
		$this->numberDaysPublication = $numberDaysPublication;
	}

	/**
	 * Returns the publicationDate
	 *
	 * @return \DateTime $publicationDate
	 */
	public function getPublicationDate() {
		return $this->publicationDate;
	}

	/**
	 * Sets the publicationDate
	 *
	 * @param \DateTime $publicationDate
	 * @return void
	 */
	public function setPublicationDate($publicationDate) {
		$this->publicationDate = $publicationDate;
	}

	/**
	 * Returns the comments
	 *
	 * @return string $comments
	 */
	public function getComments() {
		return $this->comments;
	}

	/**
	 * Sets the comments
	 *
	 * @param string $comments
	 * @return void
	 */
	public function setComments($comments) {
		$this->comments = $comments;
	}

	/**
	 * Returns the deleteDate
	 *
	 * @return \DateTime $deleteDate
	 */
	public function getDeleteDate() {
		return $this->deleteDate;
	}

	/**
	 * Sets the deleteDate
	 *
	 * @param \DateTime $deleteDate
	 * @return void
	 */
	public function setDeleteDate($deleteDate) {
		$this->deleteDate = $deleteDate;
	}

	/**
	 * Returns the deletedHow
	 *
	 * @return int $deletedHow
	 */
	public function getDeletedHow() {
		return $this->deletedHow;
	}

	/**
	 * Sets the deletedHow
	 *
	 * @param int $deletedHow
	 * @return void
	 */
	public function setDeletedHow($deletedHow) {
		$this->deletedHow = $deletedHow;
	}

	/**
	 * Returns the useAgreements
	 *
	 * @return bool $useAgreements
	 */
	public function getUseAgreements() {
		return $this->useAgreements;
	}

	/**
	 * Sets the useAgreements
	 *
	 * @param bool $useAgreements
	 * @return void
	 */
	public function setUseAgreements($useAgreements) {
		$this->useAgreements = $useAgreements;
	}

	/**
	 * Returns the boolean state of useAgreements
	 *
	 * @return bool
	 */
	public function isUseAgreements() {
		return $this->useAgreements;
	}

	/**
	 * Returns the requestIsGerman
	 *
	 * @return bool $requestIsGerman
	 */
	public function getRequestIsGerman() {
		return $this->requestIsGerman;
	}

	/**
	 * Sets the requestIsGerman
	 *
	 * @param bool $requestIsGerman
	 * @return void
	 */
	public function setRequestIsGerman($requestIsGerman) {
		$this->requestIsGerman = $requestIsGerman;
	}

	/**
	 * Returns the boolean state of requestIsGerman
	 *
	 * @return bool
	 */
	public function isRequestIsGerman() {
		return $this->requestIsGerman;
	}

	/**
	 * Returns the requestIsFrench
	 *
	 * @return bool $requestIsFrench
	 */
	public function getRequestIsFrench() {
		return $this->requestIsFrench;
	}

	/**
	 * Sets the requestIsFrench
	 *
	 * @param bool $requestIsFrench
	 * @return void
	 */
	public function setRequestIsFrench($requestIsFrench) {
		$this->requestIsFrench = $requestIsFrench;
	}

	/**
	 * Returns the boolean state of requestIsFrench
	 *
	 * @return bool
	 */
	public function isRequestIsFrench() {
		return $this->requestIsFrench;
	}

	/**
	 * Returns the requestIsItalian
	 *
	 * @return bool $requestIsItalian
	 */
	public function getRequestIsItalian() {
		return $this->requestIsItalian;
	}

	/**
	 * Sets the requestIsItalian
	 *
	 * @param bool $requestIsItalian
	 * @return void
	 */
	public function setRequestIsItalian($requestIsItalian) {
		$this->requestIsItalian = $requestIsItalian;
	}

	/**
	 * Returns the boolean state of requestIsItalian
	 *
	 * @return bool
	 */
	public function isRequestIsItalian() {
		return $this->requestIsItalian;
	}

	/**
	 * Returns the employmentRelationship
	 *
	 * @return \Sozialinfo\Jobs\Domain\Model\EmploymentRelationship $employmentRelationship
	 */
	public function getEmploymentRelationship() {
		return $this->employmentRelationship;
	}

	/**
	 * Sets the employmentRelationship
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\EmploymentRelationship $employmentRelationship
	 * @return void
	 */
	public function setEmploymentRelationship(\Sozialinfo\Jobs\Domain\Model\EmploymentRelationship $employmentRelationship) {
		$this->employmentRelationship = $employmentRelationship;
	}

	/**
	 * Returns the position
	 *
	 * @return \Sozialinfo\Jobs\Domain\Model\Position $position
	 */
	public function getPosition() {
		return $this->position;
	}

	/**
	 * Sets the position
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\Position $position
	 * @return void
	 */
	public function setPosition(\Sozialinfo\Jobs\Domain\Model\Position $position) {
		$this->position = $position;
	}

	/**
	 * Adds a Qualification
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\Qualification $qualification
	 * @return void
	 */
	public function addQualification(\Sozialinfo\Jobs\Domain\Model\Qualification $qualification) {
		$this->qualification->attach($qualification);
	}

	/**
	 * Removes a Qualification
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\Qualification $qualificationToRemove The Qualification to be removed
	 * @return void
	 */
	public function removeQualification(\Sozialinfo\Jobs\Domain\Model\Qualification $qualificationToRemove) {
		$this->qualification->detach($qualificationToRemove);
	}

	/**
	 * Returns the qualification
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\Jobs\Domain\Model\Qualification> $qualification
	 */
	public function getQualification() {
		return $this->qualification;
	}

	/**
	 * Sets the qualification
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\Jobs\Domain\Model\Qualification> $qualification
	 * @return void
	 */
	public function setQualification(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $qualification) {
		$this->qualification = $qualification;
	}

	/**
	 * Adds a AreasOfWork
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\AreasOfWork $areasOfWork
	 * @return void
	 */
	public function addAreasOfWork(\Sozialinfo\Jobs\Domain\Model\AreasOfWork $areasOfWork) {
		$this->areasOfWork->attach($areasOfWork);
	}

	/**
	 * Removes a AreasOfWork
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\AreasOfWork $areasOfWorkToRemove The AreasOfWork to be removed
	 * @return void
	 */
	public function removeAreasOfWork(\Sozialinfo\Jobs\Domain\Model\AreasOfWork $areasOfWorkToRemove) {
		$this->areasOfWork->detach($areasOfWorkToRemove);
	}

	/**
	 * Returns the areasOfWork
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\Jobs\Domain\Model\AreasOfWork> $areasOfWork
	 */
	public function getAreasOfWork() {
		return $this->areasOfWork;
	}

	/**
	 * Sets the areasOfWork
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\Jobs\Domain\Model\AreasOfWork> $areasOfWork
	 * @return void
	 */
	public function setAreasOfWork(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $areasOfWork) {
		$this->areasOfWork = $areasOfWork;
	}

	/**
	 * Returns the advertisementType
	 *
	 * @return \Sozialinfo\Jobs\Domain\Model\AdvertisementType $advertisementType
	 */
	public function getAdvertisementType() {
		return $this->advertisementType;
	}

	/**
	 * Sets the advertisementType
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\AdvertisementType $advertisementType
	 * @return void
	 */
	public function setAdvertisementType(\Sozialinfo\Jobs\Domain\Model\AdvertisementType $advertisementType) {
		$this->advertisementType = $advertisementType;
	}

	/**
	 * Adds a Canton
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\Canton $canton
	 * @return void
	 */
	public function addCanton(\Sozialinfo\Jobs\Domain\Model\Canton $canton) {
		$this->canton->attach($canton);
	}

	/**
	 * Removes a Canton
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\Canton $cantonToRemove The Canton to be removed
	 * @return void
	 */
	public function removeCanton(\Sozialinfo\Jobs\Domain\Model\Canton $cantonToRemove) {
		$this->canton->detach($cantonToRemove);
	}

	/**
	 * Returns the canton
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\Jobs\Domain\Model\Canton> $canton
	 */
	public function getCanton() {
		return $this->canton;
	}

	/**
	 * Sets the canton
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\Jobs\Domain\Model\Canton> $canton
	 * @return void
	 */
	public function setCanton(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $canton) {
		$this->canton = $canton;
	}

	/**
	 * Adds a Region
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\Region $region
	 * @return void
	 */
	public function addRegion(\Sozialinfo\Jobs\Domain\Model\Region $region) {
		$this->region->attach($region);
	}

	/**
	 * Removes a Region
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\Region $regionToRemove The Region to be removed
	 * @return void
	 */
	public function removeRegion(\Sozialinfo\Jobs\Domain\Model\Region $regionToRemove) {
		$this->region->detach($regionToRemove);
	}

	/**
	 * Returns the region
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\Jobs\Domain\Model\Region> $region
	 */
	public function getRegion() {
		return $this->region;
	}

	/**
	 * Sets the region
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\Jobs\Domain\Model\Region> $region
	 * @return void
	 */
	public function setRegion(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $region) {
		$this->region = $region;
	}

	/**
	 * Returns the postalAddressCountry
	 *
	 * @return \Sozialinfo\Jobs\Domain\Model\Country $postalAddressCountry
	 */
	public function getPostalAddressCountry() {
		return $this->postalAddressCountry;
	}

	/**
	 * Sets the postalAddressCountry
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\Country $postalAddressCountry
	 * @return void
	 */
	public function setPostalAddressCountry(\Sozialinfo\Jobs\Domain\Model\Country $postalAddressCountry) {
		$this->postalAddressCountry = $postalAddressCountry;
	}

	/**
	 * Adds a TypeOfInstitution
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\TypeOfInstitution $typeOfInstitution
	 * @return void
	 */
	public function addTypeOfInstitution(\Sozialinfo\Jobs\Domain\Model\TypeOfInstitution $typeOfInstitution) {
		$this->typeOfInstitution->attach($typeOfInstitution);
	}

	/**
	 * Removes a TypeOfInstitution
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\TypeOfInstitution $typeOfInstitutionToRemove The TypeOfInstitution to be removed
	 * @return void
	 */
	public function removeTypeOfInstitution(\Sozialinfo\Jobs\Domain\Model\TypeOfInstitution $typeOfInstitutionToRemove) {
		$this->typeOfInstitution->detach($typeOfInstitutionToRemove);
	}

	/**
	 * Returns the typeOfInstitution
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\Jobs\Domain\Model\TypeOfInstitution> $typeOfInstitution
	 */
	public function getTypeOfInstitution() {
		return $this->typeOfInstitution;
	}

	/**
	 * Sets the typeOfInstitution
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\Jobs\Domain\Model\TypeOfInstitution> $typeOfInstitution
	 * @return void
	 */
	public function setTypeOfInstitution(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $typeOfInstitution) {
		$this->typeOfInstitution = $typeOfInstitution;
	}

	/**
	 * Returns the processStep
	 *
	 * @return int $processStep
	 */
	public function getProcessStep() {
		return $this->processStep;
	}

	/**
	 * Increases the processStep
	 *
	 * @param int $processStep
	 * @return void
	 */
	public function increaseProcessStep() {
		$this->processStep += 1;
	}

	/**
	 * Decrease the processStep
	 *
	 * @param int $processStep
	 * @return void
	 */
	public function decreaseProcessStep() {
		$this->processStep -= 1;
	}

	/**
	 * Serialization method.
	 *
	 * As Extbase's ObjectStorage objects can't be serialized,
	 * a workaroung has to be implemented in order to store
	 * the whole breakout data.
	 *
	 * @todo test coverage
	 * @return string
	 */
	public function serialize() {
		$properties = $this->_getPublicProperties();
		$objectStorages = array();
		foreach($properties as $key => $value) {
			if ($value instanceof \TYPO3\CMS\Extbase\Persistence\ObjectStorage) {
				unset($properties[$key]);
				$objectStorages[$key] = $value->toArray();
			}
		}
		$properties['_objectStorages'] = $objectStorages;
		return serialize($properties);
	}
	
	/**
	 * Unserialize method.
	 *
	 * @todo test coverage
	 * @return void
	 */
	public function unserialize($serialized) {
		$data = unserialize($serialized);
		$this->initStorageObjects();
		foreach ($data['_objectStorages'] as $property => $values) {
			foreach ($values as $value) {
				$this->{$property}->attach($value);
			}
		}
		unset($data['_objectStorages']);
		$this->_setProperties($data);
	}

}