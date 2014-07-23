<?php
/* @var $this BarangController */
/* @var $model Barang */
$this->pageTitle = "Manajemen Barang";
$this->breadcrumbs = array(
    'Manajemen Barang',
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#barang-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="blue-block">
    <div class="page-title">
        <h3 class="pull-left"><i class="fa fa-inbox"></i> Manajemen Barang <span>Data barang</span></h3>
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
                <?php echo CHtml::link('<i class="fa fa-search-plus"></i> Pencarian barang', '#', array('class' => 'btn btn-xs btn-black search-button')); ?>
                <?php echo CHtml::link('<i class="fa fa-plus"></i> Tambah barang', array('create'), array('class' => 'btn btn-xs btn-success')) ?>
            </div>
            <div class="widget-body">
                <div class="table-responsive">
                    <?php
                    $this->widget('zii.widgets.grid.CGridView', array(
                        'id' => 'barang-grid',
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
                        'summaryText' => 'Menampilkan {start} - {end} dari {count} data barang',
                        'emptyText' => '<div class="alert alert-error">Tidak ada data barang ditampilkan</div>',
                        'showTableOnEmpty' => false,
                        'itemsCssClass' => 'table table-bordered table-striped table-hover table-condensed',
                        'columns' => array(
                            'BARANG_ID',
                            'BARANG_NAMA',
                            'kategori.KATEGORI_NAMA',
                            //'subkategori.SUBKATEGORI_NAMA',
                            array(
                                'name' => 'STOK_STATUS_ID',
                                'type' => 'StokStatus',
                                'value' => '$data->STOK_STATUS_ID',
                            ),
                            array(
                                'name' => 'BARANG_STATUS',
                                'type' => 'StatusAktif',
                                'value' => '$data->BARANG_STATUS',
                            ),
                            array(
                                'class' => 'MyCButtonColumn',
                                'template' => '{view} {update} {nonaktif} {aktifkan}',
                                'buttons' => array(
                                    'nonaktif' => array(
                                        'label' => 'Non aktif',
                                        'icon' => '<button class="btn btn-xs btn-warning"><i class="fa fa-times"></i></button>',
                                        'url' => 'array("nonaktif", "id"=>"$data->BARANG_ID")',
                                        'click' => 'function(e){
                                    e.preventDefault();
                                    var jawab = confirm("Apa Anda yakin untuk menonaktifkan barang?");
                                    if(jawab) {
                                        $.post($(this).attr("href"), {"' . Yii::app()->request->csrfTokenName . '":"' . Yii::app()->request->csrfToken . '"});
                                        $("#barang-grid").yiiGridView.update("barang-grid");
                                    }
                                }',
                                        'visible' => '$data->BARANG_STATUS!=0',
                                    ),
                                    'aktifkan' => array(
                                        'label' => 'Aktifkan',
                                        'icon' => '<button class="btn btn-xs btn-info"><i class="fa fa-check"></i></button>',
                                        'url' => 'array("aktifkan", "id"=>"$data->BARANG_ID")',
                                        'click' => 'function(e){
                                    e.preventDefault();
                                    var jawab = confirm("Apa Anda yakin untuk mengaktifkan barang?");
                                    if(jawab) {
                                        $.post($(this).attr("href"), {"' . Yii::app()->request->csrfTokenName . '":"' . Yii::app()->request->csrfToken . '"});
                                        $("#barang-grid").yiiGridView.update("barang-grid");
                                    }
                                }',
                                        'visible' => '$data->BARANG_STATUS==0',
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