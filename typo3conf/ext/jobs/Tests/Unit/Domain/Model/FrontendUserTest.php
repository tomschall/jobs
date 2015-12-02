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
 * Test case for class \Sozialinfo\Jobs\Domain\Model\FrontendUser.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Thomas Schallert <programmierung@sozialinfo.ch>
 */
class FrontendUserTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Sozialinfo\Jobs\Domain\Model\FrontendUser
	 */
	protected $subject = NULL;

	public function setUp() {
		$this->subject = new \Sozialinfo\Jobs\Domain\Model\FrontendUser();
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getAdditiveReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getAdditive()
		);
	}

	/**
	 * @test
	 */
	public function setAdditiveForStringSetsAdditive() {
		$this->subject->setAdditive('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'additive',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDepartmentReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getDepartment()
		);
	}

	/**
	 * @test
	 */
	public function setDepartmentForStringSetsDepartment() {
		$this->subject->setDepartment('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'department',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPoBoxReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getPoBox()
		);
	}

	/**
	 * @test
	 */
	public function setPoBoxForStringSetsPoBox() {
		$this->subject->setPoBox('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'poBox',
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
	public function getJobOffersReturnsInitialValueForJobOffer() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getJobOffers()
		);
	}

	/**
	 * @test
	 */
	public function setJobOffersForObjectStorageContainingJobOfferSetsJobOffers() {
		$jobOffer = new \Sozialinfo\Jobs\Domain\Model\JobOffer();
		$objectStorageHoldingExactlyOneJobOffers = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneJobOffers->attach($jobOffer);
		$this->subject->setJobOffers($objectStorageHoldingExactlyOneJobOffers);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneJobOffers,
			'jobOffers',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addJobOfferToObjectStorageHoldingJobOffers() {
		$jobOffer = new \Sozialinfo\Jobs\Domain\Model\JobOffer();
		$jobOffersObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$jobOffersObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($jobOffer));
		$this->inject($this->subject, 'jobOffers', $jobOffersObjectStorageMock);

		$this->subject->addJobOffer($jobOffer);
	}

	/**
	 * @test
	 */
	public function removeJobOfferFromObjectStorageHoldingJobOffers() {
		$jobOffer = new \Sozialinfo\Jobs\Domain\Model\JobOffer();
		$jobOffersObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$jobOffersObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($jobOffer));
		$this->inject($this->subject, 'jobOffers', $jobOffersObjectStorageMock);

		$this->subject->removeJobOffer($jobOffer);

	}

	/**
	 * @test
	 */
	public function getJobRequestsReturnsInitialValueForJobRequest() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getJobRequests()
		);
	}

	/**
	 * @test
	 */
	public function setJobRequestsForObjectStorageContainingJobRequestSetsJobRequests() {
		$jobRequest = new \Sozialinfo\Jobs\Domain\Model\JobRequest();
		$objectStorageHoldingExactlyOneJobRequests = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneJobRequests->attach($jobRequest);
		$this->subject->setJobRequests($objectStorageHoldingExactlyOneJobRequests);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneJobRequests,
			'jobRequests',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addJobRequestToObjectStorageHoldingJobRequests() {
		$jobRequest = new \Sozialinfo\Jobs\Domain\Model\JobRequest();
		$jobRequestsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$jobRequestsObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($jobRequest));
		$this->inject($this->subject, 'jobRequests', $jobRequestsObjectStorageMock);

		$this->subject->addJobRequest($jobRequest);
	}

	/**
	 * @test
	 */
	public function removeJobRequestFromObjectStorageHoldingJobRequests() {
		$jobRequest = new \Sozialinfo\Jobs\Domain\Model\JobRequest();
		$jobRequestsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$jobRequestsObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($jobRequest));
		$this->inject($this->subject, 'jobRequests', $jobRequestsObjectStorageMock);

		$this->subject->removeJobRequest($jobRequest);

	}

	/**
	 * @test
	 */
	public function getCountryReturnsInitialValueForCountry() {
		$this->assertEquals(
			NULL,
			$this->subject->getCountry()
		);
	}

	/**
	 * @test
	 */
	public function setCountryForCountrySetsCountry() {
		$countryFixture = new \Sozialinfo\Jobs\Domain\Model\Country();
		$this->subject->setCountry($countryFixture);

		$this->assertAttributeEquals(
			$countryFixture,
			'country',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCompanyFrontendUserReturnsInitialValueForCompanyFrontendUser() {
		$this->assertEquals(
			NULL,
			$this->subject->getCompanyFrontendUser()
		);
	}

	/**
	 * @test
	 */
	public function setCompanyFrontendUserForCompanyFrontendUserSetsCompanyFrontendUser() {
		$companyFrontendUserFixture = new \Sozialinfo\Jobs\Domain\Model\CompanyFrontendUser();
		$this->subject->setCompanyFrontendUser($companyFrontendUserFixture);

		$this->assertAttributeEquals(
			$companyFrontendUserFixture,
			'companyFrontendUser',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getInsosMemberReturnsInitialValueForInsosMember() {
		$this->assertEquals(
			NULL,
			$this->subject->getInsosMember()
		);
	}

	/**
	 * @test
	 */
	public function setInsosMemberForInsosMemberSetsInsosMember() {
		$insosMemberFixture = new \Sozialinfo\Jobs\Domain\Model\InsosMember();
		$this->subject->setInsosMember($insosMemberFixture);

		$this->assertAttributeEquals(
			$insosMemberFixture,
			'insosMember',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSozialinfoMemberReturnsInitialValueForSozialinfoMember() {
		$this->assertEquals(
			NULL,
			$this->subject->getSozialinfoMember()
		);
	}

	/**
	 * @test
	 */
	public function setSozialinfoMemberForSozialinfoMemberSetsSozialinfoMember() {
		$sozialinfoMemberFixture = new \Sozialinfo\Jobs\Domain\Model\SozialinfoMember();
		$this->subject->setSozialinfoMember($sozialinfoMemberFixture);

		$this->assertAttributeEquals(
			$sozialinfoMemberFixture,
			'sozialinfoMember',
			$this->subject
		);
	}
}
