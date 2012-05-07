<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'checkin-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gender'); ?>
		<?php echo $form->textField($model,'gender'); ?>
		<?php echo $form->error($model,'gender'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mobile'); ?>
		<?php echo $form->textField($model,'mobile'); ?>
		<?php echo $form->error($model,'mobile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'checkinDate'); ?>
		<?php echo $form->textField($model,'checkinDate'); ?>
		<?php echo $form->error($model,'checkinDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'checkoutDate'); ?>
		<?php echo $form->textField($model,'checkoutDate'); ?>
		<?php echo $form->error($model,'checkoutDate'); ?>
	</div>

<?php $this->endWidget(); ?>
<script type="text/javascript">
	$(function() {
		$("#checkin-form").validate({
			submitHandler: function(form) {
				$(form).ajaxSubmit({
					target: "#result"
				});
			},
			rules: {
				'CheckinForm[id]': 'required',
				'CheckinForm[username]': 'required',
				'CheckinForm[gender]': 'required',
				'CheckinForm[mobile]': 'required',
				'CheckinForm[checkinDate]': 'required',
				'CheckinForm[checkoutDate]': 'required'
			}
		});
	});
</script>
</div><!-- form -->