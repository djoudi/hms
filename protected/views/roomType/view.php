<?php
$this->breadcrumbs=array(
	'Room Types'=>array('index'),
	$model->Name,
);

$this->menu=array(
	array('label'=>'List RoomType', 'url'=>array('index')),
	array('label'=>'Create RoomType', 'url'=>array('create')),
	array('label'=>'Update RoomType', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete RoomType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RoomType', 'url'=>array('admin')),
);
?>

<h1>View RoomType #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'Name',
		'Desc',
	),
)); ?>
