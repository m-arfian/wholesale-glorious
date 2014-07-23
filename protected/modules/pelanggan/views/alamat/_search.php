<?php
/* @var $this AlamatController */
/* @var $model AlamatPengiriman */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ALAMAT_ID'); ?>
		<?php echo $form->textField($model,'ALAMAT_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PELANGGAN_ID'); ?>
		<?php echo $form->textField($model,'PELANGGAN_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NAMA_LOKASI'); ?>
		<?php echo $form->textField($model,'NAMA_LOKASI',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ALAMAT'); ?>
		<?php echo $form->textArea($model,'ALAMAT',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'KODEPOS'); ?>
		<?php echo $form->textField($model,'KODEPOS',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'KOTA_ID'); ?>
		<?php echo $form->textField($model,'KOTA_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PROVINSI_ID'); ?>
		<?php echo $form->textField($model,'PROVINSI_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ALAMAT_STATUS'); ?>
		<?php echo $form->textField($model,'ALAMAT_STATUS'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->