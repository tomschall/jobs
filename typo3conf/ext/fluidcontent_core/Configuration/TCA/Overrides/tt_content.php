<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes'] = array_merge(
	$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes'],
	array(
		'image' => 'mimetypes-x-content-image',
		'text' => 'mimetypes-x-content-text'
	)
);
$GLOBALS['TCA']['tt_content']['ctrl']['typeicons'] = array_merge(
	$GLOBALS['TCA']['tt_content']['ctrl']['typeicons'],
	array(
		'image' => 'tt_content_image.gif',
		'text' => 'tt_content.gif'
	)
);
array_splice(
	$GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items'],
	2,
	0,
	array(
		array(
			'LLL:EXT:cms/locallang_ttc.xlf:CType.I.1',
			'text',
			'i/tt_content.gif'
		),
		array(
			'LLL:EXT:cms/locallang_ttc.xlf:CType.I.3',
			'image',
			'i/tt_content_image.gif'
		)
	)
);

$GLOBALS['TCA']['tt_content']['palettes'] = array_replace(
	$GLOBALS['TCA']['tt_content']['palettes'],
	array(
		'10' => array(
			'showitem' => '
                                table_bgColor,
                                table_border,
                                table_cellspacing,
                                table_cellpadding
                        '
		),
		'header' => array(
			'showitem' => '
                                header;LLL:EXT:cms/locallang_ttc.xlf:header_formlabel,
                                --linebreak--,
                                header_layout;LLL:EXT:cms/locallang_ttc.xlf:header_layout_formlabel,
                                header_position;LLL:EXT:cms/locallang_ttc.xlf:header_position_formlabel,
                                date;LLL:EXT:cms/locallang_ttc.xlf:date_formlabel,
                                --linebreak--,
                                header_link;LLL:EXT:cms/locallang_ttc.xlf:header_link_formlabel
                        ',
			'canNotCollapse' => 1
		),
		'headers' => array(
			'showitem' => '
                                header;LLL:EXT:cms/locallang_ttc.xlf:header_formlabel,
                                --linebreak--,
                                header_layout;LLL:EXT:cms/locallang_ttc.xlf:header_layout_formlabel,
                                header_position;LLL:EXT:cms/locallang_ttc.xlf:header_position_formlabel,
                                date;LLL:EXT:cms/locallang_ttc.xlf:date_formlabel,
                                --linebreak--,
                                header_link;LLL:EXT:cms/locallang_ttc.xlf:header_link_formlabel,
                                --linebreak--,
                                subheader;LLL:EXT:cms/locallang_ttc.xlf:subheader_formlabel
                        ',
			'canNotCollapse' => 1
		),
		'visibility' => array(
			'showitem' => '
                                hidden;LLL:EXT:cms/locallang_ttc.xlf:hidden_formlabel,
                                sectionIndex;LLL:EXT:cms/locallang_ttc.xlf:sectionIndex_formlabel,
                                linkToTop;LLL:EXT:cms/locallang_ttc.xlf:linkToTop_formlabel
                        ',
			'canNotCollapse' => 1
		),
		'frames' => array(
			'showitem' => '
                                content_options;Options
                        ',
			'canNotCollapse' => 1
		)
	)
);

$GLOBALS['TCA']['tt_content']['types']['header']['showitem'] = '
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.general;general,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.headers;headers,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.frames;frames,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.visibility;visibility,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.access;access,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.extended
';

$GLOBALS['TCA']['tt_content']['types']['text']['showitem'] = '
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.general;general,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.header;header,
                bodytext;LLL:EXT:cms/locallang_ttc.xlf:bodytext_formlabel;;richtext:rte_transform[flag=rte_enabled|mode=ts_css],
                rte_enabled;LLL:EXT:cms/locallang_ttc.xlf:rte_enabled_formlabel,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.frames;frames,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.visibility;visibility,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.access;access,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.extended
';

$GLOBALS['TCA']['tt_content']['types']['image']['showitem'] = '
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.general;general,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.header;header,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.images,
                image,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.imagelinks;imagelinks,
	    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
		        --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.visibility;visibility,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.access;access,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.extended
';

$GLOBALS['TCA']['tt_content']['types']['bullets']['showitem'] = '
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.general;general,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.header;header,
                bodytext;LLL:EXT:cms/locallang_ttc.xlf:bodytext.ALT.bulletlist_formlabel;;nowrap,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.frames;frames,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.visibility;visibility,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.access;access,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.extended
';

$GLOBALS['TCA']['tt_content']['types']['table']['showitem'] = '
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.general;general,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.header;header,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:CType.I.5,
                layout;;10,
                cols,
                bodytext;;9;nowrap:wizards[table],
                pi_flexform,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.table_layout;tablelayout,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.frames;frames,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.visibility;visibility,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.access;access,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.extended
';

$GLOBALS['TCA']['tt_content']['types']['uploads']['showitem'] = '
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.general;general,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.header;header,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:media;uploads,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.uploads_layout;uploadslayout,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.frames;frames,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.visibility;visibility,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.access;access,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.extended
';

$GLOBALS['TCA']['tt_content']['types']['menu']['showitem'] = '
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.general;general,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.header;header,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.menu;menu,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.menu_accessibility;menu_accessibility,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.frames;frames,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.visibility;visibility,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.access;access,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.extended
';

$GLOBALS['TCA']['tt_content']['types']['shortcut']['showitem'] = '
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.general;general,
                header;LLL:EXT:cms/locallang_ttc.xlf:header.ALT.shortcut_formlabel,
                records;LLL:EXT:cms/locallang_ttc.xlf:records_formlabel,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.frames;frames,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.visibility;visibility,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.access;access,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.extended
';

$GLOBALS['TCA']['tt_content']['types']['list']['showitem'] = '
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.general;general,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.header;header,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.plugin,
                list_type;LLL:EXT:cms/locallang_ttc.xlf:list_type_formlabel,
                select_key;LLL:EXT:cms/locallang_ttc.xlf:select_key_formlabel,
                pages;LLL:EXT:cms/locallang_ttc.xlf:pages.ALT.list_formlabel,
                recursive,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.frames;frames,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.visibility;visibility,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.access;access,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.extended
';

$GLOBALS['TCA']['tt_content']['types']['div']['showitem'] = '
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.general;general,
                header;LLL:EXT:cms/locallang_ttc.xlf:header.ALT.div_formlabel,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.visibility;visibility,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.access;access,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.extended
';

$GLOBALS['TCA']['tt_content']['types']['html']['showitem'] = '
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.general;general,
                header;LLL:EXT:cms/locallang_ttc.xlf:header.ALT.html_formlabel,
                bodytext,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.frames;frames,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.visibility;visibility,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.access;access,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.extended
';

$GLOBALS['TCA']['tt_content']['columns']['pi_flexform']['label'] = NULL;
$GLOBALS['TCA']['tt_content']['columns']['content_options'] = array(
	'label' => NULL,
	'config' => array(
		'type' => 'flex'
	)
);
$GLOBALS['TCA']['tt_content']['columns']['content_variant'] = array(
	'label' => 'LLL:EXT:fluidcontent_core/Resources/Private/Language/locallang.xlf:tt_content.content_variant',
	'exclude' => 1,
	'config' => array(
		'type' => 'user',
		'userFunc' => 'FluidTYPO3\FluidcontentCore\UserFunction\ProviderField->createVariantsField',
	)
);
$GLOBALS['TCA']['tt_content']['columns']['content_version'] = array(
	'label' => 'LLL:EXT:fluidcontent_core/Resources/Private/Language/locallang.xlf:tt_content.content_version',
	'exclude' => 1,
	'config' => array(
		'type' => 'user',
		'userFunc' => 'FluidTYPO3\FluidcontentCore\UserFunction\ProviderField->createVersionsField',
	)
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('tt_content', 'general', 'content_variant, content_version', 'after:CType');


$GLOBALS['TCA']['tt_content']['palettes']['header']['showitem'] = 'header';
$GLOBALS['TCA']['tt_content']['palettes']['headers']['showitem'] = 'header';
$GLOBALS['TCA']['tt_content']['columns']['header']['label'] = NULL;
$GLOBALS['TCA']['tt_content']['ctrl']['requestUpdate'] .= ',content_variant,content_version';

unset(
	$GLOBALS['TCA']['tt_content']['types']['swfobject'],
	$GLOBALS['TCA']['tt_content']['types']['qtobject'],
	$GLOBALS['TCA']['tt_content']['types']['multimedia'],
	$GLOBALS['TCA']['tt_content']['types']['mailform'],
	$GLOBALS['TCA']['tt_content']['types']['search'],
	$GLOBALS['TCA']['tt_content']['types']['textpic'],
	$GLOBALS['TCA']['tt_content']['columns']['text_properties'],
	$GLOBALS['TCA']['tt_content']['columns']['text_align'],
	$GLOBALS['TCA']['tt_content']['columns']['text_color'],
	$GLOBALS['TCA']['tt_content']['columns']['text_face'],
	$GLOBALS['TCA']['tt_content']['columns']['text_size'],
	$GLOBALS['TCA']['tt_content']['columns']['image_compression'],
	$GLOBALS['TCA']['tt_content']['columns']['image_effects'],
	$GLOBALS['TCA']['tt_content']['columns']['image_frames'],
	$GLOBALS['TCA']['tt_content']['columns']['image_zoom'],
	$GLOBALS['TCA']['tt_content']['columns']['imageborder'],
	$GLOBALS['TCA']['tt_content']['columns']['linkToTop'],
	$GLOBALS['TCA']['tt_content']['columns']['accessibility_title'],
	$GLOBALS['TCA']['tt_content']['columns']['accessibility_bypass'],
	$GLOBALS['TCA']['tt_content']['columns']['accessibility_bypass_text'],
	$GLOBALS['TCA']['tt_content']['columns']['table_bgColor'],
	$GLOBALS['TCA']['tt_content']['columns']['table_border'],
	$GLOBALS['TCA']['tt_content']['columns']['table_cellspacing'],
	$GLOBALS['TCA']['tt_content']['columns']['table_cellpadding'],
	$GLOBALS['TCA']['tt_content']['columns']['category_field'],
	$GLOBALS['TCA']['tt_content']['palettes']['imageblock'],
	$GLOBALS['TCA']['tt_content']['palettes']['imagelinks'],
	$GLOBALS['TCA']['tt_content']['palettes']['image_accessibility'],
	$GLOBALS['TCA']['tt_content']['palettes']['table']
);

foreach ($GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items'] as $index => $item) {
	if ($item[1] === 'textpic') {
		unset($GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items'][$index]);
	}
};
unset($index, $item);
