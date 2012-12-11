<?php

class VoteBehavior extends CActiveRecordBehavior {

	public function beforeSave($event) {
		$owner = $this->getOwner();
		if($owner->isNewRecord) {
			$file = CUploadedFile::getInstance($owner, 'picpath');
			if(isset($file)) {
				$randName=date('Ymdhis').rand(100,999).'.'.$file->getExtensionName();
				$result = $file->saveAs(Yii::app()->basePath.'/../upload/'.$randName);
				$owner->picpath = '/upload/'.$randName;
			}
		$owner->counts = 0;
		$owner->audittype = 0;
		$owner->auditstate = 0;
		$owner->createtime = date('Y-m-d H:i:s',time());
		} else {
			if(isset($_GET['auditstate'])) {
				$owner->auditstate = $_GET['auditstate'];
				$owner->auditdate = date('Y-m-d H:i:s',time());
				$owner->auditname = 'admin';
			} 
		}
		
	}
	
	public function afterSave($event) {
		$owner = $this->getOwner();
		if($owner->isNewRecord) {
			
		} else {
			if(isset($_GET['auditstate'])) {
				$voteOperateLog = new VoteOperateLog();
				$voteOperateLog->opttype = $_GET['auditstate'];
				$voteOperateLog->opttime = date('Y-m-d H:i:s',time());
				$voteOperateLog->optname = 'admin';
				
				if($voteOperateLog->opttype == 1) {
					$voteOperateLog->content = '审核人 '.$voteOperateLog->optname.' '.$voteOperateLog->opttime.' 审核通过';
				} else if($voteOperateLog->opttype == 2) {
					$voteOperateLog->content = '审核人 '.$voteOperateLog->optname.' '.$voteOperateLog->opttime.' 审核不通过';
				}
				$voteOperateLog->vote_id = $owner->id;
				$voteOperateLog->save();
			} else if(isset($_POST['Vote'])) {
				$voteOperateLog = new VoteOperateLog();
				$voteOperateLog->opttime = date('Y-m-d H:i:s',time());
				$voteOperateLog->optname = 'admin';
				$voteOperateLog->vote_id = $owner->id;
				$voteOperateLog->content = '审核人 '.$voteOperateLog->optname.' '.$voteOperateLog->opttime.' 编辑数量为:'.$owner->counts;
				$voteOperateLog->save();
			}
		}
	}
	
	public function beforeDelete($event) {
		/* 
		$owner = $this->getOwner();
		
		$voteItem = new VoteItem();
		$result = $voteItem->deleteAllByAttributes(array('vote_id'=>$owner->id));
		
		$voteCateRelated = new VoteCateRelated();
		$result = $voteCateRelated->deleteAllByAttributes(array('vote_id'=>$owner->id));
		 */
	}
	
}

?>