<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id), array('view', 'id'=>$data->Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Name')); ?>:</b>
	<?php echo CHtml::encode($data->Name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Type_Id')); ?>:</b>
	<?php echo CHtml::encode(RoomType::model()->findByPk($data->Type_Id)->Name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Tags')); ?>:</b>
	<?php echo implode(', ', $data->tagLinks); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Status')); ?>:</b>
	<?php echo CHtml::encode($data->Status); ?>
	<br />

</div>