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
 * Test case for class \Sozialinfo\SiNews\Domain\Model\Offer.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Pera <pera91@mykolab.ch>
 */
class OfferTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \Sozialinfo\SiNews\Domain\Model\Offer
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \Sozialinfo\SiNews\Domain\Model\Offer();
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getFegroupReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setFegroupForIntSetsFegroup()
	{	}

	/**
	 * @test
	 */
	public function getOfferTypeReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setOfferTypeForIntSetsOfferType()
	{	}

	/**
	 * @test
	 */
	public function getNumberReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setNumberForIntSetsNumber()
	{	}

	/**
	 * @test
	 */
	public function getDateReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setDateForIntSetsDate()
	{	}

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
	public function getTitleReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getTitle()
		);
	}

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle()
	{
		$this->subject->setTitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'title',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getContentReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getContent()
		);
	}

	/**
	 * @test
	 */
	public function setContentForStringSetsContent()
	{
		$this->subject->setContent('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'content',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getInfosReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getInfos()
		);
	}

	/**
	 * @test
	 */
	public function setInfosForStringSetsInfos()
	{
		$this->subject->setInfos('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'infos',
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
	public function getDelDateReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setDelDateForIntSetsDelDate()
	{	}

	/**
	 * @test
	 */
	public function getIdCategoryReturnsInitialValueForCategory()
	{
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getIdCategory()
		);
	}

	/**
	 * @test
	 */
	public function setIdCategoryForObjectStorageContainingCategorySetsIdCategory()
	{
		$idCategory = new \Sozialinfo\SiNews\Domain\Model\Category();
		$objectStorageHoldingExactlyOneIdCategory = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneIdCategory->attach($idCategory);
		$this->subject->setIdCategory($objectStorageHoldingExactlyOneIdCategory);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneIdCategory,
			'idCategory',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addIdCategoryToObjectStorageHoldingIdCategory()
	{
		$idCategory = new \Sozialinfo\SiNews\Domain\Model\Category();
		$idCategoryObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$idCategoryObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($idCategory));
		$this->inject($this->subject, 'idCategory', $idCategoryObjectStorageMock);

		$this->subject->addIdCategory($idCategory);
	}

	/**
	 * @test
	 */
	public function removeIdCategoryFromObjectStorageHoldingIdCategory()
	{
		$idCategory = new \Sozialinfo\SiNews\Domain\Model\Category();
		$idCategoryObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$idCategoryObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($idCategory));
		$this->inject($this->subject, 'idCategory', $idCategoryObjectStorageMock);

		$this->subject->removeIdCategory($idCategory);

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
	public function getIdDegreeReturnsInitialValueForDegree()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getIdDegree()
		);
	}

	/**
	 * @test
	 */
	public function setIdDegreeForDegreeSetsIdDegree()
	{
		$idDegreeFixture = new \Sozialinfo\SiNews\Domain\Model\Degree();
		$this->subject->setIdDegree($idDegreeFixture);

		$this->assertAttributeEquals(
			$idDegreeFixture,
			'idDegree',
			$this->subject
		);
	}
}
