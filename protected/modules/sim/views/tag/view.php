<?php
/* @var $this TagController */
/* @var $model Tag */
$this->pageTitle = "Detail tag - #$model->TAG_NAMA";
$this->breadcrumbs = array(
    'Tag' => array('tag/'),
    $model->TAG_NAMA,
);
?>

<div class="blue-block">
    <div class="page-title">
        <h3 class="pull-left"><i class="fa fa-files-o"></i> Tag <span>Detail tag #<?php echo $model->TAG_NAMA ?></span></h3>
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
                <?php echo CHtml::link('<i class="fa fa-plus"></i>', array('create'), array('class' => 'btn btn-sm tip', 'data-toggle' => 'tooltip', 'title' => 'Tambah tag')) ?>
                <?php echo CHtml::link('<i class="fa fa-pencil"></i>', array('update', 'id' => $model->TAG_ID), array('class' => 'btn btn-sm tip', 'data-toggle' => 'tooltip', 'title' => 'Ubah tag')) ?>
            </div>
            <div class="widget-body">
                <?php
                $this->widget('zii.widgets.CDetailView', array(
                    'data' => $model,
                    'htmlOptions' => array(
                        'class' => 'table table-bordered table-striped table-view',
                    ),
                    'attributes' => array(
                        'TAG_ID',
                        'TAG_NAMA',
                        array(
                            'name' => 'TAG_STATUS',
                            'type' => 'statusAktif',
                            'value' => $model->TAG_STATUS
                        ),
                    ),
                ));
                ?>
            </div>
        </div>
    </div>
</div>