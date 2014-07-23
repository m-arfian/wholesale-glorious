<?php
/* @var $this PeriodikController */
/* @var $model Periodik */

$this->breadcrumbs=array(
	'Periodiks'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Periodik', 'url'=>array('index')),
	array('label'=>'Create Periodik', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#periodik-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Periodiks</h1>

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
	'id'=>'periodik-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'PERIODIK_ID',
		'ALAMAT_ID',
		'PERIODIK_NAMA',
		'NUM_WAKTU',
		'SATUAN_WAKTU_ID',
		'CREATE_DATE',
		/*
		'EKSPEDISI_ID',
		'PERIODIK_STATUS',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
