<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_adresse',
		'label' => 'institution',
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
		'searchFields' => 'institution,category,department,short,displayname,addition,adresse,post_office,postcode,location,p_postcode,p_location,areas_of_work,canton,phone,telefax,email,www,remark,other,datasheet,back_empty,institution_short,facebook,twitter,other_s_m,googleplus,xing,youtube,rss,id_user,id_canton,id_areaofwork,id_education,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('si_news') . 'Resources/Public/Icons/tx_sinews_domain_model_adresse.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, institution, category, department, short, displayname, addition, adresse, post_office, postcode, location, p_postcode, p_location, areas_of_work, canton, phone, telefax, email, www, remark, other, datasheet, back_empty, institution_short, facebook, twitter, other_s_m, googleplus, xing, youtube, rss, id_user, id_canton, id_areaofwork, id_education',
	),
	'types' => array(
		'1' => array('showitem' => 'hidden;;1, id_user, institution, institution_short, displayname, addition, department, adresse,
		post_office, postcode, location, p_postcode, p_location, canton, phone, telefax, email, www, facebook, twitter, googleplus, xing, youtube, rss, other_s_m,category, areas_of_work, id_areaofwork,id_education, id_canton, other, datasheet, back_empty,remark,short,'),
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
				'foreign_table' => 'tx_sinews_domain_model_adresse',
				'foreign_table_where' => 'AND tx_sinews_domain_model_adresse.pid=###CURRENT_PID### AND tx_sinews_domain_model_adresse.sys_language_uid IN (-1,0)',
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

		'institution' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_adresse.institution',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'department' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_adresse.department',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		/*'short' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_adresse.short',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),*/
		'displayname' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_adresse.displayname',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'addition' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_adresse.addition',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'adresse' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_adresse.adresse',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'post_office' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_adresse.post_office',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'postcode' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_adresse.postcode',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'location' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_adresse.location',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'p_postcode' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_adresse.p_postcode',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'p_location' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_adresse.p_location',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		/*'areas_of_work' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_adresse.areas_of_work',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int,required'
			)
		),*/
		'canton' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_adresse.canton',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'tx_sinews_domain_model_canton',
				'items' =>array(
					array('', '0'),
				),
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'phone' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_adresse.phone',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'telefax' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_adresse.telefax',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'email' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_adresse.email',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'www' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_adresse.www',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'remark' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_adresse.remark',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'other' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_adresse.other',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'datasheet' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_adresse.datasheet',
			'config' => array(
				'type' => 'check',
				'default' => 0,
			)
		),
		'back_empty' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_adresse.back_empty',
			'config' => array(
				'type' => 'check',
				'default' => 0,
			)
		),
		'institution_short' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_adresse.institution_short',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'facebook' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_adresse.facebook',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'twitter' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_adresse.twitter',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'other_s_m' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_adresse.other_s_m',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'googleplus' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_adresse.googleplus',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'xing' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_adresse.xing',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'youtube' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_adresse.youtube',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'rss' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_adresse.rss',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		/*'id_user' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_adresse.id_user',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'fe_users',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),*/
		'id_canton' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_adresse.id_canton',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_sinews_domain_model_canton',
				'MM' => 'tx_sinews_adresse_canton_mm',
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
		'category' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_adresse.category',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_sinews_domain_model_category',
				'MM' => 'tx_sinews_adresse_category_mm',
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
							'table' => 'tx_sinews_domain_model_category',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
					),
				),
			)
		),
		'id_areaofwork' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_adresse.id_areaofwork',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_sinews_domain_model_areasofwork',
				'MM' => 'tx_sinews_adresse_areasofwork_mm',
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
							'table' => 'tx_sinews_domain_model_areasofwork',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
					),
				),
			),
		),
		'id_education' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:si_news/Resources/Private/Language/locallang_db.xlf:tx_sinews_domain_model_adresse.id_education',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_sinews_domain_model_education',
				'MM' => 'tx_sinews_adresse_education_mm',
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
							'table' => 'tx_sinews_domain_model_education',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
					),
				),
			),
		),
		
	),
);