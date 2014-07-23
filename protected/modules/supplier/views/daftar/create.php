<?php
$this->pageTitle = "Supplier baru";
$this->breadcrumbs = array(
    'Supplier' => array('/supplier'),
    'Supplier baru',
);
?>
<div class="page-title">
    <div class="container">
        <h2><i class="fa fa-briefcase color"></i> Supplier baru <small></small></h2>
        <hr>
    </div>
</div>

<div class="account-content">
    <div class="container">
        <div class="form">
            <small class="note">Isian dengan tanda <span class="required">*</span> wajib diisi.</small>
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'supplier-form',
                'enableAjaxValidation' => false,
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'validateOnChange' => false
                ),
                'htmlOptions' => array(
                    'role' => 'form',
                    'class' => 'form-horizontal'
                )
                    ))
            ?>
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 col-lg-offset-1 col-md-offset-1">
                    <div class="form-group">
                        <?php echo $form->labelEx($supplier, 'SUPPLIER_NAMA', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                            <?php echo $form->textField($supplier, 'SUPPLIER_NAMA', array('class' => 'form-control input-sm')) ?>
                            <?php echo $form->error($supplier, 'SUPPLIER_NAMA'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo $form->labelEx($supplier, 'NAMA_PEMILIK', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                            <?php echo $form->textField($supplier, 'NAMA_PEMILIK', array('class' => 'form-control input-sm')); ?>
                            <?php echo $form->error($supplier, 'NAMA_PEMILIK'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo $form->labelEx($supplier, 'SUPPLIER_BIDANG', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                            <?php echo $form->textField($supplier, 'SUPPLIER_BIDANG', array('class' => 'form-control input-sm')); ?>
                            <?php echo $form->error($supplier, 'SUPPLIER_BIDANG'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo $form->labelEx($supplier, 'SUPPLIER_EMAIL', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                            <?php echo $form->emailField($supplier, 'SUPPLIER_EMAIL', array('class' => 'form-control input-sm')); ?>
                            <?php echo $form->error($supplier, 'SUPPLIER_EMAIL'); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <?php echo $form->labelEx($supplier, 'SUPPLIER_KONTAK', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                            <?php echo $form->textField($supplier, 'SUPPLIER_KONTAK', array('class' => 'form-control input-sm')); ?>
                            <?php echo $form->error($supplier, 'SUPPLIER_KONTAK'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo $form->labelEx($supplier, 'SUPPLIER_LOKASI', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                            <?php echo $form->textArea($supplier, 'SUPPLIER_LOKASI', array('class' => 'form-control input-sm')); ?>
                            <?php echo $form->error($supplier, 'SUPPLIER_LOKASI'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo $form->labelEx($supplier, 'SUPPLIER_PROVINSI', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                            <?php
                            echo $form->dropDownList($supplier, 'SUPPLIER_PROVINSI', Provinsi::ListAll(), array(
                                'class' => 'form-control input-sm',
                                'prompt' => '-- Pilih Provinsi --',
                                'ajax' => array(
                                    'type' => 'POST',
                                    'url' => array('ubahkota'),
                                    'update' => '#Supplier_SUPPLIER_KOTA',
                                ),
                            ));
                            ?>
                            <?php echo $form->error($supplier, 'SUPPLIER_PROVINSI'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo $form->labelEx($supplier, 'SUPPLIER_KOTA', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                            <?php
                            echo $form->dropDownList($supplier, 'SUPPLIER_KOTA', Kota::ListByProvinsi($supplier->SUPPLIER_PROVINSI), array(
                                'class' => 'form-control input-sm',
                                'prompt' => '-- Pilih Provinsi dulu --',
                            ));
                            ?>
                            <?php echo $form->error($supplier, 'SUPPLIER_KOTA'); ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <?php echo $form->labelEx($supplier, 'SUPPLIER_DESKRIPSI', array('class' => 'col-lg-3 col-md-3 col-sm-4 col-xs-12 control-label')); ?>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                            <?php echo $form->textArea($supplier, 'SUPPLIER_DESKRIPSI', array('class' => 'form-control input-sm smnote-full')); ?>
                            <small class="text-danger">Sertakan satu atau lebih foto produk milik Anda dan daftar harganya apabila perlu.</small>
                            <?php echo $form->error($supplier, 'SUPPLIER_DESKRIPSI'); ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <?php if (CCaptcha::checkRequirements()): ?>
                        <div class="form-group">
                            <?php echo $form->labelEx($supplier, 'CAPTCHA', array('class' => 'col-lg-3 col-md-3 col-sm-4 col-xs-12  control-label')); ?>
                            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                <?php $this->widget('CCaptcha'); ?>
                                <?php echo $form->textField($supplier, 'CAPTCHA', array('placeholder' => 'Masukkan kode', 'class' => 'form-control')); ?>
                                <?php echo $form->error($supplier, 'CAPTCHA'); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
                    <?php
                    echo CHtml::htmlButton('<i class="fa fa-check"></i> Simpan', array(
                        'class' => 'btn btn-success btn-block',
                        'type' => 'submit',
                    ))
                    ?>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                    <?php
                    echo CHtml::htmlButton('<i class="fa fa-refresh"></i> Ulangi', array(
                        'class' => 'btn btn-danger btn-block',
                        'type' => 'reset',
                    ))
                    ?>
                </div>
            </div>
            <?php $this->endWidget() ?>
        </div>

        <hr class="colorgraph">
    </div>
</div>