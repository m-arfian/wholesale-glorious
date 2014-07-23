<?php
/* @var $this ProvinsiController */
/* @var $model Provinsi */
$this->pageTitle = 'Tambah Provinsi';
$this->breadcrumbs = array(
    'Provinsi' => array('provinsi/'),
    'Tambah provinsi',
);
?>

<div class="blue-block">
    <div class="page-title">
        <h3 class="pull-left"><i class="fa fa-files-o"></i> Provinsi <span>Tambah provinsi</span></h3>
        <?php $this->renderPartial('/layouts/_breadcrumb') ?>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div class="page-content page-form">

        <div class="row" id="flashtop">
            <?php echo Yii::app()->user->getFlash('info') ?>
            <div class="col-md-12 col-sm-12 col-xs-12" style="display:none"></div>
        </div>

        <div class="widget">
            <div class="widget-head">
            </div>
            <div class="widget-body">
                <?php $this->renderPartial('_search', array('model' => $model)) ?>
            </div>
        </div>
    </div>
</div>

<?php $this->renderPartial('_form', array('model' => $model)); ?>