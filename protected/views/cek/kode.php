<?php
$this->pageTitle = "Pemesanan kode #$kode";
$this->breadcrumbs = array(
    'Cek pemesanan' => array('index'),
    "Pemesanan kode #$kode"
);
?>

<div class="blocky">
    <div class="container">
        <div class="paper paper-curl">
            <?php
            $this->widget('zii.widgets.CListView', array(
                'dataProvider' => $result,
                'itemView' => '/layouts/_order',
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
        </div>
    </div>
</div>