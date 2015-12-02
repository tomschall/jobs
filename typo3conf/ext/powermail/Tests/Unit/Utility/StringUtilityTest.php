<?php
namespace In2code\Powermail\Tests\Utility;

use In2code\Powermail\Utility\StringUtility;
use TYPO3\CMS\Core\Tests\UnitTestCase;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Alex Kellner <alexander.kellner@in2code.de>, in2code.de
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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
 * StringUtility Tests
 *
 * @package powermail
 * @license http://www.gnu.org/licenses/lgpl.html
 * 			GNU Lesser General Public License, version 3 or later
 */
class StringUtilityTest extends UnitTestCase {

	/**
	 * Dataprovider isNotEmptyReturnsBool()
	 *
	 * @return array
	 */
	public function isNotEmptyReturnsBoolDataProvider() {
		return array(
			'string "in2code.de"' => array(
				'in2code.de',
				TRUE
			),
			'string "a"' => array(
				'a',
				TRUE
			),
			'string empty' => array(
				'',
				FALSE
			),
			'string "0"' => array(
				'0',
				TRUE
			),
			'int 0' => array(
				0,
				TRUE
			),
			'int 1' => array(
				1,
				TRUE
			),
			'float 0.0' => array(
				0.0,
				TRUE
			),
			'float 1.0' => array(
				1.0,
				TRUE
			),
			'null' => array(
				NULL,
				FALSE
			),
			'bool false' => array(
				FALSE,
				FALSE
			),
			'bool true' => array(
				TRUE,
				FALSE
			),
			'array: string empty' => array(
				array(''),
				FALSE
			),
			'array: int 0' => array(
				array(0),
				TRUE
			),
			'array: int 1' => array(
				array(1),
				TRUE
			),
			'array: "abc" => "def"' => array(
				array('abc' => 'def'),
				TRUE
			),
			'array: empty' => array(
				array(),
				FALSE
			),
		);
	}

	/**
	 * Test for isNotEmpty()
	 *
	 * @param string $value
	 * @param array $expectedResult
	 * @return void
	 * @dataProvider isNotEmptyReturnsBoolDataProvider
	 * @test
	 */
	public function isNotEmptyReturnsBool($value, $expectedResult) {
		$this->assertSame(
			$expectedResult,
			StringUtility::isNotEmpty($value)
		);
	}

	/**
	 * Data Provider for getRandomStringAlwaysReturnsStringsOfGivenLength
	 *
	 * @return array
	 */
	public function getRandomStringAlwaysReturnsStringsOfGivenLengthDataProvider() {
		return array(
			'default params' => array(
				32,
				TRUE,
			),
			'default length lowercase' => array(
				32,
				FALSE,
			),
			'60 length' => array(
				60,
				TRUE,
			),
			'60 length lowercase' => array(
				60,
				FALSE,
			),
		);
	}

	/**
	 * getRandomStringAlwaysReturnsStringsOfGivenLength Test
	 *
	 * @param int $length
	 * @param bool $uppercase
	 * @dataProvider getRandomStringAlwaysReturnsStringsOfGivenLengthDataProvider
	 * @return void
	 * @test
	 */
	public function getRandomStringAlwaysReturnsStringsOfGivenLength($length, $uppercase) {
		for ($i = 0; $i < 100; $i++) {
			$string = StringUtility::getRandomString($length, $uppercase);

			$regex = '~[a-z0-9]{' . $length . '}~';
			if ($uppercase) {
				$regex = '~[a-zA-Z0-9]{' . $length . '}~';
			}

			$this->assertSame(1, preg_match($regex, $string));
		}
	}

	/**
	 * Data Provider for conditionalVariableReturnsMixed()
	 *
	 * @return array
	 */
	public function conditionalVariableReturnsMixedDataProvider() {
		return array(
			array(
				'string',
				'fallbackstring',
				'string'
			),
			array(
				array('abc'),
				array('def'),
				array('abc')
			),
			array(
				'',
				'fallback',
				'fallback'
			),
			array(
				NULL,
				TRUE,
				TRUE
			),
			array(
				123,
				234,
				123
			)
		);
	}

	/**
	 * conditionalVariable Test
	 *
	 * @param mixed $variable
	 * @param mixed $fallback
	 * @param mixed $expectedResult
	 * @dataProvider conditionalVariableReturnsMixedDataProvider
	 * @return void
	 * @test
	 */
	public function conditionalVariableReturnsMixed($variable, $fallback, $expectedResult) {
		$this->assertSame(
			$expectedResult,
			StringUtility::conditionalVariable($variable, $fallback)
		);
	}
}