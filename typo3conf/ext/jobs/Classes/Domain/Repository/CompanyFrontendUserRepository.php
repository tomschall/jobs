<?php
namespace Sozialinfo\Jobs\Domain\Repository;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Thomas Schallert <programmierung@sozialinfo.ch>, Sozialinfo
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
 * The repository for CompanyFrontendUsers
 */
class CompanyFrontendUserRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	protected $defaultOrderings = array('uid' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING);

	/**
	* @param mixed $arguments
	* @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	*/
	public function findCompanyFrontendUser($arguments,$count=FALSE) {
		
		$query = $this->createQuery();
		$query->matching(
			$query->logicalAnd(
				$query->equals('username', $arguments['frontendUser']['sozialinfoMemberUsername'], $caseSensitive = TRUE),
				$query->equals('password', $arguments['frontendUser']['sozialinfoMemberPassword'], $caseSensitive = TRUE),
				$query->equals('tx_extbase_type', 'Tx_Jobs_CompanyFrontendUser', $caseSensitive = TRUE)
			)
		);
		
		if($count == TRUE){
			return $query->count();	
		}else{
			return $query->execute();	
		}
		
	}

}