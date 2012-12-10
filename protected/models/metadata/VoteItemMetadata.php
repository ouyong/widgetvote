<?php

/**
 * This is the model metadata class for table "tbl_vote_item".
 */
class VoteItemMetadata extends CARMDC
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_vote_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
// 			array('vote_id', 'required'),
			array('itemtitle', 'required'),
			array('itemtitle', 'length', 'max'=>25),
			array('itemvotecount, displayorder, vote_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, itemtitle, itemvotecount, displayorder, vote_id', 'safe', 'on'=>'search'),
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
			'itemtitle' => '调查选项标题',
			'itemvotecount' => '选项总投票人数',
			'displayorder' => '排列序号，显示的顺序值。',
			'vote_id' => 'Vote',
		);
	}
}