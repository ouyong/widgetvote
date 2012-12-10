<?php

/**
 * This is the model metadata class for table "tbl_vote_cate_related".
 */
class VoteCateRelatedMetadata extends CARMDC
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_vote_cate_related';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
// 			array('vote_id, category_id', 'required'),
			array('vote_id, category_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, vote_id, category_id', 'safe', 'on'=>'search'),
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
			'vote_id' => 'Vote',
			'category_id' => '跟随分类',
		);
	}
}