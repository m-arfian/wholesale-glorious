<?php
/* @var $this KategoriController */
/* @var $model Kategori */
$this->pageTitle = "Detail kategori - #$model->KATEGORI_NAMA";
$this->breadcrumbs=array(
	'Kategori'=>array('kategori/'),
	$model->KATEGORI_NAMA,
);
?>

<div class="blue-block">
    <div class="page-title">
        <h3 class="pull-left"><i class="fa fa-files-o"></i> Kategori <span>Detail kategori #<?php echo $model->KATEGORI_NAMA ?></span></h3>
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
                <?php echo CHtml::link('<i class="fa fa-plus"></i>', array('create'), array('class' => 'btn btn-sm tip', 'data-toggle' => 'tooltip', 'title' => 'Tambah kategori')) ?>
                <?php echo CHtml::link('<i class="fa fa-pencil"></i>', array('update', 'id' => $model->KATEGORI_ID), array('class' => 'btn btn-sm tip', 'data-toggle' => 'tooltip', 'title' => 'Ubah kategori')) ?>
            </div>
            <div class="widget-body">
                <?php
                $this->widget('zii.widgets.CDetailView', array(
                    'data' => $model,
                    'htmlOptions' => array(
                        'class' => 'table table-bordered table-striped table-view',
                    ),
                    'attributes'=>array(
                        'KATEGORI_ID',
						'KATEGORI_NAMA',
						array(
							'header' => 'TAMPILAN',
							'type' => 'thumbnails',
							'value' => $model->GAMBAR_ID,
						),
                        array(
                            'name' => 'KATEGORI_STATUS',
                            'type' => 'statusAktif',
                            'value' => $model->KATEGORI_STATUS
                        ),
                    ),
                ));
                ?>
            </div>
        </div>
    </div>
</div>
