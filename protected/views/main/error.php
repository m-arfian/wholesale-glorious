<?php
$this->pageTitle = 'Error ' . YII_DEBUG ? $code : '404';
//$this->breadcrumbs = array(
//    'Error ' . $code,
//);
?>
<!-- Page content -->

<div class="error-block blocky text-center">
    <div class="container">
        <h2>Uups!!! Error <span class="color"><?php echo YII_DEBUG ? $code : '404' ?></span></h2>
        <p class="error-para"><?php echo YII_DEBUG ? CHtml::encode($message) : 'Halaman yang Anda cari tidak ditemukan' ?></p>
        
        <div class="link-list">
            <h5>Anda tersesat? Jangan cemas, silahkan coba masuk ke halaman lain melalui menu diatas atau laporkan kesulitan Anda melalui operator kami.</h5>
        </div>
        
        <div class="sep-bor"></div>
    </div>
</div>

<!-- Recent posts CarouFredSel Starts -->
<?php // $this->renderPartial('/layouts/_item_carousel') ?>
<!-- Recent posts Ends -->	

<!-- Catchy starts -->
<?php $this->renderPartial('/layouts/_belt_joinus') ?>
<!-- Catchy ends -->

<!-- CTA Starts -->
<?php // $this->renderPartial('/layouts/_cta_newsletter') ?>
<!-- CTA Ends -->