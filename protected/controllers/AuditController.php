<?php

class AuditController extends Controller {

	/**
	 * 查看评分审核列表
	 * 按发起时间倒序排序
	 */
	public function actionVlists() {
		
		$vote = new Vote();
		$votes = $vote->listbyid()->search();
		$this->render('vlists', array(
				'model' => $votes
				));
		
	}
	
	/**
	 * 评分审核，审核通过，不通过
	 */
	public function actionVapprove() {
		
		if(isset($_POST['Vote'])) {
			$vote = new Vote();
			$vote->setAttributes($_POST['Vote']);
			$result = $vote->save();
			if($result) {
				echo 'success';
			}
		} else {
			$vote = new Vote();
			$this->render('vapprove', array(
					'model' => $vote
					));
		}
		
		
		
	}
	
	/**
	 * 根据条件搜索投票(根据：标题、发起人、审批人、发起时间、审批时间、审批状态、跟随词条、跟随分类)
	 */
	public function actionSearch() {
		
		
		
	}
	
	/**
	 * 修改一个投票所有投票项的投票数
	 */
	public function actionUpdate() {
		
		if(isset($_POST['Vote'])) {
			$vote = new Vote();
			$vote->setAttributes($_POST['Vote']);
			$result = $vote->save();
			if($result) {
				echo 'success';
			}
		} else {
			$vote = new Vote();
			$this->render('update', array(
					'model' => $vote
			));
		}
		
	}
	
	/**
	 * 查看后台操作日志
	 */
	public function actionLog() {
		
		$vote = new Vote();
		$voteOperateLogs = $vote->voteOperateLogs;
		$this->render('log', array(
				'models' => $voteOperateLogs
				));
		
	}
	
	/**
	 * 显示投票选择的分类
	 */
	public function actionCategory() {
		
		$vote = new Vote();
		$voteCateRelateds = $vote->voteCateRelateds;
		foreach($voteCateRelateds as $voteCateRelated) {
			$categorys = $voteCateRelated->categorys;
		}
		$this->render('category', array(
				'models' => $categorys
				));
		
	}
	
}

?>