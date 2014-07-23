<?php
/* @var $this PeriodikController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Periodiks',
);

$this->menu=array(
	array('label'=>'Create Periodik', 'url'=>array('create')),
	array('label'=>'Manage Periodik', 'url'=>array('admin')),
);
?>

<h1>Periodiks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
