<script type="text/javascript">
	function GetCheckbox(){
		var data=new Array();
		$("input:checkbox[name='selectdel[]']").each(function (){
			if($(this).attr("checked")== 'checked'){
				data.push($(this).val());
			}
		});
		if(data.length > 0){
			$.post('<?php echo CHtml::normalizeUrl(array('/'.Yii::app()->controller->id.'/deletes'));?>',{"selectdel[]":data} , function(data) {
				var ret = $.parseJSON({"selectdel[]":data});
				if (ret != null && ret.success != null && ret.success) {
					$.fn.yiiGridView.update('yw1');
				}
			});
			window.location.reload();
		}else{
		alert("请选择要删除的关键字!");
		}
	}
</script>


<?php 

$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider' => $models,
		'columns' => array(
				array(
						'selectableRows' => 2,
		                'footer' => '<button type="button" onclick="GetCheckbox();" style="width:80px">批量删除</button>',
		                'class' => 'CCheckBoxColumn',
		                'headerHtmlOptions' => array('width'=>'33px'),
		                'checkBoxHtmlOptions' => array('name' => 'selectdel[]'),
					),
				'title','keyword',array(
							'name'=>'voteCateRelateds..category_id',
							'value'=>'$data->getCategory($data->id)'
							),'creatername','counts','createtime','voteendtime','auditname','auditdate',array(
									'name'=>'auditstate',
									'value'=>'$data->getAuditstate($data->auditstate)'
									),
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