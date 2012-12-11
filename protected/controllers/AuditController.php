<?php

class AuditController extends Controller {
	
	/**
	 * 查看评分审核列表
	 * 按发起时间倒序排序
	 */
	public function actionVlists() {
		
		$vote = new Vote ();
		$votes = $vote->listbyid ()->search ();
		$this->render ( 'vlists', array (
				'models' => $votes,
				'vote' => $vote
		) );
	
	}
	
	/**
	 * 评分审核，审核通过，不通过
	 */
	public function actionVapprove() {
		if (isset ( $_GET['id'] )) {
			$vote = new Vote ();
			$vote = $vote->findByPk($_GET['id']);
			$result = $vote->save ();
			if ($result) {
				$this->redirect(Yii::app()->createUrl('audit/vlists'));
			}
		} else {
			$this->redirect(Yii::app()->createUrl('audit/vlists'));
		}
	
	}
	
	/**
	 * 根据条件搜索投票(根据：标题、发起人、审批人、发起时间、审批时间、审批状态、跟随词条、跟随分类)
	 */
	public function actionSearch() {
		
		
		
		$criteria = new CDbCriteria();
		if(isset($_POST['Vote']['audittype'])) {
			$audittype = $_POST['Vote']['audittype'];
			$criteria->addCondition('audittype='.$audittype);
		}
		if($_POST['Vote']['title']!=null && $_POST['Vote']['title']!='') {
			$title = $_POST['Vote']['title'];
			$criteria->addSearchCondition('title', $title);
		}
		if($_POST['Vote']['creatername']!=null && $_POST['Vote']['creatername']!='') {
			$creatername = $_POST['Vote']['creatername'];
			$criteria->addSearchCondition('creatername', $creatername);
		}
		if($_POST['Vote']['auditname']!=null && $_POST['Vote']['auditname']!='') {
			$auditname = $_POST['Vote']['auditname'];
			$criteria->addSearchCondition('auditname', $auditname);
		}
		if($_POST['Vote']['keyword']!=null && $_POST['Vote']['keyword']!='') {
			$keyword = $_POST['Vote']['keyword'];
			$criteria->addSearchCondition('keyword', $keyword);
		}
		if($_POST['screatetime']!=null && $_POST['screatetime']!='' &&
				$_POST['ecreatetime']!=null && $_POST['ecreatetime']!=''
				) {
			$screatetime = $_POST['screatetime'];
			$ecreatetime = $_POST['ecreatetime'];
			$criteria->addBetweenCondition('createtime', $screatetime, $ecreatetime);
		}
		if($_POST['saudittime']!=null && $_POST['saudittime']!=''&&
				$_POST['eaudittime']!=null && $_POST['eaudittime']!=''
				) {
			$saudittime = $_POST['saudittime'];
			$eaudittime = $_POST['eaudittime'];
			$criteria->addBetweenCondition('auditdate', $saudittime, $eaudittime);
		}
		if($_POST['auditstate'] != null && $_POST['auditstate'] != '') {
			$auditstate = $_POST['auditstate'];
			if($auditstate != 'all') {
				$criteria->addCondition('auditstate='.$auditstate);
			}
		}
		//投票有效期
		if($_POST['validity']!=null && $_POST['validity']!='') {
			$validity = $_POST['validity'];
			if($validity != 'all') {
				if($validity == 'long') {
					//长期有效   未成功
					$criteria->addCondition("voteendtime=''");
				}
				if($validity == 'intime') {
					//有效期内     未成功
					$nowtime = date('Y-m-d H:i:s',time());
					$criteria->addCondition("createtime<'".$nowtime."'");
					$criteria->addCondition("voteendtime>'".$nowtime."'");
				}
				if($validity == 'overtime') {
					//过期      未成功
					$nowtime = date('Y-m-d H:i:s',time());
					$criteria->addCondition("voteendtime<'".$nowtime."'");
				}
			}
		}
		
		//根据分类搜索
		$categoryName = $_POST['categoryName'];
		
		$vote = new Vote();
		$dataProvider = new CActiveDataProvider($vote, array(
				'criteria' => $criteria
				));
		
		$this->render ( 'vlists', array (
				'models' => $dataProvider,
				'vote' => $vote
		) );
		
	}
	
	/**
	 * 修改一个投票所有投票项的投票数
	 */
	public function actionUpdate() {
		
		
		$vote = new Vote ();
		
		$votes = $vote->hot()->findAll();
		$hotVote = $votes[0];
		
		$vote = $vote->findByPk($_GET['id']);
		$counts = 0;
		if(isset($_POST['Vote'])) {
			foreach ($_POST['Vote']['voteItems'] as $voteItem) {
				$counts += $voteItem['itemvotecount'];
			}
			$vote->setAttributes($_POST['Vote']);
			$vote->counts = $counts;
			$result =$vote->save();
			$this->redirect(Yii::app()->createUrl('audit/vlists'));
		} else {
			$this->render('update', array(
					'model' => $vote,
					'hotVote' => $hotVote
			));
		}
		
	}
	
	public function actionShowVote() {
		
		$vote = new Vote ();
		if(isset($_GET['id'])) {
			$vote = $vote->findByPk($_GET['id']);
			$this->render('showVote',array(
					'model' => $vote
					));
		} else {
			$this->redirect(Yii::app()->createUrl('audit/vlists'));
		}
		
	}
	
	/**
	 * 查看后台操作日志
	 */
	public function actionLog() {
		
		$vote = new Vote ();
		$vote = $vote->findByPk($_GET['id']);

		$voteOperateLog = new VoteOperateLog();
		$dataProvider = new CActiveDataProvider($voteOperateLog,
				array('criteria' => array(
						'select'    => "*",
						'order' => "opttime DESC",
						'condition' => "vote_id=".$vote->id,
		
				),
						'pagination' => array(
								'pageSize' => 10,
						),
				));
		$this->render ( 'log', array (
				'models' => $dataProvider 
		) );
		
	}
	
	/**
	 * 显示投票选择的分类
	 */
	public function actionCategory() {
		/* 
		$vote = new Vote ();
		$voteCateRelateds = $vote->voteCateRelateds;
		foreach ( $voteCateRelateds as $voteCateRelated ) {
			$categorys = $voteCateRelated->categorys;
		}
		$this->render ( 'category', array (
				'models' => $categorys 
		) );
	 	*/
	}
	
	/**
	 * 删除投票
	 * 可以批量删除
	 */
	public function actionDeletes() {
		if (Yii::app ()->request->isPostRequest) {
			$criteria = new CDbCriteria ();
			$criteria->addInCondition ( 'id', $_POST ['selectdel'] );
			
			$vote = new Vote ();
			$result = $vote->deleteAll ( $criteria );
			
			if (isset ( Yii::app ()->request->isAjaxRequest )) {
				echo CJSON::encode ( array (
						'success' => true 
				) );
			} else
				$this->redirect ( isset ( $_POST ['returnUrl'] ) ? $_POST ['returnUrl'] : array (
						'index' 
				) );
		} else {
			throw new CHttpException ( 400, 'Invalid request. Please do not repeat this request again.' );
		}
	}

}

?>