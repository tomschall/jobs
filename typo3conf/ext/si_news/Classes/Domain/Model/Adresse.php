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
 * SiAdressen
 */
class Adresse extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * institution
     * 
     * @var string
     */
    protected $institution = '';
    
    /**
     * category
     * 
     * @var int
     * @validate NotEmpty
     */
    protected $category = 0;
    
    /**
     * department
     * 
     * @var string
     */
    protected $department = '';
    
    /**
     * short
     * 
     * @var string
     */
    protected $short = '';
    
    /**
     * displayname
     * 
     * @var string
     */
    protected $displayname = '';
    
    /**
     * addition
     * 
     * @var string
     */
    protected $addition = '';
    
    /**
     * adresse
     * 
     * @var string
     */
    protected $adresse = '';
    
    /**
     * postOffice
     * 
     * @var string
     */
    protected $postOffice = '';
    
    /**
     * postcode
     * 
     * @var string
     */
    protected $postcode = '';
    
    /**
     * location
     * 
     * @var string
     */
    protected $location = '';
    
    /**
     * pPostcode
     * 
     * @var string
     */
    protected $pPostcode = '';
    
    /**
     * pLocation
     * 
     * @var string
     */
    protected $pLocation = '';
    
    /**
     * areasOfWork
     * 
     * @var int
     * @validate NotEmpty
     */
    protected $areasOfWork = 0;
    
    /**
     * canton
     * 
     * @var string
     * @validate NotEmpty
     */
    protected $canton = '';
    
    /**
     * phone
     * 
     * @var string
     */
    protected $phone = '';
    
    /**
     * telefax
     * 
     * @var string
     */
    protected $telefax = '';
    
    /**
     * email
     * 
     * @var string
     */
    protected $email = '';
    
    /**
     * www
     * 
     * @var string
     */
    protected $www = '';
    
    /**
     * remark
     * 
     * @var string
     */
    protected $remark = '';
    
    /**
     * other
     * 
     * @var string
     */
    protected $other = '';
    
    /**
     * datasheet
     * 
     * @var int
     * @validate NotEmpty
     */
    protected $datasheet = '';
    
    /**
     * backEmpty
     * 
     * @var int
     * @validate NotEmpty
     */
    protected $backEmpty = '';
    
    /**
     * institutionShort
     * 
     * @var string
     */
    protected $institutionShort = '';
    
    /**
     * facebook
     * 
     * @var string
     */
    protected $facebook = '';
    
    /**
     * twitter
     * 
     * @var string
     */
    protected $twitter = '';
    
    /**
     * other Social Media
     * 
     * @var string
     */
    protected $otherSM = '';
    
    /**
     * googleplus
     * 
     * @var string
     */
    protected $googleplus = '';
    
    /**
     * xing
     * 
     * @var string
     */
    protected $xing = '';
    
    /**
     * youtube
     * 
     * @var string
     */
    protected $youtube = '';
    
    /**
     * rss
     * 
     * @var string
     */
    protected $rss = '';
    
    /**
     * idUser
     * 
     * @var \Sozialinfo\SiNews\Domain\Model\FeUser
     */
    protected $idUser = null;
    
    /**
     * idCanton
     * 
     * @var \Sozialinfo\SiNews\Domain\Model\Canton
     */
    protected $idCanton = null;
    
    /**
     * idAreaofwork
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\SiNews\Domain\Model\AreasOfWork>
     * @lazy
     */
    protected $idAreaofwork = null;
    
    /**
     * idEducation
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\SiNews\Domain\Model\Education>
     * @lazy
     */
    protected $idEducation = null;
    
    /**
     * Returns the institution
     * 
     * @return string $institution
     */
    public function getInstitution()
    {
        return $this->institution;
    }
    
    /**
     * Sets the institution
     * 
     * @param string $institution
     * @return void
     */
    public function setInstitution($institution)
    {
        $this->institution = $institution;
    }
    
    /**
     * Returns the category
     * 
     * @return int $category
     */
    public function getCategory()
    {
        return $this->category;
    }
    
    /**
     * Sets the category
     * 
     * @param int $category
     * @return void
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }
    
    /**
     * Returns the department
     * 
     * @return string $department
     */
    public function getDepartment()
    {
        return $this->department;
    }
    
    /**
     * Sets the department
     * 
     * @param string $department
     * @return void
     */
    public function setDepartment($department)
    {
        $this->department = $department;
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
     * Returns the displayname
     * 
     * @return string $displayname
     */
    public function getDisplayname()
    {
        return $this->displayname;
    }
    
    /**
     * Sets the displayname
     * 
     * @param string $displayname
     * @return void
     */
    public function setDisplayname($displayname)
    {
        $this->displayname = $displayname;
    }
    
    /**
     * Returns the addition
     * 
     * @return string $addition
     */
    public function getAddition()
    {
        return $this->addition;
    }
    
    /**
     * Sets the addition
     * 
     * @param string $addition
     * @return void
     */
    public function setAddition($addition)
    {
        $this->addition = $addition;
    }
    
    /**
     * Returns the adresse
     * 
     * @return string $adresse
     */
    public function getAdresse()
    {
        return $this->adresse;
    }
    
    /**
     * Sets the adresse
     * 
     * @param string $adresse
     * @return void
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }
    
    /**
     * Returns the postOffice
     * 
     * @return string $postOffice
     */
    public function getPostOffice()
    {
        return $this->postOffice;
    }
    
    /**
     * Sets the postOffice
     * 
     * @param string $postOffice
     * @return void
     */
    public function setPostOffice($postOffice)
    {
        $this->postOffice = $postOffice;
    }
    
    /**
     * Returns the areasOfWork
     * 
     * @return int $areasOfWork
     */
    public function getAreasOfWork()
    {
        return $this->areasOfWork;
    }
    
    /**
     * Sets the areasOfWork
     * 
     * @param int $areasOfWork
     * @return void
     */
    public function setAreasOfWork($areasOfWork)
    {
        $this->areasOfWork = $areasOfWork;
    }
    
    /**
     * Returns the phone
     * 
     * @return string $phone
     */
    public function getPhone()
    {
        return $this->phone;
    }
    
    /**
     * Sets the phone
     * 
     * @param string $phone
     * @return void
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
    
    /**
     * Returns the telefax
     * 
     * @return string $telefax
     */
    public function getTelefax()
    {
        return $this->telefax;
    }
    
    /**
     * Sets the telefax
     * 
     * @param string $telefax
     * @return void
     */
    public function setTelefax($telefax)
    {
        $this->telefax = $telefax;
    }
    
    /**
     * Returns the email
     * 
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * Sets the email
     * 
     * @param string $email
     * @return void
     */
    public function setEmail($email)
    {
        $this->email = $email;
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
     * Returns the remark
     * 
     * @return string $remark
     */
    public function getRemark()
    {
        return $this->remark;
    }
    
    /**
     * Sets the remark
     * 
     * @param string $remark
     * @return void
     */
    public function setRemark($remark)
    {
        $this->remark = $remark;
    }
    
    /**
     * Returns the other
     * 
     * @return string $other
     */
    public function getOther()
    {
        return $this->other;
    }
    
    /**
     * Sets the other
     * 
     * @param string $other
     * @return void
     */
    public function setOther($other)
    {
        $this->other = $other;
    }
    
    /**
     * Returns the institutionShort
     * 
     * @return string $institutionShort
     */
    public function getInstitutionShort()
    {
        return $this->institutionShort;
    }
    
    /**
     * Sets the institutionShort
     * 
     * @param string $institutionShort
     * @return void
     */
    public function setInstitutionShort($institutionShort)
    {
        $this->institutionShort = $institutionShort;
    }
    
    /**
     * Returns the facebook
     * 
     * @return string $facebook
     */
    public function getFacebook()
    {
        return $this->facebook;
    }
    
    /**
     * Sets the facebook
     * 
     * @param string $facebook
     * @return void
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;
    }
    
    /**
     * Returns the twitter
     * 
     * @return string $twitter
     */
    public function getTwitter()
    {
        return $this->twitter;
    }
    
    /**
     * Sets the twitter
     * 
     * @param string $twitter
     * @return void
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;
    }
    
    /**
     * Returns the otherSM
     * 
     * @return string $otherSM
     */
    public function getOtherSM()
    {
        return $this->otherSM;
    }
    
    /**
     * Sets the otherSM
     * 
     * @param string $otherSM
     * @return void
     */
    public function setOtherSM($otherSM)
    {
        $this->otherSM = $otherSM;
    }
    
    /**
     * Returns the googleplus
     * 
     * @return string $googleplus
     */
    public function getGoogleplus()
    {
        return $this->googleplus;
    }
    
    /**
     * Sets the googleplus
     * 
     * @param string $googleplus
     * @return void
     */
    public function setGoogleplus($googleplus)
    {
        $this->googleplus = $googleplus;
    }
    
    /**
     * Returns the xing
     * 
     * @return string $xing
     */
    public function getXing()
    {
        return $this->xing;
    }
    
    /**
     * Sets the xing
     * 
     * @param string $xing
     * @return void
     */
    public function setXing($xing)
    {
        $this->xing = $xing;
    }
    
    /**
     * Returns the youtube
     * 
     * @return string $youtube
     */
    public function getYoutube()
    {
        return $this->youtube;
    }
    
    /**
     * Sets the youtube
     * 
     * @param string $youtube
     * @return void
     */
    public function setYoutube($youtube)
    {
        $this->youtube = $youtube;
    }
    
    /**
     * Returns the rss
     * 
     * @return string $rss
     */
    public function getRss()
    {
        return $this->rss;
    }
    
    /**
     * Sets the rss
     * 
     * @param string $rss
     * @return void
     */
    public function setRss($rss)
    {
        $this->rss = $rss;
    }
    
    /**
     * Returns the postcode
     * 
     * @return string postcode
     */
    public function getPostcode()
    {
        return $this->postcode;
    }
    
    /**
     * Sets the postcode
     * 
     * @param string $postcode
     * @return void
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
    }
    
    /**
     * Returns the location
     * 
     * @return string location
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
     * Returns the pPostcode
     * 
     * @return string pPostcode
     */
    public function getPPostcode()
    {
        return $this->pPostcode;
    }
    
    /**
     * Sets the pPostcode
     * 
     * @param string $pPostcode
     * @return void
     */
    public function setPPostcode($pPostcode)
    {
        $this->pPostcode = $pPostcode;
    }
    
    /**
     * Returns the pLocation
     * 
     * @return string pLocation
     */
    public function getPLocation()
    {
        return $this->pLocation;
    }
    
    /**
     * Sets the pLocation
     * 
     * @param string $pLocation
     * @return void
     */
    public function setPLocation($pLocation)
    {
        $this->pLocation = $pLocation;
    }
    
    /**
     * Returns the canton
     * 
     * @return string canton
     */
    public function getCanton()
    {
        return $this->canton;
    }
    
    /**
     * Sets the canton
     * 
     * @param string $canton
     * @return void
     */
    public function setCanton($canton)
    {
        $this->canton = $canton;
    }
    
    /**
     * Returns the datasheet
     * 
     * @return int datasheet
     */
    public function getDatasheet()
    {
        return $this->datasheet;
    }
    
    /**
     * Sets the datasheet
     * 
     * @param string $datasheet
     * @return void
     */
    public function setDatasheet($datasheet)
    {
        $this->datasheet = $datasheet;
    }
    
    /**
     * Returns the backEmpty
     * 
     * @return int backEmpty
     */
    public function getBackEmpty()
    {
        return $this->backEmpty;
    }
    
    /**
     * Sets the backEmpty
     * 
     * @param string $backEmpty
     * @return void
     */
    public function setBackEmpty($backEmpty)
    {
        $this->backEmpty = $backEmpty;
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
        $this->idAreaofwork = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->idEducation = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }
    
    /**
     * Adds a AreasOfWork
     * 
     * @param \Sozialinfo\SiNews\Domain\Model\AreasOfWork $idAreaofwork
     * @return void
     */
    public function addIdAreaofwork(\Sozialinfo\SiNews\Domain\Model\AreasOfWork $idAreaofwork)
    {
        $this->idAreaofwork->attach($idAreaofwork);
    }
    
    /**
     * Removes a AreasOfWork
     * 
     * @param \Sozialinfo\SiNews\Domain\Model\AreasOfWork $idAreaofworkToRemove The AreasOfWork to be removed
     * @return void
     */
    public function removeIdAreaofwork(\Sozialinfo\SiNews\Domain\Model\AreasOfWork $idAreaofworkToRemove)
    {
        $this->idAreaofwork->detach($idAreaofworkToRemove);
    }
    
    /**
     * Returns the idAreaofwork
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\SiNews\Domain\Model\AreasOfWork> $idAreaofwork
     */
    public function getIdAreaofwork()
    {
        return $this->idAreaofwork;
    }
    
    /**
     * Sets the idAreaofwork
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\SiNews\Domain\Model\AreasOfWork> $idAreaofwork
     * @return void
     */
    public function setIdAreaofwork(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $idAreaofwork)
    {
        $this->idAreaofwork = $idAreaofwork;
    }
    
    /**
     * Adds a Education
     * 
     * @param \Sozialinfo\SiNews\Domain\Model\Education $idEducation
     * @return void
     */
    public function addIdEducation(\Sozialinfo\SiNews\Domain\Model\Education $idEducation)
    {
        $this->idEducation->attach($idEducation);
    }
    
    /**
     * Removes a Education
     * 
     * @param \Sozialinfo\SiNews\Domain\Model\Education $idEducationToRemove The Education to be removed
     * @return void
     */
    public function removeIdEducation(\Sozialinfo\SiNews\Domain\Model\Education $idEducationToRemove)
    {
        $this->idEducation->detach($idEducationToRemove);
    }
    
    /**
     * Returns the idEducation
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\SiNews\Domain\Model\Education> $idEducation
     */
    public function getIdEducation()
    {
        return $this->idEducation;
    }
    
    /**
     * Sets the idEducation
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\SiNews\Domain\Model\Education> $idEducation
     * @return void
     */
    public function setIdEducation(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $idEducation)
    {
        $this->idEducation = $idEducation;
    }
    
    /**
     * Returns the idCanton
     * 
     * @return \Sozialinfo\SiNews\Domain\Model\Canton idCanton
     */
    public function getIdCanton()
    {
        return $this->idCanton;
    }
    
    /**
     * Sets the idCanton
     * 
     * @param string $idCanton
     * @return void
     */
    public function setIdCanton($idCanton)
    {
        $this->idCanton = $idCanton;
    }

}