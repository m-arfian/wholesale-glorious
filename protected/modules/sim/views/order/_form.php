<?php
/* @var $this OrderController */
/* @var $model Order */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'order-form',
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
                <?php echo $form->labelEx($model, 'EKSPEDISI_ID', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->dropDownList($model, 'EKSPEDISI_ID', Ekspedisi::ListTemporary()+Ekspedisi::ListAll(), array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'EKSPEDISI_ID'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'NO_RESI', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'NO_RESI', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'NO_RESI'); ?>
                </div>
            </div>
            
            <div class="form-group">
                <?php echo $form->labelEx($model, 'BIAYA_KIRIM', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                	<div class="input-group">
						<span class="input-group-addon">Rp.</span>
					  	<?php echo $form->textField($model, 'BIAYA_KIRIM', array('class' => 'form-control')); ?>
					</div>
                    <?php echo $form->error($model, 'BIAYA_KIRIM'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'ORDER_STATUS_ID', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->dropDownList($model, 'ORDER_STATUS_ID', OrderStatus::ListAll(), array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'ORDER_STATUS_ID'); ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <?php echo $form->labelEx($alamat, 'ALAMAT', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textArea($alamat, 'ALAMAT', array('cols' => 50, 'class' => 'form-control')); ?>
                    <?php echo $form->error($alamat, 'ALAMAT'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($alamat, 'KODEPOS', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($alamat, 'KODEPOS', array('size' => 5, 'maxlength' => 5, 'class' => 'form-control')); ?>
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
                        	'class' => 'form-control',
                            'type' => 'POST',
                            'url' => array('checkout/dynakota'),
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
    </div>
    
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-3">
            <?php echo CHtml::htmlButton('<i class="fa fa-check"></i> Simpan', array('class' => 'btn btn-success btn-block', 'type' => 'submit')) ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->