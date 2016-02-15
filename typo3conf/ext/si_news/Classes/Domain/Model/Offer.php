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
 * AWDBOffer
 */
class Offer extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * fegroup
     * 
     * @var int
     * @validate NotEmpty
     */
    protected $fegroup = 0;
    
    /**
     * offerType
     * 
     * @var int
     * @validate NotEmpty
     */
    protected $offerType = 0;
    
    /**
     * number
     * 
     * @var int
     * @validate NotEmpty
     */
    protected $number = 0;
    
    /**
     * date
     * 
     * @var int
     * @validate NotEmpty
     */
    protected $date = 0;
    
    /**
     * location
     * 
     * @var string
     * @validate NotEmpty
     */
    protected $location = '';
    
    /**
     * title
     * 
     * @var string
     * @validate NotEmpty
     */
    protected $title = '';
    
    /**
     * content
     * 
     * @var string
     */
    protected $content = '';
    
    /**
     * infos
     * 
     * @var string
     */
    protected $infos = '';
    
    /**
     * www
     * 
     * @var string
     */
    protected $www = '';
    
    /**
     * delDate
     * 
     * @var int
     */
    protected $delDate = 0;
    
    /**
     * idCategory
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\SiNews\Domain\Model\Category>
     * @lazy
     */
    protected $idCategory = null;
    
    /**
     * idUser
     * 
     * @var \Sozialinfo\SiNews\Domain\Model\FeUser
     */
    protected $idUser = null;
    
    /**
     * idDegree
     * 
     * @var \Sozialinfo\SiNews\Domain\Model\Degree
     */
    protected $idDegree = null;
    
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
        $this->idCategory = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }
    
    /**
     * Returns the fegroup
     * 
     * @return int $fegroup
     */
    public function getFegroup()
    {
        return $this->fegroup;
    }
    
    /**
     * Sets the fegroup
     * 
     * @param int $fegroup
     * @return void
     */
    public function setFegroup($fegroup)
    {
        $this->fegroup = $fegroup;
    }
    
    /**
     * Returns the offerType
     * 
     * @return int $offerType
     */
    public function getOfferType()
    {
        return $this->offerType;
    }
    
    /**
     * Sets the offerType
     * 
     * @param int $offerType
     * @return void
     */
    public function setOfferType($offerType)
    {
        $this->offerType = $offerType;
    }
    
    /**
     * Returns the number
     * 
     * @return int $number
     */
    public function getNumber()
    {
        return $this->number;
    }
    
    /**
     * Sets the number
     * 
     * @param int $number
     * @return void
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }
    
    /**
     * Returns the date
     * 
     * @return int $date
     */
    public function getDate()
    {
        return $this->date;
    }
    
    /**
     * Sets the date
     * 
     * @param int $date
     * @return void
     */
    public function setDate($date)
    {
        $this->date = $date;
    }
    
    /**
     * Returns the location
     * 
     * @return string $location
     */
    public function getLocation()
    {
        return $this->location;
    }
    
    /**
     * Sets the location
     * 
     * @param string $location
     * @return void
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }
    
    /**
     * Returns the title
     * 
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * Sets the title
     * 
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
    
    /**
     * Returns the content
     * 
     * @return string $content
     */
    public function getContent()
    {
        return $this->content;
    }
    
    /**
     * Sets the content
     * 
     * @param string $content
     * @return void
     */
    public function setContent($content)
    {
        $this->content = $content;
    }
    
    /**
     * Returns the infos
     * 
     * @return string $infos
     */
    public function getInfos()
    {
        return $this->infos;
    }
    
    /**
     * Sets the infos
     * 
     * @param string $infos
     * @return void
     */
    public function setInfos($infos)
    {
        $this->infos = $infos;
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
     * Returns the idDegree
     * 
     * @return \Sozialinfo\SiNews\Domain\Model\Degree $idDegree
     */
    public function getIdDegree()
    {
        return $this->idDegree;
    }
    
    /**
     * Sets the idDegree
     * 
     * @param \Sozialinfo\SiNews\Domain\Model\Degree $idDegree
     * @return void
     */
    public function setIdDegree(\Sozialinfo\SiNews\Domain\Model\Degree $idDegree)
    {
        $this->idDegree = $idDegree;
    }
    
    /**
     * Adds a
     * 
     * @param \Sozialinfo\SiNews\Domain\Model\Category $idCategory
     * @return void
     */
    public function addIdCategory($idCategory)
    {
        $this->idCategory->attach($idCategory);
    }
    
    /**
     * Removes a
     * 
     * @param \Sozialinfo\SiNews\Domain\Model\Category $idCategoryToRemove The Category to be removed
     * @return void
     */
    public function removeIdCategory($idCategoryToRemove)
    {
        $this->idCategory->detach($idCategoryToRemove);
    }
    
    /**
     * Returns the idCategory
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\SiNews\Domain\Model\Category> idCategory
     */
    public function getIdCategory()
    {
        return $this->idCategory;
    }
    
    /**
     * Sets the idCategory
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\SiNews\Domain\Model\Category> $idCategory
     * @return void
     */
    public function setIdCategory(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $idCategory)
    {
        $this->idCategory = $idCategory;
    }
    
    /**
     * Returns the idUser
     * 
     * @return \Sozialinfo\SiNews\Domain\Model\FeUser idUser
     */
    public function getIdUser()
    {
        return $this->idUser;
    }
    
    /**
     * Sets the idUser
     * 
     * @param string $idUser
     * @return void
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }
    
    /**
     * Returns the delDate
     * 
     * @return int $delDate
     */
    public function getDelDate()
    {
        return $this->delDate;
    }
    
    /**
     * Sets the delDate
     * 
     * @param int $delDate
     * @return void
     */
    public function setDelDate($delDate)
    {
        $this->delDate = $delDate;
    }

}