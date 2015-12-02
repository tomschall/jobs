<?php
namespace In2code\Powermail\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use In2code\Powermail\Domain\Model\Form;
use In2code\Powermail\Domain\Model\Field;
use In2code\Powermail\Domain\Model\Mail;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Alex Kellner <alexander.kellner@in2code.de>, in2code.de
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Basic File Functions
 *
 * @package powermail
 * @license http://www.gnu.org/licenses/lgpl.html
 * 			GNU Lesser General Public License, version 3 or later
 */
class BasicFileUtility {

	/**
	 * Initially rewrite $_FILES array if there are files with same filename
	 *
	 * @return void
	 */
	public static function rewriteFilesArrayToPreventDuplicatFilenames() {
		$names = array();
		if (!empty($_FILES['tx_powermail_pi1']['name']['field'])) {
			foreach ((array) $_FILES['tx_powermail_pi1']['name']['field'] as $marker => $values) {
				foreach ((array) $values as $key => $value) {
					if (in_array($value, $names)) {
						$_FILES['tx_powermail_pi1']['name']['field'][$marker][$key] = self::randomizeFileName($value);
					}
					$names[] = $value;
				}
			}
		}
	}

	/**
	 * Return Unique Filename for File Upload
	 *
	 * @param array $files
	 * @param array $settings
	 * @param bool $addPath
	 * @return array
	 */
	public static function getUniqueNamesForFileUploads($files, $settings, $addPath = TRUE) {
			// stop unique function if there is no $files[0]['tmp_name']
		if (!is_array($files[0])) {
			return $files;
		}

		$destinationPath = $settings['misc']['file']['folder'];
		$randomizedFileName = $settings['misc']['file']['randomizeFileName'];
		$newFileNames = array();
		foreach ((array) $files as $file) {
			if (!empty($file['name'])) {
				$file['name'] = self::getFilenameFromFilesArrayByTempName($file);
				$newFileName = self::getUniqueName($file['name'], $destinationPath, $addPath, $randomizedFileName);
				$newFileNames[] = $newFileName;
			}
		}
		return $newFileNames;
	}

	/**
	 * Get unique/non-existing filename out of a relative path
	 * 		func. replace \TYPO3\CMS\Core\Utility\File\BasicFileUtility::getUniqueName()
	 * 		with endless limit for appending numbers
	 *
	 * @param string $filename
	 * @param string $destinationPath Relative Path to destination
	 * @param bool $addPath
	 * @param bool $randomized
	 * @return string new filename or filenameAndPath
	 */
	public static function getUniqueName($filename, $destinationPath, $addPath = TRUE, $randomized = FALSE) {
		self::cleanFileName($filename);
		self::getAndSetRandomizedFileName($filename, $randomized);
		$absoluteDestinationPath = self::getAbsoluteFolder($destinationPath);
		$fileInfo = GeneralUtility::split_fileref($filename);
		$newFileName = $filename;
		$newPathAndFileName = $absoluteDestinationPath . $fileInfo['file'];

		if (file_exists($newPathAndFileName)) {
			$theTempFileBody = self::removeAppendingNumbersInString($fileInfo['filebody']);
			$extension = $fileInfo['realFileext'] ? '.' . $fileInfo['realFileext'] : '';
			for ($a = 1; TRUE; $a++) {
				$appendix = '_' . sprintf('%02d', $a);
				$newFileName = $theTempFileBody . $appendix . $extension;
				$newPathAndFileName = $absoluteDestinationPath . $newFileName;
				if (!file_exists($newPathAndFileName)) {
					break;
				}
			}
		}

		if ($addPath) {
			return $newPathAndFileName;
		}
		return $newFileName;
	}

	/**
	 * Add _ to filenames that end with _[0-9][0-9]
	 * 		image_12.jpg => image_12_.jpg
	 *
	 * @param string $filename
	 * @return string
	 */
	protected static function dontAllowAppendingNumbersInFileName($filename) {
		$fileParts = pathinfo($filename);
		if ($fileParts['filename'] !== self::removeAppendingNumbersInString($fileParts['filename'])) {
			$filename = $fileParts['filename'] . '_.' . $fileParts['extension'];
		}
		return $filename;
	}

	/**
	 * Get File Upload Values from Unique Name (for File Uploads)
	 * 		array(
	 * 			picture_03.jpg => array(tmp_name => tmp\xazab23, name => picture.jpg)
	 * 			text_01.jpg => array(tmp_name => tmp\89706fa, name => text.jpg)
	 * 		)
	 *
	 * @param string $destinationPath
	 * @return array
	 */
	public static function getFileUploadValuesOutOfUniqueName($destinationPath) {
		$fileArray = array();
		if (isset($_FILES['tx_powermail_pi1']['name']['field'])) {
			foreach (array_keys($_FILES['tx_powermail_pi1']['name']['field']) as $marker) {
				foreach ($_FILES['tx_powermail_pi1']['name']['field'][$marker] as $key => $originalFileName) {
						// switch from original to unique
					$fileArray[self::getUniqueName($originalFileName, $destinationPath, FALSE)] = array(
						'name' => $_FILES['tx_powermail_pi1']['name']['field'][$marker][$key],
						'type' => $_FILES['tx_powermail_pi1']['name']['type'][$marker][$key],
						'tmp_name' => $_FILES['tx_powermail_pi1']['tmp_name']['field'][$marker][$key],
						'error' => $_FILES['tx_powermail_pi1']['error']['field'][$marker][$key],
						'size' => $_FILES['tx_powermail_pi1']['size']['field'][$marker][$key]
					);
				}
			}
		}
		return $fileArray;
	}

	/**
	 * File Upload
	 *
	 * @param string $destinationPath
	 * @param string $allowedFileExtensions
	 * @param Mail $mail
	 * @return bool
	 */
	public static function fileUpload($destinationPath, $allowedFileExtensions = '', Mail $mail) {
		$result = FALSE;
		if (isset($_FILES['tx_powermail_pi1']['tmp_name']['field']) && self::hasFormAnUploadField($mail->getForm())) {
			foreach (array_keys($_FILES['tx_powermail_pi1']['tmp_name']['field']) as $marker) {
				foreach ($_FILES['tx_powermail_pi1']['tmp_name']['field'][$marker] as $key => $tmpName) {
					if (!empty($_FILES['tx_powermail_pi1']['name']['field'][$marker][$key])) {
						$uniqueFileName = self::getUniqueName($_FILES['tx_powermail_pi1']['name']['field'][$marker][$key], $destinationPath);
						if (!self::checkExtension($uniqueFileName, $allowedFileExtensions)) {
							continue;
						}
						$result = GeneralUtility::upload_copy_move($tmpName, $uniqueFileName);
					}
				}
			}
		}
		return $result;
	}

	/**
	 * Is file-extension allowed for uploading?
	 *
	 * @param string $filename Filename like (upload_03.txt)
	 * @param string $allowedFileExtensions
	 * @return bool
	 */
	public static function checkExtension($filename, $allowedFileExtensions = '') {
		$fileInfo = pathinfo($filename);
		if (
			!empty($fileInfo['extension']) &&
			!empty($allowedFileExtensions) &&
			GeneralUtility::inList($allowedFileExtensions, $fileInfo['extension']) &&
			GeneralUtility::verifyFilenameAgainstDenyPattern($filename) &&
			GeneralUtility::validPathStr($filename)
		) {
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Is file size ok?
	 *
	 * @param string $filename Filename like (upload_03.txt)
	 * @param array $settings
	 * @return bool
	 */
	public static function checkFilesize($filename, $settings) {
		$fileUploads = self::getFileUploadValuesOutOfUniqueName($settings['misc.']['file.']['folder']);
		if (filesize($fileUploads[$filename]['tmp_name']) <= $settings['misc.']['file.']['size']) {
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Get all Files from a folder
	 *
	 * @param string $path Relative Path
	 * @return array
	 */
	public static function getFilesFromRelativePath($path) {
		$array = array();
		$files = GeneralUtility::getFilesInDir(
			GeneralUtility::getFileAbsFileName($path)
		);
		foreach ($files as $file) {
			$array[] = $file;
		}
		return $array;
	}

	/**
	 * Check if this form has an upload field
	 *
	 * @param Form $form
	 * @return bool
	 */
	public static function hasFormAnUploadField(Form $form) {
		foreach ($form->getPages() as $page) {
			/** @var Field $field */
			foreach ($page->getFields() as $field) {
				if ($field->getType() === 'file') {
					return TRUE;
				}
			}
		}
		return FALSE;
	}

	/**
	 * Get Randomized Filename and overwrite $_FILES array
	 *
	 * @param string &$filename
	 * @param bool $randomized
	 * @return void
	 */
	public function getAndSetRandomizedFileName(&$filename, $randomized) {
		if (!$randomized) {
			return;
		}
		$newFilename = StringUtility::getRandomString(32, FALSE) . '.' . pathinfo($filename, PATHINFO_EXTENSION);
		if (isset($_FILES['tx_powermail_pi1']['name']['field'])) {
			foreach (array_keys($_FILES['tx_powermail_pi1']['name']['field']) as $marker) {
				foreach ($_FILES['tx_powermail_pi1']['name']['field'][$marker] as $key => $originalFileName) {
					self::cleanFileName($originalFileName);
					if ($originalFileName === $filename) {
						$_FILES['tx_powermail_pi1']['name']['field'][$marker][$key] = $newFilename;
					}
				}
			}
		}
		$filename = $newFilename;
	}

	/**
	 * Return absolute path out of relative path
	 * always with appending slash
	 *
	 * @param string $path relative path
	 * @return string
	 */
	public static function getAbsoluteFolder($path) {
		if (substr($path, -1, 1) !== '/') {
			$path .= '/';
		}
		return GeneralUtility::getFileAbsFileName($path);
	}

	/**
	 * Get filename from $_FILES array from tmp name
	 *
	 * @param array $file
	 * @return string
	 */
	protected static function getFilenameFromFilesArrayByTempName($file) {
		foreach ((array) $_FILES['tx_powermail_pi1']['tmp_name']['field'] as $marker => $values) {
			foreach ((array) $values as $key => $value) {
				if ($value === $file['tmp_name']) {
					return $_FILES['tx_powermail_pi1']['name']['field'][$marker][$key];
				}
			}
		}
		return (string) $file['name'];
	}

	/**
	 * Only allowed a-z, A-Z, 0-9, -, .
	 * Others will be replaced
	 *
	 * @param string &$filename
	 * @param string $replace
	 * @return void
	 */
	public static function cleanFileName(&$filename, $replace = '_') {
		$filename = strtolower(trim($filename));
		$filename = preg_replace('~[^a-z0-9-\.]~', $replace, $filename);
		$filename = self::dontAllowAppendingNumbersInFileName($filename);
	}

	/**
	 * Add a trailing slash to a string (e.g. path)
	 * 		folder1/folder2 => folder1/folder2/
	 * 		folder1/folder2/ => folder1/folder2/
	 *
	 * @param string $string
	 * @return string
	 */
	public static function addTrailingSlash($string) {
		return rtrim($string, '/') . '/';
	}

	/**
	 * Remove appending numbers in filename strings
	 * 		image_01 => image
	 * 		image_01_02 => image_01
	 *
	 * @param $string
	 * @return mixed
	 */
	protected static function removeAppendingNumbersInString($string) {
		return preg_replace('~_\d+$~', '', $string);
	}

	/**
	 * @param string $filename
	 * @return string
	 */
	protected static function randomizeFileName($filename) {
		$fileInfo = pathinfo($filename);
		return StringUtility::getRandomString(8) . '.' . $fileInfo['extension'];
	}
}
