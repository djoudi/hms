<?php
$this->breadcrumbs=array(
	'Registration',
);

Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' );
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl . '/script/date.format.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl . '/script/jquery.hms.grid.js');

Yii::app()->clientScript->registerScript('hms_grid', "
$(function() {
	$('#hms').tooltip({ });
});
");

Yii::app()->clientScript->registerCss('checkin_css', "
	#hms {
		height: 400px;
		overflow: hidden;
		padding: 25px;
	}
	
	#hms_main {
		border-width: 1px 0 0 1px;
		border-style: solid;
		border-color: #000;
	}
	#hms_main td {
		padding: 0;
		border-width: 0 1px 1px 0;
		border-style: solid;
		border-color: #000;
	}
	
	#rooms div {
		border-width: 0 0 1px 0;
		border-style: solid;
		height: 30px;
	}
	
	#days .row {
	}
	#days .cell {
		border-width: 0 1px 0 0;
		height: 42px;
	}
	.row {
		clear: both;
		height: 30px;
	}
	.cell {
		text-align: center;
		float: left;
		border-right: 1px solid #000;
		border-bottom: 1px solid #000;
		height: 100%;
	}
	
	.cell:last-of-type {
		border-right: 0px;
	}
	td { overflow:hidden;white-space:nowrap;  }
");

?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<div id="hms">
</div>
