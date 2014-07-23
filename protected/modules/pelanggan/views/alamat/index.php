<?php
/* @var $this AlamatController */
/* @var $model AlamatPengiriman */

$this->pageTitle = "Lihat semua alamat";
$this->breadcrumbs = array(
    'Pelanggan' => array('/pelanggan'),
    'Manajemen Alamat',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#alamat-pengiriman-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<!-- Page title -->
<div class="page-title">
    <div class="container">
        <h2><i class="fa fa-flag color"></i> Manajemen alamat <small></small></h2>
        <hr />
    </div>
</div>
<!-- Page title -->

<div class="pelanggan">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <?php
                $this->widget('zii.widgets.grid.CGridView', array(
                    'id' => 'alamat-pengiriman-grid',
                    'dataProvider' => $model->searchByPelanggan(),
                    //'filter' => $model,
                    //styling pagination
                    'pager' => array(
                        'header' => '',
                        'selectedPageCssClass' => 'active',
                        'hiddenPageCssClass' => 'disabled',
                        'htmlOptions' => array('class' => ''),
                    ),
                    'enableSorting' => false,
                    'pagerCssClass' => 'pagination',
                    //'summaryCssClass'=>'alert alert-info',
                    //end styling pagination
                    'summaryText' => 'Menampilkan {start} - {end} dari {count} data Alamat',
                    'emptyText' => '<div class="alert alert-error">Tidak ada data Alamat ditemukan</div>',
                    'showTableOnEmpty' => false,
                    'itemsCssClass' => 'table table-bordered table-striped table-hover',
                    'columns' => array(
                        'NAMA_LOKASI',
                        'ALAMAT',
                        'KODEPOS',
                        array(
                            'name' => 'KOTA_ID',
                            'value' => 'Kota::KabOrKota($data->KOTA_ID)',
                        ),
                        'provinsi.PROVINSI_NAMA',
                        array(
                            'name' => 'ALAMAT_STATUS',
                            'type' => 'StatusAlamat',
                            'value' => '$data->ALAMAT_STATUS',
                        ),
                        array(
                            'class' => 'MyCButtonColumn',
                            'template'=>'{view} {update} {nonaktif} {aktifkan}',
                            'buttons' => array(
                                'view' => array(
                                    'url' => 'array("detail", "id"=>"$data->ALAMAT_ID")',
                                    'visible' => '$data->ALAMAT_STATUS!=9',
                                ),
                                'update' => array(
                                    'url' => 'array("ubah", "id"=>"$data->ALAMAT_ID")',
                                    'visible' => '$data->ALAMAT_STATUS!=9',
                                ),
                                'nonaktif' => array(
                                    'label' => 'Non aktif',
                                    'icon' => '<i class="fa fa-times"></i>',
                                    'url' => 'array("nonaktif", "id"=>"$data->ALAMAT_ID")',
                                    'visible' => '$data->ALAMAT_STATUS==1',
                                ),
                                'aktifkan' => array(
                                    'label' => 'Aktifkan',
                                    'icon' => '<i class="fa fa-check"></i>',
                                    'url' => 'array("aktifkan", "id"=>"$data->ALAMAT_ID")',
                                    'visible' => '$data->ALAMAT_STATUS==0',
                                ),
                            ),
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