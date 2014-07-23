<?php
$this->pageTitle = "Keranjang";
$this->breadcrumbs = array(
    'Pelanggan' => array('/pelanggan'),
    'Keranjang',
);
?>
<!-- Page title -->
<div class="page-title">
    <div class="container">
        <h2><i class="fa fa-shopping-cart color"></i> Keranjang <small></small></h2>
        <hr />
    </div>
</div>
<!-- Page title -->

<div class="view-cart blocky">
    <div class="container">
        <div class="row">
            <div id="cart_container" class="col-md-12">
                <?php $this->renderPartial('_keranjang', array('ordertemp' => $ordertemp)); ?>
            </div><!--end span12-->
        </div><!--end row-->
    </div>
</div>