<?php
namespace FluidTYPO3\FluidcontentCore\Tests\Fixtures\Service;

/*
 * This file is part of the FluidTYPO3/FluidcontentCore project under GPLv2 or later.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use FluidTYPO3\FluidcontentCore\Service\ConfigurationService;

/**
 * Class AccessibleConfigurationService
 */
class AccessibleConfigurationService extends ConfigurationService {

	/**
	 * @var array
	 */
	protected $registeredVariants = array();

	/**
	 * @var array
	 */
	protected $viewConfiguration = array();

	/**
	 * @param array $forcedVariants
	 * @return void
	 */
	public function setRegisteredVariants(array $forcedVariants) {
		$this->registeredVariants = $forcedVariants;
	}

	/**
	 * @return array
	 */
	public function getAllRegisteredVariants() {
		return $this->registeredVariants;
	}

	/**
	 * @return void
	 */
	public function initializeVariants() {
		parent::initializeVariants();
	}

	/**
	 * @param array $variants
	 * @return void
	 */
	public function setVariants(array $variants) {
		$this->variants = $variants;
	}

	/**
	 * @return array
	 */
	public function getVariants() {
		return $this->variants;
	}

	/**
	 * @param array $versions
	 * @return void
	 */
	public function setVersions(array $versions) {
		$this->versions = $versions;
	}

	/**
	 * @return array
	 */
	public function getVersions() {
		return $this->versions;
	}

	/**
	 * @param array $defaults
	 * @return void
	 */
	public function setDefaults(array $defaults) {
		$this->defaults = $defaults;
	}

	/**
	 * @param string $extensionName
	 * @return array
	 */
	public function getViewConfigurationForExtensionName($extensionName) {
		return $this->viewConfiguration;
	}

	/**
	 * @param array $viewConfiguration
	 * @return void
	 */
	public function setViewConfiguration(array $viewConfiguration) {
		$this->viewConfiguration = $viewConfiguration;
	}

}
