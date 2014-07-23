<?php
/* @var $this RekeningController */
/* @var $model Rekening */
$this->pageTitle = "Detail rekening - #$model->REKENING_NO";
$this->breadcrumbs=array(
	'Rekening'=>array('rekening/'),
	$model->REKENING_NO,
);
?>

<div class="blue-block">
    <div class="page-title">
        <h3 class="pull-left"><i class="fa fa-files-o"></i> Rekening <span>Detail rekening #<?php echo $model->REKENING_NO ?></span></h3>
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
                <?php echo CHtml::link('<i class="fa fa-plus"></i>', array('create'), array('class' => 'btn btn-sm tip', 'data-toggle' => 'tooltip', 'title' => 'Tambah rekening')) ?>
                <?php echo CHtml::link('<i class="fa fa-pencil"></i>', array('update', 'id' => $model->REKENING_ID), array('class' => 'btn btn-sm tip', 'data-toggle' => 'tooltip', 'title' => 'Ubah rekening')) ?>
            </div>
            <div class="widget-body">
                <?php
                $this->widget('zii.widgets.CDetailView', array(
                    'data' => $model,
                    'htmlOptions' => array(
                        'class' => 'table table-bordered table-striped table-view',
                    ),
                    'attributes'=>array(
                        'REKENING_ID',
						'ATAS_NAMA',
						'REKENING_BANK',
						'REKENING_NO',
						array(
							'header' => 'TAMPILAN',
							'type' => 'thumbnails',
							'value' => $model->GAMBAR_ID,
						),
                        array(
                            'name' => 'REKENING_STATUS',
                            'type' => 'statusAktif',
                            'value' => $model->REKENING_STATUS
                        ),
                    ),
                ));
                ?>
            </div>
        </div>
    </div>
</div>