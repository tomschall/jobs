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
 * Qualification
 */
class Qualification extends \TYPO3\CMS\Extbase\DomainObject\AbstractValueObject {

	/**
	 * title
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title = '';

	/**
	 * shortcut
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $shortcut = '';

	/**
	 * description
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $description = '';

	/**
	 * isSetJobRequest
	 *
	 * @var bool
	 */
	protected $isSetJobRequest = FALSE;

	/**
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the shortcut
	 *
	 * @return string $shortcut
	 */
	public function getShortcut() {
		return $this->shortcut;
	}

	/**
	 * Sets the shortcut
	 *
	 * @param string $shortcut
	 * @return void
	 */
	public function setShortcut($shortcut) {
		$this->shortcut = $shortcut;
	}

	/**
	 * Returns the description
	 *
	 * @return string $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Returns the isSetJobRequest
	 *
	 * @return bool $isSetJobRequest
	 */
	public function getIsSetJobRequest() {
		return $this->isSetJobRequest;
	}

	/**
	 * Sets the isSetJobRequest
	 *
	 * @param bool $isSetJobRequest
	 * @return void
	 */
	public function setIsSetJobRequest($isSetJobRequest) {
		$this->isSetJobRequest = $isSetJobRequest;
	}

	/**
	 * Returns the boolean state of isSetJobRequest
	 *
	 * @return bool
	 */
	public function isIsSetJobRequest() {
		return $this->isSetJobRequest;
	}

}