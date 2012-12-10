<?php

class VoteItemBehavior extends CActiveRecordBehavior {

	public function beforeSave($event) {
		$owner = $this->getOwner();
		if($owner->isNewRecord) {
			$owner->itemvotecount = 0;
		} else {
			$owner->itemvotecount = $owner->itemvotecount + 1;
		}
	
	}
	
	public function afterSave($event) {
		$owner = $this->getOwner();
		if ($owner->isNewRecord) {
			
		} else {
			$vote = new Vote();
			$vote = $vote->findByPk($owner->vote_id);
			$vote->counts = $vote->counts + 1;
			$vote->save();
		}
	}
	
}

?>