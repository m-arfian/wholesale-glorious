<?php
$this->pageTitle = "Konfirmasi Pembayaran";
$this->breadcrumbs = array(
    'Konfirmasi pembayaran',
);
?>
<div class="page-title">
    <div class="container">
        <h2><i class="fa fa-desktop color"></i> Konfirmasi pembayaran <small></small></h2>
        <hr>
    </div>
</div>

<div class="account-content">
    <div class="container">
        <div class="form">
            <small class="note">Isian dengan tanda <span class="required">*</span> wajib diisi.</small>
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'konfirmasi-form',
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
            )) ?>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col-lg-offset-2 col-md-offset-2">
                    <div class="form-group">
                        <?php echo $form->labelEx($konfirmasi, 'NAMA_PELANGGAN', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                            <?php echo $form->textField($konfirmasi, 'NAMA_PELANGGAN', array(
                                'class' => 'form-control input-sm tip',
                                'data-title' => 'Nama pelanggan yang melakukan pemesanan'
                            )); ?>
                            <?php echo $form->error($konfirmasi, 'NAMA_PELANGGAN'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo $form->labelEx($konfirmasi, 'INVOICE_ORDER', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                            <?php echo $form->textField($konfirmasi, 'INVOICE_ORDER', array(
                                'class' => 'form-control input-sm tip',
                                'data-title' => 'Order ID yang diperoleh ketika melakukan pemesanan'
                            )); ?>
                            <?php echo $form->error($konfirmasi, 'INVOICE_ORDER'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo $form->labelEx($konfirmasi, 'REKENING_ID', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                            <?php echo $form->dropDownList($konfirmasi, 'REKENING_ID', Rekening::ListAll(), array(
                                'class' => 'form-control input-sm',
                                'prompt' => '-- Pilih Rekening --',
                            )); ?>
                            <?php echo $form->error($konfirmasi, 'REKENING_ID'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo $form->labelEx($konfirmasi, 'TOTAL', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                            <div class="input-group">
                                <span class="input-group-addon">Rp.</span>
                                <?php echo $form->textField($konfirmasi, 'TOTAL', array('class' => 'form-control input-sm')); ?>
                            </div>
                            <?php echo $form->error($konfirmasi, 'TOTAL'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo $form->labelEx($konfirmasi, 'EMAIL', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                            <?php echo $form->textField($konfirmasi, 'EMAIL', array(
                                'class' => 'form-control input-sm tip',
                                'data-title' => 'Email aktif Anda'
                            )); ?>
                            <?php echo $form->error($konfirmasi, 'EMAIL'); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <?php echo $form->labelEx($konfirmasi, 'NO_TELP', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                            <?php echo $form->textField($konfirmasi, 'NO_TELP', array(
                                'class' => 'form-control input-sm tip',
                                'data-title' => 'No Telepon Anda yang bisa dihubungi'
                            )); ?>
                            <?php echo $form->error($konfirmasi, 'NO_TELP'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo $form->labelEx($konfirmasi, 'BAYAR_DATE', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                            <?php echo $form->textField($konfirmasi, 'BAYAR_DATE', array(
                                'class' => 'form-control input-sm datepicker tip',
                                'data-title' => 'Tanggal dan waktu melakukan pembayaran'
                            )); ?>
                            <?php echo $form->error($konfirmasi, 'BAYAR_DATE'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo $form->labelEx($konfirmasi, 'BANK_PENGIRIM', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                            <?php echo $form->textField($konfirmasi, 'BANK_PENGIRIM', array(
                                'class' => 'form-control input-sm tip',
                                'data-title' => 'Nama bank yang Anda gunakan untuk melakukan transfer'
                            )); ?>
                            <?php echo $form->error($konfirmasi, 'BANK_PENGIRIM'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo $form->labelEx($konfirmasi, 'ATAS_NAMA', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                            <?php echo $form->textField($konfirmasi, 'ATAS_NAMA', array(
                                'class' => 'form-control input-sm tip',
                                'data-title' => 'Nama pemilik rekening bank asal'
                            )); ?>
                            <?php echo $form->error($konfirmasi, 'ATAS_NAMA'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo $form->labelEx($konfirmasi, 'CATATAN', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                            <?php echo $form->textArea($konfirmasi, 'CATATAN', array('class' => 'form-control input-sm')); ?>
                            <?php echo $form->error($konfirmasi, 'CATATAN'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
                    <?php echo CHtml::htmlButton('<i class="fa fa-check"></i> Kirim', array(
                        'class' => 'btn btn-info btn-block',
                        'type' => 'submit',
                    )) ?>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                    <?php echo CHtml::htmlButton('<i class="fa fa-refresh"></i> Ulangi', array(
                        'class' => 'btn btn-danger btn-block',
                        'type' => 'reset',
                    )) ?>
                </div>
            </div>
            <?php $this->endWidget() ?>
        </div>

        <hr class="colorgraph">
    </div>
</div>