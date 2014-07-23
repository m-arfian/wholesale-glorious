<?php
/* @var $this HargaController */
/* @var $model Harga */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'harga-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            //'class' => 'form-horizontal',
        ),
    ));
    ?>

    <p class="note">Isian dengan tanda <span class="required">*</span> wajib diisi.</p>

    <?php echo $form->errorSummary($model); ?>

    <table class="table table-condensed" id="table-harga">
        <tr>
            <th><label>Prioritas <span class="required">*</span></label></th>
            <th><label>Satuan <span class="required">*</span></label></th>
            <th><label>Harga Normal <span class="required">*</span></label></th>
            <th><label>Harga Sale</label></th><th><label>Harga Pasar</label></th><th></th>
        </tr>
        <?php foreach ($model as $id => $hrg) {
            $this->renderPartial('_harga', array('brg' => $brg, 'hrg' => $hrg, 'id' => $id, 'form' => $form));
        } ?>
    </table>
    
    <?php echo CHtml::submitButton($model[0]->isNewRecord ? 'Tambah' : 'Simpan', array('class'=>'btn btn-success', 'style'=>'margin-top:15px')); ?>

    <?php $this->endWidget(); ?>

</div><!-- form -->