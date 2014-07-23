<?php
/* @var $this SubkategoriController */
/* @var $model Subkategori */
$this->pageTitle = "Detail subkategori - #$model->SUBKATEGORI_NAMA";
$this->breadcrumbs=array(
	'Subkategori'=>array('subkategori/'),
	$model->SUBKATEGORI_NAMA,
);
?>

<div class="blue-block">
    <div class="page-title">
        <h3 class="pull-left"><i class="fa fa-files-o"></i> Subkategori <span>Detail subkategori #<?php echo $model->SUBKATEGORI_NAMA ?></span></h3>
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
                <?php echo CHtml::link('<i class="fa fa-plus"></i>', array('create'), array('class' => 'btn btn-sm tip', 'data-toggle' => 'tooltip', 'title' => 'Tambah subkategori')) ?>
                <?php echo CHtml::link('<i class="fa fa-pencil"></i>', array('update', 'id' => $model->SUBKATEGORI_ID), array('class' => 'btn btn-sm tip', 'data-toggle' => 'tooltip', 'title' => 'Ubah subkategori')) ?>
            </div>
            <div class="widget-body">
                <?php
                $this->widget('zii.widgets.CDetailView', array(
                    'data' => $model,
                    'htmlOptions' => array(
                        'class' => 'table table-bordered table-striped table-view',
                    ),
                    'attributes'=>array(
                        'SUBKATEGORI_ID',
						'SUBKATEGORI_NAMA',
						'kategori.KATEGORI_NAMA',
						array(
							'header' => 'TAMPILAN',
							'type' => 'thumbnails',
							'value' => $model->GAMBAR_ID,
						),
                        array(
                            'name' => 'SUBKATEGORI_STATUS',
                            'type' => 'statusAktif',
                            'value' => $model->SUBKATEGORI_STATUS
                        ),
                    ),
                ));
                ?>
            </div>
        </div>
    </div>
</div>
