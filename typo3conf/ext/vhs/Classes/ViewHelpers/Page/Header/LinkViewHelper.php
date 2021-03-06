<?php
namespace FluidTYPO3\Vhs\ViewHelpers\Page\Header;

/*
 * This file is part of the FluidTYPO3/Vhs project under GPLv2 or later.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use FluidTYPO3\Vhs\Traits\TagViewHelperTrait;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

/**
 * ViewHelper used to render a meta tag
 *
 * @author Georg Ringer
 * @package Vhs
 * @subpackage ViewHelpers\Page\Header
 */
class LinkViewHelper extends AbstractTagBasedViewHelper {

	use TagViewHelperTrait;

	/**
	 * @var    string
	 */
	protected $tagName = 'link';

	/**
	 * Arguments initialization
	 *
	 * @return void
	 */
	public function initializeArguments() {
		$this->registerTagAttribute('rel', 'string', 'Property: rel');
		$this->registerTagAttribute('href', 'string', 'Property: href');
		$this->registerTagAttribute('type', 'string', 'Property: type');
		$this->registerTagAttribute('lang', 'string', 'Property: lang');
		$this->registerTagAttribute('dir', 'string', 'Property: dir');
	}

	/**
	 * Render method
	 *
	 * @return void
	 */
	public function render() {
		if ('BE' === TYPO3_MODE) {
			return;
		}
		$GLOBALS['TSFE']->getPageRenderer()->addMetaTag($this->renderTag($this->tagName));
	}

}
