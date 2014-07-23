<?php
/* @var $this KonfirmasiController */
/* @var $model Konfirmasi */
$this->pageTitle = "Konfirmasi";
$this->breadcrumbs = array(
    'Konfirmasi'
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#konfirmasi-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="blue-block">
    <div class="page-title">
        <h3 class="pull-left"><i class="fa fa-exclamation-triangle"></i> Konfirmasi <span></span></h3>
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
                <?php echo CHtml::link('<i class="fa fa-search-plus"></i> Pencarian konfirmasi', '#', array('class' => 'btn btn-xs btn-black search-button')); ?>
            </div>
            <div class="widget-body">
                <div class="table-responsive">
                    <?php
                    $this->widget('zii.widgets.grid.CGridView', array(
                        'id' => 'konfirmasi-grid',
                        'dataProvider' => $model->search(),
                        //styling pagination
                        'pager' => array(
                            'header' => '',
                            'selectedPageCssClass' => 'active',
                            'hiddenPageCssClass' => 'disabled',
                            'htmlOptions' => array('class' => ''),
                        ),
                        'pagerCssClass' => 'pagination',
                        //end styling pagination
                        'summaryText' => 'Menampilkan {start} - {end} dari {count} testimoni',
                        'emptyText' => '<div class="alert alert-error">Tidak ada data testimoni ditampilkan</div>',
                        'showTableOnEmpty' => false,
                        'itemsCssClass' => 'table table-bordered table-striped table-hover table-condensed',
                        'columns' => array(
                            'KONFIRMASI_ID',
                            array(
                                'name' => 'KONFIRMASI_DATE',
                                'type' => 'tanggalWaktu',
                                'value' => '$data->KONFIRMASI_DATE'
                            ),
                            array(
                                'name' => 'INVOICE_ORDER',
                                'type' => 'orderID',
                                'value' => '$data->INVOICE_ORDER'
                            ),
                            'rekening.REKENING_NO',
                            'NAMA_PELANGGAN',
                            array(
                                'name' => 'TOTAL',
                                'type' => 'uang',
                                'value' => '$data->TOTAL'
                            ),
                            /*
                              'BAYAR_DATE',
                              'CATATAN',
                              'BANK_PENGIRIM',
                              'ATAS_NAMA',
                              'EMAIL',
                              'NO_TELP',
                              'KONFIRMASI_STATUS',
                             */
                            array(
                                'class' => 'MyCButtonColumn',
                                'template' => '{view}'
                            ),
                        ),
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>