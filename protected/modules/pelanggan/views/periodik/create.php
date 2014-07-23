<?php
/* @var $this PeriodikController */
/* @var $model Periodik */

$this->breadcrumbs=array(
	'Periodiks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Periodik', 'url'=>array('index')),
	array('label'=>'Manage Periodik', 'url'=>array('admin')),
);
?>

<h1>Create Periodik</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>