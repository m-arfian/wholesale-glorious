<?php
/* @var $this PeriodikController */
/* @var $model Periodik */

$this->breadcrumbs=array(
	'Periodiks'=>array('index'),
	$model->PERIODIK_ID=>array('view','id'=>$model->PERIODIK_ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Periodik', 'url'=>array('index')),
	array('label'=>'Create Periodik', 'url'=>array('create')),
	array('label'=>'View Periodik', 'url'=>array('view', 'id'=>$model->PERIODIK_ID)),
	array('label'=>'Manage Periodik', 'url'=>array('admin')),
);
?>

<h1>Update Periodik <?php echo $model->PERIODIK_ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>