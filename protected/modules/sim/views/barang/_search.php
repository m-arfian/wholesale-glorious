<?php
/* @var $this BarangController */
/* @var $model Barang */
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
                <?php echo $form->label($model, 'BARANG_NAMA', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'BARANG_NAMA', array('class' => 'form-control')) ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->label($model, 'KATEGORI_ID', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')) ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->dropDownList($model, 'KATEGORI_ID', Kategori::ListAll(), array(
                        'class' => 'form-control',
                        'prompt' => 'Semua Kategori',
                        'ajax' => array(
                            'type' => 'POST',
                            'url' => array('gantisubkategori'),
                            'update' => '#Barang_SUBKATEGORI_ID',
                        ),
                    )) ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->label($model, 'SUBKATEGORI_ID', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')) ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->dropDownList($model, 'SUBKATEGORI_ID', array(), array(
                        'class' => 'form-control',
                        'empty' => 'Semua Subkategori',
                    )) ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="form-group">
                <?php echo $form->label($model, 'BARANG_DESKRIPSI', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')) ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textArea($model, 'BARANG_DESKRIPSI', array('class' => 'form-control')) ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->label($model, 'STOK_STATUS_ID', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')) ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->dropDownList($model, 'STOK_STATUS_ID', StokStatus::ListAll(), array(
                        'prompt' => 'Semua Status Stok',
                        'class' => 'form-control',
                    )) ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="form-group">
                <?php echo $form->label($model, 'CUSTOMABLE', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')) ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <div class="compactRadioGroup">
                        <?php echo $form->radioButtonList($model, 'CUSTOMABLE', array(''=>'Semua kondisi', Barang::CUSTOMABLE=>'Bisa', Barang::NOT_CUSTOMABLE=>'Tidak bisa')); ?>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <?php echo $form->label($model, 'BARANG_STATUS', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')) ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <div class="compactRadioGroup">
                        <?php echo $form->radioButtonList($model, 'BARANG_STATUS', array(''=>'Semua status', Barang::AKTIF=>'Aktif', Barang::NONAKTIF=>'Non Aktif')); ?>
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