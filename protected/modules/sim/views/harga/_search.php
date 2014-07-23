<?php
/* @var $this HargaController */
/* @var $model Harga */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));
    ?>

    <div class="row-fluid">
        <div class="span4">
            <div class="control-group">
                <?php echo $form->label($model, 'BARANG_ID', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo $form->dropDownList($model, 'BARANG_ID', Barang::ListAll(), array(
                        'prompt' => '-- Pilih Barang --'
                    )); ?>
                </div>
            </div>

            <div class="control-group">
                <?php echo $form->label($model, 'SATUAN_ID', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo $form->dropDownList($model, 'SATUAN_ID', Satuan::ListAll(), array(
                        'prompt' => '-- Pilih Satuan --'
                    )); ?>
                </div>
            </div>
        </div>
        <div class="span4">
            <div class="control-group">
                <?php echo $form->label($model, 'HARGA_PRIORITAS', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo $form->numberField($model, 'HARGA_PRIORITAS', array('class'=>'input-mini')); ?>
                </div>
            </div>
            <div class="control-group">
                <?php echo $form->label($model, 'HARGA_NORMAL', array('class' => 'control-label')); ?>
                <div class="controls">
                    <div class="input-prepend">
                        <span class="add-on">Rp.</span>
                        <?php echo $form->textField($model, 'HARGA_NORMAL', array('class' => 'input-small')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="span4">
            <div class="control-group">
                <?php echo $form->label($model, 'HARGA_PASAR', array('class' => 'control-label')); ?>
                <div class="controls">
                    <div class="input-prepend">
                        <span class="add-on">Rp.</span>
                        <?php echo $form->textField($model, 'HARGA_PASAR', array('class' => 'input-small')); ?>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <?php echo $form->label($model, 'HARGA_SALE', array('class' => 'control-label')); ?>
                <div class="controls">
                    <div class="input-prepend">
                        <span class="add-on">Rp.</span>
                        <?php echo $form->textField($model, 'HARGA_SALE', array('class' => 'input-small')); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Cari', array('class' => 'btn')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->