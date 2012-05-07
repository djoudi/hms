<?php

class ManageController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionCheckin() {
		$model=new CheckinForm;

		// uncomment the following code to enable ajax-based validation
		/*
		if(isset($_POST['ajax']) && $_POST['ajax']==='checkin-form-checkin-form')
		{
		    echo CActiveForm::validate($model);
		    Yii::app()->end();
		}
		*/

		if(isset($_POST['CheckinForm']))
		{
		    $model->attributes=$_POST['CheckinForm'];
		    if($model->validate())
		    {
				echo 'hongfei';
				Yii::app()->end();
		    }
		}
		$this->renderPartial('checkin',array('model'=>$model));
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