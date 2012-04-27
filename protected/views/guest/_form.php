<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'guest-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Id'); ?>
		<?php echo $form->textField($model,'Id',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Name'); ?>
		<?php echo $form->textField($model,'Name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Gender'); ?>
		<?php echo $form->textField($model,'Gender'); ?>
		<?php echo $form->error($model,'Gender'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Email'); ?>
		<?php echo $form->textField($model,'Email',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Mobile'); ?>
		<?php echo $form->textField($model,'Mobile',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Mobile'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->