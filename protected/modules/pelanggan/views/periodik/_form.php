<?php
/* @var $this PeriodikController */
/* @var $model Periodik */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'periodik-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ALAMAT_ID'); ?>
		<?php echo $form->textField($model,'ALAMAT_ID'); ?>
		<?php echo $form->error($model,'ALAMAT_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PERIODIK_NAMA'); ?>
		<?php echo $form->textField($model,'PERIODIK_NAMA',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'PERIODIK_NAMA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NUM_WAKTU'); ?>
		<?php echo $form->textField($model,'NUM_WAKTU'); ?>
		<?php echo $form->error($model,'NUM_WAKTU'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SATUAN_WAKTU_ID'); ?>
		<?php echo $form->textField($model,'SATUAN_WAKTU_ID'); ?>
		<?php echo $form->error($model,'SATUAN_WAKTU_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CREATE_DATE'); ?>
		<?php echo $form->textField($model,'CREATE_DATE'); ?>
		<?php echo $form->error($model,'CREATE_DATE'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'EKSPEDISI_ID'); ?>
		<?php echo $form->textField($model,'EKSPEDISI_ID'); ?>
		<?php echo $form->error($model,'EKSPEDISI_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PERIODIK_STATUS'); ?>
		<?php echo $form->textField($model,'PERIODIK_STATUS'); ?>
		<?php echo $form->error($model,'PERIODIK_STATUS'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->