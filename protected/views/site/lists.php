<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>投票二级页面</title>
<link href="<?php echo Yii::app()->request->baseUrl?>/css/toupiao_s.css" rel="stylesheet" type="text/css" />
<style type="text/css">

</style>
</head>
<body>
<div class="twjtp_topss twjtp_middle">
   <div class="twjtp_topnrss">
      <div class="twjtp_nrss twjtp_mr20"><strong class="twjtp_mt27">请选择投票分类</strong></div>
      <div class="twjtp_nrss twjtp_nrw twjtp_mr20">
        <span>一级分类</span>
         <select name="">
           <option>一级分类一级</option>
           <option>一级分类一级</option>
           <option>一级分类一级</option>
         </select>
      </div>
      <div class="twjtp_nrss twjtp_nrw twjtp_mr20">
        <span>二级分类</span>
         <select name="">
           <option>一级分类一级</option>
           <option>一级分类一级</option>
           <option>一级分类一级</option>
         </select>
      </div>
      <div class="twjtp_nrss twjtp_nrw twjtp_mr20">
        <span>三级分类</span>
         <select name="">
           <option>一级分类一级</option>
           <option>一级分类一级</option>
           <option>一级分类一级</option>
         </select>
      </div>
   </div>

</div>

<div class="twjtp_middle">
   <div class="twjtp_2tit twjtp_mt10">  
  <div class="twjtp_yq">
        <ul>
           <li class="bgred1">
				<?php if($page == 'hot') {?>
				<?php echo "最热";?>
				<?php } else {?>
				<a href="<?php echo Yii::app()->createUrl('site/lists',array('page'=>'hot'))?>">最热</a>
				<?php }?>
				</li>
				<li class="bgblue1" onmouseover="this.className='bgblue2'"
					onmouseout="this.className='bgblue1'">
					<?php if($page == 'new') {?>
					<?php echo "最新";?>
					<?php } else {?>
					<a href="<?php echo Yii::app()->createUrl('site/lists',array('page'=>'new'))?>">最新</a>
					<?php }?>
				</li>
        </ul>
        <a href="<?php echo Yii::app()->createUrl('site/add')?>" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl?>/images/twjtp_13.jpg" width="108" height="26" /></a>
     </div>
     <div class="twjtp_2tpss">
     <!-- 
       <input class="input1" type="text" name="textfield" id="textfield" />
       <input class="input2" name="" type="button" value="投票搜索" />
        -->
     </div>
      <?php $form = $this->beginWidget('lib.widgets.CActiveFormAdv',array(
											'method' => 'get',
										));?>
			<?php echo CHtml::textField('keyword')?>
			<?php echo CHtml::submitButton('搜索', array('class'=>'input2'))?>
		<?php $this->endWidget();?>
   </div>
   <div class="twjtp_2nr twjtp_mt10">
     <!--第一组开始-->
     <?php foreach ($models->getData() as $model) :?>
      <div class="twjtp_2nrli twjtp_mr">
         <div class="twjtp_2nrmain" onmouseover="this.className='twjtp_2nrmainon'" onmouseout="this.className='twjtp_2nrmain'">
           <div class="twjtp_2nrbg" >
              <div class="twjtp_2nrdiv">
                  <div class="twjtp_tit"> <strong>相关投票</strong></div>
                  <div class="twjtp_2nrdivnr ontit"> <div class="h24 ontit"><?php echo CHtml::value($model, 'title')?></div>
                    <!-- 投票内容 -->
                    <?php $form = $this->beginWidget('lib.widgets.CActiveFormAdv',array(
											'method' => 'post',
										));?>
                     <div class="twjtp_xq">
                         <div class="twjtp_xqimg"><img src="<?php echo Yii::app()->request->baseUrl.$model->picpath?>" /></div>
                         <div class="twjtp_xuanxiang gao4 twjtp_mt10">
                            <div class="twjtp_xuanxiangl">
                            	<?php foreach ($model->voteItems as $voteItem) :?>
                                 <div class="xuanzeul">
                                     <div class="twjtp_dx">
                                     <?php echo $form->radioButton(
											$voteItem, 'id', 
											array('value'=>$voteItem->id, 'uncheckValue'=>null)
										);?>
									</div>
                                     <div class="twjtp_bt">
                                        <div class="tit"><?php echo CHtml::value($voteItem, 'itemtitle')?></div>
                                     </div>
                                 </div>
                                 <?php endforeach;?>
                            </div>
                            <div class="twjtp_xuanxiangr"></div>
                         </div>
                         <div class="twjtp_tpiao">
                            <span>投票后可查看结果</span>
                            <strong>
                            <?php echo CHtml::submitButton('投票',array('class'=>'twjtp_xqinput2')); ?>
                            </strong>
                         </div>
                      </div>
                  <?php $this->endWidget();?>
                  <!-- 投票内容结束 -->
                 </div>
              </div>
              <div class="twjtp_2nrbgb"></div>
              <div class="twjtp_clear"></div>
           </div>
         </div>
         <div class="twjtp_2nrtxt">
            <ul>
               <li class="w70">发 起 人：</li><li class="w100"><span><?php echo CHtml::value($model, 'creatername')?></span></li>
               <li class="w70">投票人数：</li><li class="w100"><span><?php echo CHtml::value($model, 'counts')?></span>人</li>
               <li class="w70">发起日期：</li><li class="w100"><?php echo CHtml::value($model, 'createtime')?></li>
               <li class="w70">截止日期：</li><li class="w100"><?php echo CHtml::value($model, 'voteendtime')?></li>
            </ul>
         </div>
      </div>
      <?php endforeach;?>
      <!--第一组结束-->
   </div>
		   <?php $this->widget('CLinkPager', array(
						'pages' => $models->pagination,
			));?>
   <!-- 
   <div class="twjtp_2fy twjtp_mt20">
      <div class="page">
           <span><a href="#" target="_blank" title="">下一页 &gt;&gt;</a></span>  
           <div class="pagea"><strong>1</strong><a href="#" target="_blank" title="">2</a><a href="#" target="_blank" title="">3</a><a href="#" target="_blank" title="">4</a><a href="#" target="_blank" title="">5</a><a href="#" target="_blank" title="">6</a><a href="#" target="_blank" title="">7</a><a href="#" target="_blank" title="">8</a><a href="#" target="_blank" title="">9</a><strong>...</strong></div> 
           <span> &lt;&lt;上一页</span> 
      </div>
   
    </div>
     -->
</div>
</body>
</html>
