<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2009 Markus Blaschke, TEQneers GmbH & Co. KG (blaschke@teqneers.de)
 *  (c) 2007 Jens Mittag (jens.mittag@prime23.de)
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Plugin 'reCAPTCHA' for the 'jm_recaptcha' extension.
 *
 * @author  Markus Blaschke, TEQneers GmbH & Co. KG <blaschke@teqneers.de>
 * @author  Jens Mittag <jens.mittag@prime23.de>
 */
class tx_jmrecaptcha extends \TYPO3\CMS\Frontend\Plugin\AbstractPlugin {
	public $prefixId = 'tx_jmrecaptcha'; // Same as class name
	public $scriptRelPath = 'class.tx_jmrecaptcha.php'; // Path to this script relative to the extension dir.
	public $extKey = 'jm_recaptcha'; // The extension key.

	public $extConf = NULL;

	public $conf;

	/**
	 * @var \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController
	 */
	public $typoscriptFrontendController;

	public function main($content, $conf) {
	}

	/**
	 * Build reCAPTCHA Frontend HTML-Code
	 *
	 * @param  string $error Error Code (optional)
	 * @return  string      reCAPTCHA HTML-Code
	 */
	public function getReCaptcha($error = NULL) {
		$this->pi_loadLL();

		$this->initConfiguration();

		if ($this->conf['captcha_type'] === 'nocaptcha') {
			return $this->renderNoCaptcha();
		} elseif ($this->conf['captcha_type'] === 'recaptcha') {
			return $this->renderReCaptcha($error);
		}
		return NULL;
	}

	protected function initConfiguration() {
		$this->typoscriptFrontendController = $GLOBALS['TSFE'];
		$this->conf = $this->typoscriptFrontendController->tmpl->setup['plugin.']['tx_jmrecaptcha.'];
		if ($this->conf['use_ssl'] || !empty($_SERVER["HTTPS"]) || $_SERVER['SERVER_PORT'] == 443) {
			$this->conf['server'] = rtrim($this->conf['api_server_secure'], '/');
		} else {
			$this->conf['server'] = rtrim($this->conf['api_server'], '/');
		}
	}

	/**
	 * @return string
	 */
	protected function renderNoCaptcha() {
		return '<div class="g-recaptcha" data-sitekey="' . htmlspecialchars($this->conf['public_key']) . '"></div>';
	}

	/**
	 * @param $error
	 * @return string
	 */
	protected function renderReCaptcha($error) {
		// were any errors given in the last query?
		$err_parameter = '';
		if ($error) {
			$err_parameter = '&amp;error=' . $error;
		}

		###############################
		# reCaptcha Options
		###############################

		// Default settings
		$recaptchaOptions = array(
			'lang' => self::jsQuote('en'),
		);

		// Theme
		if (!empty($this->conf['theme'])) {
			$recaptchaOptions['theme'] = self::jsQuote($this->conf['theme']);
		}

		// TabIndex
		if (!empty($this->conf['tabindex'])) {
			$recaptchaOptions['tabindex'] = self::jsQuote($this->conf['tabindex']);
		}

		// TabIndex
		if (!empty($this->conf['custom_theme_widget'])) {
			$recaptchaOptions['custom_theme_widget'] = self::jsQuote($this->conf['custom_theme_widget']);
		}

		// Language detection
		if (!empty($this->conf['lang'])) {
			// language from plugin configuration
			$recaptchaOptions['lang'] = self::jsQuote($this->conf['lang']);
		} elseif (!empty($this->typoscriptFrontendController->tmpl->setup['config.']['language'])) {
			// automatic language detection (TYPO3 settings)
			$recaptchaOptions['lang'] = self::jsQuote($this->typoscriptFrontendController->tmpl->setup['config.']['language']);
		}

		// Custom translations
		$customTranslations = array();

		if (!empty($this->conf['custom_translations.'])) {
			foreach ($this->conf['custom_translations.'] as $translationKey => $translationValue) {
				$customTranslations[] = $translationKey . ' : ' . self::jsQuote($translationValue);
			}
		}
		if (!empty($customTranslations)) {
			$recaptchaOptions['custom_translations'] = ' { ' . implode(',', $customTranslations) . ' } ';
		}


		// Build option string
		$recaptchaOptionsTmp = array();
		foreach ($recaptchaOptions as $optionKey => $optionValue) {
			$recaptchaOptionsTmp[] = $optionKey . ' : ' . $optionValue;
		}
		$recaptchaOptions = implode(', ', $recaptchaOptionsTmp);


		###############################
		# reCaptcha HTML
		###############################
		$content = '<script type="text/javascript">var RecaptchaOptions = { ' . $recaptchaOptions . ' };</script>';
		$content .= '<script type="text/javascript" src="' . htmlspecialchars($this->conf['server'] . '/challenge?k=' . $this->conf['public_key'] . $err_parameter) . '"></script>';
		$content .= '<noscript><iframe class="recaptcha-noscript-frame" src="' . htmlspecialchars($this->conf['server'] . '/noscript?k=' . $this->conf['public_key']) . '" height="300" width="500" frameborder="0"></iframe><br /><p>' . $this->pi_getLL('enter_code_here') . '</p><textarea class="recaptcha-noscript-textarea" name="recaptcha_challenge_field" rows="3" cols="40"></textarea><input type="hidden" name="recaptcha_response_field" value="manual_challenge" /></noscript>';
		return $content;
	}

	/**
	 * Quote js-param-value
	 *
	 * @param  string $value Value
	 * @return  string      Quoted value
	 */
	protected static function jsQuote($value) {
		return '\'' . addslashes((string)$value) . '\'';
	}

	/**
	 * Validate reCAPTCHA challenge/response
	 *
	 * @return array
	 * @throws Exception
	 */
	public function validateReCaptcha() {
		$this->initConfiguration();

		if ($this->conf['captcha_type'] === 'nocaptcha') {
			$data = array(
				'remoteip' => $_SERVER['REMOTE_ADDR'],
				'response' => trim((string)\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('g-recaptcha-response')),
				'secret' => $this->conf['private_key'],
			);
			if (empty($data['response'])) {
				return FALSE;
			}
		} elseif ($this->conf['captcha_type'] === 'recaptcha') {
			$data = array(
				'remoteip' => $_SERVER['REMOTE_ADDR'],
				'challenge' => trim((string)\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('recaptcha_challenge_field')),
				'response' => trim((string)\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('recaptcha_response_field')),
				'privatekey' => $this->conf['private_key'],
			);
			if (empty($data['challenge']) || empty($data['response'])) {
				return FALSE;
			}
		} else {
			throw new \Exception('Invalid captcha_type', 1430388724);
		}

		$result = $this->queryVerificationServer($data);

		if (!$result) {
			return false;
		}

		// depending on the result, return appropriate status object
		$ret = array();
		if ($result[0]) {
			$ret['verified'] = true;
			$ret['error'] = NULL;
		} else {
			$ret['verified'] = false;
			$ret['error'] = $result[1];
		}

		return $ret;
	}

	/**
	 * Query reCAPTCHA server for captcha-verification
	 * @param array $data
	 * @return array Array with verified- (boolean) and error-code (string)
	 * @throws Exception
	 */
	protected function queryVerificationServer($data) {

		// if google as verify server and the old recaptcha type are used, fall back to google's old verification url
		if ($this->conf['verify_server'] === 'https://www.google.com/recaptcha/api/siteverify' && $this->conf['captcha_type'] === 'recaptcha') {
			$this->conf['verify_server'] = 'http://www.google.com/recaptcha/api/verify';
		}

		// find first occurence of '//' inside server string
		$verifyServerInfo = parse_url($this->conf['verify_server']);

		if (empty($verifyServerInfo)) {
			return array(false, 'recaptcha-not-reachable');
		}

		if ($this->conf['captcha_type'] === 'nocaptcha') {
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL, $this->conf['verify_server']);
			curl_setopt($ch,CURLOPT_POST, count($data));
			curl_setopt($ch,CURLOPT_POSTFIELDS, \TYPO3\CMS\Core\Utility\GeneralUtility::implodeArrayForUrl('', $data));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$response = json_decode(curl_exec($ch), TRUE);
			$result = array(
				$response['success'],
				isset($response['error-codes']) ? $response['error-codes'][0] : ''
			);
			curl_close($ch);
		} elseif ($this->conf['captcha_type'] === 'recaptcha') {
			$paramStr = \TYPO3\CMS\Core\Utility\GeneralUtility::implodeArrayForUrl('', $data);
			$ret = \TYPO3\CMS\Core\Utility\GeneralUtility::getURL($this->conf['verify_server'] . '?' . $paramStr);
			$result = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode("\n", $ret);
			$result[0] = $result[0] == 'true';
		} else {
			throw new \Exception('Invalid captcha_type', 1430388724);
		}
		return $result;
	}

	/**
	 * QueryServer encode values
	 *
	 * @param array $data
	 * @return array Encoded data
	 */
	protected static function qsencode($data) {
		$ret = "";

		foreach ($data as $key => $value) {
			$ret .= $key . '=' . urlencode(stripslashes($value)) . '&';
		}

		$ret = rtrim($ret, '&');

		return $ret;
	}

	/**
	 * Get extension configuration (by name)
	 *
	 * @param  string $name Configuration settings name
	 * @param  mixed $defaultValue Default value (if configuration doesn't exists)
	 * @return  mixed
	 */
	protected function getExtConf($name, $defaultValue = NULL) {

		if ($this->extConf === NULL) {
			// Load ext conf
			$this->extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['jm_recaptcha']);
			if (!is_array($this->extConf)) {
				$this->extConf = array();
			}
		}

		$ret = $defaultValue;
		if (!empty($this->extConf[$name])) {
			$ret = $this->extConf[$name];
		}

		return $ret;
	}

}
