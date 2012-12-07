<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
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
		$vote = new Vote();
		$this->render('add',array(
				'model' => $vote
				));
	}
		
	/**
	 * 查看前四个投票（按最新，最热）
	 */
	public function actionView() {
		
	}
	
	/**
	 * 用户投票
	 */
	public function actionVote() {
		
	}
	
	/**
	 * 查询所有投票（最新，最热，投票分类查询）
	 */
	public function actionLists() {
		
	}


	
}