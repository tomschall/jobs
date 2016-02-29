<?php

/**
* Created by PhpStorm.
 * User: pap
* Date: 11.02.2016
* Time: 16:33
*/

namespace Sozialinfo\SiNews\Domain\Model\Dto;

/**
 * Class CantonRepository
 */
class Demand extends \GeorgRinger\News\Domain\Model\Dto\NewsDemand {

    /** @var int */
    protected $cantonRestriction;

    public function __construct(array $settings = NULL) {
        $this->cantonRestriction = $settings['cantonRestriction'];
    }

    /**
     * @return int
     */
    public function getCantonRestriction() {
        return (int)$this->cantonRestriction;
    }

    /**
     * @param int $cantonRestriction
     */
    public function setCantonRestriction($cantonRestriction) {
        $this->cantonRestriction = $cantonRestriction;
    }
}