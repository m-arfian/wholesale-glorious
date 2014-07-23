<?php
/* @var $this HargaController */
/* @var $model Harga */
$this->pageTitle = "Tambah Harga";
$this->breadcrumbs = array(
    'Manajemen Harga' => array('index'),
    'Tambah harga',
);
?>

<div class="row-fluid">
    <div class="span9">
        <div class="well well-white">
            <div class="row-fluid">
                <div class="span12">
                    <h2 class="lead"><i class="icon-money"></i> &nbsp;Tambah Harga - <?php echo Barang::model()->findByPk($brg)->BARANG_NAMA ?></h2>
                </div>
            </div>
            <?php echo Yii::app()->user->getFlash('subinfo') ?>
            
            <?php $this->renderPartial('_form', array('model' => $model, 'brg' => $brg)); ?>
        </div>
    </div>
    <div class="span3">
        <?php $this->renderPartial('/layouts/_rightside') ?>
    </div>
</div>