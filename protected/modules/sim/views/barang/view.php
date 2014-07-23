<?php
/* @var $this BarangController */
/* @var $model Barang */
$this->pageTitle = "Detail Barang - $model->BARANG_NAMA";
$this->breadcrumbs = array(
    'Manajemen Barang' => array('index'),
    $model->BARANG_NAMA,
);
?>

<div class="blue-block">
    <div class="page-title">
        <h3 class="pull-left"><i class="fa fa-inbox"></i> Manajemen Barang <span>Detail barang #<?php echo $model->BARANG_NAMA ?></span></h3>
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
                <?php echo CHtml::link('<i class="fa fa-plus"></i>', array('create'), array('class' => 'btn btn-sm tip', 'data-toggle' => 'tooltip', 'title' => 'Tambah barang')) ?>
                <?php echo CHtml::link('<i class="fa fa-pencil"></i>', array('update', 'id' => $model->BARANG_ID), array('class' => 'btn btn-sm tip', 'data-toggle' => 'tooltip', 'title' => 'Ubah barang')) ?>
            </div>
            <div class="widget-body">
                <ul class="nav nav-tabs" id="barang-tab">
                    <li class="active"><?php echo CHtml::link('Informasi', array('barang/view/#info'), array('id' => 'tab-info')) ?></li>
                    <li><?php echo CHtml::link('Harga, Tag & Foto', array('barang/view/#foto'), array('id' => 'tab-foto')) ?></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="info">
                        <?php
                        $this->widget('zii.widgets.CDetailView', array(
                            'data' => $model,
                            'htmlOptions' => array(
                                'class' => 'table table-bordered table-striped table-view',
                            ),
                            'attributes' => array(
                                'BARANG_ID',
                                'BARANG_NAMA',
                                'BARANG_ALIAS',
                                'kategori.KATEGORI_NAMA',
                                'subkategori.SUBKATEGORI_NAMA',
                                
                                array(
                                    'name' => 'CUSTOMABLE',
                                    'type' => 'Kustomisasi',
                                    'value' => $model->CUSTOMABLE,
                                ),
                                array(
                                    'name' => 'STOK_STATUS_ID',
                                    'type' => 'StokStatus',
                                    'value' => $model->STOK_STATUS_ID,
                                ),
                                array(
                                    'name' => 'BARANG_SPEK',
                                    'type' => 'json1ToTable',
                                    'value' => $model->BARANG_SPEK,
                                ),
                                array(
                                    'name' => 'BARANG_DESKRIPSI',
                                    'type' => 'raw',
                                    'value' => $model->BARANG_DESKRIPSI,
                                ),
                                array(
                                    'name' => 'BARANG_BOBOT',
                                    'value' => $model->BARANG_BOBOT.' gram'
                                ),
                                array(
                                    'name' => 'BARANG_TIPE',
                                    'type' => 'tipeBarang',
                                    'value' => $model->BARANG_TIPE
                                ),
                                array(
                                    'name' => 'BARANG_STATUS',
                                    'type' => 'StatusAktif',
                                    'value' => $model->BARANG_STATUS,
                                ),
                            ),
                        ));
                        ?>
                    </div>

                    <div class="tab-pane btn-" id="foto">
                        <?php
                        $this->widget('zii.widgets.grid.CGridView', array(
                            'id' => 'harga-grid',
                            'dataProvider' => $harga->searchByBarang($model->BARANG_ID),
                            //styling pagination
                            'pager' => array(
                                'header' => '',
                                'selectedPageCssClass' => 'active',
                                'hiddenPageCssClass' => 'disabled',
                                'htmlOptions' => array('class' => ''),
                            ),
                            'pagerCssClass' => 'pagination',
                            //end styling pagination
                            'summaryText' => 'Menampilkan {start} - {end} dari {count} data harga - ' . $model->BARANG_NAMA,
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
                                array(
                                    'class' => 'MyCButtonColumn',
                                    'template' => '{update}',
                                    'buttons' => array(
                                        'update' => array(
                                            'url' => 'array("barang/harga/id/$data->BARANG_ID", "edit"=>"$data->HARGA_ID")',
                                        ),
                                    ),
                                ),
                            ),
                        ));
                        ?>

                        <div class="product-img-thumb">
                            <?php foreach ($model->subgambar as $gambar){
                                echo CHtml::link(CHtml::image($gambar->gambaricon->GAMBAR_NAMA, $gambar->SUB_TITLE),
                               		$gambar->gambarlarge->GAMBAR_NAMA, array('rel'=>'productphoto', 'title'=>$gambar->SUB_TITLE, 'class'=>'fancy'));
                            } ?>
                        </div>
                        
                        <div class="product-tag">
                            <?php foreach ($model->barangtag as $tag) {
                                echo CHtml::link('<span class="label label-info">'.$tag->tag->TAG_NAMA.'</span>', array('tag/view', 'id'=>$tag->TAG_ID));
                            }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#barang-tab a').click(function(e) {
            e.preventDefault();
            $(this).tab('show');
        });
    });
</script>