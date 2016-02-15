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
 * Test case for class \Sozialinfo\SiNews\Domain\Model\News.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Pera <pera91@mykolab.ch>
 */
class NewsTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \Sozialinfo\SiNews\Domain\Model\News
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \Sozialinfo\SiNews\Domain\Model\News();
	}

	public function tearDown()
	{
		unset($this->subject);
	}

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
	public function getSubtitleReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getSubtitle()
		);
	}

	/**
	 * @test
	 */
	public function setSubtitleForStringSetsSubtitle()
	{
		$this->subject->setSubtitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'subtitle',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getIsbnReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getIsbn()
		);
	}

	/**
	 * @test
	 */
	public function setIsbnForStringSetsIsbn()
	{
		$this->subject->setIsbn('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'isbn',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getIssnReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getIssn()
		);
	}

	/**
	 * @test
	 */
	public function setIssnForStringSetsIssn()
	{
		$this->subject->setIssn('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'issn',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getEditionReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getEdition()
		);
	}

	/**
	 * @test
	 */
	public function setEditionForStringSetsEdition()
	{
		$this->subject->setEdition('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'edition',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getYearofpublicaitionReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setYearofpublicaitionForIntSetsYearofpublicaition()
	{	}

	/**
	 * @test
	 */
	public function getChannelsReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setChannelsForIntSetsChannels()
	{	}

	/**
	 * @test
	 */
	public function getNewsReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setNewsForIntSetsNews()
	{	}

	/**
	 * @test
	 */
	public function getKeywordsReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getKeywords()
		);
	}

	/**
	 * @test
	 */
	public function setKeywordsForStringSetsKeywords()
	{
		$this->subject->setKeywords('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'keywords',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getHrsgReturnsInitialValueForBool()
	{
		$this->assertSame(
			FALSE,
			$this->subject->getHrsg()
		);
	}

	/**
	 * @test
	 */
	public function setHrsgForBoolSetsHrsg()
	{
		$this->subject->setHrsg(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'hrsg',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getIdAuthorReturnsInitialValueForAuthors()
	{
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getIdAuthor()
		);
	}

	/**
	 * @test
	 */
	public function setIdAuthorForObjectStorageContainingAuthorsSetsIdAuthor()
	{
		$idAuthor = new \Sozialinfo\SiNews\Domain\Model\Authors();
		$objectStorageHoldingExactlyOneIdAuthor = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneIdAuthor->attach($idAuthor);
		$this->subject->setIdAuthor($objectStorageHoldingExactlyOneIdAuthor);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneIdAuthor,
			'idAuthor',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addIdAuthorToObjectStorageHoldingIdAuthor()
	{
		$idAuthor = new \Sozialinfo\SiNews\Domain\Model\Authors();
		$idAuthorObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$idAuthorObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($idAuthor));
		$this->inject($this->subject, 'idAuthor', $idAuthorObjectStorageMock);

		$this->subject->addIdAuthor($idAuthor);
	}

	/**
	 * @test
	 */
	public function removeIdAuthorFromObjectStorageHoldingIdAuthor()
	{
		$idAuthor = new \Sozialinfo\SiNews\Domain\Model\Authors();
		$idAuthorObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$idAuthorObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($idAuthor));
		$this->inject($this->subject, 'idAuthor', $idAuthorObjectStorageMock);

		$this->subject->removeIdAuthor($idAuthor);

	}

	/**
	 * @test
	 */
	public function getIdPublisherReturnsInitialValueForPublisher()
	{
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getIdPublisher()
		);
	}

	/**
	 * @test
	 */
	public function setIdPublisherForObjectStorageContainingPublisherSetsIdPublisher()
	{
		$idPublisher = new \Sozialinfo\SiNews\Domain\Model\Publisher();
		$objectStorageHoldingExactlyOneIdPublisher = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneIdPublisher->attach($idPublisher);
		$this->subject->setIdPublisher($objectStorageHoldingExactlyOneIdPublisher);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneIdPublisher,
			'idPublisher',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addIdPublisherToObjectStorageHoldingIdPublisher()
	{
		$idPublisher = new \Sozialinfo\SiNews\Domain\Model\Publisher();
		$idPublisherObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$idPublisherObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($idPublisher));
		$this->inject($this->subject, 'idPublisher', $idPublisherObjectStorageMock);

		$this->subject->addIdPublisher($idPublisher);
	}

	/**
	 * @test
	 */
	public function removeIdPublisherFromObjectStorageHoldingIdPublisher()
	{
		$idPublisher = new \Sozialinfo\SiNews\Domain\Model\Publisher();
		$idPublisherObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$idPublisherObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($idPublisher));
		$this->inject($this->subject, 'idPublisher', $idPublisherObjectStorageMock);

		$this->subject->removeIdPublisher($idPublisher);

	}

	/**
	 * @test
	 */
	public function getIdCantonReturnsInitialValueForCanton()
	{
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getIdCanton()
		);
	}

	/**
	 * @test
	 */
	public function setIdCantonForObjectStorageContainingCantonSetsIdCanton()
	{
		$idCanton = new \Sozialinfo\SiNews\Domain\Model\Canton();
		$objectStorageHoldingExactlyOneIdCanton = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneIdCanton->attach($idCanton);
		$this->subject->setIdCanton($objectStorageHoldingExactlyOneIdCanton);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneIdCanton,
			'idCanton',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addIdCantonToObjectStorageHoldingIdCanton()
	{
		$idCanton = new \Sozialinfo\SiNews\Domain\Model\Canton();
		$idCantonObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$idCantonObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($idCanton));
		$this->inject($this->subject, 'idCanton', $idCantonObjectStorageMock);

		$this->subject->addIdCanton($idCanton);
	}

	/**
	 * @test
	 */
	public function removeIdCantonFromObjectStorageHoldingIdCanton()
	{
		$idCanton = new \Sozialinfo\SiNews\Domain\Model\Canton();
		$idCantonObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$idCantonObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($idCanton));
		$this->inject($this->subject, 'idCanton', $idCantonObjectStorageMock);

		$this->subject->removeIdCanton($idCanton);

	}

	/**
	 * @test
	 */
	public function getIdAdresseReturnsInitialValueForAdresse()
	{
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getIdAdresse()
		);
	}

	/**
	 * @test
	 */
	public function setIdAdresseForObjectStorageContainingAdresseSetsIdAdresse()
	{
		$idAdresse = new \Sozialinfo\SiNews\Domain\Model\Adresse();
		$objectStorageHoldingExactlyOneIdAdresse = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneIdAdresse->attach($idAdresse);
		$this->subject->setIdAdresse($objectStorageHoldingExactlyOneIdAdresse);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneIdAdresse,
			'idAdresse',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addIdAdresseToObjectStorageHoldingIdAdresse()
	{
		$idAdresse = new \Sozialinfo\SiNews\Domain\Model\Adresse();
		$idAdresseObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$idAdresseObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($idAdresse));
		$this->inject($this->subject, 'idAdresse', $idAdresseObjectStorageMock);

		$this->subject->addIdAdresse($idAdresse);
	}

	/**
	 * @test
	 */
	public function removeIdAdresseFromObjectStorageHoldingIdAdresse()
	{
		$idAdresse = new \Sozialinfo\SiNews\Domain\Model\Adresse();
		$idAdresseObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$idAdresseObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($idAdresse));
		$this->inject($this->subject, 'idAdresse', $idAdresseObjectStorageMock);

		$this->subject->removeIdAdresse($idAdresse);

	}

	/**
	 * @test
	 */
	public function getIdInformationstypeReturnsInitialValueForInformationstype()
	{
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getIdInformationstype()
		);
	}

	/**
	 * @test
	 */
	public function setIdInformationstypeForObjectStorageContainingInformationstypeSetsIdInformationstype()
	{
		$idInformationstype = new \Sozialinfo\SiNews\Domain\Model\Informationstype();
		$objectStorageHoldingExactlyOneIdInformationstype = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneIdInformationstype->attach($idInformationstype);
		$this->subject->setIdInformationstype($objectStorageHoldingExactlyOneIdInformationstype);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneIdInformationstype,
			'idInformationstype',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addIdInformationstypeToObjectStorageHoldingIdInformationstype()
	{
		$idInformationstype = new \Sozialinfo\SiNews\Domain\Model\Informationstype();
		$idInformationstypeObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$idInformationstypeObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($idInformationstype));
		$this->inject($this->subject, 'idInformationstype', $idInformationstypeObjectStorageMock);

		$this->subject->addIdInformationstype($idInformationstype);
	}

	/**
	 * @test
	 */
	public function removeIdInformationstypeFromObjectStorageHoldingIdInformationstype()
	{
		$idInformationstype = new \Sozialinfo\SiNews\Domain\Model\Informationstype();
		$idInformationstypeObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$idInformationstypeObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($idInformationstype));
		$this->inject($this->subject, 'idInformationstype', $idInformationstypeObjectStorageMock);

		$this->subject->removeIdInformationstype($idInformationstype);

	}

	/**
	 * @test
	 */
	public function getIdCategoryReturnsInitialValueForCategory()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getIdCategory()
		);
	}

	/**
	 * @test
	 */
	public function setIdCategoryForCategorySetsIdCategory()
	{
		$idCategoryFixture = new \Sozialinfo\SiNews\Domain\Model\Category();
		$this->subject->setIdCategory($idCategoryFixture);

		$this->assertAttributeEquals(
			$idCategoryFixture,
			'idCategory',
			$this->subject
		);
	}
}
