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
 * Informationstype
 */
class Informationstype extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * informationstype
     * 
     * @var string
     */
    protected $informationstype = '';
    
    /**
     * definition
     * 
     * @var string
     */
    protected $definition = '';
    
    /**
     * validity
     * 
     * @var int
     * @validate NotEmpty
     */
    protected $validity = 0;
    
    /**
     * media
     * 
     * @var int
     * @validate NotEmpty
     */
    //protected $media = 0;
    
    /**
     * Returns the informationstype
     * 
     * @return string $informationstype
     */
    public function getInformationstype()
    {
        return $this->informationstype;
    }
    
    /**
     * Sets the informationstype
     * 
     * @param string $informationstype
     * @return void
     */
    public function setInformationstype($informationstype)
    {
        $this->informationstype = $informationstype;
    }
    
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
     * Returns the validity
     * 
     * @return int $validity
     */
    public function getValidity()
    {
        return $this->validity;
    }
    
    /**
     * Sets the validity
     * 
     * @param int $validity
     * @return void
     */
    public function setValidity($validity)
    {
        $this->validity = $validity;
    }
    
    /**
     * Returns the media
     * 
     * @return int $media
     */
    /*public function getMedia()
    {
        return $this->media;
    }*/
    
    /**
     * Sets the media
     * 
     * @param int $media
     * @return void
     */
    /*public function setMedia($media)
    {
        $this->media = $media;
    }*/

}