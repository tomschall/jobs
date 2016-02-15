<?php

namespace Sozialinfo\SiNews\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Pera <pera91@mykolab.ch>, Sozialinfo
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
 * Test case for class \Sozialinfo\SiNews\Domain\Model\Adresse.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Pera <pera91@mykolab.ch>
 */
class AdresseTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \Sozialinfo\SiNews\Domain\Model\Adresse
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \Sozialinfo\SiNews\Domain\Model\Adresse();
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getInstitutionReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getInstitution()
		);
	}

	/**
	 * @test
	 */
	public function setInstitutionForStringSetsInstitution()
	{
		$this->subject->setInstitution('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'institution',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCategoryReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setCategoryForIntSetsCategory()
	{	}

	/**
	 * @test
	 */
	public function getDepartmentReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getDepartment()
		);
	}

	/**
	 * @test
	 */
	public function setDepartmentForStringSetsDepartment()
	{
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
	public function getShortReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getShort()
		);
	}

	/**
	 * @test
	 */
	public function setShortForStringSetsShort()
	{
		$this->subject->setShort('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'short',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDisplaynameReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getDisplayname()
		);
	}

	/**
	 * @test
	 */
	public function setDisplaynameForStringSetsDisplayname()
	{
		$this->subject->setDisplayname('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'displayname',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getAdditionReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getAddition()
		);
	}

	/**
	 * @test
	 */
	public function setAdditionForStringSetsAddition()
	{
		$this->subject->setAddition('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'addition',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getAdresseReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getAdresse()
		);
	}

	/**
	 * @test
	 */
	public function setAdresseForStringSetsAdresse()
	{
		$this->subject->setAdresse('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'adresse',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPostOfficeReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getPostOffice()
		);
	}

	/**
	 * @test
	 */
	public function setPostOfficeForStringSetsPostOffice()
	{
		$this->subject->setPostOffice('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'postOffice',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPostcodeReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getPostcode()
		);
	}

	/**
	 * @test
	 */
	public function setPostcodeForStringSetsPostcode()
	{
		$this->subject->setPostcode('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'postcode',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLocationReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getLocation()
		);
	}

	/**
	 * @test
	 */
	public function setLocationForStringSetsLocation()
	{
		$this->subject->setLocation('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'location',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPPostcodeReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getPPostcode()
		);
	}

	/**
	 * @test
	 */
	public function setPPostcodeForStringSetsPPostcode()
	{
		$this->subject->setPPostcode('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'pPostcode',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPLocationReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getPLocation()
		);
	}

	/**
	 * @test
	 */
	public function setPLocationForStringSetsPLocation()
	{
		$this->subject->setPLocation('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'pLocation',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getAreasOfWorkReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setAreasOfWorkForIntSetsAreasOfWork()
	{	}

	/**
	 * @test
	 */
	public function getCantonReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getCanton()
		);
	}

	/**
	 * @test
	 */
	public function setCantonForStringSetsCanton()
	{
		$this->subject->setCanton('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'canton',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPhoneReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getPhone()
		);
	}

	/**
	 * @test
	 */
	public function setPhoneForStringSetsPhone()
	{
		$this->subject->setPhone('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'phone',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTelefaxReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getTelefax()
		);
	}

	/**
	 * @test
	 */
	public function setTelefaxForStringSetsTelefax()
	{
		$this->subject->setTelefax('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'telefax',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getEmailReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getEmail()
		);
	}

	/**
	 * @test
	 */
	public function setEmailForStringSetsEmail()
	{
		$this->subject->setEmail('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'email',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getWwwReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getWww()
		);
	}

	/**
	 * @test
	 */
	public function setWwwForStringSetsWww()
	{
		$this->subject->setWww('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'www',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getRemarkReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getRemark()
		);
	}

	/**
	 * @test
	 */
	public function setRemarkForStringSetsRemark()
	{
		$this->subject->setRemark('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'remark',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getOtherReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getOther()
		);
	}

	/**
	 * @test
	 */
	public function setOtherForStringSetsOther()
	{
		$this->subject->setOther('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'other',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDatasheetReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setDatasheetForIntSetsDatasheet()
	{	}

	/**
	 * @test
	 */
	public function getBackEmptyReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setBackEmptyForIntSetsBackEmpty()
	{	}

	/**
	 * @test
	 */
	public function getInstitutionShortReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getInstitutionShort()
		);
	}

	/**
	 * @test
	 */
	public function setInstitutionShortForStringSetsInstitutionShort()
	{
		$this->subject->setInstitutionShort('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'institutionShort',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getFacebookReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getFacebook()
		);
	}

	/**
	 * @test
	 */
	public function setFacebookForStringSetsFacebook()
	{
		$this->subject->setFacebook('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'facebook',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTwitterReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getTwitter()
		);
	}

	/**
	 * @test
	 */
	public function setTwitterForStringSetsTwitter()
	{
		$this->subject->setTwitter('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'twitter',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getOtherSMReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getOtherSM()
		);
	}

	/**
	 * @test
	 */
	public function setOtherSMForStringSetsOtherSM()
	{
		$this->subject->setOtherSM('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'otherSM',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getGoogleplusReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getGoogleplus()
		);
	}

	/**
	 * @test
	 */
	public function setGoogleplusForStringSetsGoogleplus()
	{
		$this->subject->setGoogleplus('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'googleplus',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getXingReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getXing()
		);
	}

	/**
	 * @test
	 */
	public function setXingForStringSetsXing()
	{
		$this->subject->setXing('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'xing',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getYoutubeReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getYoutube()
		);
	}

	/**
	 * @test
	 */
	public function setYoutubeForStringSetsYoutube()
	{
		$this->subject->setYoutube('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'youtube',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getRssReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getRss()
		);
	}

	/**
	 * @test
	 */
	public function setRssForStringSetsRss()
	{
		$this->subject->setRss('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'rss',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getIdUserReturnsInitialValueForFeUser()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getIdUser()
		);
	}

	/**
	 * @test
	 */
	public function setIdUserForFeUserSetsIdUser()
	{
		$idUserFixture = new \Sozialinfo\SiNews\Domain\Model\FeUser();
		$this->subject->setIdUser($idUserFixture);

		$this->assertAttributeEquals(
			$idUserFixture,
			'idUser',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getIdCantonReturnsInitialValueForCanton()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getIdCanton()
		);
	}

	/**
	 * @test
	 */
	public function setIdCantonForCantonSetsIdCanton()
	{
		$idCantonFixture = new \Sozialinfo\SiNews\Domain\Model\Canton();
		$this->subject->setIdCanton($idCantonFixture);

		$this->assertAttributeEquals(
			$idCantonFixture,
			'idCanton',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getIdAreaofworkReturnsInitialValueForAreasOfWork()
	{
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getIdAreaofwork()
		);
	}

	/**
	 * @test
	 */
	public function setIdAreaofworkForObjectStorageContainingAreasOfWorkSetsIdAreaofwork()
	{
		$idAreaofwork = new \Sozialinfo\SiNews\Domain\Model\AreasOfWork();
		$objectStorageHoldingExactlyOneIdAreaofwork = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneIdAreaofwork->attach($idAreaofwork);
		$this->subject->setIdAreaofwork($objectStorageHoldingExactlyOneIdAreaofwork);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneIdAreaofwork,
			'idAreaofwork',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addIdAreaofworkToObjectStorageHoldingIdAreaofwork()
	{
		$idAreaofwork = new \Sozialinfo\SiNews\Domain\Model\AreasOfWork();
		$idAreaofworkObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$idAreaofworkObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($idAreaofwork));
		$this->inject($this->subject, 'idAreaofwork', $idAreaofworkObjectStorageMock);

		$this->subject->addIdAreaofwork($idAreaofwork);
	}

	/**
	 * @test
	 */
	public function removeIdAreaofworkFromObjectStorageHoldingIdAreaofwork()
	{
		$idAreaofwork = new \Sozialinfo\SiNews\Domain\Model\AreasOfWork();
		$idAreaofworkObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$idAreaofworkObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($idAreaofwork));
		$this->inject($this->subject, 'idAreaofwork', $idAreaofworkObjectStorageMock);

		$this->subject->removeIdAreaofwork($idAreaofwork);

	}

	/**
	 * @test
	 */
	public function getIdEducationReturnsInitialValueForEducation()
	{
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getIdEducation()
		);
	}

	/**
	 * @test
	 */
	public function setIdEducationForObjectStorageContainingEducationSetsIdEducation()
	{
		$idEducation = new \Sozialinfo\SiNews\Domain\Model\Education();
		$objectStorageHoldingExactlyOneIdEducation = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneIdEducation->attach($idEducation);
		$this->subject->setIdEducation($objectStorageHoldingExactlyOneIdEducation);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneIdEducation,
			'idEducation',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addIdEducationToObjectStorageHoldingIdEducation()
	{
		$idEducation = new \Sozialinfo\SiNews\Domain\Model\Education();
		$idEducationObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$idEducationObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($idEducation));
		$this->inject($this->subject, 'idEducation', $idEducationObjectStorageMock);

		$this->subject->addIdEducation($idEducation);
	}

	/**
	 * @test
	 */
	public function removeIdEducationFromObjectStorageHoldingIdEducation()
	{
		$idEducation = new \Sozialinfo\SiNews\Domain\Model\Education();
		$idEducationObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$idEducationObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($idEducation));
		$this->inject($this->subject, 'idEducation', $idEducationObjectStorageMock);

		$this->subject->removeIdEducation($idEducation);

	}
}
