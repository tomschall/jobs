<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Si News');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_sinews_domain_model_adresse', 'EXT:si_news/Resources/Private/Language/locallang_csh_tx_sinews_domain_model_adresse.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_sinews_domain_model_adresse');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_sinews_domain_model_authors', 'EXT:si_news/Resources/Private/Language/locallang_csh_tx_sinews_domain_model_authors.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_sinews_domain_model_authors');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_sinews_domain_model_informationstype', 'EXT:si_news/Resources/Private/Language/locallang_csh_tx_sinews_domain_model_informationstype.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_sinews_domain_model_informationstype');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_sinews_domain_model_canton', 'EXT:si_news/Resources/Private/Language/locallang_csh_tx_sinews_domain_model_canton.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_sinews_domain_model_canton');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_sinews_domain_model_category', 'EXT:si_news/Resources/Private/Language/locallang_csh_tx_sinews_domain_model_category.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_sinews_domain_model_category');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_sinews_domain_model_country', 'EXT:si_news/Resources/Private/Language/locallang_csh_tx_sinews_domain_model_country.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_sinews_domain_model_country');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_sinews_domain_model_media', 'EXT:si_news/Resources/Private/Language/locallang_csh_tx_sinews_domain_model_media.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_sinews_domain_model_media');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_sinews_domain_model_periodicals', 'EXT:si_news/Resources/Private/Language/locallang_csh_tx_sinews_domain_model_periodicals.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_sinews_domain_model_periodicals');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_sinews_domain_model_publisher', 'EXT:si_news/Resources/Private/Language/locallang_csh_tx_sinews_domain_model_publisher.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_sinews_domain_model_publisher');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_sinews_domain_model_education', 'EXT:si_news/Resources/Private/Language/locallang_csh_tx_sinews_domain_model_education.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_sinews_domain_model_education');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_sinews_domain_model_range', 'EXT:si_news/Resources/Private/Language/locallang_csh_tx_sinews_domain_model_range.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_sinews_domain_model_range');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_sinews_domain_model_edcuationlevel', 'EXT:si_news/Resources/Private/Language/locallang_csh_tx_sinews_domain_model_edcuationlevel.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_sinews_domain_model_edcuationlevel');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_sinews_domain_model_offer', 'EXT:si_news/Resources/Private/Language/locallang_csh_tx_sinews_domain_model_offer.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_sinews_domain_model_offer');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_sinews_domain_model_degree', 'EXT:si_news/Resources/Private/Language/locallang_csh_tx_sinews_domain_model_degree.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_sinews_domain_model_degree');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_sinews_domain_model_areasofwork', 'EXT:si_news/Resources/Private/Language/locallang_csh_tx_sinews_domain_model_areasofwork.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_sinews_domain_model_areasofwork');


## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:si_news/Configuration/TSconfig/news_modify.ts">');


$ll = 'LLL:EXT:news/Resources/Private/Language/locallang_db.xlf:';

$GLOBALS['TCA']['tx_news_domain_model_news']['columns']['type'] = array(
	'exclude' => 1,
	'label'   => 'Si News',
	'config' => array(
		'type' => 'select',
		'renderType' => 'selectSingle',
		'items' => array(
			array('Si News','Tx_SiNews_News')
		),
		'size' => 1,
		'maxitems' => 1,
		'default' => 'Tx_SiNews_News',
	),
);

$GLOBALS['TCA']['tx_news_domain_model_news']['types']['Tx_SiNews_News']['columnsOverrides'] = [ 'bodytext' => [
	'defaultExtras' => 'richtext:rte_transform[mode=ts_css]'
	],
];

$GLOBALS['TCA']['tx_news_domain_model_news']['types']['Tx_SiNews_News']['showitem'] = 'l10n_parent, l10n_diffsource,
				hidden,id_informationstype,	channels,datetime,archive,title,subtitle,bodytext;LLL:EXT:cms/locallang_ttc.xlf:rte_enabled_formlabel,content_elements,	externalurl,
				--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
					--palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.access;paletteAccess,

				--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.tabs.options,categories,tags,
				--div--;' . $ll . 'tx_news_domain_model_news.tabs.relations,media,related_files,related_links,related,related_from,
				--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.tabs.metadata,
					--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.palettes.metatags;metatags,
					--palette--;' . $ll . 'tx_news_domain_model_news.palettes.alternativeTitles;alternativeTitles,
				--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.tabs.extended,';

$GLOBALS['TCA']['tx_news_domain_model_news']['types']['Tx_SiNews_News']['showitem'] .= '--div--;LLL:EXT:si_news/Resources/Private/Language/locallang.xlf:tx_sinews_domain_model_news.tabauthor,';
$GLOBALS['TCA']['tx_news_domain_model_news']['types']['Tx_SiNews_News']['showitem'] .= 'id_adresse, id_author, hrsg, id_publisher, isbn, issn, edition, yearofpublicaition,';
$GLOBALS['TCA']['tx_news_domain_model_news']['types']['Tx_SiNews_News']['showitem'] .= '--div--;LLL:EXT:si_news/Resources/Private/Language/locallang.xlf:tx_sinews_domain_model_news.tabspecification,';
$GLOBALS['TCA']['tx_news_domain_model_news']['types']['Tx_SiNews_News']['showitem'] .= 'id_canton, id_category,date,keywords';