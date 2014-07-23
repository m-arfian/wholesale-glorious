<?php
/* @var $this KategoriController */
/* @var $model Kategori */
$this->pageTitle = "Edit Kategori - $model->KATEGORI_NAMA";
$this->breadcrumbs=array(
	'Kategori'=>array('index'),
	$model->KATEGORI_NAMA=>array('view','id'=>$model->KATEGORI_ID),
	'Perbarui data',
);
?>

<div class="blue-block">
    <div class="page-title">
        <h3 class="pull-left"><i class="fa fa-files-o"></i> Kategori <span>Edit kategori <?php echo $model->KATEGORI_NAMA ?></span></h3>
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
            <div class="widget-head">
            </div>
            <div class="widget-body">
                <?php $this->renderPartial('_form', array('model' => $model, 'gambar' => $gambar)) ?>
            </div>
        </div>
    </div>
</div>