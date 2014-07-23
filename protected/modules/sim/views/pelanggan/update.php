<?php
/* @var $this PelangganController */
/* @var $model Pelanggan */
$this->pageTitle = "Ubah Pelanggan";
$this->breadcrumbs = array(
    'Manajemen Pelanggan' => array('index'),
    $model->NAMA => array('view', 'id'=>$model->PELANGGAN_ID),
    'Perbarui data'
);
?>

<div class="row-fluid">
    <div class="span9">
        <div class="well well-white">
            <div class="row-fluid">
                <div class="span12">
                    <h2 class="lead"><i class="icon-user"></i> &nbsp;Ubah Pelanggan</h2>
                </div>
            </div>
            <?php echo Yii::app()->user->getFlash('subinfo') ?>

            <?php $this->renderPartial('_form', array('model' => $model)); ?>
        </div>
    </div>
    <div class="span3">
        <?php $this->renderPartial('/layouts/_rightside') ?>
    </div>
</div>