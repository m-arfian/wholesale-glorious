<?php
/* @var $this KotaController */
/* @var $model Kota */
$this->pageTitle = "Detail kota - #$model->KOTA_NAMA";
$this->breadcrumbs = array(
    'Kota' => array('index'),
    $model->KOTA_NAMA,
);
?>

<div class="blue-block">
    <div class="page-title">
        <h3 class="pull-left"><i class="fa fa-files-o"></i> Kota <span>Detail kota #<?php echo $model->KOTA_NAMA ?></span></h3>
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
                <?php echo CHtml::link('<i class="fa fa-plus"></i>', array('create'), array('class' => 'btn btn-sm tip', 'data-toggle' => 'tooltip', 'title' => 'Tambah kota')) ?>
                <?php echo CHtml::link('<i class="fa fa-pencil"></i>', array('update', 'id' => $model->KOTA_ID), array('class' => 'btn btn-sm tip', 'data-toggle' => 'tooltip', 'title' => 'Ubah kota')) ?>
            </div>
            <div class="widget-body">
                <?php
                $this->widget('zii.widgets.CDetailView', array(
                    'data' => $model,
                    'htmlOptions' => array(
                        'class' => 'table table-bordered table-striped table-view',
                    ),
                    'attributes' => array(
                        'KOTA_ID',
                        'KOTA_NAMA',
                        'provinsi.PROVINSI_NAMA',
                        array(
                            'name' => 'WILAYAH_ID',
                            'type' => 'wilayahKota',
                            'value' => $model->WILAYAH_ID
                        ),
                        array(
                            'name' => 'KOTA_STATUS',
                            'type' => 'statusAktif',
                            'value' => $model->KOTA_STATUS
                        ),
                    ),
                ));
                ?>
            </div>
        </div>
    </div>
</div>