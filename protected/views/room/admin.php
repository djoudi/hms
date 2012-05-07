<?php
$this->breadcrumbs=array(
	'Rooms'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Room', 'url'=>array('index')),
	array('label'=>'Create Room', 'url'=>array('create')),
);
Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' );
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl . '/script/jquery.validate.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl . '/script/jquery.form.js');

Yii::app()->clientScript->registerCssFile(
	Yii::app()->clientScript->getCoreScriptUrl().
	'/jui/css/base/jquery-ui.css'
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('room-grid', {
		data: $(this).serialize()
	});
	return false;
});
");


Yii::app()->clientScript->registerScript('checkin', "
$('a.ajax').on('click', function() {
    var url = this.href;
    var dialog = $('#dialog');
    if ($('#dialog').length == 0) {
        dialog = $('<div id=\"dialog\" style=\"display:hidden\" class=\"loading\"></div>').appendTo('body');
    } 
	dialog.dialog('resize', 'auto');
    $(window).resize(function() {
        dialog.dialog('option', 'position', ['center', 'center']);
    });
    
    // load remote content
    dialog.load(
            url,
            {},
            function(responseText, textStatus, XMLHttpRequest) {
	            dialog.dialog({
					modal: true,
					buttons: {
						'Checkin': function() {
							$('#checkin-form').submit();
						},
						Cancel: function() {
							$(this).dialog('close');
						}
					},						
	                // add a close listener to prevent adding multiple divs to the document
	                close: function(event, ui) {
	                	dialog.removeClass('loading');
	                },
	            });
	        }
        );
    //prevent the browser to follow the link
    return false;
});
");

Yii::app()->clientScript->registerCss('checkin_css', "
		.ui-widget {font-size:1em;}
		label, input { display:block; }
		input.text { width:95%; padding: .4em; }
		div#users-contain { width: 350px; margin: 20px 0; }
		div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
		div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
		.ui-dialog .ui-state-error { padding: .3em; }
		.validateTips { border: 1px solid transparent; padding: 0.3em; }
");
?>

<h1>Manage Rooms</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'room-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'Id',
		'Name',
		'Type_Id',
		'Tags',
		'Status',
		array
		(
		    'class'=>'CButtonColumn',
		    'template'=>'{checkin}{checkout}',
		    'buttons'=>array
		    (
		        'checkin' => array
		        (
		            'label'=>'Check in',
		            'imageUrl'=>Yii::app()->request->baseUrl.'/images/checkin.png',
		            'url'=>'Yii::app()->createUrl("manage/checkin", array("id"=>$data->Id))',
		        	'options'=>array('class'=>'ajax'),
		        ),
		        'checkout' => array
		        (
		            'label'=>'Check out',
		            'imageUrl'=>Yii::app()->request->baseUrl.'/images/checkout.png',
		            'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->Id))',
		        	'options'=>array('class'=>'ajax'),
		        ),

		    ),
		),
	),
)); ?>
