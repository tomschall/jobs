<?php

namespace Sozialinfo\SiNews\Hooks;


class BackendUtility extends \GeorgRinger\News\Hooks\BackendUtility{

    protected $eventRestrictionField = '<settings.eventRestriction>
						<TCEforms>
							<label>Si News Select</label>
							<config>
								<type>select</type>
								<items>
									<numIndex index="0" type="array">
										<numIndex index="0">Bern</numIndex>
										<numIndex index="1">0</numIndex>
									</numIndex>
									<numIndex index="1">
										<numIndex index="0">Solothurn</numIndex>
										<numIndex index="1">1</numIndex>
									</numIndex>
									<numIndex index="2">
										<numIndex index="0">Genf</numIndex>
										<numIndex index="1">2</numIndex>
									</numIndex>
								</items>
							</config>
						</TCEforms>
					</settings.eventRestriction>';


    /**
     * @param array|string $params
     * @param array $reference
     */
    public function updateFlexforms(&$params, &$reference){
        if ($params['selectedView'] === 'News->canton') {
            $removedFields = $this->removedFieldsInListView;
            $removedFields['sDEF'] .= ',timeRestriction,timeRestrictionHigh';

            $this->deleteFromStructure($params['dataStructure'], $removedFields);
        }

        if ($params['selectedView'] === 'News->canton' || $params['selectedView'] === 'News->list') {
            $eventRestrictionXml = GeneralUtility::xml2array($this->eventRestrictionField);
            $params['dataStructure']['sheets']['sDEF']['ROOT']['el'] = $params['dataStructure']['sheets']['sDEF']['ROOT']['el'] + array(
                    'settings.eventRestriction' => $eventRestrictionXml);
        }
    }
}