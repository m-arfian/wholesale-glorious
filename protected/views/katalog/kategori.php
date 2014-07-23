<?php
$this->pageTitle = $kategori->KATEGORI_NAMA;
$this->breadcrumbs = array(
    'Katalog' => array('/katalog'),
    $kategori->KATEGORI_NAMA,
);
?>

<!-- Page title -->
<div class="page-title">
    <div class="container">
        <h2><i class="fa fa-th-large color"></i> Katalog <small><?php echo $kategori->KATEGORI_NAMA ?></small></h2>
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
            <div class="col-lg-9 col-md-9 col-sm-12 col-sm-12">
                <div class="row">
                    <?php $this->widget('zii.widgets.CListView', array(
                        'dataProvider' => new CActiveDataProvider('Subkategori', array('criteria' => SubKategori::GetByKategori($kategori->KATEGORI_ID),)),
                        'itemView' => '_kategori',
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