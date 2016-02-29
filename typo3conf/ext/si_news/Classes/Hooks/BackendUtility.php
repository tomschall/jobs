<?php

namespace Sozialinfo\SiNews\Hooks;

use TYPO3\CMS\Core\Utility\GeneralUtility;

class BackendUtility extends \GeorgRinger\News\Hooks\BackendUtility{

    protected $eventRestrictionField = '<sDEF><ROOT><TCEforms><sheetTitle>Si News</sheetTitle></TCEforms>
                  <type>array</type><el>
                    <settings.cantonRestriction>
					 <TCEforms>
						    <label>Si News </label>
							<config>
							<type>select</type>
							<foreign_table>tx_sinews_domain_model_canton</foreign_table>
							<foreign_table_where>AND (tx_sinews_domain_model_canton.sys_language_uid = 0 OR tx_sinews_domain_model_canton.l10n_parent = 0) ORDER BY tx_sinews_domain_model_canton.sorting</foreign_table_where>
						</config>
					 </TCEforms>
					</settings.cantonRestriction>
					</el></ROOT></sDEF>';


    /**
     * @param array|string $params
     * @param array $reference
     */
    public function updateFlexforms(&$params, &$reference) {

        if ($params['selectedView'] === 'News->canton' || $params['selectedView'] === 'News->list') {
            $eventRestrictionXml = GeneralUtility::xml2array($this->eventRestrictionField);
            $params['dataStructure']['sheets'] = $params['dataStructure']['sheets'] + array(
                    'sinews' => $eventRestrictionXml);
        }
    }
}