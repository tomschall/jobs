<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest',
		'label' => 'start_date',
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
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'start_date,end_date,percent_of,percent_up,job_title,entry_date,entry_agreement,entry_immediately,job_location,job_description,contact_to,email_to,postal_addres_equal_to_registration_address,postal_address_title,postal_address_first_name,postal_address_name,postal_address_additive,postal_address_street_nr,postal_address_po_box,postal_address_zip,postal_address_city,number_days_publication,publication_date,comments,delete_date,deleted_how,use_agreements,request_is_german,request_is_french,request_is_italian,employment_relationship,position,qualification,areas_of_work,advertisement_type,canton,region,postal_address_country,type_of_institution,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('jobs') . 'Resources/Public/Icons/tx_jobs_domain_model_jobrequest.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, start_date, end_date, percent_of, percent_up, job_title, entry_date, entry_agreement, entry_immediately, job_location, job_description, contact_to, email_to, postal_addres_equal_to_registration_address, postal_address_title, postal_address_first_name, postal_address_name, postal_address_additive, postal_address_street_nr, postal_address_po_box, postal_address_zip, postal_address_city, number_days_publication, publication_date, comments, delete_date, deleted_how, use_agreements, request_is_german, request_is_french, request_is_italian, employment_relationship, position, qualification, areas_of_work, advertisement_type, canton, region, postal_address_country, type_of_institution',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, start_date, end_date, percent_of, percent_up, job_title, entry_date, entry_agreement, entry_immediately, job_location, job_description, contact_to, email_to, postal_addres_equal_to_registration_address, postal_address_title, postal_address_first_name, postal_address_name, postal_address_additive, postal_address_street_nr, postal_address_po_box, postal_address_zip, postal_address_city, number_days_publication, publication_date, comments, delete_date, deleted_how, use_agreements, request_is_german, request_is_french, request_is_italian, employment_relationship, position, qualification, areas_of_work, advertisement_type, canton, region, postal_address_country, type_of_institution, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
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
				'foreign_table' => 'tx_jobs_domain_model_jobrequest',
				'foreign_table_where' => 'AND tx_jobs_domain_model_jobrequest.pid=###CURRENT_PID### AND tx_jobs_domain_model_jobrequest.sys_language_uid IN (-1,0)',
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
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),

		'start_date' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.start_date',
			'config' => array(
				'dbType' => 'datetime',
				'type' => 'input',
				'size' => 12,
				'eval' => 'datetime,required',
				'checkbox' => 0,
				'default' => '0000-00-00 00:00:00'
			),
		),
		'end_date' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.end_date',
			'config' => array(
				'dbType' => 'datetime',
				'type' => 'input',
				'size' => 12,
				'eval' => 'datetime,required',
				'checkbox' => 0,
				'default' => '0000-00-00 00:00:00'
			),
		),
		'percent_of' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.percent_of',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'percent_up' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.percent_up',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'job_title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.job_title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'entry_date' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.entry_date',
			'config' => array(
				'dbType' => 'datetime',
				'type' => 'input',
				'size' => 12,
				'eval' => 'datetime,required',
				'checkbox' => 0,
				'default' => '0000-00-00 00:00:00'
			),
		),
		'entry_agreement' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.entry_agreement',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'entry_immediately' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.entry_immediately',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'job_location' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.job_location',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'job_description' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.job_description',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'contact_to' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.contact_to',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'email_to' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.email_to',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'postal_addres_equal_to_registration_address' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.postal_addres_equal_to_registration_address',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'postal_address_title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.postal_address_title',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'postal_address_first_name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.postal_address_first_name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'postal_address_name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.postal_address_name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'postal_address_additive' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.postal_address_additive',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'postal_address_street_nr' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.postal_address_street_nr',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'postal_address_po_box' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.postal_address_po_box',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'postal_address_zip' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.postal_address_zip',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'postal_address_city' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.postal_address_city',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'number_days_publication' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.number_days_publication',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'publication_date' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.publication_date',
			'config' => array(
				'dbType' => 'datetime',
				'type' => 'input',
				'size' => 12,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => '0000-00-00 00:00:00'
			),
		),
		'comments' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.comments',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'delete_date' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.delete_date',
			'config' => array(
				'dbType' => 'datetime',
				'type' => 'input',
				'size' => 12,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => '0000-00-00 00:00:00'
			),
		),
		'deleted_how' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.deleted_how',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'use_agreements' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.use_agreements',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'request_is_german' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.request_is_german',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'request_is_french' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.request_is_french',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'request_is_italian' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.request_is_italian',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'employment_relationship' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.employment_relationship',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'tx_jobs_domain_model_employmentrelationship',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'position' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.position',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'tx_jobs_domain_model_position',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'qualification' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.qualification',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_jobs_domain_model_qualification',
				'MM' => 'tx_jobs_jobrequest_qualification_mm',
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
							'table' => 'tx_jobs_domain_model_qualification',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
					),
				),
			),
		),
		'areas_of_work' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.areas_of_work',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_jobs_domain_model_areasofwork',
				'MM' => 'tx_jobs_jobrequest_areasofwork_mm',
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
							'table' => 'tx_jobs_domain_model_areasofwork',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
					),
				),
			),
		),
		'advertisement_type' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.advertisement_type',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'tx_jobs_domain_model_advertisementtype',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'canton' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.canton',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_jobs_domain_model_canton',
				'MM' => 'tx_jobs_jobrequest_canton_mm',
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
							'table' => 'tx_jobs_domain_model_canton',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
					),
				),
			),
		),
		'region' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.region',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_jobs_domain_model_region',
				'MM' => 'tx_jobs_jobrequest_region_mm',
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
							'table' => 'tx_jobs_domain_model_region',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
					),
				),
			),
		),
		'postal_address_country' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.postal_address_country',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'tx_jobs_domain_model_country',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'type_of_institution' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_jobrequest.type_of_institution',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_jobs_domain_model_typeofinstitution',
				'MM' => 'tx_jobs_jobrequest_typeofinstitution_mm',
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
							'table' => 'tx_jobs_domain_model_typeofinstitution',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
					),
				),
			),
		),
		
		'frontenduser' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
	),
);