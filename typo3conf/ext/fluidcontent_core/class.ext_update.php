<?php

/*
 * This file is part of the FluidTYPO3/FluidcontentCore project under GPLv2 or later.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

/**
 * Updater Script for fluidcontent_core
 *
 * @package FluidcontentCore
 */
// @codingStandardsIgnoreStart
class ext_update {

	/**
	 * @var string
	 */
	protected $sourceConfigurationLines = array(
		'$GLOBALS[\'TYPO3_CONF_VARS\'][\'FE\'][\'contentRenderingTemplates\'] = array(\'fluidcontentcore/Configuration/TypoScript/\');',
		'$GLOBALS[\'TYPO3_CONF_VARS\'][\'FE\'][\'activateContentAdapter\'] = 0;'
	);

	/**
	 * @var string
	 */
	protected $targetConfigurationFile = 'typo3conf/AdditionalConfiguration.php';

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->targetConfigurationFile = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($this->targetConfigurationFile);
	}

	/**
	 * @return array
	 */
	protected function getCurrentConfigurationLines() {
		if (FALSE === file_exists($this->targetConfigurationFile)) {
			// We return not a completely empty array but an array containing the
			// expected opening PHP tag; to make sure it ends up in the output.
			return array('<?php');
		}
		$lines = explode(PHP_EOL, trim(file_get_contents($this->targetConfigurationFile)));
		if (0 === count($lines) || '<?php' !== $lines[0]) {
			array_unshift($lines, '<?php');
		}
		return $lines;
	}

	/**
	 * Returns TRUE if either of the expected configuration lines
	 * do not currently exist. If both exist, returns FALSE
	 * meaning "no need to run the script"
	 *
	 * @return boolean
	 */
	public function access() {
		$currentConfiguration = $this->getCurrentConfigurationLines();
		foreach ($this->sourceConfigurationLines as $expectedConfigurationLine) {
			if (FALSE === in_array($expectedConfigurationLine, $currentConfiguration)) {
				return TRUE;
			}
		}
		return FALSE;
	}

	/**
	 * @return string
	 */
	public function main() {
		$this->installAdditionalConfiguration();
		return 'Additional configuration lines added to AdditionalConfiguration.php';
	}

	/**
	 * Install expected lines missing from AdditionalConfiguration file
	 *
	 * @return void
	 */
	protected function installAdditionalConfiguration() {
		$currentConfigurationLines = $this->getCurrentConfigurationLines();
		// remove trailing empty spaces and closing PHP tag to ensure predictable appending:
		for ($i = count($currentConfigurationLines) - 1; $i--; $i >= 0) {
			$line = trim($currentConfigurationLines[$i]);
			if (TRUE === empty($line) || '?>' === $line) {
				unset($currentConfigurationLines[$i]);
			}
		}
		// add expected lines if they are not found:
		foreach ($this->sourceConfigurationLines as $expectedConfigurationLine) {
			if (FALSE === in_array($expectedConfigurationLine, $currentConfigurationLines)) {
				$currentConfigurationLines[] = $expectedConfigurationLine;
			}
		}
		$this->writeAdditionalConfigurationFile($currentConfigurationLines);
	}

	/**
	 * Wrapping method to write array to file
	 *
	 * @param array $lines
	 * @return void
	 */
	protected function writeAdditionalConfigurationFile(array $lines) {
		$content = implode(PHP_EOL, $lines) . PHP_EOL;
		file_put_contents($this->targetConfigurationFile, $content);
	}

}
