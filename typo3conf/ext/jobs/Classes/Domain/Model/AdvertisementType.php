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
 * AdvertisementType
 */
class AdvertisementType extends \TYPO3\CMS\Extbase\DomainObject\AbstractValueObject {

	/**
	 * title
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title = '';

	/**
	 * description
	 *
	 * @var int
	 */
	protected $description = 0;

	/**
	 * shortCutAdvertisementType
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $shortCutAdvertisementType = '';

	/**
	 * priceMember
	 *
	 * @var int
	 * @validate NotEmpty
	 */
	protected $priceMember = 0;

	/**
	 * priceNonMember
	 *
	 * @var int
	 * @validate NotEmpty
	 */
	protected $priceNonMember = 0;

	/**
	 * priceInsosMember
	 *
	 * @var int
	 */
	protected $priceInsosMember = 0;

	/**
	 * dayToRenew
	 *
	 * @var int
	 */
	protected $dayToRenew = 0;

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
	 * Returns the description
	 *
	 * @return int $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param int $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Returns the shortCutAdvertisementType
	 *
	 * @return string $shortCutAdvertisementType
	 */
	public function getShortCutAdvertisementType() {
		return $this->shortCutAdvertisementType;
	}

	/**
	 * Sets the shortCutAdvertisementType
	 *
	 * @param string $shortCutAdvertisementType
	 * @return void
	 */
	public function setShortCutAdvertisementType($shortCutAdvertisementType) {
		$this->shortCutAdvertisementType = $shortCutAdvertisementType;
	}

	/**
	 * Returns the priceMember
	 *
	 * @return int $priceMember
	 */
	public function getPriceMember() {
		return $this->priceMember;
	}

	/**
	 * Sets the priceMember
	 *
	 * @param int $priceMember
	 * @return void
	 */
	public function setPriceMember($priceMember) {
		$this->priceMember = $priceMember;
	}

	/**
	 * Returns the priceNonMember
	 *
	 * @return int $priceNonMember
	 */
	public function getPriceNonMember() {
		return $this->priceNonMember;
	}

	/**
	 * Sets the priceNonMember
	 *
	 * @param int $priceNonMember
	 * @return void
	 */
	public function setPriceNonMember($priceNonMember) {
		$this->priceNonMember = $priceNonMember;
	}

	/**
	 * Returns the priceInsosMember
	 *
	 * @return int $priceInsosMember
	 */
	public function getPriceInsosMember() {
		return $this->priceInsosMember;
	}

	/**
	 * Sets the priceInsosMember
	 *
	 * @param int $priceInsosMember
	 * @return void
	 */
	public function setPriceInsosMember($priceInsosMember) {
		$this->priceInsosMember = $priceInsosMember;
	}

	/**
	 * Returns the dayToRenew
	 *
	 * @return int $dayToRenew
	 */
	public function getDayToRenew() {
		return $this->dayToRenew;
	}

	/**
	 * Sets the dayToRenew
	 *
	 * @param int $dayToRenew
	 * @return void
	 */
	public function setDayToRenew($dayToRenew) {
		$this->dayToRenew = $dayToRenew;
	}

}