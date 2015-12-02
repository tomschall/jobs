<?php
namespace Sozialinfo\Jobs\Domain\Model;

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
 * SozialinfoMember
 */
class SozialinfoMember extends \TYPO3\CMS\Extbase\DomainObject\AbstractValueObject {

	/**
	 * memberId
	 *
	 * @var string
	 */
	protected $memberId = '';

	/**
	 * Returns the memberId
	 *
	 * @return string $memberId
	 */
	public function getMemberId() {
		return $this->memberId;
	}

	/**
	 * Sets the memberId
	 *
	 * @param string $memberId
	 * @return void
	 */
	public function setMemberId($memberId) {
		$this->memberId = $memberId;
	}

}