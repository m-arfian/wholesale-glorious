<?php
/* @var $this OrderstatusController */
/* @var $model OrderStatus */
$this->pageTitle = "Edit Order status - $model->ORDER_STATUS_NAMA";
$this->breadcrumbs = array(
    'Order Status' => array('orderstatus/'),
    $model->ORDER_STATUS_NAMA => array('view', 'id' => $model->ORDER_STATUS_ID),
    'Perbarui data',
);
?>

<div class="blue-block">
    <div class="page-title">
        <h3 class="pull-left"><i class="fa fa-inbox"></i> Order Status <span>Edit order status <?php echo $model->ORDER_STATUS_NAMA ?></span></h3>
        <?php $this->renderPartial('/layouts/_breadcrumb') ?>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div class="page-content page-form">
        
        <div class="row" id="flashtop">
            <?php echo Yii::app()->user->getFlash('info') ?>
            <div class="col-md-12 col-sm-12 col-xs-12" style="display:none"></div>
        </div>
        
        <div class="widget">
            <div class="widget-head">
            </div>
            <div class="widget-body">
                <?php $this->renderPartial('_form', array('model' => $model)) ?>
            </div>
        </div>
    </div>
</div>