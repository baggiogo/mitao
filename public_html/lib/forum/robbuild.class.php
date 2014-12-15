<?php
! function_exists ( 'readover' ) && exit ( 'Forbidden' );

/**
 * ��¥��
 */

class PW_RobBuild {
	var $data;
	var $timestamp;
	
	function PW_RobBuild() {
		global $timestamp;
		$this->timestamp = $timestamp;
		$this->data = array(
			'tid'			=> 0,
			'authorid'		=> 0,
			'starttime'		=> 0,
			'endtime'		=> 0,
			'endbuild'		=> 0,
			'awardbuilds'	=> 0,
			'postdate'		=> 0,		
		);
	}
	
	function getByTid($tid) {
		$tid = intval($tid);
		if ($tid < 1) return false;
		$robBuilddao = $this->_getRobBuildDB();
		return $robBuilddao->get($tid);
	}

	function insert($data) {
		if (!S::isArray($data)) return false;
		$robBuilddao = $this->_getRobBuildDB();
		return $robBuilddao->add($data);
	}
	
	function update($fieldsData, $tid) {
		$tid = intval($tid);
		if ($tid < 1 || ! S::isArray($fieldsData)) return false;
		$robBuilddao = $this->_getRobBuildDB();
		return $robBuilddao->update($fieldsData, $tid);
	}
	
	function delete($tid) {
		$tid = intval($tid);
		if ($tid < 1) return false;
		$robBuilddao = $this->_getRobBuildDB();
		return $robBuilddao->delete($tid);
	}
	
	
	/**
	 * ����tids����ɾ
	 * 
	 * @param array $tids
	 * @return bool 
	 */
	function deleteByTids($tids) {
		if (! S::isArray($tids)) return false;
		$robBuilddao = $this->_getRobBuildDB();
		return $robBuilddao->deleteByTids($tids);
	}
	
	function setRobPostFloor($pid,$floor,$tid) {
		$pid = intval($pid);
		$tid = intval($tid);
		$floor = intval($floor);
		if ($pid < 1 || $tid < 1 || $floor < 1) return false;
		$robBuildFloordao = $this->_getRobBuildFloorDB();
		return $robBuildFloordao->setRobPostFloor($tid,$floor,$pid);
	}
	
	function getRobedCountByTid($tid) {
		$tid = intval($tid);
		if ($tid < 1) return false;
		$robBuildFloordao = $this->_getRobBuildFloorDB();
		return $robBuildFloordao->get($tid);
	}
	
	function getFloorsByPids($pids) {
		if (! S::isArray($pids)) return array();
		$robBuildFloordao = $this->_getRobBuildFloorDB();
		return (array)$robBuildFloordao->getFloorsByPids($pids);
	}
	
	function _getRobBuildDB() {
		return L::loadDB ('robbuild', 'forum');
	}
	
	function _getRobBuildFloorDB() {
		return L::loadDB ('robbuildfloor', 'forum');
	}
	
	/**
	 * �Ƿ�������¥
	 * 
	 * @param array $awardbuilds
	 * @param int $floor
	 * @return bool | int 
	 */
	function checkIsRobFloor($awardbuilds, $floor) {
		$floor = intval($floor);
		if ($floor < 1 || ! S::isArray($awardbuilds)) return false;
		
		foreach ($awardbuilds as $v) {
			if (strrpos($v, '*') !== false) {
				$contents = str_replace('*', '\d*', $v);
				if (preg_match ("/^$contents$/", $floor)) {
					return $floor;
				}
			}
			if ($v == $floor) {
				return $floor;
			}
		}
		return false;
	}
	
	/**
	 * ����ʱ��¥������
	 * 
	 * @param int $floor
	 * @param int $tid
	 * @return bool
	 */
	function setRobbuilds($pid, $floor, $tid) {
		$floor = intval($floor);
		$tid = intval($tid);
		$pid = intval($pid);
		if ($floor < 1 || $tid < 1 || $pid < 1) return false;
		$result = $this->getByTid($tid);
		if ($result['endbuild'] <= $floor) $this->update(array('status'=>1),$tid);
		
		if (!$result || $result['endbuild'] < $floor || $result['starttime'] > $this->timestamp || $result['endtime'] < $this->timestamp) return false;
		$awardbuilds = explode ( ',', $result['awardbuilds'] );
		if (!$this->checkIsRobFloor($awardbuilds,$floor)) return false;
		return $this->setRobPostFloor($pid,$floor,$tid);
	}
	
	/**
	 * readҳ������ʾ����
	 * 
	 * @param int $tid
	 * @return array
	 *  showtimetype �� 1δ��ʱ 2��ʼ 3����
	 */
	function buildDataByTid($tid) {
		$tid = intval($tid);
		if ($tid < 1) return array();
		$result = $this->getByTid($tid);
		if (!$result) return array();
		
	 	if ($result['endtime'] < $this->timestamp || $result['status']) {
			$result['strendtime'] = get_date ($result['endtime'], 'Y-m-d H:i');
			$result['showtimetype'] = 3;
		} elseif ($result['starttime'] > $this->timestamp) {
			$result['strstarttime'] = get_date($result['starttime'], 'Y-m-d H:i');
			$result['strendtime'] = get_date($result['endtime'], 'Y-m-d H:i');
			$result['showtimetype'] = 1;
		} elseif ($result['starttime'] <= $this->timestamp && $result['endtime'] >= $this->timestamp) {
			$result['lefttime'] = $this->getDate ($result['endtime']);
			$result['showtimetype'] = 2;
		}
		return $result;
	}
	
	/**
	 * readҳʱ����ʾ����
	 * 
	 * @param int $endtime
	 * @return string
	 */
	function getDate($endtime) {
		if ($endtime < $this->timestamp) return false;
		$leftTime = $endtime - $this->timestamp;
		if ($leftTime <= 60) return $leftTime . '��';
		if ($leftTime <= 3600) return ceil ($leftTime / 60) . '����';
		if ($leftTime <= 86400) {
			$hours = floor($leftTime / 3600);
			$minutes = ceil(($leftTime - $hours * 3600) / 60);
			return $hours . 'Сʱ' . $minutes . '����';
		}
		$days = floor($leftTime / 86400);
		$hours = floor(($leftTime - $days * 86400) / 3600);
		$minutes = ceil(($leftTime - $hours * 3600 - $days * 86400) / 60);
		return $days . '��' . $hours . 'Сʱ' . $minutes . '����';
	}
	
	/**
	 * �༭��ʾ����
	 * 
	 * @param int $tid
	 * @return array
	 */
	function resetInfo($tid) {
		$tid = intval ($tid);
		if ($tid < 1) return array();
		$reset = $this->getByTid($tid);
		if (!$reset) return array();
		$reset['disable'] = 'disabled';
		$reset['strstarttime'] = $reset['starttime'];
		$reset['starttime'] = get_date ( $reset['starttime'], "Y-m-d H:i" );
		$reset['endtime'] = get_date ( $reset['endtime'], "Y-m-d H:i" );	
		return $reset;
	}
	
	function initData($fieldsdata) {
		$this->data = array (
			'authorid' => $fieldsdata['authorid'], 
			'starttime' => PwStrtoTime($fieldsdata['starttime']), 
			'endtime' => PwStrtoTime($fieldsdata['endtime']), 
			'endbuild' => $fieldsdata['endbuild'], 
			'awardbuilds' => $fieldsdata['awardbuilds'], 
			'postdate' => $fieldsdata['postdate'] 
		);
	}
	
	/**
	 * ������
	 * 
	 * @param int $tid
	 * @return bool
	 */
	function insertData($tid) {
		$tid = intval ($tid);
		if ($tid < 1) return array();
		$this->data['tid'] = $tid;
		$this->insert ($this->data);
		$threadService = L::loadClass('threads', 'forum');
		$threadService->setTpcStatusByThreadId ($tid, 7);
	}
	
	function checkAddData($allowtype,$fieldData) {
		global $_G;
		if (!$allowtype || !$_G['robbuild']) return 'postnew_group_robbuild';
		if (!$fieldData['starttime'] || !$fieldData['endtime'] || !$fieldData['endbuild'] || !$fieldData['awardbuilds']) return '�ѿ�����¥��������������Ϣ����Ϊ��!';
		
		$starttime = PwStrtoTime($fieldData['starttime']);
		$endtime = PwStrtoTime($fieldData['endtime']);
		if ($endtime < $starttime) return '��ʼʱ����ڽ���ʱ��';
		if ($endtime < $timestamp) return '����ʱ��С�ڵ�ǰʱ��';
		$endbuild = intval($endbuild);
		return ;
	}
	
	/**
	 * �༭���ݴ���
	 * 
	 * @param int $tid
	 * @return array
	 */
	function modifyData($tid, $fieldsdata) {
		$tid = intval ($tid);
		if ($tid < 1 || ! S::isArray ($fieldsdata)) return array();
		$this->initData($fieldsdata);
	}
	
	function updateData($tid) {
		$tid = intval ($tid);
		if ($tid < 1 || !S::isArray($this->data)) return array();
		$this->update($this->data, $tid);
	}
}