<?php
/* @var $this PeriodikController */
/* @var $model Periodik */

$this->breadcrumbs=array(
	'Periodiks'=>array('index'),
	$model->PERIODIK_ID,
);

$this->menu=array(
	array('label'=>'List Periodik', 'url'=>array('index')),
	array('label'=>'Create Periodik', 'url'=>array('create')),
	array('label'=>'Update Periodik', 'url'=>array('update', 'id'=>$model->PERIODIK_ID)),
	array('label'=>'Delete Periodik', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->PERIODIK_ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Periodik', 'url'=>array('admin')),
);
?>

<h1>View Periodik #<?php echo $model->PERIODIK_ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'PERIODIK_ID',
		'ALAMAT_ID',
		'PERIODIK_NAMA',
		'NUM_WAKTU',
		'SATUAN_WAKTU_ID',
		'CREATE_DATE',
		'EKSPEDISI_ID',
		'PERIODIK_STATUS',
	),
)); ?>
