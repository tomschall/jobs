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
 * Media
 */
class Media extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * medium
     * 
     * @var string
     * @validate NotEmpty
     */
    protected $medium = '';
    
    /**
     * idInformationstype
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\SiNews\Domain\Model\Informationstype>
     */
    protected $idInformationstype = null;
    
    /**
     * Returns the medium
     * 
     * @return string $medium
     */
    public function getMedium()
    {
        return $this->medium;
    }
    
    /**
     * Sets the medium
     * 
     * @param string $medium
     * @return void
     */
    public function setMedium($medium)
    {
        $this->medium = $medium;
    }
    
    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }
    
    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     * 
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->idInformationstype = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }
    
    /**
     * Adds a Informationstype
     * 
     * @param \Sozialinfo\SiNews\Domain\Model\Informationstype $idInformationstype
     * @return void
     */
    public function addIdInformationstype(\Sozialinfo\SiNews\Domain\Model\Informationstype $idInformationstype)
    {
        $this->idInformationstype->attach($idInformationstype);
    }
    
    /**
     * Removes a Informationstype
     * 
     * @param \Sozialinfo\SiNews\Domain\Model\Informationstype $idInformationstypeToRemove The Informationstype to be removed
     * @return void
     */
    public function removeIdInformationstype(\Sozialinfo\SiNews\Domain\Model\Informationstype $idInformationstypeToRemove)
    {
        $this->idInformationstype->detach($idInformationstypeToRemove);
    }
    
    /**
     * Returns the idInformationstype
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\SiNews\Domain\Model\Informationstype> $idInformationstype
     */
    public function getIdInformationstype()
    {
        return $this->idInformationstype;
    }
    
    /**
     * Sets the idInformationstype
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\SiNews\Domain\Model\Informationstype> $idInformationstype
     * @return void
     */
    public function setIdInformationstype(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $idInformationstype)
    {
        $this->idInformationstype = $idInformationstype;
    }

}