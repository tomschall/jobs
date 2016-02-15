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
 * AreasOfWork
 */
class AreasOfWork extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * description
     * 
     * @var string
     * @validate NotEmpty
     */
    protected $description = '';
    
    /**
     * offer
     * 
     * @var bool
     * @validate NotEmpty
     */
    protected $offer = false;
    
    /**
     * request
     * 
     * @var bool
     * @validate NotEmpty
     */
    protected $request = false;
    
    /**
     * Returns the description
     * 
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    /**
     * Sets the description
     * 
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
    
    /**
     * Returns the offer
     * 
     * @return bool $offer
     */
    public function getOffer()
    {
        return $this->offer;
    }
    
    /**
     * Sets the offer
     * 
     * @param bool $offer
     * @return void
     */
    public function setOffer($offer)
    {
        $this->offer = $offer;
    }
    
    /**
     * Returns the boolean state of offer
     * 
     * @return bool
     */
    public function isOffer()
    {
        return $this->offer;
    }
    
    /**
     * Returns the request
     * 
     * @return bool $request
     */
    public function getRequest()
    {
        return $this->request;
    }
    
    /**
     * Sets the request
     * 
     * @param bool $request
     * @return void
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }
    
    /**
     * Returns the boolean state of request
     * 
     * @return bool
     */
    public function isRequest()
    {
        return $this->request;
    }

}