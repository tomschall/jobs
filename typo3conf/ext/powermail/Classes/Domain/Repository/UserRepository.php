<?php
namespace In2code\Powermail\Domain\Repository;

use In2code\Powermail\Domain\Model\User;
use TYPO3\CMS\Extbase\Persistence\Repository;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 in2code GmbH <info@in2code.de>, in2code.de
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
 * UserRepository
 *
 * @package powermail
 * @license http://www.gnu.org/licenses/lgpl.html
 * 			GNU Lesser General Public License, version 3 or later
 */
class UserRepository extends Repository {

	/**
	 * Find FE_Users by their group
	 *
	 * @param int $uid fe_groups UID
	 * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
	 */
	public function findByUsergroup($uid) {
		$query = $this->createQuery();
		$query->getQuerySettings()->setRespectStoragePage(FALSE);

		$query->matching(
			$query->contains('usergroup', $uid)
		);

		return $query->execute();
	}

	/**
	 * Find by Uid but don't respect storage page
	 *
	 * @param int $uid
	 * @return User
	 */
	public function findByUid($uid) {
		$query = $this->createQuery();
		$query->getQuerySettings()->setRespectStoragePage(FALSE);
		$query->matching(
			$query->equals('uid', $uid)
		);
		return $query->execute()->getFirst();
	}

	/**
	 * Return usergroups uid of a given fe_user
	 *
	 * @param string $uid FE_user UID
	 * @return array Usergroups
	 */
	public function getUserGroupsFromUser($uid) {
		$groups = array();
		$select = 'fe_groups.uid';
		$from = 'fe_users, fe_groups, sys_refindex';
		$where = 'sys_refindex.tablename = "fe_users"';
		$where .= ' AND sys_refindex.ref_table = "fe_groups"';
		$where .= ' AND fe_users.uid = sys_refindex.recuid AND fe_groups.uid = sys_refindex.ref_uid';
		$where .= ' AND fe_users.uid = ' . intval($uid);
		$groupBy = '';
		$orderBy = '';
		$limit = 1000;
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($select, $from, $where, $groupBy, $orderBy, $limit);
		if ($res) {
			// One loop for every entry
			while (($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res))) {
				$groups[] = $row['uid'];
			}
		}

		return $groups;
	}
}