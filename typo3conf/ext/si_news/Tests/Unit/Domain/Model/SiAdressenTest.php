<?php

namespace Sozialinfo\SiNews\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Pera <pera91@mykolab.ch>, Sozialinfo
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
 * Test case for class \Sozialinfo\SiNews\Domain\Model\SiAdressen.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Pera <pera91@mykolab.ch>
 */
class SiAdressenTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \Sozialinfo\SiNews\Domain\Model\SiAdressen
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \Sozialinfo\SiNews\Domain\Model\SiAdressen();
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getIdUserReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setIdUserForIntSetsIdUser()
	{	}

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
	public function getPlzReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getPlz()
		);
	}

	/**
	 * @test
	 */
	public function setPlzForStringSetsPlz()
	{
		$this->subject->setPlz('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'plz',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getOrtReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getOrt()
		);
	}

	/**
	 * @test
	 */
	public function setOrtForStringSetsOrt()
	{
		$this->subject->setOrt('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'ort',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPPlzReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getPPlz()
		);
	}

	/**
	 * @test
	 */
	public function setPPlzForStringSetsPPlz()
	{
		$this->subject->setPPlz('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'pPlz',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPOrtReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getPOrt()
		);
	}

	/**
	 * @test
	 */
	public function setPOrtForStringSetsPOrt()
	{
		$this->subject->setPOrt('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'pOrt',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getIdCantoneReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getIdCantone()
		);
	}

	/**
	 * @test
	 */
	public function setIdCantoneForStringSetsIdCantone()
	{
		$this->subject->setIdCantone('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'idCantone',
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
	public function getCantoneReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getCantone()
		);
	}

	/**
	 * @test
	 */
	public function setCantoneForStringSetsCantone()
	{
		$this->subject->setCantone('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'cantone',
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
	public function getIdEducationReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getIdEducation()
		);
	}

	/**
	 * @test
	 */
	public function setIdEducationForStringSetsIdEducation()
	{
		$this->subject->setIdEducation('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'idEducation',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDatasheetReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getDatasheet()
		);
	}

	/**
	 * @test
	 */
	public function setDatasheetForStringSetsDatasheet()
	{
		$this->subject->setDatasheet('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'datasheet',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getBackEmptyReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getBackEmpty()
		);
	}

	/**
	 * @test
	 */
	public function setBackEmptyForStringSetsBackEmpty()
	{
		$this->subject->setBackEmpty('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'backEmpty',
			$this->subject
		);
	}

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
}
