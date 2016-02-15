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
 * News
 */
class News extends \GeorgRinger\News\Domain\Model\News
{

    /**
     * date
     *
     * @var int
     * @validate NotEmpty
     */
    protected $date = '';

    /**
     * subtitle
     *
     * @var string
     * @validate NotEmpty
     */
    protected $subtitle = '';

    /**
     * isbn
     *
     * @var string
     */
    protected $isbn = '';

    /**
     * issn
     *
     * @var string
     */
    protected $issn = '';

    /**
     * edition
     *
     * @var string
     */
    protected $edition = '';

    /**
     * yearofpublicaition
     *
     * @var int
     * @validate NotEmpty
     */
    protected $yearofpublicaition = 0;

    /**
     * channels
     *
     * @var int
     */
    protected $channels = 0;

    /**
     * news
     *
     * @var int
     * @validate NotEmpty
     */
    protected $news = 0;

    /**
     * hrsg
     *
     * @var bool
     * @validate NotEmpty
     */
    protected $hrsg = false;

    /**
     * idAuthor
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\SiNews\Domain\Model\Authors>
     * @lazy
     */
    protected $idAuthor = null;

    /**
     * idPublisher
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\SiNews\Domain\Model\Publisher>
     * @lazy
     */
    protected $idPublisher = null;

    /**
     * idCanton
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\SiNews\Domain\Model\Canton>
     * @lazy
     */
    protected $idCanton = null;

    /**
     * idAdresse
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\SiNews\Domain\Model\Adresse>
     * @lazy
     */
    protected $idAdresse = null;

    /**
     * idInformationstype
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\SiNews\Domain\Model\Informationstype>
     * @cascade remove
     */
    protected $idInformationstype = null;

    /**
     * idCategory
     *
     * @var \Sozialinfo\SiNews\Domain\Model\Category
     */
    protected $idCategory = null;

    /**
     * Returns the date
     *
     * @return int date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Sets the date
     *
     * @param string $date
     * @return void
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * Returns the subtitle
     *
     * @return string $subtitle
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Sets the subtitle
     *
     * @param string $subtitle
     * @return void
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
    }

    /**
     * Returns the isbn
     *
     * @return string $isbn
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * Sets the isbn
     *
     * @param string $isbn
     * @return void
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
    }

    /**
     * Returns the issn
     *
     * @return string $issn
     */
    public function getIssn()
    {
        return $this->issn;
    }

    /**
     * Sets the issn
     *
     * @param string $issn
     * @return void
     */
    public function setIssn($issn)
    {
        $this->issn = $issn;
    }

    /**
     * Returns the edition
     *
     * @return string $edition
     */
    public function getEdition()
    {
        return $this->edition;
    }

    /**
     * Sets the edition
     *
     * @param string $edition
     * @return void
     */
    public function setEdition($edition)
    {
        $this->edition = $edition;
    }

    /**
     * Returns the yearofpublicaition
     *
     * @return int $yearofpublicaition
     */
    public function getYearofpublicaition()
    {
        return $this->yearofpublicaition;
    }

    /**
     * Sets the yearofpublicaition
     *
     * @param int $yearofpublicaition
     * @return void
     */
    public function setYearofpublicaition($yearofpublicaition)
    {
        $this->yearofpublicaition = $yearofpublicaition;
    }

    /**
     * Returns the channels
     *
     * @return int $channels
     */
    public function getChannels()
    {
        return $this->channels;
    }

    /**
     * Sets the channels
     *
     * @param int $channels
     * @return void
     */
    public function setChannels($channels)
    {
        $this->channels = $channels;
    }

    /**
     * Returns the news
     *
     * @return int $news
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * Sets the news
     *
     * @param int $news
     * @return void
     */
    public function setNews($news)
    {
        $this->news = $news;
    }

    /**
     * Returns the hrsg
     *
     * @return bool $hrsg
     */
    public function getHrsg()
    {
        return $this->hrsg;
    }

    /**
     * Sets the hrsg
     *
     * @param bool $hrsg
     * @return void
     */
    public function setHrsg($hrsg)
    {
        $this->hrsg = $hrsg;
    }

    /**
     * Returns the boolean state of hrsg
     *
     * @return bool
     */
    public function isHrsg()
    {
        return $this->hrsg;
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
        $this->idAuthor = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->idPublisher = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->idCanton = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->idAdresse = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->idInformationstype = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Adds a Authors
     *
     * @param \Sozialinfo\SiNews\Domain\Model\Authors $idAuthor
     * @return void
     */
    public function addIdAuthor(\Sozialinfo\SiNews\Domain\Model\Authors $idAuthor)
    {
        $this->idAuthor->attach($idAuthor);
    }

    /**
     * Removes a Authors
     *
     * @param \Sozialinfo\SiNews\Domain\Model\Authors $idAuthorToRemove The Authors to be removed
     * @return void
     */
    public function removeIdAuthor(\Sozialinfo\SiNews\Domain\Model\Authors $idAuthorToRemove)
    {
        $this->idAuthor->detach($idAuthorToRemove);
    }

    /**
     * Returns the idAuthor
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\SiNews\Domain\Model\Authors> idAuthor
     */
    public function getIdAuthor()
    {
        return $this->idAuthor;
    }

    /**
     * Sets the idAuthor
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\SiNews\Domain\Model\Authors> $idAuthor
     * @return void
     */
    public function setIdAuthor(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $idAuthor)
    {
        $this->idAuthor = $idAuthor;
    }

    /**
     * Adds a Publisher
     *
     * @param \Sozialinfo\SiNews\Domain\Model\Publisher $idPublisher
     * @return void
     */
    public function addIdPublisher(\Sozialinfo\SiNews\Domain\Model\Publisher $idPublisher)
    {
        $this->idPublisher->attach($idPublisher);
    }

    /**
     * Removes a Publisher
     *
     * @param \Sozialinfo\SiNews\Domain\Model\Publisher $idPublisherToRemove The Publisher to be removed
     * @return void
     */
    public function removeIdPublisher(\Sozialinfo\SiNews\Domain\Model\Publisher $idPublisherToRemove)
    {
        $this->idPublisher->detach($idPublisherToRemove);
    }

    /**
     * Returns the idPublisher
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\SiNews\Domain\Model\Publisher> idPublisher
     */
    public function getIdPublisher()
    {
        return $this->idPublisher;
    }

    /**
     * Sets the idPublisher
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\SiNews\Domain\Model\Publisher> $idPublisher
     * @return void
     */
    public function setIdPublisher(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $idPublisher)
    {
        $this->idPublisher = $idPublisher;
    }

    /**
     * Adds a Adresses
     *
     * @param \Sozialinfo\SiNews\Domain\Model\Adresse $idAdresse
     * @return void
     */
    public function addIdAdresse(\Sozialinfo\SiNews\Domain\Model\Adresse $idAdresse)
    {
        $this->idAdresse->attach($idAdresse);
    }

    /**
     * Removes a Adresses
     *
     * @param \Sozialinfo\SiNews\Domain\Model\Adresse $idAdresseToRemove The Adresse to be removed
     * @return void
     */
    public function removeIdAdresse(\Sozialinfo\SiNews\Domain\Model\Adresse $idAdresseToRemove)
    {
        $this->idAdresse->detach($idAdresseToRemove);
    }

    /**
     * Returns the idAdresse
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\SiNews\Domain\Model\Adresse> idAdresse
     */
    public function getIdAdresse()
    {
        return $this->idAdresse;
    }

    /**
     * Sets the idAdresse
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\SiNews\Domain\Model\Adresse> $idAdresse
     * @return void
     */
    public function setIdAdresse(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $idAdresse)
    {
        $this->idAdresse = $idAdresse;
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
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\SiNews\Domain\Model\Informationstype> idInformationstype
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

    /**
     * Returns the idCategory
     *
     * @return \Sozialinfo\SiNews\Domain\Model\Category idCategory
     */
    public function getIdCategory()
    {
        return $this->idCategory;
    }

    /**
     * Sets the idCategory
     *
     * @param \Sozialinfo\SiNews\Domain\Model\Category $idCategory
     * @return void
     */
    public function setIdCategory(\Sozialinfo\SiNews\Domain\Model\Category $idCategory)
    {
        $this->idCategory = $idCategory;
    }

    /**
     * Adds a Cantone
     *
     * @param \Sozialinfo\SiNews\Domain\Model\Canton $idCanton
     * @return void
     */
    public function addIdCanton(\Sozialinfo\SiNews\Domain\Model\Canton $idCanton)
    {
        $this->idCanton->attach($idCanton);
    }

    /**
     * Removes a Cantone
     *
     * @param \Sozialinfo\SiNews\Domain\Model\Canton $idCantonToRemove The Canton to be removed
     * @return void
     */
    public function removeIdCanton(\Sozialinfo\SiNews\Domain\Model\Canton $idCantonToRemove)
    {
        $this->idCanton->detach($idCantonToRemove);
    }

    /**
     * Returns the idCanton
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\SiNews\Domain\Model\Canton> idCanton
     */
    public function getIdCanton()
    {
        return $this->idCanton;
    }

    /**
     * Sets the idCanton
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sozialinfo\SiNews\Domain\Model\Canton> $idCanton
     * @return void
     */
    public function setIdCanton(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $idCanton)
    {
        $this->idCanton = $idCanton;
    }

}