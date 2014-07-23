<?php
/* @var $this KonfirmasiController */
/* @var $model Konfirmasi */
$this->pageTitle = "Detail Konfirmasi #$model->KONFIRMASI_ID";
$this->breadcrumbs = array(
    'Konfirmasi' => array('konfirmasi/'),
    $model->KONFIRMASI_ID,
);
?>

<div class="blue-block">
    <div class="page-title">
        <h3 class="pull-left"><i class="fa fa-exclamation-triangle"></i> Konfirmasi <span>Detail konfirmasi #<?php echo $model->KONFIRMASI_ID ?></span></h3>
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
            <div class="widget-head"></div>
            <div class="widget-body">
                <?php
                $this->widget('zii.widgets.CDetailView', array(
                    'data' => $model,
                    'htmlOptions' => array(
                        'class' => 'table table-bordered table-striped table-view',
                    ),
                    'attributes' => array(
                        'KONFIRMASI_ID',
                        array(
                            'name' => 'KONFIRMASI_DATE',
                            'type' => 'tanggalWaktu',
                            'value' => $model->KONFIRMASI_DATE
                        ),
                        array(
                            'name' => 'INVOICE_ORDER',
                            'type' => 'orderID',
                            'value' => $model->INVOICE_ORDER,
                        ),
                        'rekening.REKENING_NO',
                        'NAMA_PELANGGAN',
                        array(
                            'name' => 'TOTAL',
                            'type' => 'uang',
                            'value' => $model->TOTAL
                        ),
                        array(
                            'name' => 'BAYAR_DATE',
                            'type' => 'tanggal',
                            'value' => $model->BAYAR_DATE
                        ),
                        'CATATAN',
                        'BANK_PENGIRIM',
                        'ATAS_NAMA',
                        'EMAIL',
                        'NO_TELP',
                        array(
                            'name' => 'KONFIRMASI_STATUS',
                            'type' => 'statusKonfirmasi',
                            'value' => $model->KONFIRMASI_STATUS
                        ),
                    ),
                ));
                ?>
            </div>
        </div>
    </div>
</div>