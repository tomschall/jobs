<?php

namespace Sozialinfo\Jobs\Tests\Unit\Domain\Model;

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
 * Test case for class \Sozialinfo\Jobs\Domain\Model\JobOffer.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Thomas Schallert <programmierung@sozialinfo.ch>
 */
class JobOfferTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Sozialinfo\Jobs\Domain\Model\JobOffer
	 */
	protected $subject = NULL;

	public function setUp() {
		$this->subject = new \Sozialinfo\Jobs\Domain\Model\JobOffer();
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getStartDateReturnsInitialValueForDateTime() {
		$this->assertEquals(
			NULL,
			$this->subject->getStartDate()
		);
	}

	/**
	 * @test
	 */
	public function setStartDateForDateTimeSetsStartDate() {
		$dateTimeFixture = new \DateTime();
		$this->subject->setStartDate($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'startDate',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getEndDateReturnsInitialValueForDateTime() {
		$this->assertEquals(
			NULL,
			$this->subject->getEndDate()
		);
	}

	/**
	 * @test
	 */
	public function setEndDateForDateTimeSetsEndDate() {
		$dateTimeFixture = new \DateTime();
		$this->subject->setEndDate($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'endDate',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getNumberDaysPublicationReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setNumberDaysPublicationForIntSetsNumberDaysPublication() {	}

	/**
	 * @test
	 */
	public function getPublicationDateReturnsInitialValueForDateTime() {
		$this->assertEquals(
			NULL,
			$this->subject->getPublicationDate()
		);
	}

	/**
	 * @test
	 */
	public function setPublicationDateForDateTimeSetsPublicationDate() {
		$dateTimeFixture = new \DateTime();
		$this->subject->setPublicationDate($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'publicationDate',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getJobTitleReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getJobTitle()
		);
	}

	/**
	 * @test
	 */
	public function setJobTitleForStringSetsJobTitle() {
		$this->subject->setJobTitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'jobTitle',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCompanyReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getCompany()
		);
	}

	/**
	 * @test
	 */
	public function setCompanyForStringSetsCompany() {
		$this->subject->setCompany('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'company',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCorporateReturnsInitialValueForFileReference() {
		$this->assertEquals(
			NULL,
			$this->subject->getCorporate()
		);
	}

	/**
	 * @test
	 */
	public function setCorporateForFileReferenceSetsCorporate() {
		$fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$this->subject->setCorporate($fileReferenceFixture);

		$this->assertAttributeEquals(
			$fileReferenceFixture,
			'corporate',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDocumentsReturnsInitialValueForFileReference() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getDocuments()
		);
	}

	/**
	 * @test
	 */
	public function setDocumentsForFileReferenceSetsDocuments() {
		$document = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$objectStorageHoldingExactlyOneDocuments = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneDocuments->attach($document);
		$this->subject->setDocuments($objectStorageHoldingExactlyOneDocuments);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneDocuments,
			'documents',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addDocumentToObjectStorageHoldingDocuments() {
		$document = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$documentsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$documentsObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($document));
		$this->inject($this->subject, 'documents', $documentsObjectStorageMock);

		$this->subject->addDocument($document);
	}

	/**
	 * @test
	 */
	public function removeDocumentFromObjectStorageHoldingDocuments() {
		$document = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$documentsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$documentsObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($document));
		$this->inject($this->subject, 'documents', $documentsObjectStorageMock);

		$this->subject->removeDocument($document);

	}

	/**
	 * @test
	 */
	public function getPercentOfReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getPercentOf()
		);
	}

	/**
	 * @test
	 */
	public function setPercentOfForStringSetsPercentOf() {
		$this->subject->setPercentOf('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'percentOf',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPercentUpReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getPercentUp()
		);
	}

	/**
	 * @test
	 */
	public function setPercentUpForStringSetsPercentUp() {
		$this->subject->setPercentUp('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'percentUp',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getOnCallReturnsInitialValueForBool() {
		$this->assertSame(
			FALSE,
			$this->subject->getOnCall()
		);
	}

	/**
	 * @test
	 */
	public function setOnCallForBoolSetsOnCall() {
		$this->subject->setOnCall(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'onCall',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getEmployerReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getEmployer()
		);
	}

	/**
	 * @test
	 */
	public function setEmployerForStringSetsEmployer() {
		$this->subject->setEmployer('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'employer',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getEmployerAdditionReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getEmployerAddition()
		);
	}

	/**
	 * @test
	 */
	public function setEmployerAdditionForStringSetsEmployerAddition() {
		$this->subject->setEmployerAddition('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'employerAddition',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLinkToWebsiteReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLinkToWebsite()
		);
	}

	/**
	 * @test
	 */
	public function setLinkToWebsiteForStringSetsLinkToWebsite() {
		$this->subject->setLinkToWebsite('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'linkToWebsite',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getEntryDateReturnsInitialValueForDateTime() {
		$this->assertEquals(
			NULL,
			$this->subject->getEntryDate()
		);
	}

	/**
	 * @test
	 */
	public function setEntryDateForDateTimeSetsEntryDate() {
		$dateTimeFixture = new \DateTime();
		$this->subject->setEntryDate($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'entryDate',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getEntryAgreementReturnsInitialValueForBool() {
		$this->assertSame(
			FALSE,
			$this->subject->getEntryAgreement()
		);
	}

	/**
	 * @test
	 */
	public function setEntryAgreementForBoolSetsEntryAgreement() {
		$this->subject->setEntryAgreement(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'entryAgreement',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getEntryImmediatelyReturnsInitialValueForBool() {
		$this->assertSame(
			FALSE,
			$this->subject->getEntryImmediately()
		);
	}

	/**
	 * @test
	 */
	public function setEntryImmediatelyForBoolSetsEntryImmediately() {
		$this->subject->setEntryImmediately(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'entryImmediately',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getJobLocationReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getJobLocation()
		);
	}

	/**
	 * @test
	 */
	public function setJobLocationForStringSetsJobLocation() {
		$this->subject->setJobLocation('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'jobLocation',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getZipJobLocationReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setZipJobLocationForIntSetsZipJobLocation() {	}

	/**
	 * @test
	 */
	public function getJobDescriptionReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getJobDescription()
		);
	}

	/**
	 * @test
	 */
	public function setJobDescriptionForStringSetsJobDescription() {
		$this->subject->setJobDescription('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'jobDescription',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getApplicationToReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getApplicationTo()
		);
	}

	/**
	 * @test
	 */
	public function setApplicationToForStringSetsApplicationTo() {
		$this->subject->setApplicationTo('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'applicationTo',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getEmailToReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getEmailTo()
		);
	}

	/**
	 * @test
	 */
	public function setEmailToForStringSetsEmailTo() {
		$this->subject->setEmailTo('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'emailTo',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getFurtherInformationReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getFurtherInformation()
		);
	}

	/**
	 * @test
	 */
	public function setFurtherInformationForStringSetsFurtherInformation() {
		$this->subject->setFurtherInformation('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'furtherInformation',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getApplicationDeadlineReturnsInitialValueForDateTime() {
		$this->assertEquals(
			NULL,
			$this->subject->getApplicationDeadline()
		);
	}

	/**
	 * @test
	 */
	public function setApplicationDeadlineForDateTimeSetsApplicationDeadline() {
		$dateTimeFixture = new \DateTime();
		$this->subject->setApplicationDeadline($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'applicationDeadline',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getAssignmentReferenceReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getAssignmentReference()
		);
	}

	/**
	 * @test
	 */
	public function setAssignmentReferenceForStringSetsAssignmentReference() {
		$this->subject->setAssignmentReference('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'assignmentReference',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPostalAddresEqualToRegistrationAddressReturnsInitialValueForBool() {
		$this->assertSame(
			FALSE,
			$this->subject->getPostalAddresEqualToRegistrationAddress()
		);
	}

	/**
	 * @test
	 */
	public function setPostalAddresEqualToRegistrationAddressForBoolSetsPostalAddresEqualToRegistrationAddress() {
		$this->subject->setPostalAddresEqualToRegistrationAddress(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'postalAddresEqualToRegistrationAddress',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPostalAddressTitleReturnsInitialValueForBool() {
		$this->assertSame(
			FALSE,
			$this->subject->getPostalAddressTitle()
		);
	}

	/**
	 * @test
	 */
	public function setPostalAddressTitleForBoolSetsPostalAddressTitle() {
		$this->subject->setPostalAddressTitle(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'postalAddressTitle',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPostalAddressFirstNameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getPostalAddressFirstName()
		);
	}

	/**
	 * @test
	 */
	public function setPostalAddressFirstNameForStringSetsPostalAddressFirstName() {
		$this->subject->setPostalAddressFirstName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'postalAddressFirstName',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPostalAddressNameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getPostalAddressName()
		);
	}

	/**
	 * @test
	 */
	public function setPostalAddressNameForStringSetsPostalAddressName() {
		$this->subject->setPostalAddressName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'postalAddressName',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPostalAddressCompanyReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getPostalAddressCompany()
		);
	}

	/**
	 * @test
	 */
	public function setPostalAddressCompanyForStringSetsPostalAddressCompany() {
		$this->subject->setPostalAddressCompany('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'postalAddressCompany',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPostalAddressAdditiveReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getPostalAddressAdditive()
		);
	}

	/**
	 * @test
	 */
	public function setPostalAddressAdditiveForStringSetsPostalAddressAdditive() {
		$this->subject->setPostalAddressAdditive('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'postalAddressAdditive',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPostalAddressDepartmentReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getPostalAddressDepartment()
		);
	}

	/**
	 * @test
	 */
	public function setPostalAddressDepartmentForStringSetsPostalAddressDepartment() {
		$this->subject->setPostalAddressDepartment('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'postalAddressDepartment',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPostalAddressStreetNrReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getPostalAddressStreetNr()
		);
	}

	/**
	 * @test
	 */
	public function setPostalAddressStreetNrForStringSetsPostalAddressStreetNr() {
		$this->subject->setPostalAddressStreetNr('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'postalAddressStreetNr',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPostalAddressPoBoxReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getPostalAddressPoBox()
		);
	}

	/**
	 * @test
	 */
	public function setPostalAddressPoBoxForStringSetsPostalAddressPoBox() {
		$this->subject->setPostalAddressPoBox('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'postalAddressPoBox',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPostalAddressZipReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setPostalAddressZipForIntSetsPostalAddressZip() {	}

	/**
	 * @test
	 */
	public function getPostalAddressCityReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getPostalAddressCity()
		);
	}

	/**
	 * @test
	 */
	public function setPostalAddressCityForStringSetsPostalAddressCity() {
		$this->subject->setPostalAddressCity('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'postalAddressCity',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCommentsReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getComments()
		);
	}

	/**
	 * @test
	 */
	public function setCommentsForStringSetsComments() {
		$this->subject->setComments('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'comments',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDeleteDateReturnsInitialValueForDateTime() {
		$this->assertEquals(
			NULL,
			$this->subject->getDeleteDate()
		);
	}

	/**
	 * @test
	 */
	public function setDeleteDateForDateTimeSetsDeleteDate() {
		$dateTimeFixture = new \DateTime();
		$this->subject->setDeleteDate($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'deleteDate',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDeletedHowReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setDeletedHowForIntSetsDeletedHow() {	}

	/**
	 * @test
	 */
	public function getUseAgreementsReturnsInitialValueForBool() {
		$this->assertSame(
			FALSE,
			$this->subject->getUseAgreements()
		);
	}

	/**
	 * @test
	 */
	public function setUseAgreementsForBoolSetsUseAgreements() {
		$this->subject->setUseAgreements(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'useAgreements',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getOfferIsGermanReturnsInitialValueForBool() {
		$this->assertSame(
			FALSE,
			$this->subject->getOfferIsGerman()
		);
	}

	/**
	 * @test
	 */
	public function setOfferIsGermanForBoolSetsOfferIsGerman() {
		$this->subject->setOfferIsGerman(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'offerIsGerman',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getOfferIsFrenchReturnsInitialValueForBool() {
		$this->assertSame(
			FALSE,
			$this->subject->getOfferIsFrench()
		);
	}

	/**
	 * @test
	 */
	public function setOfferIsFrenchForBoolSetsOfferIsFrench() {
		$this->subject->setOfferIsFrench(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'offerIsFrench',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getOfferIsItalianReturnsInitialValueForBool() {
		$this->assertSame(
			FALSE,
			$this->subject->getOfferIsItalian()
		);
	}

	/**
	 * @test
	 */
	public function setOfferIsItalianForBoolSetsOfferIsItalian() {
		$this->subject->setOfferIsItalian(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'offerIsItalian',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getStartDateRenewReturnsInitialValueForDateTime() {
		$this->assertEquals(
			NULL,
			$this->subject->getStartDateRenew()
		);
	}

	/**
	 * @test
	 */
	public function setStartDateRenewForDateTimeSetsStartDateRenew() {
		$dateTimeFixture = new \DateTime();
		$this->subject->setStartDateRenew($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'startDateRenew',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getEmploymentRelationshipsReturnsInitialValueForEmploymentRelationship() {
		$this->assertEquals(
			NULL,
			$this->subject->getEmploymentRelationships()
		);
	}

	/**
	 * @test
	 */
	public function setEmploymentRelationshipsForEmploymentRelationshipSetsEmploymentRelationships() {
		$employmentRelationshipsFixture = new \Sozialinfo\Jobs\Domain\Model\EmploymentRelationship();
		$this->subject->setEmploymentRelationships($employmentRelationshipsFixture);

		$this->assertAttributeEquals(
			$employmentRelationshipsFixture,
			'employmentRelationships',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPositionReturnsInitialValueForPosition() {
		$this->assertEquals(
			NULL,
			$this->subject->getPosition()
		);
	}

	/**
	 * @test
	 */
	public function setPositionForPositionSetsPosition() {
		$positionFixture = new \Sozialinfo\Jobs\Domain\Model\Position();
		$this->subject->setPosition($positionFixture);

		$this->assertAttributeEquals(
			$positionFixture,
			'position',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getQualificationReturnsInitialValueForQualification() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getQualification()
		);
	}

	/**
	 * @test
	 */
	public function setQualificationForObjectStorageContainingQualificationSetsQualification() {
		$qualification = new \Sozialinfo\Jobs\Domain\Model\Qualification();
		$objectStorageHoldingExactlyOneQualification = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneQualification->attach($qualification);
		$this->subject->setQualification($objectStorageHoldingExactlyOneQualification);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneQualification,
			'qualification',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addQualificationToObjectStorageHoldingQualification() {
		$qualification = new \Sozialinfo\Jobs\Domain\Model\Qualification();
		$qualificationObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$qualificationObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($qualification));
		$this->inject($this->subject, 'qualification', $qualificationObjectStorageMock);

		$this->subject->addQualification($qualification);
	}

	/**
	 * @test
	 */
	public function removeQualificationFromObjectStorageHoldingQualification() {
		$qualification = new \Sozialinfo\Jobs\Domain\Model\Qualification();
		$qualificationObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$qualificationObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($qualification));
		$this->inject($this->subject, 'qualification', $qualificationObjectStorageMock);

		$this->subject->removeQualification($qualification);

	}

	/**
	 * @test
	 */
	public function getAreasOfWorkReturnsInitialValueForAreasOfWork() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getAreasOfWork()
		);
	}

	/**
	 * @test
	 */
	public function setAreasOfWorkForObjectStorageContainingAreasOfWorkSetsAreasOfWork() {
		$areasOfWork = new \Sozialinfo\Jobs\Domain\Model\AreasOfWork();
		$objectStorageHoldingExactlyOneAreasOfWork = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneAreasOfWork->attach($areasOfWork);
		$this->subject->setAreasOfWork($objectStorageHoldingExactlyOneAreasOfWork);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneAreasOfWork,
			'areasOfWork',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addAreasOfWorkToObjectStorageHoldingAreasOfWork() {
		$areasOfWork = new \Sozialinfo\Jobs\Domain\Model\AreasOfWork();
		$areasOfWorkObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$areasOfWorkObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($areasOfWork));
		$this->inject($this->subject, 'areasOfWork', $areasOfWorkObjectStorageMock);

		$this->subject->addAreasOfWork($areasOfWork);
	}

	/**
	 * @test
	 */
	public function removeAreasOfWorkFromObjectStorageHoldingAreasOfWork() {
		$areasOfWork = new \Sozialinfo\Jobs\Domain\Model\AreasOfWork();
		$areasOfWorkObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$areasOfWorkObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($areasOfWork));
		$this->inject($this->subject, 'areasOfWork', $areasOfWorkObjectStorageMock);

		$this->subject->removeAreasOfWork($areasOfWork);

	}

	/**
	 * @test
	 */
	public function getAdvertisementTypeReturnsInitialValueForAdvertisementType() {
		$this->assertEquals(
			NULL,
			$this->subject->getAdvertisementType()
		);
	}

	/**
	 * @test
	 */
	public function setAdvertisementTypeForAdvertisementTypeSetsAdvertisementType() {
		$advertisementTypeFixture = new \Sozialinfo\Jobs\Domain\Model\AdvertisementType();
		$this->subject->setAdvertisementType($advertisementTypeFixture);

		$this->assertAttributeEquals(
			$advertisementTypeFixture,
			'advertisementType',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCantonReturnsInitialValueForCanton() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getCanton()
		);
	}

	/**
	 * @test
	 */
	public function setCantonForObjectStorageContainingCantonSetsCanton() {
		$canton = new \Sozialinfo\Jobs\Domain\Model\Canton();
		$objectStorageHoldingExactlyOneCanton = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneCanton->attach($canton);
		$this->subject->setCanton($objectStorageHoldingExactlyOneCanton);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneCanton,
			'canton',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addCantonToObjectStorageHoldingCanton() {
		$canton = new \Sozialinfo\Jobs\Domain\Model\Canton();
		$cantonObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$cantonObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($canton));
		$this->inject($this->subject, 'canton', $cantonObjectStorageMock);

		$this->subject->addCanton($canton);
	}

	/**
	 * @test
	 */
	public function removeCantonFromObjectStorageHoldingCanton() {
		$canton = new \Sozialinfo\Jobs\Domain\Model\Canton();
		$cantonObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$cantonObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($canton));
		$this->inject($this->subject, 'canton', $cantonObjectStorageMock);

		$this->subject->removeCanton($canton);

	}

	/**
	 * @test
	 */
	public function getRegionReturnsInitialValueForRegion() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getRegion()
		);
	}

	/**
	 * @test
	 */
	public function setRegionForObjectStorageContainingRegionSetsRegion() {
		$region = new \Sozialinfo\Jobs\Domain\Model\Region();
		$objectStorageHoldingExactlyOneRegion = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneRegion->attach($region);
		$this->subject->setRegion($objectStorageHoldingExactlyOneRegion);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneRegion,
			'region',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addRegionToObjectStorageHoldingRegion() {
		$region = new \Sozialinfo\Jobs\Domain\Model\Region();
		$regionObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$regionObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($region));
		$this->inject($this->subject, 'region', $regionObjectStorageMock);

		$this->subject->addRegion($region);
	}

	/**
	 * @test
	 */
	public function removeRegionFromObjectStorageHoldingRegion() {
		$region = new \Sozialinfo\Jobs\Domain\Model\Region();
		$regionObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$regionObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($region));
		$this->inject($this->subject, 'region', $regionObjectStorageMock);

		$this->subject->removeRegion($region);

	}

	/**
	 * @test
	 */
	public function getPostalAddressCountryReturnsInitialValueForCountry() {
		$this->assertEquals(
			NULL,
			$this->subject->getPostalAddressCountry()
		);
	}

	/**
	 * @test
	 */
	public function setPostalAddressCountryForCountrySetsPostalAddressCountry() {
		$postalAddressCountryFixture = new \Sozialinfo\Jobs\Domain\Model\Country();
		$this->subject->setPostalAddressCountry($postalAddressCountryFixture);

		$this->assertAttributeEquals(
			$postalAddressCountryFixture,
			'postalAddressCountry',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTypeOfInstitutionReturnsInitialValueForTypeOfInstitution() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getTypeOfInstitution()
		);
	}

	/**
	 * @test
	 */
	public function setTypeOfInstitutionForObjectStorageContainingTypeOfInstitutionSetsTypeOfInstitution() {
		$typeOfInstitution = new \Sozialinfo\Jobs\Domain\Model\TypeOfInstitution();
		$objectStorageHoldingExactlyOneTypeOfInstitution = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneTypeOfInstitution->attach($typeOfInstitution);
		$this->subject->setTypeOfInstitution($objectStorageHoldingExactlyOneTypeOfInstitution);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneTypeOfInstitution,
			'typeOfInstitution',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addTypeOfInstitutionToObjectStorageHoldingTypeOfInstitution() {
		$typeOfInstitution = new \Sozialinfo\Jobs\Domain\Model\TypeOfInstitution();
		$typeOfInstitutionObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$typeOfInstitutionObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($typeOfInstitution));
		$this->inject($this->subject, 'typeOfInstitution', $typeOfInstitutionObjectStorageMock);

		$this->subject->addTypeOfInstitution($typeOfInstitution);
	}

	/**
	 * @test
	 */
	public function removeTypeOfInstitutionFromObjectStorageHoldingTypeOfInstitution() {
		$typeOfInstitution = new \Sozialinfo\Jobs\Domain\Model\TypeOfInstitution();
		$typeOfInstitutionObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$typeOfInstitutionObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($typeOfInstitution));
		$this->inject($this->subject, 'typeOfInstitution', $typeOfInstitutionObjectStorageMock);

		$this->subject->removeTypeOfInstitution($typeOfInstitution);

	}
}
