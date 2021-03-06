<?php
/* @var $this SupplierController */
/* @var $model Supplier */
$this->pageTitle = "Edit Spplier - $model->SUPPLIER_NAMA";
$this->breadcrumbs = array(
    'Supplier' => array('index'),
    $model->SUPPLIER_NAMA => array('view', 'id' => $model->SUPPLIER_ID),
    'Perbarui Data',
);
?>

<div class="blue-block">
    <div class="page-title">
        <h3 class="pull-left"><i class="fa fa-files-o"></i> Supplier <span>Edit supplier <?php echo $model->SUPPLIER_NAMA ?></span></h3>
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