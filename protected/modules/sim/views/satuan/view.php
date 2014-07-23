<?php
/* @var $this SatuanController */
/* @var $model Satuan */
$this->pageTitle = "Detail tag - #$model->SATUAN_NAMA";
$this->breadcrumbs = array(
    'Satuan' => array('index'),
    $model->SATUAN_NAMA,
);
?>

<div class="blue-block">
    <div class="page-title">
        <h3 class="pull-left"><i class="fa fa-files-o"></i> Satuan <span>Detail satuan #<?php echo $model->SATUAN_NAMA ?></span></h3>
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
                <?php echo CHtml::link('<i class="fa fa-plus"></i>', array('create'), array('class' => 'btn btn-sm tip', 'data-toggle' => 'tooltip', 'title' => 'Tambah satuan')) ?>
                <?php echo CHtml::link('<i class="fa fa-pencil"></i>', array('update', 'id' => $model->SATUAN_ID), array('class' => 'btn btn-sm tip', 'data-toggle' => 'tooltip', 'title' => 'Ubah satuan')) ?>
            </div>
            <div class="widget-body">
                <?php
                $this->widget('zii.widgets.CDetailView', array(
                    'data' => $model,
                    'htmlOptions' => array(
                        'class' => 'table table-bordered table-striped table-view',
                    ),
                    'attributes' => array(
                        'SATUAN_ID',
                        'SATUAN_NAMA',
                        array(
                            'name' => 'SATUAN_STATUS',
                            'type' => 'statusAktif',
                            'value' => $model->SATUAN_STATUS
                        ),
                    ),
                ));
                ?>
            </div>
        </div>
    </div>
</div>