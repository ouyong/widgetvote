<?php

/**
 * This is the model class for table "tbl_vote_category".
 *
 * The followings are the available columns in table 'tbl_vote_category':
 * @property integer $id 主键
 * @property string $categoryname Categoryname
 * @property integer $parent_id Parent
 *
 * The followings are the available model relations:
 * @property TblVoteCateRelated[] $tblVoteCateRelateds
 */
class VoteCategory extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return VoteCategory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getMdcClass() {
		return 'application.models.metadata.VoteCategoryMetadata';
	}
	
	/**
	 * behavior 如果要继承使用父类的 behaviors 请使用 array_merge 方法
	 * 否则直接返回 array 数组
	 */
	public function behaviors() {
		return array_merge(parent::behaviors(), array(
		));
	}
	
	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array_merge(parent::relations(), array(
		));
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array_merge(parent::rules(), array(
		));
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array_merge(parent::attributeLabels(), array(
		));
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
		$criteria->compare('categoryname',$this->categoryname,true);
		$criteria->compare('parent_id',$this->parent_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}