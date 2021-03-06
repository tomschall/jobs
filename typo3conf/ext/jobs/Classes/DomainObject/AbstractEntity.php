<?php
namespace Sozialinfo\Jobs\DomainObject;

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
 * Extended Abstract Entity Class
 */
abstract class AbstractEntity extends \TYPO3\CMS\Extbase\Domain\Model\FrontendUser {
	/**
	 * Reconstitute multiple properties.
	 *
	 * @param array $properties
	 * @return void
	 */
	public function _setProperties($properties) {
		foreach ($properties as $propertyName => $propertyValue) {
			$this->_setProperty($propertyName, $propertyValue);
		}
	}
	/**
	 * Return object properties, excluding given ones.
	 *
	 * @param array $exclude Properties which shoult not be exposed
	 * @return array
	 */
	public function _getPublicProperties($exclude = array()) {
		$properties = $this->_getProperties();
		foreach($exclude as $property) {
			unset($properties[$property]);
		}
		return $properties;
	}
}