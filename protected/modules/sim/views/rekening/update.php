<?php
/* @var $this RekeningController */
/* @var $model Rekening */
$this->pageTitle = "Edit Rekening - $model->REKENING_NO";
$this->breadcrumbs=array(
	'Rekening'=>array('rekening/'),
	$model->REKENING_NO=>array('view','id'=>$model->REKENING_ID),
	'Perbarui data',
);
?>

<div class="blue-block">
    <div class="page-title">
        <h3 class="pull-left"><i class="fa fa-files-o"></i> Rekening <span>Edit rekening <?php echo $model->REKENING_NO ?></span></h3>
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
                <?php $this->renderPartial('_form', array('model' => $model, 'gambar' => $gambar)) ?>
            </div>
        </div>
    </div>
</div>