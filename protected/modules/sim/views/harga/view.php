<?php
/* @var $this HargaController */
/* @var $model Harga */

$this->pageTitle = "Detail Harga - " . $barang->BARANG_NAMA;
$this->breadcrumbs = array(
    'Manajemen Harga' => array('index'),
    $barang->BARANG_NAMA,
);
?>

<div class="row-fluid">
    <div class="span9">
        <div class="well well-white">
            <div class="row-fluid">
                <div class="span10">
                    <h2 class="lead"><i class="icon-money"></i> &nbsp;Detail Harga #<?php echo $barang->BARANG_NAMA ?></h2>
                </div>
                <div class="span2">
                    <?php echo CHtml::link('<i class="icon-plus"></i>', array('harga/create', 'brgid'=>$barang->BARANG_ID), array('class' => 'btn btn-success tip', 'data-toggle'=>'tooltip', 'title'=>'Tambah harga')) ?>
                    <?php echo CHtml::link('<i class="icon-pencil"></i>', array('harga/update', 'brgid'=>$barang->BARANG_ID), array('class' => 'btn btn-info tip', 'data-toggle'=>'tooltip', 'title'=>'Ubah harga')) ?>
                </div>
            </div>
            <?php echo Yii::app()->user->getFlash('subinfo') ?>

            <?php
            $this->widget('zii.widgets.grid.CGridView', array(
                'id' => 'harga-grid',
                'dataProvider' => $model->searchByBarang($barang->BARANG_ID),
                //styling pagination
                'pager' => array(
                    'header' => '',
                    'selectedPageCssClass' => 'active',
                    'hiddenPageCssClass' => 'disabled',
                    'htmlOptions' => array('class' => ''),
                ),
                'pagerCssClass' => 'pagination',
                //end styling pagination
                'summaryText' => 'Menampilkan {start} - {end} dari {count} data harga - ' . $barang->BARANG_NAMA,
                'emptyText' => '<div class="alert alert-error">Tidak ada data harga ditampilkan</div>',
                'showTableOnEmpty' => false,
                'itemsCssClass' => 'table table-bordered table-striped table-hover table-condensed',
                'columns' => array(
                    'HARGA_PRIORITAS',
                    'satuan.SATUAN_NAMA',
                    //'subkategori.SUBKATEGORI_NAMA',
                    array(
                        'name' => 'HARGA_NORMAL',
                        'type' => 'Uang',
                        'value' => '$data->HARGA_NORMAL',
                    ),
                    array(
                        'name' => 'HARGA_SALE',
                        'type' => 'Uang',
                        'value' => '$data->HARGA_SALE',
                    ),
                    array(
                        'name' => 'HARGA_PASAR',
                        'type' => 'Uang',
                        'value' => '$data->HARGA_PASAR',
                        'visible' => WebUser::isAdmin(),
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
