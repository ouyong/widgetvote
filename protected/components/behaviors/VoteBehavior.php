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
				$owner->counts = 0;
				$owner->createtime = date('Y-m-d H:i:s',time());
			}
		} else {
			
		}
		
	}
	
	public function afterSave($event) {
		$owner = $this->getOwner();
	}
	
}

?>