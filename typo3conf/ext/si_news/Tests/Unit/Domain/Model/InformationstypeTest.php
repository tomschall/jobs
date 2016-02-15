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
 * Test case for class \Sozialinfo\SiNews\Domain\Model\Informationstype.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Pera <pera91@mykolab.ch>
 */
class InformationstypeTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \Sozialinfo\SiNews\Domain\Model\Informationstype
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \Sozialinfo\SiNews\Domain\Model\Informationstype();
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getInformationstypeReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getInformationstype()
		);
	}

	/**
	 * @test
	 */
	public function setInformationstypeForStringSetsInformationstype()
	{
		$this->subject->setInformationstype('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'informationstype',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDefinitionReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getDefinition()
		);
	}

	/**
	 * @test
	 */
	public function setDefinitionForStringSetsDefinition()
	{
		$this->subject->setDefinition('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'definition',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getValidityReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setValidityForIntSetsValidity()
	{	}

	/**
	 * @test
	 */
	public function getMediaReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setMediaForIntSetsMedia()
	{	}
}
