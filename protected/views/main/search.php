<?php
$this->pageTitle = 'Hasil Pencarian';
$this->breadcrumbs = array(
    "Hasil pencarian | $keyword",
);
?>

<!-- Page title -->
<div class="page-title">
    <div class="container">
        <h2><i class="fa fa-search-plus color"></i> Hasil Pencarian <small><?php echo $keyword ?></small></h2>
        <hr />
    </div>
</div>
<!-- Page title -->

<div class="shop-items">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <?php $this->widget('zii.widgets.CListView', array(
                        'dataProvider' => $result,
                        'itemView' => '/layouts/_katalog_item_4_col',
                        'pager' => array(
                            'header' => '',
                            'selectedPageCssClass' => 'active',
                            'hiddenPageCssClass' => 'disabled',
                            'htmlOptions' => array('class' => ''),
                        ),
                        'summaryText' => '',
                        'pagerCssClass' => 'pagination',
                        'emptyText' => '<div class="alert alert-danger">Tidak ada barang yang ditemukan</div>',
                    )) ?>
                </div><!--end row-->

            </div>
        </div>
        <hr class="colorgraph">
    </div>
</div>

<?php $this->renderPartial('/layouts/_buy') ?>