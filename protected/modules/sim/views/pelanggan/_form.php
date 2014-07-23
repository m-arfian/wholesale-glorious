<?php
/* @var $this PelangganController */
/* @var $model Pelanggan */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'pelanggan-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'class' => 'form-horizontal',
        )
    ));
    ?>

    <p class="note">Isian dengan tanda <span class="required">*</span> wajib diisi.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row-fluid">
        <div class="span6">
            <div class="control-group">
                <?php echo $form->labelEx($model, 'NAMA', array('class'=>'control-label')); ?>
                <div class="controls">
                    <?php echo $form->textField($model, 'NAMA', array('size' => 60, 'maxlength' => 100)); ?>
                    <?php echo $form->error($model, 'NAMA'); ?>
                </div>
            </div>

            <div class="control-group">
                <?php echo $form->labelEx($model, 'EMAIL', array('class'=>'control-label')); ?>
                <div class="controls">
                    <?php echo $form->textField($model, 'EMAIL', array('size' => 50, 'maxlength' => 50)); ?>
                    <?php echo $form->error($model, 'EMAIL'); ?>
                </div>
            </div>

            <div class="control-group">
                <?php echo $form->labelEx($model, 'HP', array('class'=>'control-label')); ?>
                <div class="controls">
                    <?php echo $form->textField($model, 'HP', array('size' => 20, 'maxlength' => 20)); ?>
                    <?php echo $form->error($model, 'HP'); ?>
                </div>
            </div>
        </div>
        <div class="span6">
            <div class="control-group">
                <?php echo $form->labelEx($model, 'KELAMIN', array('class'=>'control-label')); ?>
                <div class="controls compactRadioGroup">
                    <?php echo $form->radioButtonList($model, 'KELAMIN', array('L' => 'Pria', 'P' => 'Wanita')); ?>
                    <?php echo $form->error($model, 'KELAMIN'); ?>
                </div>

            </div>

            <div class="control-group">
                <?php echo $form->labelEx($model, 'PELANGGAN_STATUS', array('class'=>'control-label')); ?>
                <div class="controls compactRadioGroup">
                    <?php echo $form->radioButtonList($model, 'PELANGGAN_STATUS', array(Pelanggan::NO_AKUN=>'Tidak punya akun', Pelanggan::PUNYA_AKUN=>'Punya akun')); ?>
                    <?php echo $form->error($model, 'PELANGGAN_STATUS'); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Tambah' : 'Simpan', array('class'=>'btn btn-primary')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->