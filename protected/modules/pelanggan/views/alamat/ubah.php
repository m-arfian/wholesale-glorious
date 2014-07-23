<?php
/* @var $this AlamatController */
/* @var $model AlamatPengiriman */
$this->pageTitle = 'Edit alamat';
$this->breadcrumbs = array(
    'Manajemen Alamat' => array('alamat/'),
    "Detail Alamat - $model->NAMA_LOKASI" => array('detail', 'id'=>$model->ALAMAT_ID),
    'Edit Alamat',
);
?>

<!-- Page title -->
<div class="page-title">
    <div class="container">
        <h2><i class="fa fa-flag color"></i> Edit alamat <small><?php echo $model->NAMA_LOKASI ?></small></h2>
        <hr />
    </div>
</div>
<!-- Page title -->

<div class="pelanggan">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <?php $this->renderPartial('_form', array('model' => $model, 'kota' => $kota)); ?>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <?php $this->renderPartial('/layouts/_rightside', array('registered' => $registered)) ?>
            </div>
        </div>
        <hr class="colorgraph">
    </div>
</div>