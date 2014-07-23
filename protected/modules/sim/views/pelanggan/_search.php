<?php
/* @var $this PelangganController */
/* @var $model Pelanggan */
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

    <div class="row-fluid">
        <div class="span6">
            <div class="row">
                <?php echo $form->label($model, 'PELANGGAN_ID'); ?>
                <?php echo $form->textField($model, 'PELANGGAN_ID', array('class'=>'input-small')); ?>
            </div>

            <div class="row">
                <?php echo $form->label($model, 'NAMA'); ?>
                <?php echo $form->textField($model, 'NAMA'); ?>
            </div>
            
            <div class="row">
                <?php echo $form->label($model, 'EMAIL'); ?>
                <?php echo $form->textField($model, 'EMAIL'); ?>
            </div>
            
            <div class="row buttons">
                <?php echo CHtml::submitButton('Cari', array('class'=>'btn btn-success')); ?>
            </div>
        </div>
        <div class="span6">
            <div class="row">
                <?php echo $form->label($model, 'HP'); ?>
                <?php echo $form->textField($model, 'HP'); ?>
            </div>
            
            <div class="row compactRadioGroup">
                <?php echo $form->label($model, 'KELAMIN'); ?><br>
                <?php echo $form->radioButtonList($model, 'KELAMIN', array(''=>'Semua', 'L' => 'Pria', 'P' => 'Wanita')); ?>
            </div>

            <div class="row compactRadioGroup">
                <?php echo $form->label($model, 'PELANGGAN_STATUS'); ?><br>
                <?php echo $form->radioButtonList($model, 'PELANGGAN_STATUS', array(''=>'Semua', Pelanggan::NO_AKUN=>'Tidak punya akun', Pelanggan::PUNYA_AKUN=>'Punya akun')); ?>
            </div>
        </div>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->