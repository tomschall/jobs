<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Sozialinfo.' . $_EXTKEY,
	'Jobregistration',
	array(
		'FrontendUser' => 'list, new, preview, create, show, delete, continue, previous, hydrateFromSession, edit, update, cancel',
	),
	// non-cacheable actions
	array(
		'FrontendUser' => 'list, new, preview, create, show, delete, continue, previous, hydrateFromSession, edit, update, cancel',
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Sozialinfo.' . $_EXTKEY,
	'Jobuseradmin',
	array(
		'FrontendUser' => 'listUserSpecificData, editData, updateData',
	),
	// non-cacheable actions
	array(
		'FrontendUser' => 'listUserspecificData, editData, updateData',
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Sozialinfo.' . $_EXTKEY,
	'Joboffers',
	array(
		'JobOffer' => 'list, listUserSpecificData, new, create, delete, edit, continueEdit, previousEdit, hydrateEditFromSession, show, continue, previous, hydrateFromSession, cancel, cancelEdit',
	),
	// non-cacheable actions
	array(
		'JobOffer' => 'list, listUserSpecificData, new, create, delete, edit, continueEdit, previousEdit, hydrateEditFromSession, show, continue, previous, hydrateFromSession, cancel, cancelEdit',
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Sozialinfo.' . $_EXTKEY,
	'Jobrequests',
	array(
		'JobRequest' => 'list, new, create, delete, edit, continueEdit, previousEdit, hydrateEditFromSession, show, continue, previous, hydrateFromSession, cancel, cancelEdit',
	),
	// non-cacheable actions
	array(
		'JobRequest' => 'list, new, create, delete, edit, continueEdit, previousEdit, hydrateEditFromSession, show, continue, previous, hydrateFromSession, cancel, cancelEdit',
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerTypeConverter('Sozialinfo\\Jobs\\Property\\TypeConverter\\UploadedFileReferenceConverter');
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerTypeConverter('Sozialinfo\\Jobs\\Property\\TypeConverter\\ObjectStorageConverter');
