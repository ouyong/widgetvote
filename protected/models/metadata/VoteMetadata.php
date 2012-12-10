<?php

/**
 * This is the model metadata class for table "tbl_vote".
 */
class VoteMetadata extends CARMDC
{
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_vote';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title,createremail,voteendtime', 'required'),
			array('votetype, counts, createrid, audittype, auditstate', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>14),
			array('createremail', 'length', 'max'=>100),
// 			array('createremail','email','message'=>'邮箱输入有误.'),
			array('md5', 'length', 'max'=>125),
			array('keyword', 'length', 'max'=>64),
			array('auditname', 'length', 'max'=>255),
			array('createtime, creatername, voteendtime, auditdate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, picpath, votetype, counts, createrid, creatername, createremail, keyword, createtime, voteendtime, audittype, auditname, auditdate, auditstate, md5', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '主键',
			'title' => '调查标题',
			'picpath' => '调查的图标地址',
			'votetype' => '投票类型. 0, 单选. 1, 多选',
			'counts' => 'Counts',
			'createrid' => '发起人id',
			'creatername' => '发起人的妮称',
			'createremail' => '发起人的邮箱地址',
			'keyword' => '所属关键词, 跟随词条',
			'createtime' => '调查创建时间',
			'voteendtime' => '投票截至时间',
			'audittype' => '审核模式. 0，先审后发；1, 先发后审',
			'auditname' => '审核人名称',
			'auditdate' => '审核时间',
			'auditstate' => '审批状态. -1，不通过； 0，待审核； 1，通过；',
			'md5' => '中搜微件hems系统中的关系id, 唯一值',
		);
	}
	
}