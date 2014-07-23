<?php
/* @var $this SupplierController */
/* @var $model Supplier */
$this->pageTitle = "Detail supplier - #$model->SUPPLIER_NAMA";
$this->breadcrumbs = array(
    'Supplier' => array('supplier/'),
    $model->SUPPLIER_NAMA,
);
?>

<div class="blue-block">
    <div class="page-title">
        <h3 class="pull-left"><i class="fa fa-files-o"></i> Supplier <span>Detail supplier #<?php echo $model->SUPPLIER_NAMA ?></span></h3>
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
                <?php echo CHtml::link('<i class="fa fa-plus"></i> tambah', array('create'), array('class' => 'btn btn-sm tip', 'data-toggle' => 'tooltip', 'title' => 'Tambah supplier')) ?>
                <?php echo CHtml::link('<i class="fa fa-pencil"></i> edit', array('update', 'id' => $model->SUBKATEGORI_ID), array('class' => 'btn btn-sm tip', 'data-toggle' => 'tooltip', 'title' => 'Ubah supplier')) ?>
                <div class="pull-right">
                    <?php echo CHtml::link('<i class="fa fa-check"></i> terima', array('accept'), array('class' => 'btn btn-sm tip', 'data-toggle' => 'tooltip', 'title' => 'Terima supplier')) ?>
                    <?php echo CHtml::link('<i class="fa fa-table"></i> tolak', array('reject'), array('class' => 'btn btn-sm tip', 'data-toggle' => 'tooltip', 'title' => 'Tolak supplier')) ?>
                </div>
            </div>
            <div class="widget-body">
                <?php
                $this->widget('zii.widgets.CDetailView', array(
                    'data' => $model,
                    'htmlOptions' => array(
                        'class' => 'table table-bordered table-striped table-view',
                    ),
                    'attributes' => array(
                        'SUPPLIER_ID',
                        'SUPPLIER_NAMA',
                        'NAMA_PEMILIK',
                        'SUPPLIER_BIDANG',
                        'SUPPLIER_EMAIL',
                        'SUPPLIER_KONTAK',
                        'SUPPLIER_LOKASI',
                        'kota.provinsi.PROVINSI_NAMA',
                        'kota.KOTA_NAMA',
                        'SUPPLIER_DESKRIPSI',
                        array(
                            'name' => 'SUPPLIER_TGL',
                            'type' => 'tanggalwaktu',
                            'value' => '$data->SUPPLIER_TGL'
                        ),
                        array(
                            'name' => 'SUPPLIER_STATUS',
                            'type' => 'supplierstatus',
                            'value' => $model->SUPPLIER_STATUS
                        ),
                    ),
                ));
                ?>
            </div>
        </div>
    </div>
</div>
