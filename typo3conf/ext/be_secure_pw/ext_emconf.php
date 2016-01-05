<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "be_secure_pw".
 *
 * Auto generated 21-12-2015 15:30
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
  'title' => 'Make BE user password really secure',
  'description' => 'You can set password conventions to force secure passwords for BE users. Works with rsa auth and salted passwords!',
  'category' => 'be',
  'version' => '7.0.2',
  'state' => 'stable',
  'createDirs' => '',
  'author' => 'Thomas Loeffler',
  'author_email' => 'loeffler@spooner-web.de',
  'author_company' => '',
  'constraints' => 
  array (
    'depends' => 
    array (
      'typo3' => '6.0.0-7.99.99',
    ),
    'conflicts' => 
    array (
    ),
    'suggests' => 
    array (
    ),
  ),
  'uploadfolder' => false,
  'clearcacheonload' => false,
);

