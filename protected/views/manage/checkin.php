<form method="post" class="cmxform" id="form" action="<?php echo Yii::app()->createUrl('manage/checkin', array('id'=>$id)) ?>">
	<fieldset>
		<legend>Fields with <span class="required">*</span> are required.</legend>
		<p>
			<label for="username">Username</label>
			<input id="username" name="username" title="Please enter your username (at least 3 characters)" class="required" minlength="3" />
		</p>
		<p>
			<label for="password">Password</label>
			<input type="password" name="password" id="password" class="required" minlength"5" />
		</p>
	</fieldset>
</form>