<?php
/* @var $this SupplierController */
/* @var $model Supplier */

$this->breadcrumbs=array(
	'Suppliers'=>array('index'),
	$model->SUPPLIER_ID,
);

$this->menu=array(
	array('label'=>'List Supplier', 'url'=>array('index')),
	array('label'=>'Create Supplier', 'url'=>array('create')),
	array('label'=>'Update Supplier', 'url'=>array('update', 'id'=>$model->SUPPLIER_ID)),
	array('label'=>'Delete Supplier', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->SUPPLIER_ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Supplier', 'url'=>array('admin')),
);
?>

<h1>View Supplier #<?php echo $model->SUPPLIER_ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'SUPPLIER_ID',
		'SUPPLIER_NAMA',
		'NAMA_PEMILIK',
		'SUPPLIER_BIDANG',
		'SUPPLIER_EMAIL',
		'SUPPLIER_KONTAK',
		'SUPPLIER_LOKASI',
		'SUPPLIER_KOTA',
		'SUPPLIER_DESKRIPSI',
		'SUPPLIER_STATUS',
	),
)); ?>
