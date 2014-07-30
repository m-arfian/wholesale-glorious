<?php
/* @var $this PelangganController */
/* @var $model Pelanggan */
$this->pageTitle = "Detail Pelanggan";
$this->breadcrumbs = array(
    'Manajemen Pelanggan' => array('index'),
    $model->NAMA,
);
?>

<div class="blue-block">
    <div class="page-title">
        <h3 class="pull-left"><i class="fa fa-files-o"></i> Manajemen Pelanggan <span>Detail pelanggan #<?php echo $model->NAMA ?></span></h3>
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
                <?php echo CHtml::link('<i class="fa fa-plus"></i>', array('create'), array('class' => 'btn btn-sm tip', 'data-toggle' => 'tooltip', 'title' => 'Tambah pelanggan')) ?>
                <?php echo CHtml::link('<i class="fa fa-pencil"></i>', array('update', 'id' => $model->PELANGGAN_ID), array('class' => 'btn btn-sm tip', 'data-toggle' => 'tooltip', 'title' => 'Ubah pelanggan')) ?>
            </div>
            <div class="widget-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                        <?php
                        $this->widget('zii.widgets.CDetailView', array(
                            'data' => $model,
                            'htmlOptions' => array(
                                'class' => 'table table-bordered table-striped table-view',
                            ),
                            'attributes' => array(
                                'PELANGGAN_ID',
                                'NAMA',
                                'EMAIL',
                                'HP',
                                array(
                                    'name' => 'KELAMIN',
                                    'type' => 'Kelamin',
                                    'value' => $model->KELAMIN,
                                ),
                                array(
                                    'name' => 'PELANGGAN_STATUS',
                                    'type' => 'StatusPelanggan',
                                    'value' => $model->PELANGGAN_STATUS,
                                ),
                            ),
                        ));
                        ?>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <?php
                        if ($model->PELANGGAN_STATUS == Pelanggan::PUNYA_AKUN &&
                                $model->registered->PELANGGAN_ID == $model->PELANGGAN_ID) {

                            $this->widget('zii.widgets.CDetailView', array(
                                'data' => $model->registered,
                                'htmlOptions' => array(
                                    'class' => 'table table-bordered table-striped table-view',
                                ),
                                'attributes' => array(
                                    'REGISTERED_ID',
                                    'USERNAME',
                                    array(
                                        'name' => 'MEMBER_SINCE',
                                        'type' => 'tanggalwaktu',
                                        'value' => $model->registered->MEMBER_SINCE,
                                    ),
                                    array(
                                        'name' => 'LAST_LOGIN',
                                        'type' => 'tanggalwaktu',
                                        'value' => $model->registered->LAST_LOGIN,
                                    ),
                                    array(
                                        'name' => 'STATUS',
                                        'type' => 'StatusAktif',
                                        'value' => $model->registered->STATUS,
                                    ),
                                ),
                            ));
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>