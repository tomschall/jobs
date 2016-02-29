<?php
/**
 * Created by PhpStorm.
 * User: pap
 * Date: 15.02.2016
 * Time: 11:53
 */

namespace Sozialinfo\SiNews\Hooks;


class PageLayoutView{
    /**
     * Provide an extension summary for the month selection
     *
     * @param array $params
     * @param \GeorgRinger\News\Hooks\PageLayoutView $pageLayout
     * @return void
     */
    public function extensionSummary(array $params, \GeorgRinger\News\Hooks\PageLayoutView $pageLayout){
        if ($params['action'] === 'news_canton') {
            $pageLayout->getStartingPoint();
            $pageLayout->getTimeRestrictionSetting();
            $pageLayout->getTopNewsRestrictionSetting();
            $pageLayout->getOrderSettings();
            $pageLayout->getCategorySettings();
            $pageLayout->getArchiveSettings();
            $pageLayout->getOffsetLimitSettings();
            $pageLayout->getDetailPidSetting();
            $pageLayout->getListPidSetting();
            $pageLayout->getTagRestrictionSetting();
            $this->getCantonRestrictionSetting($pageLayout);
        }
    }

    /**
     * Show the event restriction
     *
     * @param \GeorgRinger\News\Hooks\PageLayoutView $cmsLayout
     * @return void
     */
    protected function getCantonRestrictionSetting(\GeorgRinger\News\Hooks\PageLayoutView $cmsLayout){
        $eventRestriction = (int)$cmsLayout->getFieldFromFlexform('settings.cantonRestriction');
        if ($eventRestriction > 0) {
            $cmsLayout->tableData[] = array(
                $cmsLayout->getLanguageService()->sL('sadasdasd'),
                $cmsLayout->getLanguageService()->sL('323213')
            );
        }
    }
}