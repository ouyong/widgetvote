<table>
<?php $form = $this->beginWidget('lib.widgets.CActiveFormAdv',array(
					'method' => 'post',
					'enableAjaxValidation'=>false,
					'enableClientValidation'=>true,
					'clientOptions'=>array(
							'validateOnSubmit'=>true,
					),
				));?>
		当前范围内最热投票<?php echo $hotVote->counts?>票<br/>
		------------------------------------------
		<br/>
		修改分项投票数：
		<?php foreach ($model->voteItems as $key=>$voteItem) :?>
		<tr>
			<td>
				<?php echo CHtml::value($model, 'voteItems.'.$key.'.itemtitle')?>
			</td>
			<td>
				<?php echo $form->textField($model,'voteItems.'.$key.'.itemvotecount'); ?>
			</td>
		</tr>	
		<?php endforeach;?>	
		<tr>
			<td></td><td>总计：</td>
		</tr>
		<tr>
		<td><?php echo CHtml::submitButton('确定')?><?php echo CHtml::resetButton('取消')?></td>
		</tr>
<?php $this->endWidget();?>
</table>
<a href="<?php echo Yii::app()->createUrl('audit/vlists')?>">返回</a>