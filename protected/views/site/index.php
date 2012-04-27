<?php $this->pageTitle=Yii::app()->name; ?>

<ul>
	<li><?php echo CHtml::link('房间管理',$this->createUrl('/Room')) ?></li>
	<li><?php echo CHtml::link('客户管理',$this->createUrl('/Guest')) ?></li>
	<li><?php echo CHtml::link('入住登记',$this->createUrl('/Registration')) ?></li>
	<li><?php echo CHtml::link('房型管理',$this->createUrl('/RoomType')) ?></li>
	<li><?php echo CHtml::link('价格管理',$this->createUrl('/Price')) ?></li>
</ul>
	