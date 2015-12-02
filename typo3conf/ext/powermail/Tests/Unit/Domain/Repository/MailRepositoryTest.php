<?php
namespace In2code\Powermail\Tests\Domain\Model;

use In2code\Powermail\Domain\Model\Answer;
use In2code\Powermail\Domain\Model\Field;
use In2code\Powermail\Domain\Model\Mail;
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
 * MailRepository Tests
 *
 * @package powermail
 * @license http://www.gnu.org/licenses/lgpl.html
 * 			GNU Lesser General Public License, version 3 or later
 */
class MailRepositoryTest extends UnitTestCase {

	/**
	 * @var \In2code\Powermail\Domain\Repository\MailRepository
	 */
	protected $generalValidatorMock;

	/**
	 * @return void
	 */
	public function setUp() {
		$objectManager = $this->getMock('TYPO3\\CMS\\Extbase\\Object\\ObjectManagerInterface');
		$this->generalValidatorMock = $this->getAccessibleMock(
			'\In2code\Powermail\Domain\Repository\MailRepository',
			array('dummy'),
			array($objectManager)
		);
	}

	/**
	 * Dataprovider getLabelsWithMarkersFromMailReturnsArray()
	 *
	 * @return array
	 */
	public function getLabelsWithMarkersFromMailReturnsArrayDataProvider() {
		return array(
			array(
				array(
					array(
						'marker',
						'title'
					),
				),
				array(
					'label_marker' => 'title'
				),
			),
			array(
				array(
					array(
						'firstname',
						'Firstname'
					),
					array(
						'lastname',
						'Lastname'
					),
					array(
						'email',
						'Email Address'
					),
				),
				array(
					'label_firstname' => 'Firstname',
					'label_lastname' => 'Lastname',
					'label_email' => 'Email Address'
				),
			),
		);
	}

	/**
	 * Test for getLabelsWithMarkersFromMail()
	 *
	 * @param array $values
	 * @param string $expectedResult
	 * @return void
	 * @dataProvider getLabelsWithMarkersFromMailReturnsArrayDataProvider
	 * @test
	 */
	public function getLabelsWithMarkersFromMailReturnsArray($values, $expectedResult) {
		$mail = new Mail();
		if (is_array($values)) {
			foreach ($values as $markerTitleMix) {
				$answer = new Answer();
				$field = new Field();
				$field->setMarker($markerTitleMix[0]);
				$field->setTitle($markerTitleMix[1]);
				$answer->setField($field);
				$mail->addAnswer($answer);
			}
		}

		$result = $this->generalValidatorMock->_callRef('getLabelsWithMarkersFromMail', $mail);
		$this->assertSame($expectedResult, $result);
	}

	/**
	 * Dataprovider getVariablesWithMarkersFromMailReturnsArray()
	 *
	 * @return array
	 */
	public function getVariablesWithMarkersFromMailReturnsArrayDataProvider() {
		return array(
			array(
				array(
					array(
						'marker',
						'value'
					),
				),
				array(
					'marker' => 'value'
				),
			),
			array(
				array(
					array(
						'firstname',
						'Alex'
					),
					array(
						'lastname',
						'Kellner'
					),
					array(
						'email',
						'alex@in2code.de'
					),
				),
				array(
					'firstname' => 'Alex',
					'lastname' => 'Kellner',
					'email' => 'alex@in2code.de'
				),
			),
			array(
				array(
					array(
						'checkbox',
						array(
							'red',
							'blue'
						)
					),
					array(
						'firstname',
						'Alex'
					),
				),
				array(
					'checkbox' => 'red, blue',
					'firstname' => 'Alex'
				),
			),
		);
	}

	/**
	 * Test for getVariablesWithMarkersFromMail()
	 *
	 * @param array $values
	 * @param string $expectedResult
	 * @return void
	 * @dataProvider getVariablesWithMarkersFromMailReturnsArrayDataProvider
	 * @test
	 */
	public function getVariablesWithMarkersFromMailReturnsArray($values, $expectedResult) {
		$mail = new Mail;
		if (is_array($values)) {
			foreach ($values as $markerValueMix) {
				$answer = new Answer;
				$field = new Field;
				$field->setMarker($markerValueMix[0]);
				$answer->setValue($markerValueMix[1]);
				$answer->setField($field);
				$answer->setValueType((is_array($markerValueMix[1]) ? 1 : 0));
				$mail->addAnswer($answer);
			}
		}

		$result = $this->generalValidatorMock->_callRef('getVariablesWithMarkersFromMail', $mail);
		$this->assertSame($expectedResult, $result);
	}

	/**
	 * Dataprovider getSenderMailFromArgumentsReturnsString()
	 *
	 * @return array
	 */
	public function getSenderMailFromArgumentsReturnsStringDataProvider() {
		return array(
			array(
				array(
					'no email',
					'abc@def.gh'
				),
				NULL,
				NULL,
				'abc@def.gh'
			),
			array(
				array(
					'alexander.kellner@in2code.de',
					'abc@def.gh'
				),
				NULL,
				NULL,
				'alexander.kellner@in2code.de'
			),
			array(
				array(
					'no email'
				),
				'test1@email.org',
				'test2@email.org',
				'test1@email.org'
			),
			array(
				array(
					'no email'
				),
				'test1@email.org',
				NULL,
				'test1@email.org'
			),
			array(
				array(
					'no email'
				),
				NULL,
				'test2@email.org',
				'test2@email.org'
			),
			array(
				array(
					'abc',
					'def',
					'ghi'
				),
				'test1@email.org',
				'test2@email.org',
				'test1@email.org'
			)
		);
	}

	/**
	 * Test for getSenderMailFromArguments()
	 *
	 * @param array $values
	 * @param string $fallback
	 * @param string $defaultMailFromAddress
	 * @param string $expectedResult
	 * @return void
	 * @dataProvider getSenderMailFromArgumentsReturnsStringDataProvider
	 * @test
	 */
	public function getSenderMailFromArgumentsReturnsString($values, $fallback, $defaultMailFromAddress, $expectedResult) {
		$GLOBALS['TYPO3_CONF_VARS']['MAIL']['defaultMailFromAddress'] = $defaultMailFromAddress;
		$mail = new Mail;
		if (is_array($values)) {
			foreach ($values as $value) {
				$answer = new Answer;
				$answer->_setProperty('valueType', (is_array($values) ? 2 : 0));
				$answer->_setProperty('value', $value);
				$field = new Field;
				$field->setType('input');
				$field->setSenderEmail(TRUE);
				$answer->setField($field);
				$mail->addAnswer($answer);
			}
		}

		$result = $this->generalValidatorMock->_callRef('getSenderMailFromArguments', $mail, $fallback);
		$this->assertSame($expectedResult, $result);
	}

	/**
	 * Dataprovider getSenderNameFromArgumentsReturnsString()
	 *
	 * @return array
	 */
	public function getSenderNameFromArgumentsReturnsStringDataProvider() {
		return array(
			array(
				array(
					'Alex',
					'Kellner'
				),
				NULL,
				NULL,
				'Alex Kellner'
			),
			array(
				array(
					'Prof. Dr.',
					'Müller'
				),
				'abc',
				'def',
				'Prof. Dr. Müller'
			),
			array(
				NULL,
				NULL,
				'Fallback Name',
				'Fallback Name'
			),
			array(
				NULL,
				'Fallback Name',
				NULL,
				'Fallback Name'
			),
			array(
				array(
					// test multivalue (e.g. checkbox)
					array(
						'Prof.',
						'Dr.'
					),
					'Max',
					'Muster'
				),
				'xyz',
				'abc',
				'Prof. Dr. Max Muster'
			),
		);
	}

	/**
	 * Test for getSenderNameFromArguments()
	 *
	 * @param array $values
	 * @param string $fallback
	 * @param string $defaultMailFromAddress
	 * @param string $expectedResult
	 * @return void
	 * @dataProvider getSenderNameFromArgumentsReturnsStringDataProvider
	 * @test
	 */
	public function getSenderNameFromArgumentsReturnsString($values, $fallback, $defaultMailFromAddress, $expectedResult) {
		$GLOBALS['TYPO3_CONF_VARS']['MAIL']['defaultMailFromName'] = $defaultMailFromAddress;
		$mail = new Mail;
		if (is_array($values)) {
			foreach ($values as $value) {
				$answer = new Answer;
				$answer->_setProperty('translateFormat', 'Y-m-d');
				$answer->_setProperty('valueType', (is_array($values) ? 2 : 0));
				$field = new Field;
				$field->setType('input');
				$field->setSenderName(TRUE);
				$answer->_setProperty('value', $value);
				$answer->setValueType((is_array($value) ? 1 : 0));
				$answer->setField($field);
				$mail->addAnswer($answer);
			}
		}

		$result = $this->generalValidatorMock->_callRef('getSenderNameFromArguments', $mail, $fallback);
		$this->assertSame($expectedResult, $result);
	}
}