<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_informationstype',
		'label' => 'informationstype',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',

		),
		'searchFields' => 'informationstype,definition,validity,media,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('si_news') . 'Resources/Public/Icons/tx_sinews_domain_model_informationstype.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, informationstype, definition, validity, media',
	),
	'types' => array(
		'1' => array('showitem' => 'hidden;;1, informationstype, definition, validity, media, '),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
	
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_sinews_domain_model_informationstype',
				'foreign_table_where' => 'AND tx_sinews_domain_model_informationstype.pid=###CURRENT_PID### AND tx_sinews_domain_model_informationstype.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),

		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
	
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),

		'informationstype' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_informationstype.informationstype',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'definition' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_informationstype.definition',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			)
		),
		'validity' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_informationstype.validity',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int,required'
			)
		),
		/*'media' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_informationstype.media',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int,required'
			)
		),*/
		
		'news' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
	),
);