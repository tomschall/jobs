<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "fluidcontent_core".
 *
 * Auto generated 22-10-2015 15:05
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
	'title' => 'Fluid Styled Content',
	'description' => 'Not CSS styled content - Fluid styled content',
	'category' => 'fe',
	'version' => '1.2.0',
	'state' => 'beta',
	'uploadfolder' => true,
	'createDirs' => '',
	'clearcacheonload' => true,
	'author' => 'FluidTYPO3 Team',
	'author_email' => 'claus@namelesscoder.net',
	'author_company' => '',
	'constraints' => 
	array (
		'depends' => 
		array (
			'typo3' => '6.2.0-7.4.99',
			'cms' => '',
			'flux' => '7.2.0-7.2.99',
			'vhs' => '2.1.0-2.3.99',
		),
		'conflicts' => 
		array (
			'css_styled_content' => '',
		),
		'suggests' => 
		array (
		),
	),
	'_md5_values_when_last_written' => 'a:0:{}',
);

