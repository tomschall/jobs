<?php
namespace In2code\Powermail\Domain\Service;

use In2code\Powermail\Domain\Model\Mail;
use In2code\Powermail\Domain\Model\Field;
use In2code\Powermail\Utility\StringUtility;
use In2code\Powermail\Utility\TemplateUtility;
use TYPO3\CMS\Core\Mail\MailMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Exception\InvalidActionNameException;
use TYPO3\CMS\Extbase\Mvc\Exception\InvalidControllerNameException;
use TYPO3\CMS\Extbase\Persistence\Generic\QueryResult;
use TYPO3\CMS\Fluid\View\StandaloneView;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Alex Kellner <alexander.kellner@in2code.de>, in2code.de
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
 * Class for generating and sending export files (xls or csv)
 * with scheduler
 *
 * @package powermail
 * @license http://www.gnu.org/licenses/lgpl.html
 * 			GNU Lesser General Public License, version 3 or later
 */
class ExportService {

	/**
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
	 * @inject
	 */
	protected $objectManager = NULL;

	/**
	 * Contains mails for export
	 *
	 * @var null|QueryResult
	 */
	protected $mails = NULL;

	/**
	 * Receiver email addresses
	 *
	 * @var array
	 */
	protected $receiverEmails = array();

	/**
	 * Sender email addresses
	 *
	 * @var array
	 */
	protected $senderEmails = array(
		'powermail@domain.org'
	);

	/**
	 * Mail subject
	 *
	 * @var string
	 */
	protected $subject = '';

	/**
	 * Export format can be 'xls' or 'csv'
	 *
	 * @var string
	 */
	protected $format = 'xls';

	/**
	 * Fields to export
	 * 	Can be empty for all fields
	 * 	can contain:
	 * 		field uids
	 * 		"crdate"
	 * 		"sender_name"
	 * 		"sender_mail"
	 * 		"receiver_mail"
	 * 		"subject"
	 * 		"marketing_referer_domain"
	 * 		"marketing_referer"
	 * 		"marketing_frontend_language"
	 * 		"marketing_browser_language"
	 * 		"marketing_country"
	 * 		"marketing_mobile_device"
	 * 		"marketing_page_funnel"
	 * 		"user_agent"
	 * 		"time"
	 * 		"sender_ip"
	 * 		"uid"
	 * 		"feuser"
	 *
	 * @var array
	 */
	protected $fieldList = array();

	/**
	 * @var string
	 */
	protected $fileName = '';

	/**
	 * @var array
	 */
	protected $additionalProperties = array();

	/**
	 * @var bool
	 */
	protected $addAttachment = TRUE;

	/**
	 * @var string
	 */
	protected $storageFolder = 'typo3temp/tx_powermail/';

	/**
	 * @var string
	 */
	protected $emailTemplate = 'Module/ExportTaskMail.html';

	/**
	 * Constructor
	 *
	 * @param QueryResult $mails Given mails for export
	 * @param string $format can be 'xls' or 'csv'
	 * @param array $additionalProperties add additional properties
	 */
	public function __construct(QueryResult $mails = NULL, $format = 'xls', $additionalProperties = array()) {
		$this->setMails($mails);
		$this->setFormat($format);
		$this->setAdditionalProperties($additionalProperties);
		$this->setFieldList(
			$this->getDefaultFieldListFromFirstMail($mails)
		);
		$this->createRandomFileName();
	}

	/**
	 * send mail
	 *
	 * @return mixed mail send status
	 */
	public function send() {
		$result = $this->createExportFile();
		if (!$result) {
			return 'File could not be generated';
		}
		return $this->sendEmail();
	}

	/**
	 * Send the export mail
	 *
	 * @return bool
	 */
	protected function sendEmail() {
		/** @var MailMessage $email */
		$email = $this->objectManager->get('TYPO3\\CMS\\Core\\Mail\\MailMessage');
		$email->setTo($this->getReceiverEmails());
		$email->setFrom($this->getSenderEmails());
		$email->setSubject($this->getSubject());
		$email->setBody($this->createMailBody());
		$email->setFormat('html');
		if ($this->isAddAttachment()) {
			$email->attach(\Swift_Attachment::fromPath($this->getAbsolutePathAndFileName()));
		}
		$email->send();
		return $email->isSent();
	}

	/**
	 * Create bodytext for export mail
	 *
	 * @return string
	 */
	protected function createMailBody() {
		$standaloneView = TemplateUtility::getDefaultStandAloneView();
		$standaloneView->setTemplatePathAndFilename(GeneralUtility::getFileAbsFileName($this->getEmailTemplate()));
		$standaloneView->setLayoutRootPaths(TemplateUtility::getTemplateFolders('layout'));
		$standaloneView->setPartialRootPaths(TemplateUtility::getTemplateFolders('partial'));
		$standaloneView->assign('export', $this);
		return $standaloneView->render();
	}

	/**
	 * Create an export file
	 *
	 * @return bool if file operation could done successfully
	 */
	protected function createExportFile() {
		if (!is_dir($this->getStorageFolder(TRUE))) {
			GeneralUtility::mkdir($this->getStorageFolder(TRUE));
		}
		return GeneralUtility::writeFile($this->getAbsolutePathAndFileName(), $this->getFileContent(), TRUE);
	}

	/**
	 * Create export file content
	 *
	 * @return string
	 * @throws InvalidActionNameException
	 * @throws InvalidControllerNameException
	 */
	protected function getFileContent() {
		$rootPath = GeneralUtility::getFileAbsFileName('EXT:powermail/Resources/Private/');
		$standaloneView = TemplateUtility::getDefaultStandAloneView();
		$standaloneView->setTemplatePathAndFilename($rootPath . $this->getRelativeTemplatePathAndFileName());
		$standaloneView->setLayoutRootPaths(array($rootPath . 'Layouts'));
		$standaloneView->setPartialRootPaths(array($rootPath . 'Partials'));
		$standaloneView->assignMultiple(
			array(
				'mails' => $this->getMails(),
				'fieldUids' => $this->getFieldList()
			)
		);
		return $standaloneView->render();
	}

	/**
	 * @return string
	 */
	protected function getRelativeTemplatePathAndFileName() {
		return 'Templates/Module/Export' . ucfirst($this->getFormat()) . '.html';
	}

	/**
	 * Get a list with all default fields
	 *
	 * @param QueryResult $mails
	 * @return array
	 */
	protected function getDefaultFieldListFromFirstMail(QueryResult $mails = NULL) {
		$fieldList = array();
		if ($mails !== NULL) {
			/** @var Mail $mail */
			$mail = $mails->getFirst();
			if ($mail !== NULL) {
				foreach ($mail->getForm()->getPages() as $page) {
					/** @var Field $field */
					foreach ($page->getFields() as $field) {
						if ($field->isBasicFieldType()) {
							$fieldList[] = $field->getUid();
						}
					}
				}
			}
		}
		return $fieldList;
	}

	/**
	 * @return QueryResult
	 */
	public function getMails() {
		return $this->mails;
	}

	/**
	 * @param QueryResult $mails
	 * @return ExportService
	 */
	public function setMails($mails) {
		$this->mails = $mails;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getFormat() {
		$allowedFormats = array(
			'xls',
			'csv'
		);
		if (!in_array($this->format, $allowedFormats)) {
			return 'xls';
		}
		return $this->format;
	}

	/**
	 * @param string $format
	 * @return ExportService
	 */
	public function setFormat($format) {
		$this->format = $format;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getFieldList() {
		return $this->fieldList;
	}

	/**
	 * @param string|array $fieldList
	 * @return ExportService
	 */
	public function setFieldList($fieldList) {
		if (!empty($fieldList)) {
			if (is_string($fieldList)) {
				$fieldList = GeneralUtility::trimExplode(',', $fieldList, TRUE);
			}
			$this->fieldList = $fieldList;
		}
		return $this;
	}

	/**
	 * Get an array prepared for mail function
	 * 		array(
	 * 			'mail1@mail.org' => '',
	 * 			'mail2@mail.org' => ''
	 * 		)
	 *
	 * @return array
	 */
	public function getReceiverEmails() {
		$mailArray = array();
		foreach ($this->receiverEmails as $email) {
			$mailArray[$email] = '';
		}
		return $mailArray;
	}

	/**
	 * @param string|array $emails
	 * @return ExportService
	 */
	public function setReceiverEmails($emails) {
		if (is_string($emails)) {
			$emails = GeneralUtility::trimExplode(',', $emails, TRUE);
		}
		$this->receiverEmails = $emails;
		return $this;
	}

	/**
	 * Get an array prepared for mail function
	 * 		array(
	 * 			'mail1@mail.org' => 'Sender',
	 * 			'mail2@mail.org' => 'Sender'
	 * 		)
	 *
	 * @return array
	 */
	public function getSenderEmails() {
		$mailArray = array();
		foreach ($this->senderEmails as $email) {
			$mailArray[$email] = 'Sender';
		}
		return $mailArray;
	}

	/**
	 * @param array $senderEmails
	 * @return ExportService
	 */
	public function setSenderEmails($senderEmails) {
		if (is_string($senderEmails)) {
			$senderEmails = GeneralUtility::trimExplode(',', $senderEmails, TRUE);
		}
		$this->senderEmails = $senderEmails;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getSubject() {
		return $this->subject;
	}

	/**
	 * @param string $subject
	 * @return ExportService
	 */
	public function setSubject($subject) {
		$this->subject = $subject;
		return $this;
	}

	/**
	 * Create a random filename
	 *
	 * @return void
	 */
	protected function createRandomFileName() {
		/**
		 * Note:
		 * 		GeneralUtility::writeFileToTypo3tempDir()
		 * 		allows only filenames which are max 59 characters long
		 */
		$fileName = StringUtility::getRandomString(55);
		$fileName .= '.';
		$fileName .= $this->getFormat();
		$this->fileName = $fileName;
	}

	/**
	 * @return string
	 */
	public function getFileName() {
		return $this->fileName;
	}

	/**
	 * Set a user defined filename
	 *
	 * @param string $fileName
	 * @return ExportService
	 */
	public function setFileName($fileName = NULL) {
		if ($fileName) {
			$this->fileName = $fileName . '.' . $this->getFormat();
		}
		return $this;
	}

	/**
	 * Get relative path and filename
	 *
	 * @return string
	 */
	public function getRelativePathAndFileName() {
		return $this->getStorageFolder() . $this->getFileName();
	}

	/**
	 * Get absolute path and filename
	 *
	 * @return string
	 */
	public function getAbsolutePathAndFileName() {
		return GeneralUtility::getFileAbsFileName($this->getRelativePathAndFileName());
	}

	/**
	 * @return array
	 */
	public function getAdditionalProperties() {
		return $this->additionalProperties;
	}

	/**
	 * @param array $additionalProperties
	 * @return ExportService
	 */
	public function setAdditionalProperties($additionalProperties) {
		$this->additionalProperties = $additionalProperties;
		return $this;
	}

	/**
	 * @param string $additionalProperty
	 * @param string $propertyName
	 * @return void
	 */
	public function addAdditionalProperty($additionalProperty, $propertyName) {
		$this->additionalProperties[$propertyName] = $additionalProperty;
	}

	/**
	 * @return boolean
	 */
	public function isAddAttachment() {
		return $this->addAttachment;
	}

	/**
	 * @param boolean $addAttachment
	 * @return ExportService
	 */
	public function setAddAttachment($addAttachment) {
		$this->addAttachment = $addAttachment;
		return $this;
	}

	/**
	 * @param bool $absolute
	 * @return string
	 */
	public function getStorageFolder($absolute = FALSE) {
		$storageFolder = $this->storageFolder;
		if ($absolute) {
			$storageFolder = GeneralUtility::getFileAbsFileName($storageFolder);
		}
		return $storageFolder;
	}

	/**
	 * @param string $storageFolder
	 * @return ExportService
	 */
	public function setStorageFolder($storageFolder) {
		$this->storageFolder = $storageFolder;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getEmailTemplate() {
		return $this->emailTemplate;
	}

	/**
	 * @param string $emailTemplate
	 * @return ExportService
	 */
	public function setEmailTemplate($emailTemplate) {
		if (!empty($emailTemplate)) {
			$this->emailTemplate = $emailTemplate;
		}
		return $this;
	}
}