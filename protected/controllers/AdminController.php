<?php

class AdminController extends Controller {

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
	 * 后台发起一个投票
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
	
}

?>