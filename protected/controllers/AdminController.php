<?php

class AdminController extends Controller {

	/**
	 * 后台发起一个投票
	 */
	public function actionAdd() {
		
		if(isset($_POST['Vote'])) {
			$vote = new Vote();
			$vote->setAttributes($_POST['Vote']);
			$vote->save();
			echo 'success';
		} else {
			$vote = new Vote();
			$this->render('add',array(
					'model' => $vote
					));
		}
	}
	
}

?>