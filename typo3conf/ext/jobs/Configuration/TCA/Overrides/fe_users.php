<?php

if (!isset($GLOBALS['TCA']['fe_users']['ctrl']['type'])) {
	if (file_exists($GLOBALS['TCA']['fe_users']['ctrl']['dynamicConfigFile'])) {
		require_once($GLOBALS['TCA']['fe_users']['ctrl']['dynamicConfigFile']);
	}
	// no type field defined, so we define it here. This will only happen the first time the extension is installed!!
	$GLOBALS['TCA']['fe_users']['ctrl']['type'] = 'tx_extbase_type';
	$tempColumnstx_jobs_fe_users = array();
	$tempColumnstx_jobs_fe_users[$GLOBALS['TCA']['fe_users']['ctrl']['type']] = array(
		'exclude' => 1,
		'label'   => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs.tx_extbase_type',
		'config' => array(
			'type' => 'select',
			'renderType' => 'selectSingle',
			'items' => array(
				array('CompanyFrontendUser','Tx_Jobs_CompanyFrontendUser')
			),
			'default' => 'Tx_Jobs_CompanyFrontendUser',
			'size' => 1,
			'maxitems' => 1,
		)
	);
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users', $tempColumnstx_jobs_fe_users, 1);
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
	'fe_users',
	$GLOBALS['TCA']['fe_users']['ctrl']['type'],
	'',
	'after:' . $GLOBALS['TCA']['fe_users']['ctrl']['label']
);

/***************************
 ** Company Frontend User **
 ***************************/

$tmp_jobs_columns = array(

	'is_frontend_admin' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_companyfrontenduser.is_frontend_admin',
		'config' => array(
			'type' => 'check',
			'default' => 0
		)
	),
	'additive' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_companyfrontenduser.additive',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	),
	'department' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_companyfrontenduser.department',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	),
	'po_box' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_companyfrontenduser.po_box',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	),
	'corporate' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_companyfrontenduser.corporate',
		'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
			'corporate',array(
				'maxitems' => 1,
				'appearance' => array(
					'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference'
				),
				// custom configuration for displaying fields in the overlay/reference table
				// to use the imageoverlayPalette instead of the basicoverlayPalette
				'foreign_match_fields' => array(
					'fieldname' => 'corporate',
					'tablenames' => 'fe_users',
					'table_local' => 'sys_file',
				),
				'foreign_types' => array(
					'0' => array(
						'showitem' => '
						--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
						--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => array(
						'showitem' => '
						--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
						--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => array(
						'showitem' => '
						--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
						--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => array(
						'showitem' => '
						--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
						--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => array(
						'showitem' => '
						--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
						--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => array(
						'showitem' => '
						--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
						--palette--;;filePalette'
					)
				)
			),
			$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
		),
	),
	'documents' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_companyfrontenduser.documents',
		'config' => 
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
			'documents',
			array('maxitems' => 3,
				'appearance' => array(
					'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:media.addFileReference'
				),
				// custom configuration for displaying fields in the overlay/reference table
				// to use the imageoverlayPalette instead of the basicoverlayPalette
				'foreign_match_fields' => array(
					'fieldname' => 'documents',
					'tablenames' => 'fe_users',
					'table_local' => 'sys_file',
				),
				'foreign_types' => array(
					'0' => array(
						'showitem' => '
						--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
						--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => array(
						'showitem' => '
						--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
						--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => array(
						'showitem' => '
						--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
						--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => array(
						'showitem' => '
						--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
						--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => array(
						'showitem' => '
						--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
						--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => array(
						'showitem' => '
						--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
						--palette--;;filePalette'
					)
				)
			)
		),

	),
	'country' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_companyfrontenduser.country',
		'config' => array(
			'type' => 'select',
			'renderType' => 'selectSingle',
			'foreign_table' => 'tx_jobs_domain_model_country',
			'minitems' => 0,
			'maxitems' => 1,
		),
	),
	'insos_member' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_companyfrontenduser.insos_member',
		'config' => array(
			'type' => 'select',
			'renderType' => 'selectSingle',
			'foreign_table' => 'tx_jobs_domain_model_insosmember',
			'minitems' => 0,
			'maxitems' => 1,
		),
	),
	'sozialinfo_member' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_companyfrontenduser.sozialinfo_member',
		'config' => array(
			'type' => 'select',
			'renderType' => 'selectSingle',
			'foreign_table' => 'tx_jobs_domain_model_sozialinfomember',
			'minitems' => 0,
			'maxitems' => 1,
		),
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users',$tmp_jobs_columns);

/* inherit and extend the show items from the parent class */

if(isset($GLOBALS['TCA']['fe_users']['types']['0']['showitem'])) {
	$GLOBALS['TCA']['fe_users']['types']['Tx_Jobs_CompanyFrontendUser']['showitem'] = $GLOBALS['TCA']['fe_users']['types']['0']['showitem'];
} elseif(is_array($GLOBALS['TCA']['fe_users']['types'])) {
	// use first entry in types array
	$fe_users_type_definition = reset($GLOBALS['TCA']['fe_users']['types']);
	$GLOBALS['TCA']['fe_users']['types']['Tx_Jobs_CompanyFrontendUser']['showitem'] = $fe_users_type_definition['showitem'];
} else {
	$GLOBALS['TCA']['fe_users']['types']['Tx_Jobs_CompanyFrontendUser']['showitem'] = '';
}
$GLOBALS['TCA']['fe_users']['types']['Tx_Jobs_CompanyFrontendUser']['showitem'] .= ',--div--;LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_companyfrontenduser,';
$GLOBALS['TCA']['fe_users']['types']['Tx_Jobs_CompanyFrontendUser']['showitem'] .= 'is_frontend_admin, additive, department, po_box, corporate, documents, country, insos_member, sozialinfo_member';

$GLOBALS['TCA']['fe_users']['columns'][$GLOBALS['TCA']['fe_users']['ctrl']['type']]['config']['items'][] = array('LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:fe_users.tx_extbase_type.Tx_Jobs_CompanyFrontendUser','Tx_Jobs_CompanyFrontendUser');



/***************************
 ****** Frontend User ******
 ***************************/


$tmp_jobs_columns = array(

	'salutation' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_frontenduser.salutation',
		'config' => array (
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => array (
                        array('LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_frontenduser.salutation.options.I.0', '0'),
                        array('LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_frontenduser.salutation.options.I.1', '1'),
                ),
                'size' => 1,
                'maxitems' => 1,
        )
	),
	'additive' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_frontenduser.additive',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	),
	'department' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_frontenduser.department',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	),
	'po_box' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_frontenduser.po_box',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	),
	'mobilephone' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_frontenduser.mobilephone',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	),
	'corporate' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_frontenduser.corporate',
		'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
			'corporate',
			array('maxitems' => 1,
				'appearance' => array(
					'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference'
				),
				// custom configuration for displaying fields in the overlay/reference table
				// to use the imageoverlayPalette instead of the basicoverlayPalette
				'foreign_match_fields' => array(
					'fieldname' => 'corporate',
					'tablenames' => 'fe_users',
					'table_local' => 'sys_file',
				),
				'foreign_types' => array(
					'0' => array(
						'showitem' => '
						--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
						--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => array(
						'showitem' => '
						--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
						--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => array(
						'showitem' => '
						--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
						--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => array(
						'showitem' => '
						--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
						--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => array(
						'showitem' => '
						--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
						--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => array(
						'showitem' => '
						--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
						--palette--;;filePalette'
					)
				)
			),
			$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
		),
	),
	'documents' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_frontenduser.documents',
		'config' => 
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
			'documents',
			array('maxitems' => 3,
				'appearance' => array(
					'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:media.addFileReference'
				),
				// custom configuration for displaying fields in the overlay/reference table
				// to use the imageoverlayPalette instead of the basicoverlayPalette
				'foreign_match_fields' => array(
					'fieldname' => 'documents',
					'tablenames' => 'fe_users',
					'table_local' => 'sys_file',
				),
				'foreign_types' => array(
					'0' => array(
						'showitem' => '
						--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
						--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => array(
						'showitem' => '
						--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
						--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => array(
						'showitem' => '
						--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
						--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => array(
						'showitem' => '
						--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
						--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => array(
						'showitem' => '
						--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
						--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => array(
						'showitem' => '
						--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
						--palette--;;filePalette'
					)
				)
			)
		),

	),
	'job_offers' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_frontenduser.job_offers',
		'config' => array(
			'type' => 'inline',
			'foreign_table' => 'tx_jobs_domain_model_joboffer',
			'foreign_field' => 'frontenduser',
			'maxitems'      => 9999,
			'appearance' => array(
				'collapseAll' => 0,
				'levelLinksPosition' => 'top',
				'showSynchronizationLink' => 1,
				'showPossibleLocalizationRecords' => 1,
				'useSortable' => 1,
				'showAllLocalizationLink' => 1
			),
		),

	),
	'job_requests' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_frontenduser.job_requests',
		'config' => array(
			'type' => 'inline',
			'foreign_table' => 'tx_jobs_domain_model_jobrequest',
			'foreign_field' => 'frontenduser',
			'maxitems'      => 9999,
			'appearance' => array(
				'collapseAll' => 0,
				'levelLinksPosition' => 'top',
				'showSynchronizationLink' => 1,
				'showPossibleLocalizationRecords' => 1,
				'useSortable' => 1,
				'showAllLocalizationLink' => 1
			),
		),

	),
	'country' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_frontenduser.country',
		'config' => array(
			'type' => 'select',
			'renderType' => 'selectSingle',
			'foreign_table' => 'tx_jobs_domain_model_country',
			'minitems' => 0,
			'maxitems' => 1,
		),
	),
	'company_frontend_user' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_frontenduser.company_frontend_user',
		'config' => array(
			'type' => 'select',
			'renderType' => 'selectSingle',
			'foreign_table' => 'fe_users',
			'minitems' => 0,
			'maxitems' => 1,
		),
	),
	'insos_member' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_frontenduser.insos_member',
		'config' => array(
			'type' => 'select',
			'renderType' => 'selectSingle',
			'foreign_table' => 'tx_jobs_domain_model_insosmember',
			'minitems' => 0,
			'maxitems' => 1,
		),
	),
	'sozialinfo_member' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_frontenduser.sozialinfo_member',
		'config' => array(
			'type' => 'select',
			'renderType' => 'selectSingle',
			'foreign_table' => 'tx_jobs_domain_model_sozialinfomember',
			'minitems' => 0,
			'maxitems' => 1,
		),
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users',$tmp_jobs_columns);

/* inherit and extend the show items from the parent class */

if(isset($GLOBALS['TCA']['fe_users']['types']['0']['showitem'])) {
	$GLOBALS['TCA']['fe_users']['types']['Tx_Jobs_FrontendUser']['showitem'] = $GLOBALS['TCA']['fe_users']['types']['0']['showitem'];
} elseif(is_array($GLOBALS['TCA']['fe_users']['types'])) {
	// use first entry in types array
	$fe_users_type_definition = reset($GLOBALS['TCA']['fe_users']['types']);
	$GLOBALS['TCA']['fe_users']['types']['Tx_Jobs_FrontendUser']['showitem'] = $fe_users_type_definition['showitem'];
} else {
	$GLOBALS['TCA']['fe_users']['types']['Tx_Jobs_FrontendUser']['showitem'] = '';
}
$GLOBALS['TCA']['fe_users']['types']['Tx_Jobs_FrontendUser']['showitem'] .= ',--div--;LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:tx_jobs_domain_model_frontenduser,';
$GLOBALS['TCA']['fe_users']['types']['Tx_Jobs_FrontendUser']['showitem'] .= 'salutation, additive, department, po_box, mobilephone, corporate, documents, job_offers, job_requests, country, company_frontend_user, insos_member, sozialinfo_member';

$GLOBALS['TCA']['fe_users']['columns'][$GLOBALS['TCA']['fe_users']['ctrl']['type']]['config']['items'][] = array('LLL:EXT:jobs/Resources/Private/Language/locallang_db.xlf:fe_users.tx_extbase_type.Tx_Jobs_FrontendUser','Tx_Jobs_FrontendUser');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
	'',
	'EXT:/Resources/Private/Language/locallang_csh_.xlf'
);