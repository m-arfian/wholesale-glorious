<?php
$this->pageTitle = "Lihat semua order";
$this->breadcrumbs = array(
    'Pelanggan' => array('/pelanggan'),
    'Manajemen Order'
);
?>

<!-- Page title -->
<div class="page-title">
    <div class="container">
        <h2><i class="fa fa-truck color"></i> Manajemen Order <small></small></h2>
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
                    'id' => 'order-grid',
                    'dataProvider' => $model->searchForPelanggan(),
                    //styling pagination
                    'pager' => array(
                        'header' => '',
                        'selectedPageCssClass' => 'active',
                        'hiddenPageCssClass' => 'disabled',
                        'htmlOptions' => array('class' => ''),
                    ),
                    'pagerCssClass' => 'pagination',
                    //'summaryCssClass'=>'alert alert-info',
                    //end styling pagination
                    'summaryText' => 'Menampilkan {start} - {end} dari {count} data Order',
                    'emptyText' => '<div class="alert alert-error">Tidak ada data Order ditampilkan</div>',
                    'showTableOnEmpty' => false,
                    'itemsCssClass' => 'table table-bordered table-striped table-hover',
                    'columns' => array(
                        'ORDER_ID',
                        array(
                            'name' => 'ORDER_DATE',
                            'type' => 'DateFormat',
                            'value' => '$data->ORDER_DATE'
                        ),
                        array(
                            'name' => 'EKSPEDISI_ID',
                            'type' => 'Ekspedisi',
                            'value' => '$data->EKSPEDISI_ID'
                        ),
                        array(
                            'header' => 'Total',
                            'type' => 'HitungTotal',
                            'value' => '$data->ORDER_ID'
                        ),
                        array(
                            'name' => 'ORDER_STATUS_ID',
                            'type' => 'StatusPesanan',
                            'value' => '$data->ORDER_STATUS_ID',
                        ),
                        array(
                            'class' => 'MyCButtonColumn',
                            'template' => '{view}',
                            'buttons' => array(
                                'view' => array(
                                    'url' => 'array("view", "kode"=>$data->ORDER_ID)',
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