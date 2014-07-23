<?php
/* @var $this SubkategoriController */
/* @var $model Subkategori */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'subkategori-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableClientValidation' => true,
	'enableAjaxValidation'=>false,
	'clientOptions' => array(
		'validateOnChange' => false,
		'validateOnSubmit' => true
	),
	'htmlOptions' => array(
		'class' => 'form-horizontal',
		'enctype' => 'multipart/form-data',
	),
)); ?>

	<p class="note">Isian dengan tanda <span class="required">*</span> wajib diisi.</p>
	
	<div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'SUBKATEGORI_NAMA', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'SUBKATEGORI_NAMA', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'SUBKATEGORI_NAMA'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'KATEGORI_ID', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->dropDownList($model, 'KATEGORI_ID', Kategori::ListAll(), array('class' => 'form-control', 'prompt' => '-- Pilih Kategori --')); ?>
                    <?php echo $form->error($model, 'KATEGORI_ID'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'SUBKATEGORI_LINK', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'SUBKATEGORI_LINK', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'SUBKATEGORI_LINK'); ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        	<?php if(!$gambar->isNewRecord): ?>
        	<?php echo CHtml::link(CHtml::image($gambar->GAMBAR_NAMA,'',array('class'=>'','width'=>100)),$gambar->GAMBAR_NAMA,array('class'=>'fancy')) ?>
        	<?php endif ?>
        	<div class="form-group">
                <?php echo $form->labelEx($gambar, 'GAMBAR_NAMA', array('class' => 'col-lg-6 col-md-6 col-sm-6 col-xs-6 control-label')); ?>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <?php echo $form->fileField($gambar, 'GAMBAR_NAMA'); ?>
                    <?php echo $form->error($gambar, 'GAMBAR_NAMA'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'SUBKATEGORI_STATUS', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <div class="compactRadioGroup">
                        <?php echo $form->radioButtonList($model, 'SUBKATEGORI_STATUS', array(
                            Subkategori::AKTIF => 'Aktif',
                            Subkategori::NONAKTIF => 'Non Aktif',
                        )); ?>
                    </div>
                    <?php echo $form->error($model, 'SUBKATEGORI_STATUS'); ?>
                </div>
            </div>
        </div>
    </div><hr>

	<div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-3">
            <?php echo CHtml::htmlButton('<i class="fa fa-check"></i> Simpan', array('class' => 'btn btn-success btn-block', 'type' => 'submit')) ?>
        </div>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->