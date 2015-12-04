<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Sozialinfo.' . $_EXTKEY,
	'Jobregistration',
	array(
		'FrontendUser' => 'list, new, preview, create, delete, continue, previous, hydrateFromSession',
		
	),
	// non-cacheable actions
	array(
		'FrontendUser' => 'list, new, preview, create, delete, continue, previous, hydrateFromSession',
		
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Sozialinfo.' . $_EXTKEY,
	'Jobuseradmin',
	array(
		'FrontendUser' => 'new, create, edit, update, deleteConfirm, delete, preview',
		
	),
	// non-cacheable actions
	array(
		'FrontendUser' => 'new, create, edit, update, deleteConfirm, delete, preview',
		
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Sozialinfo.' . $_EXTKEY,
	'Joboffers',
	array(
		'JobOffer' => 'list, new, create, delete',
		
	),
	// non-cacheable actions
	array(
		'JobOffer' => 'list, new, create, delete',
		
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Sozialinfo.' . $_EXTKEY,
	'Jobrequests',
	array(
		'JobRequest' => 'list, new, create',
		
	),
	// non-cacheable actions
	array(
		'JobRequest' => 'list, new, create',
		
	)
);
