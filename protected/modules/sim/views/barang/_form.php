<?php
/* @var $this BarangController */
/* @var $model Barang */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'barang-form',
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
                <?php echo $form->labelEx($model, 'BARANG_NAMA', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'BARANG_NAMA', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'BARANG_NAMA'); ?>
                </div>
            </div>
            
            <div class="form-group">
                <?php echo $form->labelEx($model, 'BARANG_ALIAS', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')) ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'BARANG_ALIAS', array('class' => 'form-control')) ?>
                    <?php echo $form->error($model, 'BARANG_ALIAS') ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'STOK_STATUS_ID', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->dropDownList($model, 'STOK_STATUS_ID', StokStatus::ListAll(), array(
                        'class' => 'form-control',
                        'prompt' => '-- Pilih Status Stok --',
                    )) ?>
                    <?php echo $form->error($model, 'STOK_STATUS_ID'); ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'CUSTOMABLE', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <div class="compactRadioGroup">
                        <?php echo $form->radioButtonList($model, 'CUSTOMABLE', array(Barang::CUSTOMABLE => 'Bisa', Barang::NOT_CUSTOMABLE => 'Tidak bisa')); ?>
                    </div>
                    <?php echo $form->error($model, 'CUSTOMABLE'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'KATEGORI_ID', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php
                    echo $form->dropDownList($model, 'KATEGORI_ID', Kategori::ListAll(), array(
                        'class' => 'form-control',
                        'prompt' => '-- Pilih Kategori --',
                        'ajax' => array(
                            'type' => 'POST',
                            'url' => array('gantisubkategori'),
                            'update' => '#Barang_SUBKATEGORI_ID',
                        ),
                    ));
                    ?>
                    <?php echo $form->error($model, 'KATEGORI_ID'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'SUBKATEGORI_ID', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php
                    echo $form->dropDownList($model, 'SUBKATEGORI_ID', Subkategori::ListByKategori($model->KATEGORI_ID), array(
                        'prompt' => '-- Pilih Subkategori --',
                        'class' => 'form-control'
                    ))
                    ?>
                    <?php echo $form->error($model, 'SUBKATEGORI_ID'); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'BARANG_SPEK', array('class' => 'col-lg-3 col-md-3 col-sm-3 col-xs-3 control-label')); ?>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                    <?php echo $form->textArea($model, 'BARANG_SPEK', array('class' => 'smnote form-control')); ?>
                    <?php echo $form->error($model, 'BARANG_SPEK'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'BARANG_DESKRIPSI', array('class' => 'col-lg-3 col-md-3 col-sm-3 col-xs-3 control-label')); ?>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                    <?php echo $form->textArea($model, 'BARANG_DESKRIPSI', array('class' => 'smnote form-control')); ?>
                    <?php echo $form->error($model, 'BARANG_DESKRIPSI'); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'BGRUP_ID', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')) ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->dropDownList($model, 'BGRUP_ID', Barang::ListGrup(), array('class' => 'form-control', 'prompt' => '-- Pilih Grup --')) ?>
                    <?php echo $form->error($model, 'BGRUP_ID') ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'BARANG_TIPE', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <div class="compactRadioGroup">
                        <?php echo $form->radioButtonList($model, 'BARANG_TIPE', array(Barang::TIPE_PER => 'Per Satu Barang', Barang::TIPE_PAKET => 'Paket')) ?>
                    </div>
                    <?php echo $form->error($model, 'BARANG_TIPE'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'BARANG_LINK', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')) ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'BARANG_LINK', array('class' => 'form-control')) ?>
                    <?php echo $form->error($model, 'BARANG_LINK') ?>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'BARANG_BOBOT', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')) ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <div class="input-group">
                        <?php echo $form->numberField($model, 'BARANG_BOBOT', array('class' => 'form-control', 'min' => '0', 'step' => '0.1')) ?>
                        <span class="input-group-addon">gram</span>
                    </div>
                    <?php echo $form->error($model, 'BARANG_BOBOT') ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'THUMBNAILED', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <div class="compactRadioGroup">
                        <?php echo $form->radioButtonList($model, 'THUMBNAILED', array(Barang::THUMB => 'Ada thumbnail', Barang::NO_THUMB => 'Tanpa thumbnail')) ?>
                    </div>
                    <?php echo $form->error($model, 'THUMBNAILED'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'BARANG_STATUS', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <div class="compactRadioGroup">
                        <?php echo $form->radioButtonList($model, 'BARANG_STATUS', array(Barang::AKTIF => 'Aktif', Barang::NONAKTIF => 'Non Aktif')) ?>
                    </div>
                    <?php echo $form->error($model, 'BARANG_STATUS'); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <?php $pic = 0 ?>
            <?php if (!$model->isNewRecord): ?>
                <div class="row" id="list-icon">
                    <?php foreach ($model->subgambar as $gambar): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <?php echo CHtml::link(CHtml::image($gambar->gambaricon->GAMBAR_NAMA, $gambar->SUB_TITLE), $gambar->gambarlarge->GAMBAR_NAMA, array('rel' => 'productphoto', 'title' => $gambar->SUB_TITLE, 'class' => 'fancy'))
                            ?><br>
                            <?php
                            echo CHtml::link('<i class="fa fa-times"></i>', array('hapusfoto', 'id' => $gambar->SUB_GAMBAR_ID), array(
                                'class' => 'btn btn-danger btn-xs btn-block',
                                'confirm' => 'Apa Anda yakin untuk menghapus foto?',
                            ));
                            ?>
                            <?php $pic++; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <div class="form-group">
                <?php echo $form->labelEx($model, 'FOTO', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php
                    $this->widget('CMultiFileUpload', array(
                        'model' => $model,
                        'attribute' => 'FOTO',
                        'accept' => 'jpeg|jpg|bmp|png',
                        'duplicate' => 'File sudah dipilih',
                        'denied' => 'Tipe file ini tidak diperbolehkan diupload',
                        'max' => Barang::MAX_FOTO - $pic,
                        'remove' => '[x]',
                        'htmlOptions' => array(
                            'disabled' => Barang::MAX_FOTO == $pic,
                        ),
                    ));
                    ?>
                    <?php echo $form->error($model, 'FOTO'); ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="row">
                <?php foreach ($model->barangtag as $tag): ?>
                    <span class="label label-info tagitem">
                        <?php
                        echo $tag->tag->TAG_NAMA . ' ' . CHtml::link('<i class="fa fa-times"></i>', array('hapustag', 'id' => $tag->BARANG_TAG_ID), array(
                            'confirm' => 'Apa Anda yakin untuk menghapus tag?'))
                        ?>
                    </span>
                <?php endforeach ?>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'TAG', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo CHtml::textField('TAG', '', array('class' => 'tm-input form-control')) ?>
                    <?php echo $form->error($model, 'TAG'); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-3">
            <?php echo CHtml::htmlButton('<i class="fa fa-check"></i> Simpan', array('class' => 'btn btn-success btn-block', 'type' => 'submit')) ?>
        </div>
    </div>
</div>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/library/tagmanager/tagmanager.css'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/library/tagmanager/tagmanager.js', CClientScript::POS_END); ?>
<script type="text/javascript">
    var root = "<?php echo Yii::app()->createUrl('/') ?>";

    $(document).ready(function() {
        $(".tm-input").tagsManager({
            hiddenTagListName: 'Barang[TAG]',
            hiddenTagListId: 'taglist',
        });        
    });
    
    /* untuk grup foto & tag */
    $('#grup-trigger').change(function() {
        gruptrigger(this);
    });
    
    function gruptrigger(element) {
        if(isNumeric($(element).val()))
            $('.grupee').show();
        else
           $('.grupee').hide();
    }
</script>
