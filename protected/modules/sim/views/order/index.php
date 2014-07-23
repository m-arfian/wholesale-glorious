<?php
/* @var $this OrderController */
/* @var $model Order */
$this->pageTitle = "Manajemen Order";
$this->breadcrumbs = array(
    'Manajemen Order',
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#order-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="blue-block">
    <div class="page-title">
        <h3 class="pull-left"><i class="fa fa-truck"></i> Manajemen Order <span></span></h3>
        <?php $this->renderPartial('/layouts/_breadcrumb') ?>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div class="page-content page-tables">

        <div class="row" id="flashtop">
            <?php echo Yii::app()->user->getFlash('info') ?>
            <div class="col-md-12 col-sm-12 col-xs-12" style="display:none"></div>
        </div>

        <div class="widget">
            <div class="search-form" style="display:none">
                <?php $this->renderPartial('_search', array('model' => $model)) ?>
            </div><!-- search-form -->
            <div class="widget-head">
                <?php echo CHtml::link('<i class="fa fa-search-plus"></i> Pencarian order', '#', array('class' => 'btn btn-xs btn-black search-button')); ?>
                <?php echo CHtml::link('<i class="fa fa-plus"></i> Tambah order', array('create'), array('class' => 'btn btn-xs btn-success')) ?>
            </div>
            <div class="widget-body">
                <div class="table-responsive">
                    <?php
                    $this->widget('zii.widgets.grid.CGridView', array(
                        'id' => 'order-grid',
                        'dataProvider' => $model->search(),
                        //styling pagination
                        'pager' => array(
                            'header' => '',
                            'selectedPageCssClass' => 'active',
                            'hiddenPageCssClass' => 'disabled',
                            'htmlOptions' => array('class' => 'pagination'),
                        ),
                        'pagerCssClass' => 'pagination',
                        //end styling pagination
                        'summaryText' => 'Menampilkan {start} - {end} dari {count} data order',
                        'emptyText' => '<div class="alert alert-error">Tidak ada data order ditampilkan</div>',
                        'showTableOnEmpty' => false,
                        'itemsCssClass' => 'table table-bordered table-striped table-hover table-condensed',
                        'columns' => array(
                            array(
                                'name' => 'ORDER_ID',
                                'type' => 'orderID',
                                'value' => '$data->ORDER_ID',
                            ),
                            array(
                                'name' => 'ORDER_DATE',
                                'type' => 'Tanggal',
                                'value' => '$data->ORDER_DATE',
                            ),
                            'ekspedisi.EKSPEDISI_NAMA',
                            'NO_RESI',
                            array(
                                'name' => 'ORDER_STATUS_ID',
                                'type' => 'StatusPesanan',
                                'value' => '$data->ORDER_STATUS_ID',
                            ),
                            array(
                                'class' => 'MyCButtonColumn',
                                'template' => '{view} {update}',
                                'buttons' => array(
                                    'view' => array(
                                        'url' => 'array("order/view/id/".$data->ORDER_ID)',
                                    ),
                                    'update' => array(
                                        'url' => 'array("order/update/id/".$data->ORDER_ID)',
                                    ),
                                ),
                            ),
                            array(
                                'class' => 'MyCButtonColumn',
                                'template' => '{batal} {pending} {menunggu} {persiapan} {terkirim} {diterima}',
                                'buttons' => array(
                                    'batal' => array(
                                        'label' => 'Pembatalan pemesanan',
                                        'icon' => '<i class="fa fa-times"></i>',
                                        'url' => 'array("escalate", "kode"=>$data->ORDER_ID, "status"=>OrderStatus::BATAL)',
                                        'click' => 'function(e){
                                            e.preventDefault();
                                            var jawab = confirm("Apa Anda yakin untuk membatalkan pemesanan?");
                                            if(jawab) {
                                                $.post($(this).attr("href"), {"' . Yii::app()->request->csrfTokenName . '":"' . Yii::app()->request->csrfToken . '"});
                                                reloadGrid();
                                            }
                                        }',
                                        'options' => array('class' => 'tip batal btn btn-xs', 'data-original-title' => 'Pembatalan pemesanan'),
                                    ),
                                    'pending' => array(
                                        'label' => 'Pending pemesanan',
                                        'icon' => '<i class="fa fa-signal"></i>',
                                        'url' => 'array("escalate", "kode"=>$data->ORDER_ID, "status"=>OrderStatus::PENDING)',
                                        'visible' => '$data->ORDER_STATUS_ID==OrderStatus::BATAL',
                                        'click' => 'function(e){
                                            e.preventDefault();
                                            var jawab = confirm("Apa Anda yakin?");
                                            if(jawab) {
                                                $.post($(this).attr("href"), {"' . Yii::app()->request->csrfTokenName . '":"' . Yii::app()->request->csrfToken . '"});
                                                reloadGrid();
                                            }
                                        }',
                                        'options' => array('class' => 'tip pending btn btn-xs btn-warning', 'data-original-title' => 'Pending pemesanan'),
                                    ),
                                    'menunggu' => array(
                                        'label' => 'Menunggu konfirmasi pembayaran',
                                        'icon' => '<i class="fa fa-envelope-o"></i>',
                                        'url' => 'array("escalate", "kode"=>$data->ORDER_ID, "status"=>OrderStatus::MENUNGGU)',
                                        'visible' => '$data->ORDER_STATUS_ID==OrderStatus::PENDING',
                                        'click' => 'function(e){
                                            e.preventDefault();
                                            var jawab = confirm("Apa Anda yakin?");
                                            if(jawab) {
                                                $.post($(this).attr("href"), {"' . Yii::app()->request->csrfTokenName . '":"' . Yii::app()->request->csrfToken . '"});
                                                reloadGrid();
                                            }
                                        }',
                                        'options' => array('class' => 'tip menunggu btn btn-xs btn-danger', 'data-original-title' => 'Menunggu konfirmasi pembayaran'),
                                    ),
                                    'persiapan' => array(
                                        'label' => 'Persiapan pengiriman',
                                        'icon' => '<i class="fa fa-inbox"></i>',
                                        'url' => 'array("escalate", "kode"=>$data->ORDER_ID, "status"=>OrderStatus::PERSIAPAN)',
                                        'visible' => '$data->ORDER_STATUS_ID==OrderStatus::MENUNGGU',
                                        'click' => 'function(e){
                                            e.preventDefault();
                                            var jawab = confirm("Apa Anda yakin?");
                                            if(jawab) {
                                                $.post($(this).attr("href"), {"' . Yii::app()->request->csrfTokenName . '":"' . Yii::app()->request->csrfToken . '"});
                                                reloadGrid();
                                            }
                                        }',
                                        'options' => array('class' => 'tip persiapan btn btn-xs btn-primary', 'data-original-title' => 'Persiapan kirim'),
                                    ),
                                    'terkirim' => array(
                                        'label' => 'Pemesanan terkirim',
                                        'icon' => '<i class="fa fa-truck"></i>',
                                        'url' => 'array("escalate", "kode"=>$data->ORDER_ID, "status"=>OrderStatus::TERKIRIM)',
                                        'visible' => '$data->ORDER_STATUS_ID==OrderStatus::PERSIAPAN',
                                        'click' => 'function(e){
                                            e.preventDefault();
                                            var jawab = confirm("Apa Anda yakin?");
                                            if(jawab) {
                                                $.post($(this).attr("href"), {"' . Yii::app()->request->csrfTokenName . '":"' . Yii::app()->request->csrfToken . '"});
                                                reloadGrid();
                                            }
                                        }',
                                        'options' => array('class' => 'tip terkirim btn btn-xs btn-info', 'data-original-title' => 'Pemesanan terkirim'),
                                    ),
                                    'diterima' => array(
                                        'label' => 'Pemesanan diterima',
                                        'icon' => '<i class="fa fa-thumbs-up"></i>',
                                        'url' => 'array("escalate", "kode"=>$data->ORDER_ID)',
                                        'visible' => '$data->ORDER_STATUS_ID==OrderStatus::TERKIRIM',
                                        'click' => 'function(e){
                                            e.preventDefault();
                                            var jawab = confirm("Apa Anda yakin?");
                                            if(jawab) {
                                                $.post($(this).attr("href"), {"' . Yii::app()->request->csrfTokenName . '":"' . Yii::app()->request->csrfToken . '"});
                                                reloadGrid();
                                            }
                                        }',
                                        'options' => array('class' => 'tip diterima btn btn-xs btn-success', 'data-original-title' => 'Pemesanan diterima'),
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

<script type="text/javascript">
    function reloadGrid() {
        $("#order-grid").yiiGridView.update("order-grid");
    }
</script>