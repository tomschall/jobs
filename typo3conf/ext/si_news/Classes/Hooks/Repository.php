<?php
/**
 * Created by PhpStorm.
 * User: pap
 * Date: 16.02.2016
 * Time: 09:16
 */

namespace Sozialinfo\SiNews\Hooks;

use Sozialinfo\SiNews\Domain\Model\Dto\Demand;

class Repository{

    public function modify(array $params) {
        if (get_class($params['demand']) !== 'Sozialinfo\\SiNews\\Domain\\Model\\Dto\\Demand') {
            return;
        }
        $this->updateNewsConstraints($params['demand'], $params['respectEnableFields'], $params['query'], $params['constraints']);
    }

    /**
     * @param Demand $demand
     * @param bool $respectEnableFields
     * @param \TYPO3\CMS\Extbase\Persistence\QueryInterface $query
     * @param array $constraints
     * @return void
     */
    protected function updateNewsConstraints(Demand $demand, $respectEnableFields, \TYPO3\CMS\Extbase\Persistence\QueryInterface $query, array &$constraints) {
        $idCanton = $demand->getCantonRestriction();
        //$constraints[] = $query->contains('idCanton',$idCanton);

    }
}