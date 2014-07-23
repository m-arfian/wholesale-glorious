<?php
/* @var $this PeriodikController */
/* @var $model Periodik */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'PERIODIK_ID'); ?>
		<?php echo $form->textField($model,'PERIODIK_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ALAMAT_ID'); ?>
		<?php echo $form->textField($model,'ALAMAT_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PERIODIK_NAMA'); ?>
		<?php echo $form->textField($model,'PERIODIK_NAMA',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NUM_WAKTU'); ?>
		<?php echo $form->textField($model,'NUM_WAKTU'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SATUAN_WAKTU_ID'); ?>
		<?php echo $form->textField($model,'SATUAN_WAKTU_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CREATE_DATE'); ?>
		<?php echo $form->textField($model,'CREATE_DATE'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'EKSPEDISI_ID'); ?>
		<?php echo $form->textField($model,'EKSPEDISI_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PERIODIK_STATUS'); ?>
		<?php echo $form->textField($model,'PERIODIK_STATUS'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->