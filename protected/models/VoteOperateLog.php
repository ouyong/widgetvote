<?php

/**
 * This is the model class for table "tbl_vote_operate_log".
 *
 * The followings are the available columns in table 'tbl_vote_operate_log':
 * @property integer $id 主键
 * @property string $opttype 操作类型
 * @property integer $opttime 操作时间
 * @property string $optname 操作人名称
 * @property string $content 日志内容
 * @property integer $vote_id Vote
 *
 * The followings are the available model relations:
 * @property TblVote $vote
 */
class VoteOperateLog extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return VoteOperateLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getMdcClass() {
		return 'application.models.metadata.VoteOperateLogMetadata';
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
		$criteria->compare('opttype',$this->opttype,true);
		$criteria->compare('opttime',$this->opttime);
		$criteria->compare('optname',$this->optname,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('vote_id',$this->vote_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}