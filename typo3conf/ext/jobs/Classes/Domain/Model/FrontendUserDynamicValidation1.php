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
 * FrontendUser
 */
class FrontendUserDynamicValidation1 extends \Sozialinfo\Jobs\DomainObject\AbstractEntity {

	const PROCESS_STEP_MAXIMUM = 3;

	/**
	 * username
	 *
	 * @var string
	 */
	protected $username = '';

	/**
	 * password
	 *
	 * @var string
	 */
	protected $password = '';

	/**
	 * email
	 *
	 * @var string
	 */
	protected $email = '';

	/**
	 * disable
	 *
	 * @var string
	 */
	protected $disable = '';

	/**
	 * additive
	 *
	 * @var string
	 * @validate Text, NotEmpty
	 */
	protected $additive = '';

	/**
	 * department
	 *
	 * @var string
	 * @validate Text, NotEmpty
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
	 * jobOffers
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\Jobs\Domain\Model\JobOffer>
	 * @cascade remove
	 */
	protected $jobOffers = NULL;

	/**
	 * jobRequests
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\Jobs\Domain\Model\JobRequest>
	 * @cascade remove
	 */
	protected $jobRequests = NULL;

	/**
	 * country
	 *
	 * @var \Sozialinfo\Jobs\Domain\Model\Country
	 */
	protected $country = NULL;

	/**
	 * companyFrontendUser
	 *
	 * @var \Sozialinfo\Jobs\Domain\Model\CompanyFrontendUser
	 */
	protected $companyFrontendUser = NULL;

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
	 * processStep
	 *
	 * @var int
	 */
	protected $processStep = 0;

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
		$this->jobOffers = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->jobRequests = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the username
	 *
	 * @return string $username
	 */
	public function getUsername() {
		return $this->username;
	}

	/**
	 * Sets the username
	 *
	 * @param string $username
	 * @return void
	 */
	public function setUsername($username) {
		$this->username = $username;
	}

	/**
	 * Returns the password
	 *
	 * @return string $password
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * Sets the password
	 *
	 * @param string $password
	 * @return void
	 */
	public function setPassword($password) {
		$this->password = $password;
	}

	/**
	 * Returns the email
	 *
	 * @return string $email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Sets the email
	 *
	 * @param string $email
	 * @return void
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * Returns the disable
	 *
	 * @return string $disable
	 */
	public function getDisable() {
		return $this->disable;
	}

	/**
	 * Sets the disable
	 *
	 * @param string $disable
	 * @return void
	 */
	public function setDisable($disable) {
		$this->disable = $disable;
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
	 * Returns the boolean state of member
	 *
	 * @return bool
	 */
	public function isMember() {
		return $this->member;
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
	 * Adds a JobOffer
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\JobOffer $jobOffer
	 * @return void
	 */
	public function addJobOffer(\Sozialinfo\Jobs\Domain\Model\JobOffer $jobOffer) {
		$this->jobOffers->attach($jobOffer);
	}

	/**
	 * Removes a JobOffer
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\JobOffer $jobOfferToRemove The JobOffer to be removed
	 * @return void
	 */
	public function removeJobOffer(\Sozialinfo\Jobs\Domain\Model\JobOffer $jobOfferToRemove) {
		$this->jobOffers->detach($jobOfferToRemove);
	}

	/**
	 * Returns the jobOffers
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\Jobs\Domain\Model\JobOffer> $jobOffers
	 */
	public function getJobOffers() {
		return $this->jobOffers;
	}

	/**
	 * Sets the jobOffers
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\Jobs\Domain\Model\JobOffer> $jobOffers
	 * @return void
	 */
	public function setJobOffers(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $jobOffers) {
		$this->jobOffers = $jobOffers;
	}

	/**
	 * Adds a JobRequest
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\JobRequest $jobRequest
	 * @return void
	 */
	public function addJobRequest(\Sozialinfo\Jobs\Domain\Model\JobRequest $jobRequest) {
		$this->jobRequests->attach($jobRequest);
	}

	/**
	 * Removes a JobRequest
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\JobRequest $jobRequestToRemove The JobRequest to be removed
	 * @return void
	 */
	public function removeJobRequest(\Sozialinfo\Jobs\Domain\Model\JobRequest $jobRequestToRemove) {
		$this->jobRequests->detach($jobRequestToRemove);
	}

	/**
	 * Returns the jobRequests
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\Jobs\Domain\Model\JobRequest> $jobRequests
	 */
	public function getJobRequests() {
		return $this->jobRequests;
	}

	/**
	 * Sets the jobRequests
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\Jobs\Domain\Model\JobRequest> $jobRequests
	 * @return void
	 */
	public function setJobRequests(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $jobRequests) {
		$this->jobRequests = $jobRequests;
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
	 * Returns the companyFrontendUser
	 *
	 * @return \Sozialinfo\Jobs\Domain\Model\CompanyFrontendUser $companyFrontendUser
	 */
	public function getCompanyFrontendUser() {
		return $this->companyFrontendUser;
	}

	/**
	 * Sets the companyFrontendUser
	 *
	 * @param \Sozialinfo\Jobs\Domain\Model\CompanyFrontendUser $companyFrontendUser
	 * @return void
	 */
	public function setCompanyFrontendUser(\Sozialinfo\Jobs\Domain\Model\CompanyFrontendUser $companyFrontendUser) {
		$this->companyFrontendUser = $companyFrontendUser;
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
		echo "serialize";
		exit();
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
		echo "unserialize";
		exit();
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