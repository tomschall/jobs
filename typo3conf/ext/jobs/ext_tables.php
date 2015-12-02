<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'Sozialinfo.' . $_EXTKEY,
	'Jobregistration',
	'Jobs - Registration'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'Sozialinfo.' . $_EXTKEY,
	'Jobuseradmin',
	'Jobs - User Administration'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'Sozialinfo.' . $_EXTKEY,
	'Joboffers',
	'Jobs - Offers'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'Sozialinfo.' . $_EXTKEY,
	'Jobrequests',
	'Jobs - Requests'
);

if (TYPO3_MODE === 'BE') {

	/**
	 * Registers a Backend Module
	 */
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'Sozialinfo.' . $_EXTKEY,
		'web',	 // Make module a submodule of 'web'
		'adminjoboffers',	// Submodule key
		'',						// Position
		array(
			'FrontendUser' => 'list, show, new, create, edit, update, delete, preview, deleteConfirm','JobOffer' => 'list, show, new, create, edit, update, delete, confirmDelete, preview','JobRequest' => 'list, show, new, create, edit, update, delete, confirmDelete, preview','CompanyFrontendUser' => 'list, show, new, create, edit, update, delete',
		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_adminjoboffers.xlf',
		)
	);

	/**
	 * Registers a Backend Module
	 */
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'Sozialinfo.' . $_EXTKEY,
		'web',	 // Make module a submodule of 'web'
		'adminjobrequests',	// Submodule key
		'',						// Position
		array(
			'FrontendUser' => 'list, show, new, create, edit, update, delete, preview, deleteConfirm','JobOffer' => 'list, show, new, create, edit, update, delete, confirmDelete, preview','JobRequest' => 'list, show, new, create, edit, update, delete, confirmDelete, preview','CompanyFrontendUser' => 'list, show, new, create, edit, update, delete',
		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_adminjobrequests.xlf',
		)
	);

	/**
	 * Registers a Backend Module
	 */
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'Sozialinfo.' . $_EXTKEY,
		'web',	 // Make module a submodule of 'web'
		'adminfrontendusers',	// Submodule key
		'',						// Position
		array(
			'FrontendUser' => 'list, show, new, create, edit, update, delete, preview, deleteConfirm','JobOffer' => 'list, show, new, create, edit, update, delete, confirmDelete, preview','JobRequest' => 'list, show, new, create, edit, update, delete, confirmDelete, preview','CompanyFrontendUser' => 'list, show, new, create, edit, update, delete',
		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_adminfrontendusers.xlf',
		)
	);

	/**
	 * Registers a Backend Module
	 */
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'Sozialinfo.' . $_EXTKEY,
		'web',	 // Make module a submodule of 'web'
		'admincompanyfrontendusers',	// Submodule key
		'',						// Position
		array(
			'FrontendUser' => 'list, show, new, create, edit, update, delete, preview, deleteConfirm','JobOffer' => 'list, show, new, create, edit, update, delete, confirmDelete, preview','JobRequest' => 'list, show, new, create, edit, update, delete, confirmDelete, preview','CompanyFrontendUser' => 'list, show, new, create, edit, update, delete',
		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_admincompanyfrontendusers.xlf',
		)
	);

}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Job Platform');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_jobs_domain_model_joboffer', 'EXT:jobs/Resources/Private/Language/locallang_csh_tx_jobs_domain_model_joboffer.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_jobs_domain_model_joboffer');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_jobs_domain_model_jobrequest', 'EXT:jobs/Resources/Private/Language/locallang_csh_tx_jobs_domain_model_jobrequest.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_jobs_domain_model_jobrequest');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_jobs_domain_model_employmentrelationship', 'EXT:jobs/Resources/Private/Language/locallang_csh_tx_jobs_domain_model_employmentrelationship.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_jobs_domain_model_employmentrelationship');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_jobs_domain_model_position', 'EXT:jobs/Resources/Private/Language/locallang_csh_tx_jobs_domain_model_position.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_jobs_domain_model_position');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_jobs_domain_model_qualification', 'EXT:jobs/Resources/Private/Language/locallang_csh_tx_jobs_domain_model_qualification.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_jobs_domain_model_qualification');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_jobs_domain_model_areasofwork', 'EXT:jobs/Resources/Private/Language/locallang_csh_tx_jobs_domain_model_areasofwork.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_jobs_domain_model_areasofwork');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_jobs_domain_model_advertisementtype', 'EXT:jobs/Resources/Private/Language/locallang_csh_tx_jobs_domain_model_advertisementtype.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_jobs_domain_model_advertisementtype');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_jobs_domain_model_canton', 'EXT:jobs/Resources/Private/Language/locallang_csh_tx_jobs_domain_model_canton.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_jobs_domain_model_canton');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_jobs_domain_model_country', 'EXT:jobs/Resources/Private/Language/locallang_csh_tx_jobs_domain_model_country.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_jobs_domain_model_country');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_jobs_domain_model_region', 'EXT:jobs/Resources/Private/Language/locallang_csh_tx_jobs_domain_model_region.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_jobs_domain_model_region');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_jobs_domain_model_insosmember', 'EXT:jobs/Resources/Private/Language/locallang_csh_tx_jobs_domain_model_insosmember.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_jobs_domain_model_insosmember');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_jobs_domain_model_typeofinstitution', 'EXT:jobs/Resources/Private/Language/locallang_csh_tx_jobs_domain_model_typeofinstitution.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_jobs_domain_model_typeofinstitution');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_jobs_domain_model_sozialinfomember', 'EXT:jobs/Resources/Private/Language/locallang_csh_tx_jobs_domain_model_sozialinfomember.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_jobs_domain_model_sozialinfomember');
