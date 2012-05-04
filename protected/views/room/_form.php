<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'room-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Name'); ?>
		<?php echo $form->textField($model,'Name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Type_Id'); ?>
		<?php echo $form->dropDownList($model,'Type_Id',RoomType::loadItems()); ?>
		<?php echo $form->error($model,'Type_Id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Tags'); ?>
		<?php echo $form->textField($model,'Tags',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'Tags'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->