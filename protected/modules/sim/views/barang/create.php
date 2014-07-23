<?php
/* @var $this BarangController */
/* @var $model Barang */
$this->pageTitle = 'Tambah Barang';
$this->breadcrumbs = array(
    'Manajemen Barang' => array('barang/'),
    'Tambah barang',
);
?>

<div class="blue-block">
    <div class="page-title">
        <h3 class="pull-left"><i class="fa fa-inbox"></i> Manajemen Barang <span>Tambah barang</span></h3>
        <?php $this->renderPartial('/layouts/_breadcrumb') ?>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div class="page-content page-form">
        
        <div class="row form-group">
	        <div class="col-xs-12">
	            <ul class="nav nav-pills nav-justified thumbnail setup-panel">
	                <li class="active"><a href="#">
	                    <p class="list-group-item-text">1. Deskripsi Barang</p>
	                </a></li>
	                <li class="disabled"><a href="#">
	                    <p class="list-group-item-text">2. Penentuan Harga</p>
	                </a></li>
	            </ul>
	        </div>
		</div>
		
		<div id="flashtop">
            <?php echo Yii::app()->user->getFlash('info') ?>
            <div class="col-md-12 col-sm-12 col-xs-12" style="display:none"></div>
        </div>
        
        <div class="widget">
            <div class="widget-head">
            </div>
            <div class="widget-body">
                <?php $this->renderPartial('_form', array('model' => $model)) ?>
            </div>
        </div>
    </div>
</div>