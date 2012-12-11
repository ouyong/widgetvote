<?php

/**
 * This is the model metadata class for table "tbl_vote_operate_log".
 */
class VoteOperateLogMetadata extends CARMDC
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_vote_operate_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('vote_id', 'required'),
			array('vote_id', 'numerical', 'integerOnly'=>true),
			array('opttype', 'length', 'max'=>64),
			array('optname', 'length', 'max'=>255),
			array('content', 'length', 'max'=>125),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, opttype, opttime, optname, content, vote_id', 'safe', 'on'=>'search'),
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
			'opttype' => '操作类型',
			'opttime' => '操作时间',
			'optname' => '操作人名称',
			'content' => '日志内容',
			'vote_id' => 'Vote',
		);
	}
}