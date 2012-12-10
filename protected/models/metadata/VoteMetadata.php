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
			'title' => '标题',
			'picpath' => '调查图标',
			'votetype' => '投票类型',
			'counts' => '投票人数',
			'createrid' => '发起人id',
			'creatername' => '发起人',
			'createremail' => '发起人邮箱',
			'keyword' => '跟随词条',
			'createtime' => '发起时间',
			'voteendtime' => '投票截至时间',
			'audittype' => '审核模式',
			'auditname' => '审批人',
			'auditdate' => '审批时间',
			'auditstate' => '状态',
			'md5' => '中搜微件hems系统中的关系id唯一值',
		);
	}
	
}