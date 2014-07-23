<?php
/* @var $this PelangganController */
/* @var $model Pelanggan */
$this->pageTitle = "Manajemen Pelanggan";
$this->breadcrumbs = array(
    'Manajemen Pelanggan',
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pelanggan-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="row-fluid">
    <div class="span9">
        <div class="well well-white">
            <div class="row-fluid">
                <div class="span9">
                    <h2 class="lead"><i class="icon-user"></i> &nbsp;Manajemen Pelanggan</h2>
                </div>
                <div class="span3">
                    <?php echo CHtml::link('<i class="icon-plus"></i> Tambah data', array('create'), array('class'=>'btn pull-right')) ?>
                </div>
            </div>
            <?php echo CHtml::link('Pencarian', '#', array('class' => 'search-button')); ?>
            <div class="search-form" style="display:none">
                <?php
                $this->renderPartial('_search', array(
                    'model' => $model,
                ));
                ?>
            </div><!-- search-form -->
            <?php echo Yii::app()->user->getFlash('subinfo') ?>
            <?php
            $this->widget('zii.widgets.grid.CGridView', array(
                'id' => 'pelanggan-grid',
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
                'summaryText' => 'Menampilkan {start} - {end} dari {count} data pelanggan',
                'emptyText' => '<div class="alert alert-error">Tidak ada data pelanggan ditampilkan</div>',
                'showTableOnEmpty' => false,
                'itemsCssClass' => 'table table-bordered table-striped table-hover table-condensed',
                'columns' => array(
                    'PELANGGAN_ID',
                    'NAMA',
                    'EMAIL',
                    'HP',
                    array(
                        'name' => 'PELANGGAN_STATUS',
                        'header' => 'Akun',
                        'type' => 'StatusPelanggan',
                        'value' => '$data->PELANGGAN_STATUS',
                    ),
                    array(
                        'class' => 'MyCButtonColumn',
                    ),
                ),
            ));
            ?>
        </div>
    </div>
    <div class="span3">
        <?php $this->renderPartial('/layouts/_rightside') ?>
    </div>
</div>