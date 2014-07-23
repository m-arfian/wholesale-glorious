<?php
$this->pageTitle = 'Cek Pemesanan';
$this->breadcrumbs = array(
    'Cek pemesanan'
);
?>

<div class="blocky">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 col-lg-offset-4 col-md-offset-3 col-sm-offset-3">
                <div class="cool-block">
                    <div class="form cool-block-bor">
                        <h3 class="text-center"><i class="fa fa-ticket color"></i> Cek status pemesanan Anda disini.</h3><hr class="inner-separator">
                        <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'cekorder-form',
                            'enableAjaxValidation' => false
                            ))
                        ?>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                    <?php echo $form->textField($cekorder, 'ORDERID', array('class' => 'form-control input-lg tip', 'placeholder' => 'Order ID', 'data-title' => 'Order ID dari pemesanan barang sebelumnya',)) ?>
                                </div>
                                <?php echo $form->error($cekorder, 'ORDERID'); ?>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-1">
                                <br><?php echo CHtml::htmlButton('<i class="fa fa-search"></i> Cari pemesanan', array('class' => 'btn btn-primary btn-block', 'type' => 'submit')) ?>
                            </div>
                        </div>

                        <?php $this->endWidget(); ?>
                    </div>
                </div>   
            </div>
            <div class="col-lg-4 col-md-3 col-sm-3 hidden-xs">
                <?php echo CHtml::image(Yii::app()->baseUrl . '/images/toko/maskot/Cari_small.png') ?>
            </div>
        </div>
        <hr class="colorgraph">
    </div>
</div>