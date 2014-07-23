<?php
$this->pageTitle = $subkategori->SUBKATEGORI_NAMA;
$this->breadcrumbs = array(
    'Katalog' => array('katalog/'),
    $subkategori->kategori->KATEGORI_NAMA => array('kategori', 'id'=>Expr::linkForward($subkategori->KATEGORI_ID, Expr::LINK_KATEGORI)),
    $subkategori->SUBKATEGORI_NAMA
);
?>

<!-- Page title -->
<div class="page-title">
    <div class="container">
        <h2><i class="fa fa-th-large color"></i> Katalog <small><?php echo $subkategori->kategori->KATEGORI_NAMA.' - '.$subkategori->SUBKATEGORI_NAMA ?></small></h2>
        <hr />
    </div>
</div>
<!-- Page title -->

<div class="shop-items">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 hidden-sm hidden-xs">
                <?php $this->renderPartial('_sidebar') ?>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="row">
                    <?php $this->widget('zii.widgets.CListView', array(
                        'dataProvider' => new CActiveDataProvider('Barang', array(
                            'criteria' => $barang_c, 'pagination' => array('pageSize' => 6)
                        )),
                        'itemView' => '/layouts/_katalog_item',
                        'pager' => array(
                            'header' => '',
                            'selectedPageCssClass' => 'active',
                            'hiddenPageCssClass' => 'disabled',
                            'htmlOptions' => array('class' => 'pagination'),
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