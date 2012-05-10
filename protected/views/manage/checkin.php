
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
		<?php echo $form->labelEx($model,'性别'); ?>
		<?php echo  $form->radioButtonList($model,'gender',array('1'=>'男', '0'=>'女'),array('template'=>'{input}{label}','separator'=>'&nbsp;')); ?>
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
		// 身份证号码验证       
		jQuery.validator.addMethod("isIdCardNo", function(value, element) {       
			return this.optional(element) || isIdCardNo(value);       
			}, "请正确输入您的身份证号码");
		jQuery.validator.addMethod("stringCheck", function(value, element) {       
			return this.optional(element) || /^[\u0391-\uFFE5\w]+$/.test(value);       
			}, "只能包括中文字、英文字母、数字和下划线"); 
		jQuery.validator.addMethod("isMobile", function(value, element) {       
			var length = value.length;   
			var mobile = /^(((13[0-9]{1})|(15[0-9]{1}))+\d{8})$/;   
			return this.optional(element) || (length == 11 && mobile.test(value));       
		}, "请正确填写您的手机号码");  
	
		$("#checkin-form").validate({
			submitHandler: function(form) {
				$(form).ajaxSubmit(function() {
					$('#dialog').dialog('close');
				});
			},
			rules: {
				'CheckinForm[id]': {'required':true},
				'CheckinForm[username]': {'required':true,'stringCheck':true},
				'CheckinForm[gender]': 'required',
				'CheckinForm[mobile]': {'required':true,'isMobile':true},
				'CheckinForm[checkinDate]': 'required',
				'CheckinForm[checkoutDate]': 'required'
				},
			messages:{ 
				'CheckinForm[id]': {'required': "输入身份证号"},
				'CheckinForm[username]': {'required':"请输入姓名"},
				'CheckinForm[gender]': {'required':"选择性别"},
				'CheckinForm[mobile]': {'required':"填写手机号码"},
				'CheckinForm[checkinDate]': {'required':"入住日期"},
				'CheckinForm[checkoutDate]': {'required':"退房日期"}
			}
		});
	});
</script>
</div><!-- form -->
