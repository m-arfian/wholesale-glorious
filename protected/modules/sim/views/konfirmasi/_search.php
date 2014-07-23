<?php
/* @var $this KonfirmasiController */
/* @var $model Konfirmasi */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
        'htmlOptions' => array(
            'class' => 'form-horizontal'
        ),
    ));
    ?>
    
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="form-group">
                <?php echo $form->label($model, 'KONFIRMASI_ID', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'KONFIRMASI_ID', array('class' => 'form-control')) ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->label($model, 'KONFIRMASI_DATE', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'KONFIRMASI_DATE', array('class' => 'form-control datepicker')) ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->label($model, 'INVOICE_ORDER', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'INVOICE_ORDER', array('class' => 'form-control')) ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->label($model, 'REKENING_ID', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->dropDownList($model, 'REKENING_ID', Rekening::ListAll(), array('class' => 'form-control', 'prompt' => 'Semua rekening')) ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->label($model, 'NAMA_PELANGGAN', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'NAMA_PELANGGAN', array('class' => 'form-control')) ?>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="form-group">
                <?php echo $form->label($model, 'BAYAR_DATE', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'BAYAR_DATE', array('class' => 'form-control datepicker')) ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->label($model, 'TOTAL', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'TOTAL', array('class' => 'form-control')) ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->label($model, 'CATATAN', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textArea($model, 'CATATAN', array('class' => 'form-control')) ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->label($model, 'BANK_PENGIRIM', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'BANK_PENGIRIM', array('class' => 'form-control')) ?>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="form-group">
                <?php echo $form->label($model, 'ATAS_NAMA', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'ATAS_NAMA', array('class' => 'form-control')) ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->label($model, 'EMAIL', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'EMAIL', array('class' => 'form-control')) ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->label($model, 'NO_TELP', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'NO_TELP', array('class' => 'form-control')) ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->label($model, 'KONFIRMASI_STATUS', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <div class="compactRadioGroup">
                        <?php echo $form->radioButtonList($model, 'KONFIRMASI_STATUS', array(
                            '' => 'Semua status',
                            Konfirmasi::PENDING => 'Pending',
                            Konfirmasi::TOLAK => 'Ditolak',
                            Konfirmasi::OK => 'Diterima'
                        )) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-xs-12 col-lg-offset-4">
            <?php echo CHtml::htmlButton('<i class="fa fa-search-plus"></i> Cari', array('class' => 'btn btn-block btn-info', 'type' => 'submit')) ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->