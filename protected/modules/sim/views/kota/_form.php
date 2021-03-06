<?php
/* @var $this KotaController */
/* @var $model Kota */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'kota-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'class' => 'form-horizontal'
        ),
    ));
    ?>

    <p class="note">Isian dengan tanda <span class="required">*</span> wajib diisi.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'KOTA_NAMA', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'KOTA_NAMA', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'KOTA_NAMA'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'WILAYAH_ID', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <div class="compactRadioGroup">
                        <?php echo $form->radioButtonList($model, 'WILAYAH_ID', array(
                            Kota::WIL_KOTA => 'Kota',
                            Kota::WIL_KAB => 'Kabupaten',
                        )); ?>
                    </div>
                    <?php echo $form->error($model, 'WILAYAH_ID'); ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'PROVINSI_ID', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->dropDownList($model, 'PROVINSI_ID', Provinsi::ListAll(), array('class' => 'form-control', 'prompt' => 'Pilih provinsi')); ?>
                    <?php echo $form->error($model, 'PROVINSI_ID'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'KOTA_STATUS', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <div class="compactRadioGroup">
                        <?php
                        echo $form->radioButtonList($model, 'KOTA_STATUS', array(
                            Kota::AKTIF => 'Aktif',
                            Kota::NONAKTIF => 'Non Aktif',
                        ));
                        ?>
                    </div>
                    <?php echo $form->error($model, 'KOTA_STATUS'); ?>
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