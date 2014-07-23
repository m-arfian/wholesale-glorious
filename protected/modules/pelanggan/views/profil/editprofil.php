<?php
$this->pageTitle = "Edit Profil";
$this->breadcrumbs = array(
    'Pelanggan' => array('/pelanggan'),
    'Profil' => array('profil/'),
    'Edit Profil',
);
?>

<!-- Page title -->
<div class="page-title">
    <div class="container">
        <h2><i class="fa fa-user color"></i> Edit profil <small></small></h2>
        <hr />
    </div>
</div>
<!-- Page title -->

<div class="pelanggan">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="form">
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'editpribadi-form',
                        'enableClientValidation' => true,
                        'clientOptions' => array(
                            'validateOnSubmit' => true
                        ),
                        'htmlOptions' => array(
                            'class' => 'form-horizontal',
                            'enctype' => 'multipart/form-data',
                        )
                    ));
                    ?>

                    <p class="note">Isian dengan tanda <span class="required">*</span> wajib diisi.</p>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <?php echo $form->labelEx($pelanggan, 'NAMA', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                    <?php echo $form->textField($pelanggan, 'NAMA', array('class' => 'form-control')); ?>
                                    <?php echo $form->error($pelanggan, 'NAMA'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <?php echo $form->labelEx($pelanggan, 'KELAMIN', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                    <div class="compactRadioGroup">
                                        <?php echo $form->radioButtonList($pelanggan, 'KELAMIN', array('L' => 'Laki-laki', 'P' => 'Perempuan')); ?>
                                    </div>
                                    <?php echo $form->error($pelanggan, 'KELAMIN'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php echo $form->labelEx($pelanggan, 'EMAIL', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                    <?php echo $form->emailField($pelanggan, 'EMAIL', array('class' => 'form-control')); ?>
                                    <?php echo $form->error($pelanggan, 'EMAIL'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php echo $form->labelEx($pelanggan, 'HP', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                    <?php echo $form->telField($pelanggan, 'HP', array('class' => 'form-control')); ?>
                                    <?php echo $form->error($pelanggan, 'HP'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php echo $form->labelEx($gambar, 'GAMBAR_NAMA', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                    <?php echo $form->fileField($gambar, 'GAMBAR_NAMA'); ?>
                                    <?php echo $form->error($gambar, 'GAMBAR_NAMA'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <?php echo $form->labelEx($alamat, 'ALAMAT', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                    <?php echo $form->textArea($alamat, 'ALAMAT', array('class' => 'form-control')); ?>
                                    <?php echo $form->error($alamat, 'ALAMAT'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php echo $form->labelEx($alamat, 'KODEPOS', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                    <?php echo $form->textField($alamat, 'KODEPOS', array('class' => 'form-control')); ?>
                                    <?php echo $form->error($alamat, 'KODEPOS'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php echo $form->labelEx($alamat, 'PROVINSI_ID', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                    <?php
                                    echo $form->dropDownList($alamat, 'PROVINSI_ID', Provinsi::ListAll(), array(
                                        'class' => 'form-control',
                                        'prompt' => '-- Pilih Provinsi --',
                                        'ajax' => array(
                                            'type' => 'POST',
                                            'url' => array('default/ubahkota'),
                                            'update' => '#AlamatPengiriman_KOTA_ID',
                                        ),
                                    ));
                                    ?>
                                    <?php echo $form->error($alamat, 'PROVINSI_ID'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php echo $form->labelEx($alamat, 'KOTA_ID', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                    <?php
                                    echo $form->dropDownList($alamat, 'KOTA_ID', Kota::ListByProvinsi($alamat->PROVINSI_ID), array(
                                        'class' => 'form-control',
                                        'prompt' => '-- Pilih Kota --',
                                    ));
                                    ?>
                                    <?php echo $form->error($alamat, 'KOTA_ID'); ?>
                                </div>
                            </div>
                        </div>
                    </div><hr>

                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
                            <?php echo CHtml::htmlButton('<i class="fa fa-check"></i> Simpan', array('class' => 'btn btn-block btn-primary', 'type' => 'submit')) ?>
                        </div>
                    </div>
                    <?php $this->endWidget() ?>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <?php $this->renderPartial('/layouts/_rightside', array('registered' => $registered)) ?>
            </div>
        </div>
        <hr class="colorgraph">
    </div>
</div>