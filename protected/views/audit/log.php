<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider' => $models,
	'columns' => array(
		'content'
	),
));

?>

<a href="<?php echo Yii::app()->createUrl('audit/vlists')?>">返回</a>