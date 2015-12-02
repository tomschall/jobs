<?php
namespace FluidTYPO3\FluidcontentCore\UserFunction;

/*
 * This file is part of the FluidTYPO3/FluidcontentCore project under GPLv2 or later.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use FluidTYPO3\FluidcontentCore\Provider\CoreContentProvider;
use FluidTYPO3\FluidcontentCore\Service\ConfigurationService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Object\ObjectManagerInterface;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Variants Field TCA user function
 */
class ProviderField {

	/**
	 * @var ObjectManagerInterface
	 */
	protected $objectManager;

	/**
	 * @var ConfigurationService
	 */
	protected $configurationService;

	/**
	 * @param ObjectManagerInterface $objectManager
	 * @reutrn void
	 */
	public function injectObjectManager(ObjectManagerInterface $objectManager) {
		$this->objectManager = $objectManager;
	}

	/**
	 * @param ConfigurationService $configurationService
	 * @return void
	 */
	public function injectConfigurationService(ConfigurationService $configurationService) {
		$this->configurationService = $configurationService;
	}

	/**
	 * Constructor
	 */
	public function __construct() {
		/** @var ObjectManager $objectManager */
		$objectManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
		$this->injectObjectManager($objectManager);
		/** @var ConfigurationService $configurationService */
		$configurationService = $this->objectManager->get('FluidTYPO3\FluidcontentCore\Service\ConfigurationService');
		$this->injectConfigurationService($configurationService);
	}

	/**
	 * @param array $parameters
	 * @return string
	 */
	public function createVariantsField(array $parameters) {
		$extensionKeys = $this->configurationService->getVariantExtensionKeysForContentType($parameters['row']['CType']);
		$defaults = $this->configurationService->getDefaults();
		$preSelected = $parameters['row']['content_variant'];
		if (CoreContentProvider::MODE_PRESELECT === $defaults['mode'] && TRUE === empty($preSelected)) {
			$preSelected = $defaults['variant'];
		}
		if (TRUE === is_array($extensionKeys) && 0 < count($extensionKeys)) {
			$options = $this->renderOptions($extensionKeys);
		} else {
			$options = array();
		}
		return $this->renderSelectField($parameters, $options, $preSelected);
	}

	/**
	 * @param array $variants
	 * @return array
	 */
	protected function renderOptions(array $variants) {
		$options = array();
		foreach ($variants as $variantSetup) {
			list ($extensionKey, $labelReference, $icon) = $variantSetup;
			$translatedLabel = LocalizationUtility::translate($labelReference, $extensionKey);
			if (NULL === $translatedLabel) {
				$translatedLabel = $extensionKey;
			}
			$optionsIcon = '<img src="' . $icon . '" alt="' . $extensionKey . '" /> ';
			$options[$extensionKey] = array($optionsIcon, $translatedLabel);
		}
		return $options;
	}

	/**
	 * @param array $parameters
	 * @param array $options
	 * @param mixed $selectedValue
	 * @return string
	 */
	protected function renderSelectField($parameters, $options, $selectedValue) {
		$optionsIcons = array();
		$optionsLabels = array();
		$selectedIcon = '<img alt="" src="" />';
		foreach ($options as $extensionKey => $optionsSetup) {
			list($optionsIcons[$extensionKey], $optionsLabels[$extensionKey]) = $optionsSetup;
		}
		$hasSelectedValue = (TRUE === empty($selectedValue) || TRUE === array_key_exists($selectedValue, $optionsLabels));
		$selected = (TRUE === empty($selectedValue) ? ' selected="selected"' : NULL);
		foreach ($optionsIcons as $value => $img) {
			if ($value === $selectedValue) {
				$selectedIcon = $img;
				break;
			}
		}
		$html = array(
			'<div class="form-control-wrap"><div class="input-group"><div class="input-group-addon input-group-icon">' . $selectedIcon . '</div><select class="select form-control" name="' . $parameters['itemFormElName'] . '" onchange="' . $parameters['fieldChangeFunc']['TBE_EDITOR_fieldChanged'] . ';' . $parameters['fieldChangeFunc']['alert'] . '">',
			'<option' . $selected . ' value="">' . LocalizationUtility::translate('tt_content.nativeLabel', 'FluidcontentCore') . '</option>'
		);
		foreach ($optionsLabels as $value => $label) {
			$selected = $value === $selectedValue ? ' selected="selected"' : NULL;
			$html[] = '<option' . $selected . ' value="' . $value . '">' . $label . '</option>';
		}
		if (FALSE === $hasSelectedValue) {
			$html[] = '<option selected="selected">INVALID: ' . $selectedValue . '</option>';
		}
		$html[] = '</select></div></div>';
		return implode(LF, $html);
	}

	/**
	 * @param array $parameters
	 * @return string
	 */
	public function createVersionsField(array $parameters) {
		$options = array();
		$defaults = $this->configurationService->getDefaults();
		$preSelectedVariant = $parameters['row']['content_variant'];
		$preSelectedVersion = $parameters['row']['content_version'];
		if (CoreContentProvider::MODE_PRESELECT === $defaults['mode']) {
			if (TRUE === empty($preSelectedVariant)) {
				$preSelectedVariant = $defaults['variant'];
			}
			if (TRUE === empty($preSelectedVersion)) {
				$preSelectedVersion = $defaults['version'];
			}
		}

		$versions = $this->configurationService->getVariantVersions($parameters['row']['CType'], $preSelectedVariant);
		if (TRUE === is_array($versions) && 0 < count($versions)) {
			foreach ($versions as $version) {
				$icon = $this->configurationService->getIconFromVersion($preSelectedVariant, $parameters['row']['CType'], $version);
				$versionIcon = '<img src="' . $icon . '" alt="" /> ';
				$options[$version] = array($versionIcon, $version);
			}
		}
		return $this->renderSelectField($parameters, $options, $preSelectedVersion);
	}

}
