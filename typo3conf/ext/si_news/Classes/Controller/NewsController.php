<?php

namespace Sozialinfo\SiNews\Controller;

/**
 * NewsController
 */
class NewsController extends \GeorgRinger\News\Controller\NewsController{


    /**
     * view of cantone
     *
     */
    public function cantonAction(){
        /*
        $demand = $this->createDemandObjectFromSettings($this->settings);
        $demand->setActionAndClass(__METHOD__, __CLASS__);

        $newsRecords = $this->newsRepository->findDemanded($demand);
        */

        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump("Test Hallo Welt");

        $assignedValues = array("news"=>array('hallo'=>'Testhallo'));
        $assignedValues = $this->emitActionSignal('NewsController', self::SIGNAL_NEWS_LIST_ACTION, $assignedValues);
        $this->view->assignMultiple($assignedValues);
    }

}