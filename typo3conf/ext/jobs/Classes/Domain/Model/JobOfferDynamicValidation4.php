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
 * JobOffer
 */
class JobOfferDynamicValidation4 extends \Sozialinfo\Jobs\DomainObject\AbstractEntityJobOffer implements \Serializable {

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
	 * 
	 */
	protected $startDate = NULL;

	/**
	 * endDate
	 *
	 * @var \DateTime
	 * 
	 */
	protected $endDate = NULL;

	/**
	 * numberDaysPublication
	 *
	 * @var int
	 * 
	 */
	protected $numberDaysPublication = 0;

	/**
	 * publicationDate
	 *
	 * @var \DateTime
	 */
	protected $publicationDate = NULL;

	/**
	 * jobTitle
	 *
	 * @var string
	 */
	protected $jobTitle = '';

	/**
	 * company
	 *
	 * @var string
	 * 
	 */
	protected $company = '';

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
	 */
	protected $documents = NULL;

	/**
	 * percentOf
	 *
	 * @var string
	 * 
	 */
	protected $percentOf = '';

	/**
	 * percentUp
	 *
	 * @var string
	 */
	protected $percentUp = '';

	/**
	 * onCall
	 *
	 * @var bool
	 */
	protected $onCall = '';

	/**
	 * employer
	 *
	 * @var string
	 * 
	 */
	protected $employer = '';

	/**
	 * employerAddition
	 *
	 * @var string
	 */
	protected $employerAddition = '';

	/**
	 * linkToWebsite
	 *
	 * @var string
	 */
	protected $linkToWebsite = '';

	/**
	 * entryDate
	 *
	 * @var \DateTime
	 * 
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
	 * zipJobLocation
	 *
	 * @var int
	 */
	protected $zipJobLocation = 0;

	/**
	 * jobDescription
	 *
	 * @var string
	 */
	protected $jobDescription = '';

	/**
	 * applicationTo
	 *
	 * @var string
	 */
	protected $applicationTo = '';

	/**
	 * emailTo
	 *
	 * @var string
	 */
	protected $emailTo = '';

	/**
	 * furtherInformation
	 *
	 * @var string
	 */
	protected $furtherInformation = '';

	/**
	 * applicationDeadline
	 *
	 * @var \DateTime
	 */
	protected $applicationDeadline = NULL;

	/**
	 * assignmentReference
	 *
	 * @var string
	 */
	protected $assignmentReference = '';

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
	 * postalAddressCompany
	 *
	 * @var string
	 */
	protected $postalAddressCompany = '';

	/**
	 * postalAddressAdditive
	 *
	 * @var string
	 */
	protected $postalAddressAdditive = '';

	/**
	 * postalAddressDepartment
	 *
	 * @var string
	 */
	protected $postalAddressDepartment = '';

	/**
	 * postalAddressStreetNr
	 *
	 * @var string
	 */
	protected $postalAddressStreetNr = '';

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
	 * offerIsGerman
	 *
	 * @var bool
	 */
	protected $offerIsGerman = '';

	/**
	 * offerIsFrench
	 *
	 * @var bool
	 */
	protected $offerIsFrench = '';

	/**
	 * offerIsItalian
	 *
	 * @var bool
	 */
	protected $offerIsItalian = '';

	/**
	 * startDateRenew
	 *
	 * @var \DateTime
	 */
	protected $startDateRenew = NULL;

	/**
	 * employmentRelationships
	 *
	 * @var \Sozialinfo\Jobs\Domain\Model\EmploymentRelationship
	 */
	protected $employmentRelationships = NULL;

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
		$this->documents = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
	 * Returns the company
	 *
	 * @return string $company
	 */
	public function getCompany() {
		return $this->company;
	}

	/**
	 * Sets the company
	 *
	 * @param string $company
	 * @return void
	 */
	public function setCompany($company) {
		$this->company = $company;
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
	public function setCorporate($corporate) {
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
	 * Returns the onCall
	 *
	 * @return bool $onCall
	 */
	public function getOnCall() {
		return $this->onCall;
	}

	/**
	 * Sets the onCall
	 *
	 * @param bool $onCall
	 * @return void
	 */
	public function setOnCall($onCall) {
		$this->onCall = $onCall;
	}

	/**
	 * Returns the boolean state of onCall
	 *
	 * @return bool
	 */
	public function isOnCall() {
		return $this->onCall;
	}

	/**
	 * Returns the employer
	 *
	 * @return string $employer
	 */
	public function getEmployer() {
		return $this->employer;
	}

	/**
	 * Sets the employer
	 *
	 * @param string $employer
	 * @return void
	 */
	public function setEmployer($employer) {
		$this->employer = $employer;
	}

	/**
	 * Returns the employerAddition
	 *
	 * @return string $employerAddition
	 */
	public function getEmployerAddition() {
		return $this->employerAddition;
	}

	/**
	 * Sets the employerAddition
	 *
	 * @param string $employerAddition
	 * @return void
	 */
	public function setEmployerAddition($employerAddition) {
		$this->employerAddition = $employerAddition;
	}

	/**
	 * Returns the linkToWebsite
	 *
	 * @return string $linkToWebsite
	 */
	public function getLinkToWebsite() {
		return $this->linkToWebsite;
	}

	/**
	 * Sets the linkToWebsite
	 *
	 * @param string $linkToWebsite
	 * @return void
	 */
	public function setLinkToWebsite($linkToWebsite) {
		$this->linkToWebsite = $linkToWebsite;
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
	 * Returns the zipJobLocation
	 *
	 * @return int $zipJobLocation
	 */
	public function getZipJobLocation() {
		return $this->zipJobLocation;
	}

	/**
	 * Sets the zipJobLocation
	 *
	 * @param int $zipJobLocation
	 * @return void
	 */
	public function setZipJobLocation($zipJobLocation) {
		$this->zipJobLocation = $zipJobLocation;
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
	 * Returns the applicationTo
	 *
	 * @return string $applicationTo
	 */
	public function getApplicationTo() {
		return $this->applicationTo;
	}

	/**
	 * Sets the applicationTo
	 *
	 * @param string $applicationTo
	 * @return void
	 */
	public function setApplicationTo($applicationTo) {
		$this->applicationTo = $applicationTo;
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
	 * Returns the furtherInformation
	 *
	 * @return string $furtherInformation
	 */
	public function getFurtherInformation() {
		return $this->furtherInformation;
	}

	/**
	 * Sets the furtherInformation
	 *
	 * @param string $furtherInformation
	 * @return void
	 */
	public function setFurtherInformation($furtherInformation) {
		$this->furtherInformation = $furtherInformation;
	}

	/**
	 * Returns the applicationDeadline
	 *
	 * @return \DateTime $applicationDeadline
	 */
	public function getApplicationDeadline() {
		return $this->applicationDeadline;
	}

	/**
	 * Sets the applicationDeadline
	 *
	 * @param \DateTime $applicationDeadline
	 * @return void
	 */
	public function setApplicationDeadline($applicationDeadline) {
		$this->applicationDeadline = $applicationDeadline;
	}

	/**
	 * Returns the assignmentReference
	 *
	 * @return string $assignmentReference
	 */
	public function getAssignmentReference() {
		return $this->assignmentReference;
	}

	/**
	 * Sets the assignmentReference
	 *
	 * @param string $assignmentReference
	 * @return void
	 */
	public function setAssignmentReference($assignmentReference) {
		$this->assignmentReference = $assignmentReference;
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
	 * Returns the postalAddressCompany
	 *
	 * @return string $postalAddressCompany
	 */
	public function getPostalAddressCompany() {
		return $this->postalAddressCompany;
	}

	/**
	 * Sets the postalAddressCompany
	 *
	 * @param string $postalAddressCompany
	 * @return void
	 */
	public function setPostalAddressCompany($postalAddressCompany) {
		$this->postalAddressCompany = $postalAddressCompany;
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
	 * Returns the postalAddressDepartment
	 *
	 * @return string $postalAddressDepartment
	 */
	public function getPostalAddressDepartment() {
		return $this->postalAddressDepartment;
	}

	/**
	 * Sets the postalAddressDepartment
	 *
	 * @param string $postalAddressDepartment
	 * @return void
	 */
	public function setPostalAddressDepartment($postalAddressDepartment) {
		$this->postalAddressDepartment = $postalAddressDepartment;
	}

	/**
	 * Returns the postalAddressStreetNr
	 *
	 * @return string $postalAddressStreetNr
	 */
	public function getPostalAddressStreetNr() {
		return $this->postalAddressStreetNr;
	}

	/**
	 * Sets the postalAddressStreetNr
	 *
	 * @param string $postalAddressStreetNr
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
	 * Returns the offerIsGerman
	 *
	 * @return bool $offerIsGerman
	 */
	public function getOfferIsGerman() {
		return $this->offerIsGerman;
	}

	/**
	 * Sets the offerIsGerman
	 *
	 * @param bool $offerIsGerman
	 * @return void
	 */
	public function setOfferIsGerman($offerIsGerman) {
		$this->offerIsGerman = $offerIsGerman;
	}

	/**
	 * Returns the boolean state of offerIsGerman
	 *
	 * @return bool
	 */
	public function isOfferIsGerman() {
		return $this->offerIsGerman;
	}

	/**
	 * Returns the offerIsFrench
	 *
	 * @return bool $offerIsFrench
	 */
	public function getOfferIsFrench() {
		return $this->offerIsFrench;
	}

	/**
	 * Sets the offerIsFrench
	 *
	 * @param bool $offerIsFrench
	 * @return void
	 */
	public function setOfferIsFrench($offerIsFrench) {
		$this->offerIsFrench = $offerIsFrench;
	}

	/**
	 * Returns the boolean state of offerIsFrench
	 *
	 * @return bool
	 */
	public function isOfferIsFrench() {
		return $this->offerIsFrench;
	}

	/**
	 * Returns the offerIsItalian
	 *
	 * @return bool $offerIsItalian
	 */
	public function getOfferIsItalian() {
		return $this->offerIsItalian;
	}

	/**
	 * Sets the offerIsItalian
	 *
	 * @param bool $offerIsItalian
	 * @return void
	 */
	public function setOfferIsItalian($offerIsItalian) {
		$this->offerIsItalian = $offerIsItalian;
	}

	/**
	 * Returns the boolean state of offerIsItalian
	 *
	 * @return bool
	 */
	public function isOfferIsItalian() {
		return $this->offerIsItalian;
	}

	/**
	 * Returns the startDateRenew
	 *
	 * @return \DateTime $startDateRenew
	 */
	public function getStartDateRenew() {
		return $this->startDateRenew;
	}

	/**
	 * Sets the startDateRenew
	 *
	 * @param \DateTime $startDateRenew
	 * @return void
	 */
	public function setStartDateRenew($startDateRenew) {
		$this->startDateRenew = $startDateRenew;
	}

	/**
	 * Returns the employmentRelationships
	 *
	 * @return \Sozialinfo\Jobs\Domain\Model\EmploymentRelationship $employmentRelationships
	 */
	public function getEmploymentRelationships() {
		return $this->employmentRelationships;
	}

	/**
	 * Sets the employmentRelationships
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\EmploymentRelationship $employmentRelationships
	 * @return void
	 */
	public function setEmploymentRelationships(\Sozialinfo\Jobs\Domain\Model\EmploymentRelationship $employmentRelationships) {
		$this->employmentRelationships = $employmentRelationships;
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