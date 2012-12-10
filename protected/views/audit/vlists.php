<?php 

$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider' => $models,
		'columns' => array(
				'title','keyword',array(
						'name'=>'voteCateRelateds..category_id',
						'value'=>'$data->getCategory($data->id)'
						),'creatername','counts','createtime','voteendtime','auditname','auditdate','auditstate',
				array(            // display a column with "view", "update" and "delete" buttons
						'class'=>'CButtonColumn',
						'template' => '{pass}{nopass}{updateCategory}{updateCounts}{log}',
						'header' => '操作',
						'buttons' => array(
								'pass' => array(
										'label' => '通过',
										'url' => 'Yii::app()->controller->createUrl("vapprove", array("id"=>$data->primaryKey))',
										),
								'nopass' => array(
										'label' => '不通过',
										'url' => 'Yii::app()->controller->createUrl("vapprove", array("id"=>$data->primaryKey))',
										),
								'updateCategory' => array(
										'label' => '分类',
										'url' => 'Yii::app()->controller->createUrl("vapprove", array("id"=>$data->primaryKey))',
										),
								'updateCounts' => array(
										'label' => '编辑数量',
										'url' => 'Yii::app()->controller->createUrl("vapprove", array("id"=>$data->primaryKey))',
										),
								'log' => array(
										'label' => '日志',
										'url' => 'Yii::app()->controller->createUrl("vapprove", array("id"=>$data->primaryKey))',
										),
						),
				),
		),
));

?>