<?php
/* @var $this SubkategoriController */
/* @var $model Subkategori */
$this->pageTitle = "Subkategori";
$this->breadcrumbs = array(
    'Subkategori'
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#subkategori-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="blue-block">
    <div class="page-title">
        <h3 class="pull-left"><i class="fa fa-files-o"></i> Subkategori <span></span></h3>
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
            <div class="search-form" style="display:none">
                <?php $this->renderPartial('_search', array('model' => $model)) ?>
            </div><!-- search-form -->
            <div class="widget-head">
                <?php echo CHtml::link('<i class="fa fa-search-plus"></i> Pencarian subkategori', '#', array('class' => 'btn btn-xs btn-black search-button')); ?>
                <?php echo CHtml::link('<i class="fa fa-plus"></i> Tambah subkategori', array('create'), array('class' => 'btn btn-xs btn-success')) ?>
            </div>
            <div class="widget-body">
                <div class="table-responsive">
                    <?php
                    $this->widget('zii.widgets.grid.CGridView', array(
                        'id' => 'subkategori-grid',
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
                        'summaryText' => 'Menampilkan {start} - {end} dari {count} data subkategori',
                        'emptyText' => '<div class="alert alert-error">Tidak ada data subkategori ditampilkan</div>',
                        'showTableOnEmpty' => false,
                        'itemsCssClass' => 'table table-bordered table-striped table-hover table-condensed',
                        'columns' => array(
                            'SUBKATEGORI_ID',
                            'SUBKATEGORI_NAMA',
                            'kategori.KATEGORI_NAMA',
                            array(
                                'header' => 'TAMPILAN',
                                'type' => 'thumbnaili',
                                'value' => '$data->GAMBAR_ID',
                            ),
                            array(
                                'name' => 'SUBKATEGORI_STATUS',
                                'type' => 'statusAktif',
                                'value' => '$data->SUBKATEGORI_STATUS'
                            ),
                            array(
                                'class' => 'MyCButtonColumn',
                                'template' => '{view} {update}'
                            ),
                        ),
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
