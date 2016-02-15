<?php

if (!isset($GLOBALS['TCA']['tx_news_domain_model_news']['ctrl']['type'])) {
	if (file_exists($GLOBALS['TCA']['tx_news_domain_model_news']['ctrl']['dynamicConfigFile'])) {
		require_once($GLOBALS['TCA']['tx_news_domain_model_news']['ctrl']['dynamicConfigFile']);
	}
	// no type field defined, so we define it here. This will only happen the first time the extension is installed!!
	$GLOBALS['TCA']['tx_news_domain_model_news']['ctrl']['type'] = 'tx_extbase_type';
	$tempColumnstx_sinews_tx_news_domain_model_news = array();
	$tempColumnstx_sinews_tx_news_domain_model_news[$GLOBALS['TCA']['tx_news_domain_model_news']['ctrl']['type']] = array(
		'exclude' => 1,
		'label'   => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews.tx_extbase_type',
		'config' => array(
			'type' => 'select',
			'renderType' => 'selectSingle',
			'items' => array(
				array('News','Tx_SiNews_News')
			),
			'size' => 1,
			'maxitems' => 1,
		),
	);
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_news_domain_model_news', $tempColumnstx_sinews_tx_news_domain_model_news, 1);
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
	'tx_news_domain_model_news',
	$GLOBALS['TCA']['tx_news_domain_model_news']['ctrl']['type'],
	'',
	'after:' . $GLOBALS['TCA']['tx_news_domain_model_news']['ctrl']['label']
);

$tmp_si_news_columns = array(

	'date' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_news.date',
		'config' => array(
			'type' => 'input',
			'size' => 4,
			'eval' => 'int,required',
			'default' => date('Y')
		)
	),
	'subtitle' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_news.subtitle',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim,required'
		),
	),
	'isbn' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_news.isbn',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	),
	'issn' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_news.issn',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	),
	'edition' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_news.edition',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	),
	'yearofpublicaition' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_news.yearofpublicaition',
		'config' => array(
			'type' => 'input',
			'size' => 4,
			'eval' => 'int,required',
			'default' => date('Y')
		)
	),
	'channels' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_news.channels',
		'config' => array(
			'type' => 'input',
			'size' => 4,
			'eval' => 'int'
		)
	),
	'news' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_news.news',
		'config' => array(
			'type' => 'input',
			'size' => 4,
			'eval' => 'int,required'
		)
	),
	'hrsg' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_news.hrsg',
		'config' => array(
			'type' => 'check',
			'default' => 0
		)
	),
	'id_author' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_news.id_author',
		'config' => array(
			'type' => 'select',
			'renderType' => 'selectMultipleSideBySide',
			'foreign_table' => 'tx_sinews_domain_model_authors',
			'MM' => 'tx_sinews_news_authors_mm',
			'size' => 10,
			'autoSizeMax' => 30,
			'maxitems' => 9999,
			'multiple' => 0,
			'wizards' => array(
				'_PADDING' => 1,
				'_VERTICAL' => 1,
				'edit' => array(
					'module' => array(
						'name' => 'wizard_edit',
					),
					'type' => 'popup',
					'title' => 'Edit',
					'icon' => 'edit2.gif',
					'popup_onlyOpenIfSelected' => 1,
					'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
					),
				'add' => Array(
					'module' => array(
						'name' => 'wizard_add',
					),
					'type' => 'script',
					'title' => 'Create new',
					'icon' => 'add.gif',
					'params' => array(
						'table' => 'tx_sinews_domain_model_authors',
						'pid' => '###CURRENT_PID###',
						'setValue' => 'prepend'
					),
				),
			),
		),
	),
	'id_publisher' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_news.id_publisher',
		'config' => array(
			'type' => 'select',
			'renderType' => 'selectMultipleSideBySide',
			'foreign_table' => 'tx_sinews_domain_model_publisher',
			'MM' => 'tx_sinews_news_publisher_mm',
			'size' => 10,
			'autoSizeMax' => 30,
			'maxitems' => 9999,
			'multiple' => 0,
			'wizards' => array(
				'_PADDING' => 1,
				'_VERTICAL' => 1,
				'edit' => array(
					'module' => array(
						'name' => 'wizard_edit',
					),
					'type' => 'popup',
					'title' => 'Edit',
					'icon' => 'edit2.gif',
					'popup_onlyOpenIfSelected' => 1,
					'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
					),
				'add' => Array(
					'module' => array(
						'name' => 'wizard_add',
					),
					'type' => 'script',
					'title' => 'Create new',
					'icon' => 'add.gif',
					'params' => array(
						'table' => 'tx_sinews_domain_model_publisher',
						'pid' => '###CURRENT_PID###',
						'setValue' => 'prepend'
					),
				),
			),
		),
	),
	'id_canton' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_news.id_canton',
		'config' => array(
			'type' => 'select',
			'renderType' => 'selectMultipleSideBySide',
			'foreign_table' => 'tx_sinews_domain_model_canton',
			'MM' => 'tx_sinews_news_canton_mm',
			'size' => 10,
			'autoSizeMax' => 30,
			'maxitems' => 9999,
			'multiple' => 0,
			'wizards' => array(
				'_PADDING' => 1,
				'_VERTICAL' => 1,
				'edit' => array(
					'module' => array(
						'name' => 'wizard_edit',
					),
					'type' => 'popup',
					'title' => 'Edit',
					'icon' => 'edit2.gif',
					'popup_onlyOpenIfSelected' => 1,
					'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
					),
				'add' => Array(
					'module' => array(
						'name' => 'wizard_add',
					),
					'type' => 'script',
					'title' => 'Create new',
					'icon' => 'add.gif',
					'params' => array(
						'table' => 'tx_sinews_domain_model_canton',
						'pid' => '###CURRENT_PID###',
						'setValue' => 'prepend'
					),
				),
			),
		),
	),
	'id_adresse' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_news.id_adresse',
		'config' => array(
			'type' => 'select',
			'renderType' => 'selectMultipleSideBySide',
			'foreign_table' => 'tx_sinews_domain_model_adresse',
			'MM' => 'tx_sinews_news_adresse_mm',
			'size' => 10,
			'autoSizeMax' => 30,
			'maxitems' => 9999,
			'multiple' => 0,
			'wizards' => array(
				'_PADDING' => 1,
				'_VERTICAL' => 1,
				'edit' => array(
					'module' => array(
						'name' => 'wizard_edit',
					),
					'type' => 'popup',
					'title' => 'Edit',
					'icon' => 'edit2.gif',
					'popup_onlyOpenIfSelected' => 1,
					'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
					),
				'add' => Array(
					'module' => array(
						'name' => 'wizard_add',
					),
					'type' => 'script',
					'title' => 'Create new',
					'icon' => 'add.gif',
					'params' => array(
						'table' => 'tx_sinews_domain_model_adresse',
						'pid' => '###CURRENT_PID###',
						'setValue' => 'prepend'
					),
				),
			),
		),
	),
	'id_informationstype' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_news.id_informationstype',
		'config' => array(
			'type' => 'select',
			'renderType' => 'selectSingle',
			'foreign_table' => 'tx_sinews_domain_model_informationstype',
			'minitems' => 0,
			'maxitems' => 1,
		),
	),
	'id_category' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_news.id_category',
		'config' => array(
			'type' => 'select',
			'foreign_table' => 'sys_category',
			'MM' => 'sys_category_record_mm',
			'size' => 10,
			'autoSizeMax' => 30,
			'maxitems' => 9999,
			'renderType' => 'selectTree',
			'treeConfig' => array(
				'parentField' => 'parent',
				'appearance' => array(
					'expandAll' => TRUE,
					'showHeader' => TRUE,
				),
			),
		),
		/*'config' => array(
			'type' => 'select',
			'renderType' => 'selectMultipleSideBySide',
			'foreign_table' => 'sys_category',
			'MM' => 'sys_category_record_mm',
			'size' => 10,
			'autoSizeMax' => 30,
			'maxitems' => 9999,
			'multiple' => 0,
			'wizards' => array(
				'_PADDING' => 1,
				'_VERTICAL' => 1,
				'edit' => array(
					'module' => array(
						'name' => 'wizard_edit',
					),
					'type' => 'popup',
					'title' => 'Edit',
					'icon' => 'edit2.gif',
					'popup_onlyOpenIfSelected' => 1,
					'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
				),
				'add' => Array(
					'module' => array(
						'name' => 'wizard_add',
					),
					'type' => 'script',
					'title' => 'Create new',
					'icon' => 'add.gif',
					'params' => array(
						'table' => 'tx_news_domain_model_news',
						'pid' => '###CURRENT_PID###',
						'setValue' => 'prepend'
					),
				),
			),
		),*/
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_news_domain_model_news',$tmp_si_news_columns);

/* inherit and extend the show items from the parent class */

if(isset($GLOBALS['TCA']['tx_news_domain_model_news']['types']['1']['showitem'])) {
	$GLOBALS['TCA']['tx_news_domain_model_news']['types']['Tx_SiNews_News']['showitem'] = $GLOBALS['TCA']['tx_news_domain_model_news']['types']['1']['showitem'];
} elseif(is_array($GLOBALS['TCA']['tx_news_domain_model_news']['types'])) {
	// use first entry in types array
	$tx_news_domain_model_news_type_definition = reset($GLOBALS['TCA']['tx_news_domain_model_news']['types']);
	$GLOBALS['TCA']['tx_news_domain_model_news']['types']['Tx_SiNews_News']['showitem'] = $tx_news_domain_model_news_type_definition['showitem'];
} else {
	$GLOBALS['TCA']['tx_news_domain_model_news']['types']['Tx_SiNews_News']['showitem'] = '';
}
$GLOBALS['TCA']['tx_news_domain_model_news']['types']['Tx_SiNews_News']['showitem'] .= ',--div--;LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_news,';
$GLOBALS['TCA']['tx_news_domain_model_news']['types']['Tx_SiNews_News']['showitem'] .= 'date, subtitle, isbn, issn, edition, yearofpublicaition, channels, news, hrsg, id_author, id_publisher, id_canton, id_adresse, id_informationstype, id_category';

$GLOBALS['TCA']['tx_news_domain_model_news']['columns'][$GLOBALS['TCA']['tx_news_domain_model_news']['ctrl']['type']]['config']['items'][] = array('LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_news_domain_model_news.tx_extbase_type.Tx_SiNews_News','Tx_SiNews_News');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
	'',
	'EXT:/Resources/Private/Language/locallang_csh_.xlf'
);