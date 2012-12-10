<?php

/**
 * This is the model class for table "tbl_vote_item".
 *
 * The followings are the available columns in table 'tbl_vote_item':
 * @property integer $id 主键
 * @property string $itemtitle 调查选项标题
 * @property integer $itemvotecount 选项总投票人数
 * @property integer $displayorder 排列序号，显示的顺序值。
 * @property integer $vote_id Vote
 *
 * The followings are the available model relations:
 * @property TblVote $vote
 */
class VoteItem extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return VoteItem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getMdcClass() {
		return 'application.models.metadata.VoteItemMetadata';
	}
	
	/**
	 * behavior 如果要继承使用父类的 behaviors 请使用 array_merge 方法
	 * 否则直接返回 array 数组
	 */
	public function behaviors() {
		return array_merge(parent::behaviors(), array(
				'voteItem' => array(
						'class' => 'application.components.behaviors.VoteItemBehavior'
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
				'vote' => array(CActiveRecord::BELONGS_TO, 'Vote', 'vote_id'),
		));
	}
	
	public function cascade() {
		return array(
				'vote'
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
		$criteria->compare('itemtitle',$this->itemtitle,true);
		$criteria->compare('itemvotecount',$this->itemvotecount);
		$criteria->compare('displayorder',$this->displayorder);
		$criteria->compare('vote_id',$this->vote_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}