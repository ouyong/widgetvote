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

<?php $form = $this->beginWidget('lib.widgets.CActiveFormAdv',array(
											'action' => 'search',
											'method' => 'post',
										));?>
<table>
  <tr>
    <th>审核模式：
    <?php echo $form->radioButton(
						$vote, 'audittype', 
						array('value'=>0, 'uncheckValue'=>null)
					);?>
					先发后审
    <?php echo $form->radioButton(
						$vote, 'audittype', 
						array('value'=>1, 'uncheckValue'=>null)
					);?>
					先审后发
    </th>
    <th></th>
    <th></th>
    <th></th>
  </tr>
  <tr>
  	<th>标题：<?php echo $form->textField($vote,'title',array('size'=>15))?></th>
    <th>发起人：<?php echo $form->textField($vote,'creatername',array('size'=>13))?></th>
    <th>发起时间：<?php echo CHtml::textField('screatetime')?>~<?php echo CHtml::textField('ecreatetime')?></th>
  </tr>
  <tr>
  	<th>投票有效期：<?php echo CHtml::dropDownList('validity', '1', array('all'=>'全部','long'=>'长期有效','intime'=>'有效期内','overtime'=>'过期'))?></th>
  	<th>审批人：<?php echo $form->textField($vote,'auditname',array('size'=>13))?></th>
  	<th>审批时间：<?php echo CHtml::textField('saudittime')?>~<?php echo CHtml::textField('eaudittime')?></th>
  </tr>
  <tr>
  	<th>审批状态：<?php echo CHtml::dropDownList('auditstate', 'all', array('all'=>'全部','1'=>'审核通过','2'=>'审核不通过','0'=>'未审核'))?></th>
  	<th>跟随词条：<?php echo $form->textField($vote,'keyword',array('size'=>10))?></th>
  	<th>跟随分类：<?php echo CHtml::textField('categoryName')?></th>
  </tr>
  <tr>
    <th></th>
    <th></th>
    <th><?php echo CHtml::submitButton('搜索')?><?php echo CHtml::resetButton('取消')?></th>
  </tr>
</table>
<?php $this->endWidget();?>

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
				array( 
						'class'=>'CLinkColumn',
                        'header'=>'标题',
                        'labelExpression'=>'$data->title',//显示标题
                        'urlExpression'=>'Yii::app()->controller->createUrl("showVote",array("id"=>$data->primaryKey))',//显示URL
                        //'linkHtmlOptions'=>array('title'=>'See all entries with this last name')
                        ),'keyword',array(
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
										'url' => 'Yii::app()->controller->createUrl("vapprove", array("id"=>$data->primaryKey,"auditstate"=>"1"))',
										),
								'nopass' => array(
										'label' => '不通过',
										'url' => 'Yii::app()->controller->createUrl("vapprove", array("id"=>$data->primaryKey,"auditstate"=>"2"))',
										),
								'updateCategory' => array(
										'label' => '分类',
										'url' => 'Yii::app()->controller->createUrl("vapprove", array("id"=>$data->primaryKey))',
										),
								'updateCounts' => array(
										'label' => '编辑数量',
										'url' => 'Yii::app()->controller->createUrl("update", array("id"=>$data->primaryKey))',
										),
								'log' => array(
										'label' => '日志',
										'url' => 'Yii::app()->controller->createUrl("log", array("id"=>$data->primaryKey))',
										),
						),
				),
		),
));

?>