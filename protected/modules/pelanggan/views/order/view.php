<?php
$orderid = MyFormatter::formatOrderID($kode);
$this->pageTitle = "Detail order - $orderid";
$this->breadcrumbs = array(
    'Pelanggan' => array('/pelanggan'),
    'Manajemen Order' => array('order/'),
    "Detail order - $orderid",
);
?>

<!-- Page title -->
<!-- Page title -->

<div class="pelanggan">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <?php
                $this->widget('zii.widgets.CListView', array(
                    'dataProvider' => $order,
                    'itemView' => '//layouts/_order',
                    'pager' => array(
                        'header' => '',
                        'selectedPageCssClass' => 'active',
                        'hiddenPageCssClass' => 'disabled',
                        'htmlOptions' => array('class' => ''),
                    ),
                    'summaryText' => '',
                    'pagerCssClass' => 'pagination',
                    'emptyText' => '<div class="span12"><div class="alert alert-error">Tidak ada order yang ditemukan</div></div>',
                ));
                ?>
                <hr>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <?php $this->renderPartial('/layouts/_rightside', array('registered' => $registered)) ?>
            </div>
        </div>
        <hr class="colorgraph">
    </div>
</div>