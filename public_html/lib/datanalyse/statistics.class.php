<?php
!defined('P_W') && exit('Forbidden');

/**
 * ����ͳ��
 *
 * @package DataAnalyse
 */
class PW_Statistics {
	
	var $_db;
	var $t;
	var $day;
	var $unday;

	function PW_Statistics() {
		$this->__construct();
	}

	function __construct() {
		global $db,$timestamp;
		$this->_db = & $db;
		$this->t   = $timestamp;
		$this->day = get_date($timestamp, 'Y-m-d');
		$this->unday = '0000-00-00';
	}

	function _getDay() {

	}

	function register($num = 1) {
		$this->_add('register', $num, 0, $this->day);
		$this->_add('sexdistribution', $num, 0, $this->unday);
		$this->_add('agedistribution', $num, 0, $this->unday);
	}

	/*ÿ�յ�¼��*/
	function login($uid,$num = 1){
		$this->_add('login', $num, $uid, $this->day);
	}
	
	function photouser($uid, $num = 1) {
		$this->_add('photouser', $num, $uid, $this->day);
	}

	function alertSexDistribution($srcNum, $dstNum) {
		if ($srcNum == $dstNum) {
			return;
		}
		$this->_reduce('sexdistribution', 1, $srcNum, $this->unday);
		$this->_add('sexdistribution', 1, $dstNum, $this->unday);
	}

	function alertAgeDistribution($srcNum, $dstNum) {
		if ($srcNum == $dstNum) {
			return;
		}
		$this->_reduce('agedistribution', 1, $srcNum, $this->unday);
		$this->_add('agedistribution', 1, $dstNum, $this->unday);
	}
	
	/**
	 * ������װʱ��
	 */
	function houseInstallTime() {
		$this->_add('houseinstalltime', 0, 0, $this->unday);
	}
	
	/**
	 * ���̰�װʱ��
	 */
	function dianpuInstallTime() {
		$this->_add('dianpuinstalltime', 0, 0, $this->unday);
	}
	
	/**
	 * ʵ����֤��װʱ��
	 */
	function authInstallTime() {
		$this->_add('authinstalltime', 0, 0, $this->unday);
	}
	
	function addtag($tagids) {
		if (empty($tagids) || !is_array($tagids)) {
			return false;
		}
		foreach ($tagids as $id) {
			$this->_add('tag', 1, $id, $this->day);
		}
	}

	function deletetag($tagids) {
		if (empty($tagids) || !is_array($tagids)) {
			return false;
		}
		foreach ($tagids as $id) {
			$this->_reduce('tag', 1, $id, $this->day);
		}
	}
	
	/**
	 * ����������Ϣ
	 * @return void
	 */
	function updateOnlineInfo(){
		global $tdtime,$timestamp,$userinbbs,$guestinbbs;
		$typeid = pwEscape(get_date($this->t,'G'));
		$date = pwEscape(get_date($this->t,'Y-m-d'));
		$userinbbs = intval($userinbbs);
		$guestinbbs = intval($guestinbbs);
		$this->_db->update(
			"REPLACE INTO `pw_statistics_daily` (`name`,`typeid`,`date`,`value`,`updatetime`)
				VALUES('userinbbs',$typeid,$date,$userinbbs,$this->t),
				('guestinbbs',$typeid,$date,$guestinbbs,$this->t)
			"
		);
	
		$lastday = pwEscape(get_date($tdtime - 86400,'Y-m-d'));
		$this->_db->update("DELETE FROM `pw_statistics_daily` WHERE (name='userinbbs' OR name='guestinbbs') AND `date`<$lastday");
		//$this->_db->update("UPDATE `pw_bbsinfo` SET `last_statistictime`=$this->t WHERE id=1");
		pwQuery::update('pw_bbsinfo', 'id=:id', array(1), array('last_statistictime' => $this->t));
		
		/*����ǰ�յ�¼��*/
		if(procLock('statisticLogin')){
			$query = $this->_db->query(
				"SELECT COUNT(`typeid`) AS `value`,`date` FROM `pw_statistics_daily` 
				WHERE name='login' AND `typeid`>0 AND `date`<'$this->day'
				GROUP BY `date`"
			);
			$logins = array();
			while ($rt = $this->_db->fetch_array($query)) {
				$rt['typeid'] = 0;
				$rt['name'] = 'login';
				$rt['updatetime'] = $timestamp;
				$logins[$rt['date']] = $rt;
			}
			$cnt = count($logins);
			if($cnt > 0){
				$this->_db->update( "REPLACE INTO `pw_statistics_daily` (`value`,`date`,`typeid`,`name`,`updatetime`) VALUE " .pwSqlMulti($logins));
				$this->_db->affected_rows() == $cnt &&
					$this->_db->query("DELETE FROM `pw_statistics_daily` WHERE `name`='login' AND `date`<'$this->day' AND `typeid`>0");
			}
			procUnLock('statisticLogin');
		}
	}
	
	function _reduce($name, $num, $typeid, $date) {
		$num = intval($num);
		$this->_db->update("UPDATE pw_statistics_daily SET value=value-$num,updatetime=" . pwEscape($this->t) . ' WHERE name=' . pwEscape($name) . ' AND typeid=' . pwEscape($typeid) . ' AND date=' . pwEscape($date));
	}
	
	function addByName($name, $num = 1, $typeid = 0) {
      $this->_add($name, $num, $typeid, $this->day);
    }

	function _add($name, $num, $typeid, $date) {
		$num = intval($num);
		$this->_db->pw_update(
			'SELECT * FROM pw_statistics_daily WHERE name=' . pwEscape($name) . ' AND typeid=' . pwEscape($typeid) . ' AND date=' . pwEscape($date),
			"UPDATE pw_statistics_daily SET value=value+$num,updatetime=" . pwEscape($this->t) . ' WHERE name=' . pwEscape($name) . ' AND typeid=' . pwEscape($typeid) . ' AND date=' . pwEscape($date),
			"REPLACE INTO pw_statistics_daily SET " . pwSqlSingle(array(
				'name' => $name,
				'typeid' => $typeid,
				'date' => $date,
				'value' => $num,
				'updatetime' => $this->t
			))
		);
	}
}
?>