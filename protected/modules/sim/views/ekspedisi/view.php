<?php
/* @var $this EkspedisiController */
/* @var $model Ekspedisi */
$this->pageTitle = "Detail ekspedisi - #$model->EKSPEDISI_NAMA";
$this->breadcrumbs = array(
    'Ekspedisi' => array('ekspedisi/'),
    $model->EKSPEDISI_NAMA,
);
?>

<div class="blue-block">
    <div class="page-title">
        <h3 class="pull-left"><i class="fa fa-files-o"></i> Ekspedisi <span>Detail ekspedisi #<?php echo $model->EKSPEDISI_NAMA ?></span></h3>
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
                <?php echo CHtml::link('<i class="fa fa-plus"></i>', array('create'), array('class' => 'btn btn-sm tip', 'data-toggle' => 'tooltip', 'title' => 'Tambah ekspedisi')) ?>
                <?php echo CHtml::link('<i class="fa fa-pencil"></i>', array('update', 'id' => $model->EKSPEDISI_ID), array('class' => 'btn btn-sm tip', 'data-toggle' => 'tooltip', 'title' => 'Ubah ekspedisi')) ?>
            </div>
            <div class="widget-body">
                <?php
                $this->widget('zii.widgets.CDetailView', array(
                    'data' => $model,
                    'htmlOptions' => array(
                        'class' => 'table table-bordered table-striped table-view',
                    ),
                    'attributes' => array(
                        'EKSPEDISI_ID',
                        'EKSPEDISI_NAMA',
                        array(
                            'name' => 'EKSPEDISI_TIPE',
                            'type' => 'ekspedisiTipe',
                            'value' => $model->EKSPEDISI_TIPE
                        ),
                        array(
                            'name' => 'EKSPEDISI_STATUS',
                            'type' => 'statusAktif',
                            'value' => $model->EKSPEDISI_STATUS,
                        ),
                    ),
                ));
                ?>
            </div>
        </div>
    </div>
</div>