<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>创建投票</title>

<link href="<?php echo Yii::app()->request->baseUrl?>/css/toupiao_s.css" rel="stylesheet" type="text/css" />
</head>

<body>

	<div class="twjtp_creatwindow" style="left: 350px; top: 50px;">
		<!--弹窗位置需动态算出。-->
		<div class="twjtp_title">
			<a class="twjtp_close" href="#" title="关闭"></a>创建投票
		</div>
		<div class="twjtp_windowbody">
		<?php $form = $this->beginWidget('lib.widgets.CActiveFormAdv',array(
					'method' => 'post',
					'htmlOptions'=>array('enctype'=>'multipart/form-data'),
					'enableAjaxValidation'=>false,
					'enableClientValidation'=>true,
					'clientOptions'=>array(
							'validateOnSubmit'=>true,
					),
				));?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0"
				class="wrap">
				<tr>
					<th><b>*</b>投票标题：</th>
					<td>
						<?php echo $form->textField($model,'title')?>
						<span><?php echo $form->error($model,'title');?></span>
					</td>
				</tr>
				<tr>
					<th valign="top">投票图片：</th>
					<td><div>
							<?php echo $form->FileField($model,'picpath'); ?> 
						</div>
						<div class="flie">
							<a class="close2" href="#" title="关闭"></a>
							<?php if($model->picpath == null) :?>
								<img src="<?php echo Yii::app()->request->baseUrl?>/images/no_pic.jpg" />
							<?php else:?>
								<img src="<?php echo Yii::app()->request->baseUrl.$model->picpath?>" />
							<?php endif;?>
						</div>
						<div class="fl mt">
							<span><?php echo $form->error($model,'picpath');?></span><br />
					</div></td>
				</tr>
				<tr>
					<th><b>*</b>投票方式：</th>
					<td>
					单选<?php echo $form->radioButton($model,'votetype',array('value'=>0, 'uncheckValue'=>null),array('separator'=>''));?>
					多选<?php echo $form->radioButton($model,'votetype',array('value'=>1, 'uncheckValue'=>null),array('separator'=>''));?>
					<span><?php echo $form->error($model,'votetype');?></span>
					</td>
				</tr>
				<tr>
					<th>截止时间：</th>
					<td>
					<?php 
						$this->widget('zii.widgets.jui.CJuiDatePicker',array( 
			                'model'=>$model, 
				            'attribute'=>'voteendtime', 
				            'options'=>array( 
				                        'showOn'=>'both', 
				                        'dateFormat'=>'yy-mm-dd', 
				            			'buttonImage'=>Yii::app()->request->baseUrl.'/images/shezhi.gif',
				            			'minDate'=>'new Date()',
				            ), 
				            'htmlOptions'=>array( 
				                        'style'=>'height:18px', 
				                        'maxlength'=>8, 
				            ), 
			    		)); 
						?>
						<span><?php echo $form->error($model,'voteendtime');?></span>
					</td>
				</tr>
				<tr>
					<th>投票分类：</th>
					<td>
					<?php foreach ($datas as $category) :?>
					<?php echo $category->categoryname?>-<?php echo $category->id?>
					<?php endforeach;?><br/>
					<?php echo $form->textField($model,'voteCateRelateds..category_id')?><br/>
					<?php echo $form->textField($model,'voteCateRelateds..category_id')?><br/>
					<?php echo $form->textField($model,'voteCateRelateds..category_id')?><br/>
					<span>选择分类后，投票将有机会展示在更多的分类中</span>
					</td>
				</tr>
				<tr>
					<th valign="top"><b>*</b>投票选项：</th>
					<td>
						<div class="bar">
							<a href="" title="">
								<img src="<?php echo Yii::app()->request->baseUrl?>/images/c_add.jpg" width="13" height="13" />
							</a>
							<a href="" title="">
								<img src="<?php echo Yii::app()->request->baseUrl?>/images/c_up.jpg" width="12" height="13" />
							</a>
							<a href="" title="">
								<img src="<?php echo Yii::app()->request->baseUrl?>/images/c_down.jpg" width="12" height="13" />
							</a>
							<a href="" title="">
								<img src="<?php echo Yii::app()->request->baseUrl?>/images/c_del.jpg" width="12" height="13" />
							</a>
						</div>
						
						
						<ul class="optionwrap fl">
							<li class="bgblue1" onmouseover="this.className='bgblue2'"
								onmouseout="this.className='bgblue1'">
								<?php //echo $form->checkBoxList($model,'voteItems..itemtitle',array('我觉得这个啊，真好！' => '我觉得这个啊，真好！','我觉得这个啊，真不好！' => '我觉得这个啊，真不好！','我觉得这个很一般！' => '我觉得这个很一般！'),array('separator'=>''));?>
								<?php echo $form->textField($model,'voteItems..itemtitle')?><br/>
								<?php echo $form->textField($model,'voteItems..itemtitle')?><br/>
								<?php echo $form->textField($model,'voteItems..itemtitle')?><br/>
							</li>
						</ul>
						<div class="fl mt2">
							<span><?php echo $form->error($model,'voteItems..itemtitle');?></span><br />
						</div>
					</td>
				</tr>
				<tr>
					<th>昵称：</th>
					<td>
					<?php echo $form->textField($model,'creatername')?>
						<span class="black">邮箱：</span>
						<?php echo $form->textField($model,'createremail')?>
						<span><?php echo $form->error($model,'createremail')?></span>
					</td>
				</tr>
				<tr>
					<th><b>*</b>验证码：</th>
					<td>
					<?php echo $form->textField($model,'verifyCode',array('size'=>10)); ?>
					
					<a href="#" class="twjtp_yzm">
						<?php $this->widget('CCaptcha'); ?>
					</a>
					<span>
						<?php echo $form->error($model,'verifyCode'); ?>
					</span></td>
				</tr>
				<tr class="bgnone">
					<th>&nbsp;</th>
					<td>
						<?php echo CHtml::submitButton('确定',array('id'=>'submit')); ?>
					</td>
				</tr>
			<?php $this->endWidget();?>
			</table>
		</div>
	</div>
	<div class="twjtp_mask"
		style="position: relative; height: 900px; display: ;">
		<!--遮罩高度需动态算出。-->
	</div>
</body>
</html>
