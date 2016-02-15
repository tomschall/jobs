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
 * Education
 */
class Education extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * title
     * 
     * @var string
     * @validate NotEmpty
     */
    protected $title = '';
    
    /**
     * link
     * 
     * @var string
     * @validate NotEmpty
     */
    protected $link = '';
    
    /**
     * idEducationLevel
     * 
     * @var \Sozialinfo\SiNews\Domain\Model\EdcuationLevel
     */
    protected $idEducationLevel = null;
    
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
     * Returns the link
     * 
     * @return string $link
     */
    public function getLink()
    {
        return $this->link;
    }
    
    /**
     * Sets the link
     * 
     * @param string $link
     * @return void
     */
    public function setLink($link)
    {
        $this->link = $link;
    }
    
    /**
     * Returns the idEducationLevel
     * 
     * @return \Sozialinfo\SiNews\Domain\Model\EdcuationLevel $idEducationLevel
     */
    public function getIdEducationLevel()
    {
        return $this->idEducationLevel;
    }
    
    /**
     * Sets the idEducationLevel
     * 
     * @param \Sozialinfo\SiNews\Domain\Model\EdcuationLevel $idEducationLevel
     * @return void
     */
    public function setIdEducationLevel(\Sozialinfo\SiNews\Domain\Model\EdcuationLevel $idEducationLevel)
    {
        $this->idEducationLevel = $idEducationLevel;
    }

}