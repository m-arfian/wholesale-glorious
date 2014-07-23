<?php
/* @var $this RekeningController */
/* @var $model Rekening */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'rekening-form',
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

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'ATAS_NAMA', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'ATAS_NAMA', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'ATAS_NAMA'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'REKENING_BANK', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'REKENING_BANK', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'REKENING_BANK'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'REKENING_NO', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'REKENING_NO', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'REKENING_NO'); ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'REKENING_CABANG', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'REKENING_CABANG', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'REKENING_CABANG'); ?>
                </div>
            </div>
            <?php if (!$gambar->isNewRecord): ?>
                <?php echo CHtml::link(CHtml::image($gambar->GAMBAR_NAMA, '', array('class' => '', 'width' => 100)), $gambar->GAMBAR_NAMA, array('class' => 'fancy')) ?>
            <?php endif ?>
            <div class="form-group">
                <?php echo $form->labelEx($gambar, 'GAMBAR_NAMA', array('class' => 'col-lg-6 col-md-6 col-sm-6 col-xs-6 control-label')); ?>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <?php echo $form->fileField($gambar, 'GAMBAR_NAMA'); ?>
                    <?php echo $form->error($gambar, 'GAMBAR_NAMA'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'REKENING_STATUS', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <div class="compactRadioGroup">
                        <?php
                        echo $form->radioButtonList($model, 'REKENING_STATUS', array(
                            Rekening::AKTIF => 'Aktif',
                            Rekening::NONAKTIF => 'Non Aktif',
                        ));
                        ?>
                    </div>
                    <?php echo $form->error($model, 'REKENING_STATUS'); ?>
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