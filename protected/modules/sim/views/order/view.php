<?php
/* @var $this OrderController */
/* @var $model Order */
$this->pageTitle = "Detail Order";
$this->breadcrumbs = array(
    'Manajemen Order' => array('index'),
    'Detail Order #' . $model->ORDER_ID,
);
?>

<div class="blue-block">
    <div class="page-title">
        <h3 class="pull-left"><i class="fa fa-files-o"></i> Manajemen Order <span>Detail order #<?php echo $model->ORDER_ID ?></span></h3>
        <?php $this->renderPartial('/layouts/_breadcrumb') ?>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div class="page-content page-tables">
        <div id="flashtop">
            <?php echo Yii::app()->user->getFlash('info') ?>
            <div class="col-md-12 col-sm-12 col-xs-12" style="display:none"></div>
        </div>

        <div class="widget">
            <div class="widget-head">
                <?php // echo CHtml::link('<i class="fa fa-plus"></i>', array('create'), array('class' => 'btn btn-sm tip', 'data-toggle' => 'tooltip', 'title' => 'Tambah kategori')) ?>
                <?php // echo CHtml::link('<i class="fa fa-pencil"></i>', array('update', 'id' => $model->ORDER_ID), array('class' => 'btn btn-sm tip', 'data-toggle' => 'tooltip', 'title' => 'Ubah kategori')) ?>
            </div>
            <div class="widget-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <?php
                            $this->widget('zii.widgets.CDetailView', array(
                                'data' => $model,
                                'htmlOptions' => array(
                                    'class' => 'table table-bordered table-striped table-view-sm',
                                ),
                                'attributes' => array(
                                    array(
                                        'name' => 'ORDER_ID',
                                        'type' => 'orderID',
                                        'value' => $model->ORDER_ID,
                                    ),
                                    array(
                                        'name' => 'ORDER_DATE',
                                        'type' => 'tanggal',
                                        'value' => $model->ORDER_DATE,
                                    ),
                                    array(
                                        'name' => 'ORDER_MSG',
                                        'type' => 'raw',
                                        'value' => !empty($model->ORDER_MSG) ? $model->ORDER_MSG : '<i>Tidak ada pesan</i>',
                                    ),
                                    'alamatkirim.PELANGGAN_ID',
                                    'alamatkirim.pelanggan.NAMA',
                                    'alamatkirim.pelanggan.EMAIL',
                                    'alamatkirim.pelanggan.HP',
                                    array(
                                        'name' => 'alamatkirim.pelanggan.KELAMIN',
                                        'type' => 'Kelamin',
                                        'value' => $model->alamatkirim->pelanggan->KELAMIN,
                                    ),
                                    array(
                                        'name' => 'ORDER_STATUS_ID',
                                        'type' => 'StatusPesanan',
                                        'value' => $model->ORDER_STATUS_ID,
                                    ),
                                ),
                            ));
                        ?>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <?php
                        $this->widget('zii.widgets.CDetailView', array(
                            'data' => $model,
                            'htmlOptions' => array(
                                'class' => 'table table-bordered table-striped table-view-sm',
                            ),
                            'attributes' => array(
                                'alamatkirim.ALAMAT',
                                'alamatkirim.KODEPOS',
                                array(
                                    'name' => 'alamatkirim.KOTA_ID',
                                    'value' => Kota::KabOrKota($model->alamatkirim->KOTA_ID),
                                ),
                                array(
                                    'name' => 'alamatkirim.PROVINSI_ID',
                                    'value' => $model->alamatkirim->provinsi->PROVINSI_NAMA,
                                ),
                                array(
                                    'name' => 'alamatkirim.ALAMAT_STATUS',
                                    'type' => 'StatusAlamat',
                                    'value' => $model->alamatkirim->ALAMAT_STATUS,
                                ),
                                'ekspedisi.EKSPEDISI_NAMA',
                                'NO_RESI',
                                array(
                                    'name' => 'SENT_DATE',
                                    'type' => 'tanggal',
                                    'value' => $model->SENT_DATE,
                                ),
                            ),
                        ));
                        ?>
                    </div>
                </div><hr/>
                
                <div class="table-responsive">
                    <?php
                    $this->widget('zii.widgets.grid.CGridView', array(
                        'id' => 'order-grid',
                        'dataProvider' => $detail->searchByOrder($model->ORDER_ID),
                        //styling pagination
                        'pager' => array(
                            'header' => '',
                            'selectedPageCssClass' => 'active',
                            'hiddenPageCssClass' => 'disabled',
                            'htmlOptions' => array('class' => 'pagination'),
                        ),
                        'pagerCssClass' => 'pagination',
                        //end styling pagination
                        'summaryText' => 'Menampilkan {start} - {end} dari {count} data order detail',
                        'emptyText' => '<div class="alert alert-error">Tidak ada data order detail ditampilkan</div>',
                        'showTableOnEmpty' => false,
                        'itemsCssClass' => 'table table-bordered table-striped table-hover table-condensed',
                        'columns' => array(
                            array(
                                'header' => 'No.',
                                'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                            ),
                            'harga.barang.BARANG_NAMA',
                            array(
                                'name' => 'HARGA_BELI',
                                'type' => 'uang',
                                'value' => '$data->HARGA_BELI',
                            ),
                            'JUMLAH',
                            array(
                                'header' => 'Subtotal',
                                'type' => 'uang',
                                'value' => '($data->HARGA_BELI * $data->JUMLAH)',
                            ),
                            array(
                                'class' => 'MyCButtonColumn',
                                'template' => '{view} {delete}',
                                'buttons' => array(
                                    'view' => array(
                                        'url' => 'array("barang/view", "id" => $data->harga->BARANG_ID)',
                                    ),
                                    'delete' => array(
                                        'url' => 'array("hapusdetail", "id" => $data->ORDER_DETAIL_ID)',
                                    ),
                                ),
                            ),
                        ),
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
