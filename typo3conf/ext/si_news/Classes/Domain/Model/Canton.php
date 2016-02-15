<?php
namespace Sozialinfo\SiNews\Domain\Model;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Pera <pera91@mykolab.ch>, Sozialinfo
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
 * Cantone
 */
class Canton extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * definition
     * 
     * @var string
     * @validate NotEmpty
     */
    protected $definition = '';
    
    /**
     * short
     * 
     * @var string
     * @validate NotEmpty
     */
    protected $short = '';
    
    /**
     * Returns the definition
     * 
     * @return string $definition
     */
    public function getDefinition()
    {
        return $this->definition;
    }
    
    /**
     * Sets the definition
     * 
     * @param string $definition
     * @return void
     */
    public function setDefinition($definition)
    {
        $this->definition = $definition;
    }
    
    /**
     * Returns the short
     * 
     * @return string $short
     */
    public function getShort()
    {
        return $this->short;
    }
    
    /**
     * Sets the short
     * 
     * @param string $short
     * @return void
     */
    public function setShort($short)
    {
        $this->short = $short;
    }

}