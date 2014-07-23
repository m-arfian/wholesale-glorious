<?php
/* @var $this WaktuController */
/* @var $model SatuanWaktu */
$this->pageTitle = "Edit Satuan waktu - $model->SATUAN_WAKTU_NAMA";
$this->breadcrumbs = array(
    'Satuan Waktu' => array('waktu/'),
    $model->SATUAN_WAKTU_NAMA => array('view', 'id' => $model->SATUAN_WAKTU_ID),
    'Perbarui data',
);
?>

<div class="blue-block">
    <div class="page-title">
        <h3 class="pull-left"><i class="fa fa-inbox"></i> Satuan waktu <span>Edit satuan waktu <?php echo $model->SATUAN_WAKTU_NAMA ?></span></h3>
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