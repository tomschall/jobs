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
 * Test case for class \Sozialinfo\Jobs\Domain\Model\AdvertisementType.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Thomas Schallert <programmierung@sozialinfo.ch>
 */
class AdvertisementTypeTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Sozialinfo\Jobs\Domain\Model\AdvertisementType
	 */
	protected $subject = NULL;

	public function setUp() {
		$this->subject = new \Sozialinfo\Jobs\Domain\Model\AdvertisementType();
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTitle()
		);
	}

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle() {
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
	public function getDescriptionReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setDescriptionForIntSetsDescription() {	}

	/**
	 * @test
	 */
	public function getShortCutAdvertisementTypeReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getShortCutAdvertisementType()
		);
	}

	/**
	 * @test
	 */
	public function setShortCutAdvertisementTypeForStringSetsShortCutAdvertisementType() {
		$this->subject->setShortCutAdvertisementType('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'shortCutAdvertisementType',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPriceMemberReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setPriceMemberForIntSetsPriceMember() {	}

	/**
	 * @test
	 */
	public function getPriceNonMemberReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setPriceNonMemberForIntSetsPriceNonMember() {	}

	/**
	 * @test
	 */
	public function getPriceInsosMemberReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setPriceInsosMemberForIntSetsPriceInsosMember() {	}

	/**
	 * @test
	 */
	public function getDayToRenewReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setDayToRenewForIntSetsDayToRenew() {	}
}
