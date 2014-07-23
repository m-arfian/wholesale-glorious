<?php
/* @var $this OrderstatusController */
/* @var $model OrderStatus */
$this->pageTitle = "Detail order status - #$model->ORDER_STATUS_NAMA";
$this->breadcrumbs = array(
    'Order Status' => array('orderstatus/'),
    $model->ORDER_STATUS_NAMA,
);
?>

<div class="blue-block">
    <div class="page-title">
        <h3 class="pull-left"><i class="fa fa-comments"></i> Order Status <span>Detail order status #<?php echo $model->ORDER_STATUS_NAMA ?></span></h3>
        <?php $this->renderPartial('/layouts/_breadcrumb') ?>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div class="page-content page-tables">
        <div class="row" id="flashtop">
            <?php echo Yii::app()->user->getFlash('info') ?>
            <div class="col-md-12 col-sm-12 col-xs-12" style="display:none"></div>
        </div>
        
        <div class="widget">
            <div class="widget-head">
                <?php echo CHtml::link('<i class="fa fa-pencil"></i>', array('update', 'id' => $model->ORDER_STATUS_ID), array('class' => 'btn btn-sm tip', 'data-toggle' => 'tooltip', 'title' => 'Ubah order status')) ?>
            </div>
            <div class="widget-body">
                <?php
                $this->widget('zii.widgets.CDetailView', array(
                    'data' => $model,
                    'htmlOptions' => array(
                        'class' => 'table table-bordered table-striped table-view',
                    ),
                    'attributes' => array(
                        'ORDER_STATUS_ID',
                        'ORDER_STATUS_NAMA',
                    ),
                ))
                ?>
            </div>
        </div>
    </div>
</div>
