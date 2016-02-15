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
 * Test case for class \Sozialinfo\SiNews\Domain\Model\Media.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Pera <pera91@mykolab.ch>
 */
class MediaTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \Sozialinfo\SiNews\Domain\Model\Media
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \Sozialinfo\SiNews\Domain\Model\Media();
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getMediumReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getMedium()
		);
	}

	/**
	 * @test
	 */
	public function setMediumForStringSetsMedium()
	{
		$this->subject->setMedium('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'medium',
			$this->subject
		);
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
}
