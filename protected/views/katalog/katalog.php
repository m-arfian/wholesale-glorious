<?php
$this->pageTitle = "Kategori";
$this->breadcrumbs = array(
    'Katalog',
);
?>

<!-- Page title -->
<div class="page-title">
    <div class="container">
        <h2><i class="fa fa-th-large color"></i> Katalog <small>kategori</small></h2>
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
                        'dataProvider' => new CActiveDataProvider('Kategori', array('criteria' => Kategori::GetAll(),)),
                        'itemView' => '_katalog',
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