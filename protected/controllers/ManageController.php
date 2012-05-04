<?php

class ManageController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionCheckin($id) {
		$model=new LoginForm;

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
		//	$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			//if($model->validate() && $model->login())
				//$this->redirect(Yii::app()->user->returnUrl);
				return 'hongfei';
		}
		
		//$this->renderPartial('checkin', array('id'=>$id));
		// display the login form
		$this->renderPartial('login',array('model'=>$model));
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}