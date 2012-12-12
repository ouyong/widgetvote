<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>中搜第三代搜索开放平台</title>
<link rel="stylesheet" type="text/css" media="all"
	href="<?php echo Yii::app()->request->baseUrl?>/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" media="all"
	href="<?php echo Yii::app()->request->baseUrl?>/css/daterangepicker.css" />
<script type="text/javascript"
	src="<?php echo Yii::app()->request->baseUrl?>/js/jquery.min.js"></script>
<script type="text/javascript"
	src="<?php echo Yii::app()->request->baseUrl?>/js/date.js"></script>
<script type="text/javascript"
	src="<?php echo Yii::app()->request->baseUrl?>/js/daterangepicker.js"></script>
<script type="text/javascript">
			$(document).ready(function() {
						$('#reservation').daterangepicker();
					});
					$(document).ready(function() {
						$('#reservation1').daterangepicker();
					});
		</script>
		
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
		
<link
	href="<?php echo Yii::app()->request->baseUrl?>/css/iframstyle.css"
	rel="stylesheet" type="text/css">

	
</head>
<body>

	<div class="layout">
		<div class="bgbox AddCategory formsearch">
			<div class="bd">
				<div class="pd10">
				<?php $form = $this->beginWidget('lib.widgets.CActiveFormAdv',array(
											'action' => 'search',
											'method' => 'post',
										));?>
					<table class="table5">
						<tbody>
							<tr>
								<td><span>标题：</span><?php echo $form->textField($vote,'title')?></td>
								<td><span class="wd60">发起人：</span><?php echo $form->textField($vote,'creatername',array('size'=>13))?></td>
								<td>发起时间：<?php echo CHtml::textField('screatetime')?>~<?php echo CHtml::textField('ecreatetime')?></td>
								<td></td>
							</tr>
							<tr>
								<td>投票有效期：<?php echo CHtml::dropDownList('validity', '1', array('all'=>'全部','long'=>'长期有效','intime'=>'有效期内','overtime'=>'过期'))?></td>
								<td><span class="wd60">审批人：</span><?php echo $form->textField($vote,'auditname',array('size'=>13))?></td>
								<td>审批时间：<?php echo CHtml::textField('saudittime')?>~<?php echo CHtml::textField('eaudittime')?></td>
								<td>审批状态：<?php echo CHtml::dropDownList('auditstate', 'all', array('all'=>'全部','1'=>'审核通过','2'=>'审核不通过','0'=>'未审核'))?></td>
							</tr>
							<tr>
								<td></td>
								<td>跟随词条：<?php echo $form->textField($vote,'keyword',array('size'=>10))?></td>
								<td><span class="wd60">跟随分类：</span><?php echo CHtml::textField('categoryName')?></td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td>
									<?php echo CHtml::submitButton('搜索')?> 
									<?php echo CHtml::resetButton('取消')?>
								</td>
								<td></td>
							</tr>
						</tbody>
					</table>
					<?php $this->endWidget();?>
				</div>
			</div>
		</div>

		<div class="x-table">
			<table class="x-tdpa typeid_1" align="center" border="0"
				cellpadding="0" cellspacing="0">
				<tbody>
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
													'label' => ' 通过 ',
													'url' => 'Yii::app()->controller->createUrl("vapprove", array("id"=>$data->primaryKey,"auditstate"=>"1"))',
													),
											'nopass' => array(
													'label' => ' 不通过 ',
													'url' => 'Yii::app()->controller->createUrl("vapprove", array("id"=>$data->primaryKey,"auditstate"=>"2"))',
													),
											'updateCategory' => array(
													'label' => ' 分类 ',
													'url' => 'Yii::app()->controller->createUrl("vapprove", array("id"=>$data->primaryKey))',
													),
											'updateCounts' => array(
													'label' => ' 编辑数量 ',
													'url' => 'Yii::app()->controller->createUrl("update", array("id"=>$data->primaryKey))',
													'options'=>array(
															'ajax' =>   array(
																	'type' =>   'get',
																	'url' =>   "js:$(this).attr('href')",
																	'dataType' =>   'html',
																	'success' =>   'function(data){$("#UpdateItemCount").html(data);$("#UpdateItemCount").dialog("open");   return   false;}',
															),
													),
													),
											'log' => array(
													'label' => ' 日志 ',
													'url' => 'Yii::app()->controller->createUrl("log", array("id"=>$data->primaryKey))',
													'options'=>array(
															'ajax' =>   array(
														        'type' =>   'get',
														        'url' =>   "js:$(this).attr('href')",   
														        'dataType' =>   'html',
														        'success' =>   'function(data){$("#LogDialog").html(data);$("#LogDialog").dialog("open");   return   false;}',
														        ),
														),
													),
										),
								),
						),
					));
					
					?>
<div class="c-pag1 x-mT8">
	<?php 
		$this->widget('CListPager', array(
				'pages' => $models->pagination,
		));
	?>
</div>	
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog',   array(
      'id'=>'LogDialog',
 
    // additional   javascript options for the dialog plugin
      'options'=>array(
          'title'=>'查看日志',
  		  'modal' =>   true,
          'autoOpen'=>false,
  		  'minWidth' =>'500',
      	  'position'=>'center',
      ),
));
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog',   array(
      'id'=>'UpdateItemCount',
 
    // additional   javascript options for the dialog plugin
      'options'=>array(
          'title'=>'查看日志',
  		  'modal' =>   true,
          'autoOpen'=>false,
  		  'minWidth' =>'500',
      	  'position'=>'center',
      ),
));
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>

				</tbody>
			</table>
		</div>

</body>
</html>