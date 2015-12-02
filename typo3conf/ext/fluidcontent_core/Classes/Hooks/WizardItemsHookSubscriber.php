<?php
namespace FluidTYPO3\FluidcontentCore\Hooks;

/*
 * This file is part of the FluidTYPO3/FluidcontentCore project under GPLv2 or later.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use TYPO3\CMS\Backend\Controller\ContentElement\NewContentElementController;
use TYPO3\CMS\Backend\Wizard\NewContentElementWizardHookInterface;

/**
 * WizardItems Hook Subscriber
 */
class WizardItemsHookSubscriber extends \FluidTYPO3\Fluidcontent\Hooks\WizardItemsHookSubscriber implements NewContentElementWizardHookInterface {

	/**
	 * @param array $items
	 * @param NewContentElementController $parentObject
	 * @return void
	 */
	public function manipulateWizardItems(&$items, &$parentObject) {
		parent::manipulateWizardItems($items, $parentObject);
		unset($items['common_textpic']);
	}
}
