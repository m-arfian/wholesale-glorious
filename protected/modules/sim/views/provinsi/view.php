<?php
/* @var $this ProvinsiController */
/* @var $model Provinsi */
$this->pageTitle = "Detail provinsi - #$model->PROVINSI_NAMA";
$this->breadcrumbs=array(
	'Provinsi'=>array('provinsi/'),
	$model->PROVINSI_NAMA,
);
?>

<div class="blue-block">
    <div class="page-title">
        <h3 class="pull-left"><i class="fa fa-files-o"></i> Provinsi <span>Detail provinsi #<?php echo $model->PROVINSI_NAMA ?></span></h3>
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
                <?php echo CHtml::link('<i class="fa fa-plus"></i>', array('create'), array('class' => 'btn btn-sm tip', 'data-toggle' => 'tooltip', 'title' => 'Tambah provinsi')) ?>
                <?php echo CHtml::link('<i class="fa fa-pencil"></i>', array('update', 'id' => $model->PROVINSI_ID), array('class' => 'btn btn-sm tip', 'data-toggle' => 'tooltip', 'title' => 'Ubah provinsi')) ?>
            </div>
            <div class="widget-body">
                <?php
                $this->widget('zii.widgets.CDetailView', array(
                    'data' => $model,
                    'htmlOptions' => array(
                        'class' => 'table table-bordered table-striped table-view',
                    ),
                    'attributes'=>array(
                        'PROVINSI_ID',
                        'PROVINSI_NAMA',
                        array(
                            'name' => 'PROVINSI_STATUS',
                            'type' => 'statusAktif',
                            'value' => $model->PROVINSI_STATUS
                        ),
                    ),
                ));
                ?>
            </div>
        </div>
    </div>
</div>