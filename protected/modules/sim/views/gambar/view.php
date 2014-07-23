<?php
/* @var $this GambarController */
/* @var $model Gambar */
$this->pageTitle = "Detail gambar - #$model->GAMBAR_ID";
$this->breadcrumbs = array(
    'Gambar' => array('gambar/'),
    $model->GAMBAR_ID,
);
?>

<div class="blue-block">
    <div class="page-title">
        <h3 class="pull-left"><i class="fa fa-files-o"></i> Gambar <span>Detail #<?php echo $model->GAMBAR_ID ?></span></h3>
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
                <?php echo CHtml::link('<i class="fa fa-plus"></i>', array('create'), array('class' => 'btn btn-sm tip', 'data-toggle' => 'tooltip', 'title' => 'Tambah gambar')) ?>
                <?php echo CHtml::link('<i class="fa fa-pencil"></i>', array('update', 'id' => $model->GAMBAR_ID), array('class' => 'btn btn-sm tip', 'data-toggle' => 'tooltip', 'title' => 'Ubah gambar')) ?>
            </div>
            <div class="widget-body">
                <?php
                $this->widget('zii.widgets.CDetailView', array(
                    'data' => $model,
                    'htmlOptions' => array(
                        'class' => 'table table-bordered table-striped table-view',
                    ),
                    'attributes' => array(
                        'GAMBAR_ID',
                        'GAMBAR_NAMA',
                        array(
                            'header' => 'TAMPILAN',
                            'type' => 'thumbnails',
                            'value' => $model->GAMBAR_ID,
                        ),
                        array(
                            'name' => 'GAMBAR_STATUS',
                            'type' => 'statusAktif',
                            'value' => $model->GAMBAR_STATUS
                        ),
                    ),
                ));
                ?>
            </div>
        </div>
    </div>
</div>