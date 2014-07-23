<?php
/* @var $this GambarController */
/* @var $model Gambar */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'gambar-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
		'clientOptions' => array(
			'validateOnChange' => false,
			'validateOnSubmit' => true
		),
        'htmlOptions' => array(
            'class' => 'form-horizontal',
            'enctype' => 'multipart/form-data',
        ),
    ));
    ?>

    <p class="note">Isian dengan tanda <span class="required">*</span> wajib diisi.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'GAMBAR_NAMA', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->fileField($model, 'GAMBAR_NAMA'); ?>
                    <?php echo $form->error($model, 'GAMBAR_NAMA'); ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'GAMBAR_LOKASI', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->dropDownList($model, 'GAMBAR_LOKASI', Gambar::ListLokasi(), array(
                        'class' => 'form-control',
                        'prompt' => '-- Pilih lokasi --'
                    )); ?>
                    <?php echo $form->error($model, 'GAMBAR_LOKASI'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'GAMBAR_STATUS', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <div class="compactRadioGroup">
                        <?php echo $form->radioButtonList($model, 'GAMBAR_STATUS', array(
                            Gambar::AKTIF => 'Aktif',
                            Gambar::NON_AKTIF => 'Non Aktif',
                        )); ?>
                    </div>
                    <?php echo $form->error($model, 'GAMBAR_STATUS'); ?>
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