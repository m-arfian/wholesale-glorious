<?php
$this->pageTitle = 'Cara Pembayaran';
$this->breadcrumbs = array(
    'Cara Pembayaran',
);
?>
<!-- Page title -->
<div class="page-title">
    <div class="container">
        <h2><i class="fa fa-credit-card color"></i> Pembayaran <small></small></h2>
        <hr>
    </div>
</div>
<!-- Page title -->

<div class="bank">
    <div class="container">        
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <p class="font1 text-danger">Pembayaran bisa dilakukan melalui transfer ke rekening yang kami sediakan pada halaman ini. 
                    Setelah melakukan pembayaran, jangan lupa untuk konfirmasi pembayaran Anda melalui halaman <?php echo CHtml::link('konfirmasi', array('/konfirmasi')) ?></p>
                <br/>
            </div>
            <?php foreach ($bank as $rekening): ?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div class="text-center">
                        <?php echo CHtml::image($rekening->gambar->GAMBAR_NAMA, '', array('class' => 'img-thumbnail')) ?>
                        <p><?php echo $rekening->REKENING_BANK.' '.$rekening->REKENING_CABANG ?></p>
                        <p class="font4"><?php echo $rekening->REKENING_NO ?></p>
                        <p><?php echo $rekening->ATAS_NAMA ?></p>
                    </div>
                </div>
            <?php endforeach ?>
        </div>

        <hr class="colorgraph">
    </div>
</div>