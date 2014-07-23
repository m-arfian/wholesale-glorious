<?php
/* @var $this PelangganController */
/* @var $model Pelanggan */
$this->pageTitle = "Detail Pelanggan";
$this->breadcrumbs = array(
    'Manajemen Pelanggan' => array('index'),
    $model->NAMA,
);
?>

<div class="row-fluid">
    <div class="span9">
        <div class="well well-white">
            <div class="row-fluid">
                <div class="span12">
                    <h2 class="lead"><i class="icon-user"></i> &nbsp;Detail Pelanggan #<?php echo $model->NAMA ?></h2>
                </div>
            </div>
            <?php echo Yii::app()->user->getFlash('subinfo') ?>

            <?php
            if ($model->PELANGGAN_STATUS == Pelanggan::PUNYA_AKUN &&
                    $model->registered->PELANGGAN_ID == $model->PELANGGAN_ID
            ) {
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
                            'type' => 'DateFormat',
                            'value' => $model->registered->MEMBER_SINCE,
                        ),
                        array(
                            'name' => 'LAST_LOGIN',
                            'type' => 'DateFormat',
                            'value' => $model->registered->LAST_LOGIN,
                        ),
                        array(
                            'name' => 'STATUS',
                            'type' => 'StatusAktif',
                            'value' => $model->registered->STATUS,
                        ),
                    ),
                ));
                echo '<br>';
            }
            ?>

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
    </div>
    <div class="span3">
        <?php $this->renderPartial('/layouts/_rightside') ?>
    </div>
</div>