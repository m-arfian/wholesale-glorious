<?php
/* @var $this AlamatController */
/* @var $model AlamatPengiriman */
$this->pageTitle = "Detail alamat - $model->NAMA_LOKASI";
$this->breadcrumbs = array(
    'Pelanggan' => array('/pelanggan'),
    'Manajemen Alamat' => array('alamat/'),
    "Detail Alamat - $model->NAMA_LOKASI",
);
?>

<!-- Page title -->
<div class="page-title">
    <div class="container">
        <h2><i class="fa fa-flag color"></i> Detail alamat <small><?php echo $model->NAMA_LOKASI ?></small></h2>
        <hr />
    </div>
</div>
<!-- Page title -->

<div class="pelanggan">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <?php
                $this->widget('zii.widgets.CDetailView', array(
                    'data' => $model,
                    'htmlOptions' => array(
                        'class' => 'table table-bordered table-striped table-view',
                    ),
                    'attributes' => array(
                        'NAMA_LOKASI',
                        'ALAMAT',
                        'KODEPOS',
                        array(
                            'name' => 'KOTA_ID',
                            'value' => Kota::KabOrKota($model->KOTA_ID),
                        ),
                        array(
                            'name' => 'PROVINSI_ID',
                            'value' => $model->provinsi->PROVINSI_NAMA,
                        ),
                        array(
                            'name' => 'ALAMAT_STATUS',
                            'type' => 'StatusAlamat',
                            'value' => $model->ALAMAT_STATUS,
                        ),
                    ),
                ));
                ?>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <?php $this->renderPartial('/layouts/_rightside', array('registered' => $registered)) ?>
            </div>
        </div>
        <hr class="colorgraph">
    </div>
</div>