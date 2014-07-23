<?php
/* @var $this SupplierController */
/* @var $model Supplier */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
        'htmlOptions' => array(
            'class' => 'form-horizontal'
        )
    ));
    ?>

    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="form-group">
                <?php echo $form->label($model, 'SUPPLIER_ID', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'SUPPLIER_ID', array('class' => 'form-control')); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->label($model, 'SUPPLIER_NAMA', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'SUPPLIER_NAMA', array('class' => 'form-control')); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->label($model, 'NAMA_PEMILIK', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'NAMA_PEMILIK', array('class' => 'form-control')); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->label($model, 'SUPPLIER_BIDANG', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'SUPPLIER_BIDANG', array('class' => 'form-control')); ?>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="form-group">
                <?php echo $form->label($model, 'SUPPLIER_EMAIL', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'SUPPLIER_EMAIL', array('class' => 'form-control')); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->label($model, 'SUPPLIER_KONTAK', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'SUPPLIER_KONTAK', array('class' => 'form-control')); ?>
                </div>
            </div>
            
            <div class="form-group">
                <?php echo $form->label($model, 'SUPPLIER_LOKASI', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textArea($model, 'SUPPLIER_LOKASI', array('class' => 'form-control')); ?>
                </div>
            </div>
            
            <div class="form-group">
                <?php echo $form->label($model, 'SUPPLIER_PROVINSI', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
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
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="form-group">
                <?php echo $form->label($model, 'SUPPLIER_KOTA', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->dropDownList($model, 'SUPPLIER_KOTA', Kota::ListByProvinsi($model->SUPPLIER_PROVINSI), array(
                        'class' => 'form-control',
                        'prompt' => '-- Pilih Provinsi dulu --'
                    )); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->label($model, 'SUPPLIER_DESKRIPSI', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textArea($model, 'SUPPLIER_DESKRIPSI', array('class' => 'form-control')); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->label($model, 'SUPPLIER_STATUS', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <div class="compactRadioGroup">
                        <?php
                        echo $form->radioButtonList($model, 'SUPPLIER_STATUS', array(
                            '' => 'Semua status',
                            Supplier::BARU => 'Aktif',
                            Supplier::TOLAK => 'Tolak',
                            Supplier::OK => 'Terima',
                        ))
                        ?>
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