<?php
/* @var $this KotaController */
/* @var $model Kota */
$this->pageTitle = "Edit Kota - $model->KOTA_NAMA";
$this->breadcrumbs=array(
	'Kota'=>array('index'),
	$model->KOTA_NAMA=>array('view','id'=>$model->KOTA_ID),
	'Perbarui data',
);
?>

<div class="blue-block">
    <div class="page-title">
        <h3 class="pull-left"><i class="fa fa-files-o"></i> Tag <span>Edit kota <?php echo $model->KOTA_NAMA ?></span></h3>
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