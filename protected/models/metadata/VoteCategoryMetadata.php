<?php

/**
 * This is the model metadata class for table "tbl_vote_category".
 */
class VoteCategoryMetadata extends CARMDC
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_vote_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent_id', 'numerical', 'integerOnly'=>true),
			array('categoryname', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, categoryname, parent_id', 'safe', 'on'=>'search'),
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
			'voteCateRelateds' => array(self::HAS_MANY, 'TblVoteCateRelated', 'category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '主键',
			'categoryname' => 'Categoryname',
			'parent_id' => 'Parent',
		);
	}
}