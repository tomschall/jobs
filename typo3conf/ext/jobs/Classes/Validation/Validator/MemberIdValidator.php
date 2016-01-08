<?php
namespace Sozialinfo\Jobs\Validation\Validator;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Thomas Schallert <programmierung@sozialinfo.ch>, Sozialinfo
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
 * Member Id Validator
 */

class MemberIdValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator {
	public function isValid($property) {
		$max = $this->options['max'];
		if (str_word_count($property, 0) <= $max) {
			return TRUE;
		}else{
			$this->addError('Verringern Sie die Anzahl der Worte - es sind maximal '.$max.' erlaubt!', 1383400016);
			return FALSE;
		}
	}
}

?>