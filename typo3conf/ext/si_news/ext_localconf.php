<?php
defined('TYPO3_MODE') or die();



// Add new controller/action
$GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['switchableControllerActions']['newItems']['News->canton'] = 'Kanton Ansicht';

// Add new controller/action
$GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['switchableControllerActions']['newItems']['News->searchAdvanced'] = 'Erweiterte Suche';


/***********
 * Hooks
 */
// Update flexforms
$GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['Hooks/BackendUtility.php']['updateFlexforms']['si_news'] = 'Sozialinfo\\SiNews\\Hooks\\BackendUtility->updateFlexforms';

//$GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['GeorgRinger\\News\\Hooks\\PageLayoutView']['extensionSummary']['si_news'] = 'Sozialinfo\\SiNews\\Hooks\\PageLayoutView->extensionSummary';


// Extend query
$GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['Domain/Repository/AbstractDemandedRepository.php']['findDemanded']['si_news'] = 'EXT:si_news/Classes/Hooks/Repository.php:Sozialinfo\\SiNews\\Hooks\\Repository->modify';

/***********
 * Extend EXT:news
 */
$GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['classes']['Domain/Model/News'][] = 'si_news';
$GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['classes']['Controller/NewsController'][] = 'si_news';
