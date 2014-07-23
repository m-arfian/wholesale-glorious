<?php
$this->pageTitle = 'Jual atribut berbagai macam seragam grosir dan eceran - Jayagrosir.net';
$this->breadcrumbs = array();
?>

<!-- Carousel starts -->
<!--<div id="carousel-example-generic" class="carousel slide">
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    </ol>

    <div class="carousel-inner">
        <div class="item active animated fadeInRight">
            <img src="http://placehold.it/1350x250&text=NO%20IMAGE" alt="" class="img-responsive" />
            <div class="carousel-caption">
                <h2 class="animated fadeInLeftBig">Lorem ipsum dolor sit amet</h2>
                <p class="animated fadeInRightBig">Lorem ipsum dolor sit amet, <strong>consectetur adipiscing</strong> elit. Donec tristique est sit amet diam interdum semper. </p>
                <a href="#" class="animated fadeInLeftBig btn btn-info btn-lg">Buy Now - $199</a>
            </div>
        </div>       
    </div>

    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
        <span class="icon-prev"></span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
        <span class="icon-next"></span>
    </a>
</div>-->
<!-- carousel ends -->

<!-- Hero starts -->
<div class="hero">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Catchy title -->
                <h3>Barang terbaru</h3>
                <!--<p>Barang Terbaru</p>-->
            </div>
        </div>
        <hr class="inner-separator">
    </div>
</div>
<!-- Hero ends -->  

<!-- Items List starts -->
<div class="shop-items blocky">
    <div class="container">
        <div class="row">
            <!-- Item #1 -->
            <?php
            $this->widget('zii.widgets.CListView', array(
                'dataProvider' => new CActiveDataProvider('Barang', array('criteria' => $barang_cr, 'pagination' => false)),
                'itemView' => '/layouts/_front_item',
                'pager' => array(
                    'header' => '',
                    'selectedPageCssClass' => 'active',
                    'hiddenPageCssClass' => 'disabled',
                    'htmlOptions' => array('class' => ''),
                ),
                'summaryText' => '',
                'pagerCssClass' => 'pagination',
                'emptyText' => '<div class="col-xs-12"><div class="alert alert-error">Tidak ada barang yang ditemukan</div></div>',
            ));
            ?>
        </div>
    </div>
</div>

<!-- Items List ends -->

<!-- Catchy starts -->
<?php $this->renderPartial('/layouts/_belt_joinus') ?>
<!-- Catchy ends -->

<!-- Tree Starts -->
<?php $this->renderPartial('/layouts/_katalog_tree') ?>
<!-- Tree Ends -->	

<!-- CTA Starts -->
<!-- CTA Ends -->

<!-- Clients starts -->
<!-- Clients ends -->

<div class="container">
    <hr class="colorgraph">
</div>

<?php $this->renderPartial('/layouts/_buy') ?>