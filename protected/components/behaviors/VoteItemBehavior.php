<?php

class VoteItemBehavior extends CActiveRecordBehavior {

	public function beforeSave($event) {
		$owner = $this->getOwner();
		if($owner->isNewRecord) {
			$owner->itemvotecount = 0;
		} else {
			
		}
	
	}
	
	public function afterSave($event) {
		$owner = $this->getOwner();
		if ($owner->isNewRecord) {
			
		} else {
			
		}
	}
	
}

?>