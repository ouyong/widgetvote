<?php

/**
 * This is the model class for table "tbl_vote".
 *
 * The followings are the available columns in table 'tbl_vote':
 * @property integer $id 主键
 * @property string $title 调查标题
 * @property string $picpath 调查的图标地址
 * @property integer $votetype 投票类型. 0, 单选. 1, 多选
 * @property integer $counts Counts
 * @property integer $createrid 发起人id
 * @property integer $creatername 发起人的妮称
 * @property string $createremail 发起人的邮箱地址
 * @property string $keyword 所属关键词, 跟随词条
 * @property string $createtime 调查创建时间
 * @property string $voteendtime 投票截至时间
 * @property integer $audittype 审核模式. 0，先审后发；1, 先发后审
 * @property string $auditname 审核人名称
 * @property string $auditdate 审核时间
 * @property integer $auditstate 审批状态. -1，不通过； 0，待审核； 1，通过；
 * @property string $md5 中搜微件hems系统中的关系id, 唯一值
 * @property string $verifyCode 验证码
 *
 * The followings are the available model relations:
 * @property TblVoteCateRelated[] $tblVoteCateRelateds
 * @property TblVoteItem[] $tblVoteItems
 * @property TblVoteOperateLog[] $tblVoteOperateLogs
 */
class Vote extends ActiveRecord
{
	public $verifyCode;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Vote the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getMdcClass() {
		return 'application.models.metadata.VoteMetadata';
	}
	
	/**
	 * behavior 如果要继承使用父类的 behaviors 请使用 array_merge 方法
	 * 否则直接返回 array 数组
	 */
	public function behaviors() {
		return array_merge(parent::behaviors(), array(
				'vote' => array(
						'class' => 'application.components.behaviors.VoteBehavior'
				),
		));
	}
	
	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array_merge(parent::relations(), array(
			'voteCateRelateds' => array(CActiveRecord::HAS_MANY, 'VoteCateRelated', 'vote_id'),
			'voteItems' => array(CActiveRecord::HAS_MANY, 'VoteItem', 'vote_id'),
			'voteOperateLogs' => array(CActiveRecord::HAS_MANY, 'VoteOperateLog', 'vote_id'),
		));
	}
	
	public function cascade() {
		return array(
				'voteCateRelateds', 'voteItems', 'voteOperateLogs'
		);
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array_merge(parent::rules(), array(
				array('verifyCode','captcha','on'=>'insert', 'allowEmpty'=>!CCaptcha::checkRequirements()),
		));
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array_merge(parent::attributeLabels(), array(
		));
	}
	
	public function scopes() {
		return array(
				'hot' => array(
						'order' => 'counts DESC',
						'limit' => '4'
						),
				'new' => array(
						'order' => 'createtime DESC',
						'limit' => '4'
						),
				'listhot' => array(
						'order' => 'counts DESC',
						),
				'listnew' => array(
						'order' => 'createtime DESC',
						),
				'listbyid' => array(
						'order' => 'id DESC',
						),
				
		);
	}
	
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('picpath',$this->picpath,true);
		$criteria->compare('votetype',$this->votetype);
		$criteria->compare('counts',$this->counts);
		$criteria->compare('createrid',$this->createrid);
		$criteria->compare('creatername',$this->creatername);
		$criteria->compare('createremail',$this->createremail,true);
		$criteria->compare('keyword',$this->keyword,true);
		$criteria->compare('createtime',$this->createtime,true);
		$criteria->compare('voteendtime',$this->voteendtime,true);
		$criteria->compare('audittype',$this->audittype);
		$criteria->compare('auditname',$this->auditname,true);
		$criteria->compare('auditdate',$this->auditdate,true);
		$criteria->compare('auditstate',$this->auditstate);
		$criteria->compare('md5',$this->md5,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
					'pageSize'=>4,
			),
		));
	}
	
}