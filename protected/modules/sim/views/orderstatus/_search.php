<?php
/* @var $this OrderstatusController */
/* @var $model OrderStatus */
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
                <?php echo $form->label($model, 'ORDER_STATUS_ID', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'ORDER_STATUS_ID', array('class' => 'form-control')) ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="form-group">
                <?php echo $form->label($model, 'ORDER_STATUS_NAMA', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php echo $form->textField($model, 'ORDER_STATUS_NAMA', array('class' => 'form-control')) ?>
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