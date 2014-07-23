<?php
/* @var $this OrderController */
/* @var $model Order */
$this->pageTitle = "Tambah Order";
$this->breadcrumbs=array(
	'Manajemen Order'=>array('order/'),
	'Tambah Order',
);
?>

<div class="blue-block">
    <div class="page-title">
        <h3 class="pull-left"><i class="fa fa-truck"></i> Manajemen Order <span>Tambah order</span></h3>
        <?php $this->renderPartial('/layouts/_breadcrumb') ?>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div class="page-content page-form">

        <div id="flashtop">
            <?php echo Yii::app()->user->getFlash('info') ?>
            <div class="col-md-12 col-sm-12 col-xs-12" style="display:none"></div>
        </div>

        <div class="widget">
            <div class="widget-head"></div>
            <div class="widget-body">
                <?php $this->renderPartial('_form', array('model' => $model, 'alamat' => $alamat)); ?>
            </div>
        </div>
    </div>
</div>