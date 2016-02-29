<?php
/**
 * Created by PhpStorm.
 * User: pap
 * Date: 16.02.2016
 * Time: 16:27
 */

namespace Sozialinfo\SiNews\Domain\Model\Dto;


class SearchDemand extends \GeorgRinger\News\Domain\Model\Dto\Search{

    /**
     * idInformationstype
     *
     * @var array
     */
    protected $idInformationstype = null;

    /**
     * idAreaofwork
     *
     * @var array
     */
    protected $idAreaofwork = null;


    /**
     * Returns the idInformationstype
     *
     * @return array
     */
    public function getIdInformationstype()
    {
        return $this->idInformationstype;
    }

    /**
     * Sets the idInformationstype
     *
     * @param array  $idInformationstype
     * @return void
     */
    public function setIdInformationstype($idInformationstype)
    {
        $this->idInformationstype = $idInformationstype;
    }

    /**
     * Returns the idInformationstype
     *
     * @return array
     */
    public function getIdAreaofwork()
    {
        return $this->idAreaofwork;
    }

    /**
     * Sets the idAreaofwork
     *
     * @param array  idAreaofwork
     * @return void
     */
    public function setIdAreaofwork($idAreaofwork)
    {
        $this->idAreaofwork = $idAreaofwork;
    }


}