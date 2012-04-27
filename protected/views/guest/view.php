<?php
$this->breadcrumbs=array(
	'Guests'=>array('index'),
	$model->Name,
);

$this->menu=array(
	array('label'=>'List Guest', 'url'=>array('index')),
	array('label'=>'Create Guest', 'url'=>array('create')),
	array('label'=>'Update Guest', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete Guest', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Guest', 'url'=>array('admin')),
);
?>

<h1>View Guest #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'Name',
		'Gender',
		'Email',
		'Mobile',
	),
)); ?>
