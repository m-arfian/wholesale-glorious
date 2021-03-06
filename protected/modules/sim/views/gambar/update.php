<?php
/* @var $this GambarController */
/* @var $model Gambar */
$this->pageTitle = "Edit Gambar - $model->GAMBAR_NAMA";
$this->breadcrumbs = array(
    'Gambar' => array('gambar/'),
    $model->GAMBAR_NAMA => array('view', 'id' => $model->GAMBAR_ID),
    'Perbarui data',
);
?>

<div class="blue-block">
    <div class="page-title">
        <h3 class="pull-left"><i class="fa fa-files-o"></i> Gambar <span>Edit #<?php echo $model->GAMBAR_NAMA ?></span></h3>
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