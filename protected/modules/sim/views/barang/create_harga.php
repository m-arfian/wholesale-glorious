<?php
/* @var $this BarangController */
/* @var $model Barang */
$this->pageTitle = "Penentuan Harga $model->BARANG_NAMA";
$this->breadcrumbs = array(
    'Manajemen Barang' => array('barang/'),
    "$model->BARANG_NAMA" => array('view', 'id' => $model->BARANG_ID),
    'Penentuan Harga',
);
?>

<div class="blue-block">
    <div class="page-title">
        <h3 class="pull-left"><i class="fa fa-inbox"></i> Manajemen Barang <span>Harga - <?php echo $model->BARANG_NAMA ?></span></h3>
        <?php $this->renderPartial('/layouts/_breadcrumb') ?>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div class="page-content page-form">

        <div class="row form-group">
            <div class="col-xs-12">
                <ul class="nav nav-pills nav-justified thumbnail setup-panel">
                    <li>
                        <?php echo CHtml::link('<p class="list-group-item-text">1. Deskripsi Barang</p>', array('update', 'id' => $model->BARANG_ID)) ?>
                    </li>
                    <li class="active"><a href="#"><p class="list-group-item-text">2. Penentuan Harga</p></a></li>
                </ul>
            </div>
        </div>

        <div id="flashtop">
            <?php echo Yii::app()->user->getFlash('info') ?>
            <div class="col-md-12 col-sm-12 col-xs-12" style="display:none"></div>
        </div>

        <div class="widget">
            <div class="widget-head"></div>

            <div class="widget-body">
                <div class="table-responsive">
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'enableAjaxValidation' => true,
                        'action' => array('nosale'),
                    )) ?>

                    <?php echo CHtml::ajaxSubmitButton('Hapus Harga Sale', array('nosale'), array('success' => 'reloadGrid'), array('class' => 'btn btn-black', 'title' => 'Hapus harga sale', 'confirm' => 'Apakah Anda yakin?')) ?>

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
                        'summaryText' => 'Menampilkan {start} - {end} dari {count} data harga',
                        'emptyText' => '<div class="alert alert-error">Tidak ada data harga ditampilkan</div>',
                        'showTableOnEmpty' => false,
                        'itemsCssClass' => 'table table-bordered table-striped table-hover table-condensed',
                        'columns' => array(
                            array(
                                'id' => 'CHECKBOX',
                                'class' => 'CCheckBoxColumn',
                                'selectableRows' => '2', // ANY ROWS
                            ),
                            'HARGA_PRIORITAS',
                            'satuan.SATUAN_NAMA',
                            array(
                                'name' => 'HARGA_NORMAL',
                                'type' => 'uang',
                                'value' => '$data->HARGA_NORMAL',
                            ),
                            array(
                                'name' => 'HARGA_SALE',
                                'type' => 'uang',
                                'value' => '$data->HARGA_SALE',
                            ),
                            array(
                                'name' => 'HARGA_PASAR',
                                'type' => 'uang',
                                'value' => '$data->HARGA_PASAR',
                            ),
                            array(
                                'class' => 'MyCButtonColumn',
                                'template' => '{update} {nonaktif} {aktifkan}',
                                'buttons' => array(
                                    'update' => array(
                                        'url' => 'array("ubah", "harga"=>"$data->HARGA_ID")',
                                    ),
                                    'nonaktif' => array(
                                        'label' => 'Hapus prioritas',
                                        'icon' => '<button class="btn btn-xs btn-warning"><i class="fa fa-arrow-down"></i></button>',
                                        'url' => 'array("revoke", "hid"=>"$data->HARGA_ID", "brgid"=>"$data->BARANG_ID")',
                                        'click' => 'function(e){
                                            e.preventDefault();
		                            var jawab = confirm("Apa Anda yakin untuk menghapus prioritas harga?");
                                            if(jawab) {
                                                $.post($(this).attr("href"), {"' . Yii::app()->request->csrfTokenName . '":"' . Yii::app()->request->csrfToken . '"});
                                                reloadGrid();
		                            }
                                        }',
                                        'visible' => '$data->HARGA_PRIORITAS!=0',
                                    ),
                                    'aktifkan' => array(
                                        'label' => 'Beri prioritas',
                                        'icon' => '<button class="btn btn-xs btn-info"><i class="fa fa-arrow-up"></i></button>',
                                        'url' => 'array("grant", "hid"=>"$data->HARGA_ID", "brgid"=>"$data->BARANG_ID")',
                                        'click' => 'function(e){
                                            e.preventDefault();
                                            var jawab = confirm("Apa Anda yakin untuk memberi prioritas harga?");
                                            if(jawab) {
                                                $.post($(this).attr("href"), {"' . Yii::app()->request->csrfTokenName . '":"' . Yii::app()->request->csrfToken . '"});
                                                reloadGrid();
		                            }
		                        }',
                                        'visible' => '$data->HARGA_PRIORITAS==0',
                                    ),
                                ),
                            ),
                        ),
                    ));
                    ?>

                    <?php $this->endWidget(); ?>
                </div><br/>

                <?php $this->renderPartial('_form_harga', array('harga' => $harga, 'model' => $model)) ?>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function reloadGrid() {
        $("#harga-grid").yiiGridView.update("harga-grid");
    }
</script>