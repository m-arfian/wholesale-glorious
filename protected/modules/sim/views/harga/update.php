<?php
/* @var $this HargaController */
/* @var $model Harga */
$this->pageTitle = "Ubah Harga";
$this->breadcrumbs = array(
    'Manajemen Harga' => array('index'),
    'Ubah harga',
);
?>

<div class="row-fluid">
    <div class="span9">
        <div class="well well-white">
            <div class="row-fluid">
                <div class="span12">
                    <h2 class="lead"><i class="icon-money"></i> &nbsp;Ubah Harga - <?php echo Barang::model()->findByPk($brg)->BARANG_NAMA ?></h2>
                </div>
            </div>
            <?php echo Yii::app()->user->getFlash('subinfo') ?>
            
            <?php $this->renderPartial('_form', array('model' => $model, 'brg' => 0)); ?>
        </div>
    </div>
    <div class="span3">
        <?php $this->renderPartial('/layouts/_rightside') ?>
    </div>
</div>