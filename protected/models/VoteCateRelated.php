<?php

/**
 * This is the model class for table "tbl_vote_cate_related".
 *
 * The followings are the available columns in table 'tbl_vote_cate_related':
 * @property integer $id 主键
 * @property integer $vote_id Vote
 * @property integer $category_id 分类id
 *
 * The followings are the available model relations:
 * @property TblVote $vote
 * @property TblVoteCategory $category
 */
class VoteCateRelated extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return VoteCateRelated the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getMdcClass() {
		return 'application.models.metadata.VoteCateRelatedMetadata';
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
				'vote' => array(ActiveRecord::BELONGS_TO, 'Vote', 'vote_id'),
				'category' => array(ActiveRecord::BELONGS_TO, 'VoteCategory', 'category_id'),
		));
	}
	
	public function cascade() {
		return array(
				'vote','category'
		);
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
		$criteria->compare('vote_id',$this->vote_id);
		$criteria->compare('category_id',$this->category_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}