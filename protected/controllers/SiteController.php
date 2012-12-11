<?php

class SiteController extends Controller
{
	
	public function actions()
	{
		return array(
				// captcha action renders the CAPTCHA image displayed on the contact page
				'captcha'=>array(
						'class'=>'CCaptchaAction',
						'backColor'=>0xFFFFFF,
						'foreColor'=>0x2040A0,  //字体颜色
						'offset'=>2,            //字符间偏移量
						'padding'=>2,         //文本周围的间距. 默认是 2
						'height'=>28,         //验证码图片的高度. 默认是 50
						'width'=>85,          //验证码图片宽度. 默认是 120
						'minLength'=>4,     //设置最短为4位
						'maxLength'=>4,       //设置最长为4位,生成的code在4直接rand了
				),
				// page action renders "static" pages stored under 'protectediews/site/pages'
				// They can be accessed via: index.php?r=site/page&view=FileName
				'page'=>array(
						'class'=>'CViewAction',
				),
		);
	}
	
	
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * 前台发起一个投票
	 */
	public function actionAdd() {
		
		if(isset($_POST['Vote'])) {
			$vote = new Vote();
			$vote->setAttributes($_POST['Vote']);
			$result =$vote->save();
			if($result) {
				echo 'success';
			} else {
				echo '发布失败';
			}
			
		} else {
			$vote = new Vote();
			$voteCategory = new VoteCategory();
			$voteCategorys = $voteCategory->findAll();
			$this->render('add',array(
					'model' => $vote,
					'datas' =>$voteCategorys
					));
		}
	}
	
	public function UserVote($voteItemid) {
		
		$voteItem = new VoteItem();
		$voteItem = $voteItem->findByPk($voteItemid);
		$voteItem->itemvotecount = $voteItem->itemvotecount + 1;
		$result = $voteItem->save();
		if($result) {
			$vote = new Vote();
			$vote = $vote->findByPk($voteItem->vote_id);
			$vote->counts = $vote->counts + 1;
			$vote->save();
		}
		
	}
	
	/**
	 * 查看前四个投票（按最新，最热）
	 */
	public function actionView() {
		
		$page = 'hot';
		
		/**
		 * 用户投票
		 */
		if(isset($_POST['VoteItem']['id'])) {
			$this->UserVote($_POST['VoteItem']['id']);
		}
		if(isset($_GET['page'])) {
			$page = $_GET['page'];
			//最热
			if($page == 'hot') {
				$vote = new Vote();
				$votes = $vote->hot()->findAll();
				$this->render('view', array(
						'models' => $votes,
						'page' => $page
						));
			//最新
			} else if($page == 'new') {
				$vote = new Vote();
				$votes = $vote->new()->findAll();
				$this->render('view', array(
						'models' => $votes,
						'page' => $page
				));
			}
		//默认显示最热
		} else {
			$vote = new Vote();
			$votes = $vote->hot()->findAll();
			$this->render('view', array(
					'models' => $votes,
					'page' => $page
			));
		}
	}
	
	/**
	 * 查询所有投票（最新，最热，投票分类查询）
	 */
	public function actionLists() {
		
		$page = 'hot';
		
		/**
		 * 用户投票
		 */
		if(isset($_POST['VoteItem']['id'])) {
			$this->UserVote($_POST['VoteItem']['id']);
		}
		/**
		 * 搜索
		 */
		if(isset($_GET['keyword'])) {
			$keyword = $_GET['keyword'];
				
			$vote = new Vote();
			$dataProvider = new CActiveDataProvider($vote,
					array('criteria' => array(
							'select'    => "*",
							'order' => "createtime DESC",
							'condition' => "title LIKE :keyword",
							'params' => array(':keyword' =>"%".$keyword."%"),
								
					),
							'pagination' => array(
									'pageSize' => 4,
							),
					));
			$this->render('lists', array(
					'page' => $page,
					'models' => $dataProvider
			));
			
		} else if(isset($_GET['page'])) {
			$page = $_GET['page'];
			//最热
			if($page == 'hot') {
				$vote = new Vote();
				$votes = $vote->listhot()->search();
				$this->render('lists', array(
						'page' => $page,
						'models' => $votes
				));
			//最新
			} else if($page == 'new') {
				$vote = new Vote();
				$votes = $vote->listnew()->search();
				$this->render('lists', array(
						'page' => $page,
						'models' => $votes
				));
			}
			
		//默认显示最热
		} else {
			$vote = new Vote();
			$votes = $vote->listhot()->search();
			$this->render('lists', array(
					'page' => $page,
					'models' => $votes
			));
		}
	}
	
	public function actionSearch() {
		$keyword = $_POST['keyword'];
	
		$vote = new Vote();
		$dataProvider = new CActiveDataProvider($vote,
				array('criteria' => array(
						'select'    => "*",
						'order' => "createtime DESC",
						'condition' => "title LIKE :keyword",
						'params' => array(':keyword' =>"%".$keyword."%"),
	
				),
						'pagination' => array(
								'pageSize' => 4,
						),
				));
		$this->redirect('lists', array(
// 				'page' => $page,
				'models' => $dataProvider
		));
	}
	
}