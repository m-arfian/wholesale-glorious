<?php
/* @var $this SupplierController */
/* @var $model Supplier */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'supplier-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableClientValidation' => true,
        'enableAjaxValidation' => false,
        'clientOptions' => array(
            'validateOnChange' => false,
            'validateOnSubmit' => true
        ),
        'htmlOptions' => array(
            'class' => 'form-horizontal',
        ),
    ));
    ?>

    <p class="note">Isian dengan tanda <span class="required">*</span> wajib diisi.</p>

    <?php // echo $form->errorSummary($model); ?>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'SUPPLIER_NAMA', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'SUPPLIER_NAMA', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'SUPPLIER_NAMA'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'NAMA_PEMILIK', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'NAMA_PEMILIK', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'NAMA_PEMILIK'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'SUPPLIER_BIDANG', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'SUPPLIER_BIDANG', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'SUPPLIER_BIDANG'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'SUPPLIER_EMAIL', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'SUPPLIER_EMAIL', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'SUPPLIER_EMAIL'); ?>
                </div>
            </div>
            
            <div class="form-group">
                <?php echo $form->labelEx($model, 'SUPPLIER_KONTAK', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'SUPPLIER_KONTAK', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'SUPPLIER_KONTAK'); ?>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'SUPPLIER_LOKASI', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textArea($model, 'SUPPLIER_LOKASI', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'SUPPLIER_LOKASI'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'SUPPLIER_PROVINSI', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php
                    echo $form->dropDownList($model, 'SUPPLIER_PROVINSI', Provinsi::ListAll(), array(
                        'class' => 'form-control input-sm',
                        'prompt' => '-- Pilih Provinsi --',
                        'ajax' => array(
                            'type' => 'POST',
                            'url' => array('ubahkota'),
                            'update' => '#Supplier_SUPPLIER_KOTA',
                        ),
                    ));
                    ?>
                    <?php echo $form->error($model, 'SUPPLIER_PROVINSI'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'SUPPLIER_KOTA', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->dropDownList($model, 'SUPPLIER_KOTA', Kota::ListByProvinsi($supplier->SUPPLIER_PROVINSI), array(
                        'class' => 'form-control',
                        'prompt' => '-- Pilih Provinsi dulu --'
                    )); ?>
                    <?php echo $form->error($model, 'SUPPLIER_KOTA'); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'SUPPLIER_DESKRIPSI', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textArea($model, 'SUPPLIER_DESKRIPSI', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'SUPPLIER_DESKRIPSI'); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-3">
            <?php echo CHtml::htmlButton('<i class="fa fa-check"></i> Simpan', array('class' => 'btn btn-success btn-block', 'type' => 'submit')) ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->