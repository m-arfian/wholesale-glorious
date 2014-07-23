<?php
/* @var $this AlamatController */
/* @var $model AlamatPengiriman */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'alamat-pengiriman-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'htmlOptions' => array(
            'class' => 'form-horizontal',
        )
    ));
    ?>

    <p class="note">Isian dengan tanda <span class="required">*</span> wajib diisi.</p>
    <?php //echo $form->errorSummary($model); ?>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'NAMA_LOKASI', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')) ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'NAMA_LOKASI', array('class' => 'form-control')) ?>
                    <small>Contoh: Rumah, Kantor 1, Kantor 2, dll</small>
                    <?php echo $form->error($model, 'NAMA_LOKASI') ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'ALAMAT', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')) ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textArea($model, 'ALAMAT', array('class' => 'form-control')) ?>
                    <?php echo $form->error($model, 'ALAMAT') ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'KODEPOS', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')) ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'KODEPOS', array('class' => 'form-control', 'size' => 5, 'maxlength' => 5)) ?>
                    <?php echo $form->error($model, 'KODEPOS') ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'PROVINSI_ID', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')) ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php
                    echo $form->dropDownList($model, 'PROVINSI_ID', Provinsi::ListAll(), array(
                        'class' => 'form-control',
                        'prompt' => '-- Pilih Provinsi --',
                        'ajax' => array(
                            'type' => 'POST',
                            'url' => array('default/ubahkota'),
                            'update' => '#AlamatPengiriman_KOTA_ID',
                        ),
                    ))
                    ?>
                    <?php echo $form->error($model, 'PROVINSI_ID') ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'KOTA_ID', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')) ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php
                    echo $form->dropDownList($model, 'KOTA_ID', Kota::ListByProvinsi($model->PROVINSI_ID), array(
                        'class' => 'form-control',
                        'prompt' => '-- Pilih Kota --',
                    ))
                    ?>
                    <?php echo $form->error($model, 'KOTA_ID') ?>
                </div>
            </div>
        </div>
    </div><hr>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
            <?php echo CHtml::htmlButton('<i class="fa fa-check"></i> Simpan', array('class' => 'btn btn-block btn-primary', 'type' => 'submit')) ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->