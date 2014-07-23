<?php
/* @var $this OrderController */
/* @var $model Order */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions' => array(
		'class' => 'form-horizontal'
    ),
)); ?>
	
	<div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="form-group">
                <?php echo $form->label($model, 'ORDER_ID', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'ORDER_ID', array('class' => 'form-control')) ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->label($model, 'ORDER_DATE', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'ORDER_DATE', array('class' => 'form-control')) ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->label($model, 'alamat', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textArea($model, 'alamat', array('class' => 'form-control')) ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="form-group">
                <?php echo $form->label($model, 'NO_RESI', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'NO_RESI', array('class' => 'form-control')) ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->label($model, 'BIAYA_KIRIM', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'BIAYA_KIRIM', array('class' => 'form-control')) ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->label($model, 'ORDER_MSG', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textArea($model, 'ORDER_MSG', array('class' => 'form-control')) ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
        	<div class="form-group">
                <?php echo $form->label($model, 'EKSPEDISI_ID', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->dropDownList($model, 'EKSPEDISI_ID', Ekspedisi::ListAll(), array('class' => 'form-control', 'prompt' => 'Semua Ekspedisi')) ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->label($model, 'ORDER_STATUS_ID', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <div class="compactRadioGroup">
                        <?php echo $form->dropDownList($model, 'ORDER_STATUS_ID', OrderStatus::ListAll(), array('class' => 'form-control', 'prompt' => 'Semua Order status')) ?>
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