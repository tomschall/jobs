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
 * Periodicals
 */
class Periodicals extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * name
     * 
     * @var string
     */
    protected $name = '';
    
    /**
     * short
     * 
     * @var string
     * @validate NotEmpty
     */
    protected $short = '';
    
    /**
     * www
     * 
     * @var string
     * @validate NotEmpty
     */
    protected $www = '';
    
    /**
     * idAdresse
     * 
     * @var \Sozialinfo\SiNews\Domain\Model\Adresse
     */
    protected $idAdresse = null;
    
    /**
     * Returns the name
     * 
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Sets the name
     * 
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
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
    
    /**
     * Returns the www
     * 
     * @return string $www
     */
    public function getWww()
    {
        return $this->www;
    }
    
    /**
     * Sets the www
     * 
     * @param string $www
     * @return void
     */
    public function setWww($www)
    {
        $this->www = $www;
    }
    
    /**
     * Returns the idAdresse
     * 
     * @return \Sozialinfo\SiNews\Domain\Model\Adresse idAdresse
     */
    public function getIdAdresse()
    {
        return $this->idAdresse;
    }
    
    /**
     * Sets the idAdresse
     * 
     * @param string $idAdresse
     * @return void
     */
    public function setIdAdresse($idAdresse)
    {
        $this->idAdresse = $idAdresse;
    }

}