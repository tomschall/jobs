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
 * Test case for class \Sozialinfo\Jobs\Domain\Model\Position.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Thomas Schallert <programmierung@sozialinfo.ch>
 */
class PositionTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Sozialinfo\Jobs\Domain\Model\Position
	 */
	protected $subject = NULL;

	public function setUp() {
		$this->subject = new \Sozialinfo\Jobs\Domain\Model\Position();
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
	public function getDescriptionReturnsInitialValueForBool() {
		$this->assertSame(
			FALSE,
			$this->subject->getDescription()
		);
	}

	/**
	 * @test
	 */
	public function setDescriptionForBoolSetsDescription() {
		$this->subject->setDescription(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'description',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getIsSetJobRequestReturnsInitialValueForBool() {
		$this->assertSame(
			FALSE,
			$this->subject->getIsSetJobRequest()
		);
	}

	/**
	 * @test
	 */
	public function setIsSetJobRequestForBoolSetsIsSetJobRequest() {
		$this->subject->setIsSetJobRequest(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'isSetJobRequest',
			$this->subject
		);
	}
}
