<?php
/* @var $this WaktuController */
/* @var $model SatuanWaktu */
$this->pageTitle = "Detail satuan waktu - #$model->SATUAN_WAKTU_NAMA";
$this->breadcrumbs = array(
    'Satuan Waktu' => array('waktu/'),
    $model->SATUAN_WAKTU_NAMA,
);
?>

<div class="blue-block">
    <div class="page-title">
        <h3 class="pull-left"><i class="fa fa-comments"></i> Satuan Waktu <span>Detail satuan waktu #<?php echo $model->SATUAN_WAKTU_NAMA ?></span></h3>
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
            <div class="widget-head">
                <?php echo CHtml::link('<i class="fa fa-plus"></i>', array('create'), array('class' => 'btn btn-sm tip', 'data-toggle' => 'tooltip', 'title' => 'Tambah satuan waktu')) ?>
                <?php echo CHtml::link('<i class="fa fa-pencil"></i>', array('update', 'id' => $model->SATUAN_WAKTU_ID), array('class' => 'btn btn-sm tip', 'data-toggle' => 'tooltip', 'title' => 'Ubah satuan waktu')) ?>
            </div>
            <div class="widget-body">
                <?php
                $this->widget('zii.widgets.CDetailView', array(
                    'data' => $model,
                    'htmlOptions' => array(
                        'class' => 'table table-bordered table-striped table-view',
                    ),
                    'attributes' => array(
                        'SATUAN_WAKTU_ID',
                        'SATUAN_WAKTU_NAMA',
                        array(
                            'name' => 'SATUAN_WAKTU_TIPE',
                            'type' => 'tipeWaktu',
                            'value' => $model->SATUAN_WAKTU_TIPE
                        ),
                        array(
                            'name' => 'SATUAN_WAKTU_STATUS',
                            'type' => 'statusAktif',
                            'value' => $model->SATUAN_WAKTU_STATUS
                        ),
                    ),
                ));
                ?>
            </div>
        </div>
    </div>
</div>