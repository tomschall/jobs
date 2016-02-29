<?php

namespace Sozialinfo\SiNews\Controller;

/**
 * NewsController
 */
class NewsController extends \GeorgRinger\News\Controller\NewsController{


    /**
     * @var \Sozialinfo\SiNews\Domain\Repository\InformationstypeRepository
     * @inject
     */
    protected $InformationstypeRepository;

    /**
     * @var \Sozialinfo\SiNews\Domain\Repository\AreasOfWorkRepository
     * @inject
     */
    protected $AreasOfWorkRepository;


    /**
     * view of cantone
     * @param array $overwriteDemand
     * @return void
     */
    public function cantonAction(array $overwriteDemand = NULL){

        $demand = $this->getDemand($overwriteDemand);
        $newsRecords = $this->newsRepository->findDemanded($demand);

        $assignedValues = array(
            'news' => $newsRecords,
            'overwriteDemand' => $overwriteDemand,
            'demand' => $demand,
        );
        $assignedValues = $this->emitActionSignal('NewsController', self::SIGNAL_NEWS_LIST_ACTION, $assignedValues);
        $this->view->assignMultiple($assignedValues);

        //\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($content);
    }

    /**
     * Display the search form
     *
     * @param \Sozialinfo\SiNews\Domain\Model\Dto\SearchDemand $search
     * @param array $overwriteDemand
     * @return void
     */
    public function searchAdvancedAction(\Sozialinfo\SiNews\Domain\Model\Dto\SearchDemand $search = null, array $overwriteDemand = NULL) {
        $demand = $this->createDemandObjectFromSettings($this->settings);
        $demand->setActionAndClass(__METHOD__, __CLASS__);

        if ($this->settings['disableOverrideDemand'] != 1 && $overwriteDemand !== null) {
            $demand = $this->overwriteDemandObject($demand, $overwriteDemand);
        }

        if (is_null($search)) {
            $search = $this->objectManager->get(\Sozialinfo\SiNews\Domain\Model\Dto\SearchDemand::class);
            $search->setIdInformationstype($this->InformationstypeRepository->findAll());
            $search->setIdAreaofwork($this->AreasOfWorkRepository->findAll());
            $newssearch = FALSE;
        }else{
            $search->setIdInformationstype($this->InformationstypeRepository->findAll());
            $search->setIdAreaofwork($this->AreasOfWorkRepository->findAll());
            $search->setFields('title,subtitle,datetime');
            $search->setDateField($this->settings['dateField']);
            $demand->setSearch($search);
            $newssearch = TRUE;
        }




        $assignedValues = [
            'search' => $search,
            'overwriteDemand' => $overwriteDemand,
            'demand' => $demand,
            'newssearch' => $newssearch,
            'news' => $this->newsRepository->findDemanded($demand),
        ];

        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($assignedValues);

        $assignedValues = $this->emitActionSignal('NewsController', self::SIGNAL_NEWS_SEARCHFORM_ACTION,$assignedValues);
        $this->view->assignMultiple($assignedValues);
    }


    protected function getDemand(array $overwriteDemand = NULL){
        $demand = $this->createDemandObjectFromSettings($this->settings, 'Sozialinfo\\SiNews\\Domain\\Model\\Dto\\Demand');
        if (is_array($overwriteDemand) && !empty($overwriteDemand)) {
            $demand = $this->overwriteDemandObject($demand, $overwriteDemand);
        }
        return $demand;
    }


}