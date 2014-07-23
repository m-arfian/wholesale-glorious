<?php
/* @var $this HargaController */
/* @var $model Harga */

$this->pageTitle = "Manajemen Harga";
$this->breadcrumbs = array(
    'Manajemen Harga',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#harga-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="row-fluid">
    <div class="span9">
        <div class="well well-white">
            <div class="row-fluid">
                <div class="span12">
                    <h2 class="lead"><i class="icon-money"></i> &nbsp;Manajemen Harga</h2>
                </div>
                <div class="span12">
                    <?php $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'hargainput-form',
                        'enableAjaxValidation' => false,
                    )); ?>
                    <div class="input-append">
                        <?php echo CHtml::dropDownList('kategori', '', Kategori::ListAll(), array(
                            'prompt' => '-- Pilih Kategori --',
                            'ajax' => array(
                                'type' => 'POST',
                                'url' => array('dropsubkategori'),
                                'update' => '#subkategori',
                            ),
                            'onChange' => 'loadSubkategori(this)',
                        )) ?>
                        <?php echo CHtml::dropDownList('subkategori', '', array(), array(
                            'prompt' => '-- Pilih Subkategori --',
                            'ajax' => array(
                                'type' => 'POST',
                                'url' => array('dropbarang'),
                                'update' => '#barang',
                            ),
                            'disabled' => true,
                            'onChange' => 'loadBarang(this)'
                        )) ?>
                        <?php echo CHtml::dropDownList('barang', '', array(), array(
                            'prompt' => '-- Pilih Barang --',
                            'disabled' => true,
                            'onChange' => 'openPlus(this)'
                        )) ?>
                        <?php echo CHtml::link('<i class="icon-plus"></i>', 'javascript:void(0)', array(
                            'class' => 'btn btn-success',
                            'disabled' => true,
                            'id' => 'plus'
                        )) ?>
                    </div>
                    <?php $this->endWidget(); ?>
                </div>
            </div>
            <?php echo CHtml::link('[Pencarian]', '#', array('class' => 'search-button')); ?>
            <div class="search-form" style="display:none">
                <?php $this->renderPartial('_search', array(
                    'model' => $model,
                )); ?>
            </div><!-- search-form -->
            <?php echo Yii::app()->user->getFlash('subinfo') ?>
            <?php
            $this->widget('zii.widgets.grid.CGridView', array(
                'id' => 'harga-grid',
                'dataProvider' => $model->search(),
                //styling pagination
                'pager' => array(
                    'header' => '',
                    'selectedPageCssClass' => 'active',
                    'hiddenPageCssClass' => 'disabled',
                    'htmlOptions' => array('class' => ''),
                ),
                'pagerCssClass' => 'pagination',
                //end styling pagination
                'summaryText' => 'Menampilkan {start} - {end} dari {count} data barang',
                'emptyText' => '<div class="alert alert-error">Tidak ada data barang ditampilkan</div>',
                'showTableOnEmpty' => false,
                'itemsCssClass' => 'table table-bordered table-striped table-hover table-condensed',
                'columns' => array(
                    array(
                        'id' => 'CHECKBOX',
                        'class' => 'CCheckBoxColumn',
                        'selectableRows' => '2', // ANY ROWS
                    ),
                    'HARGA_ID',
                    'barang.BARANG_NAMA',
                    array(
                        'name' => 'HARGA_NORMAL',
                        'type' => 'uang',
                        'value' => '$data->HARGA_NORMAL'
                    ),
                    array(
                        'name' => 'HARGA_SALE',
                        'type' => 'uang',
                        'value' => '$data->HARGA_SALE'
                    ),
                    array(
                        'name' => 'HARGA_PASAR',
                        'type' => 'uang',
                        'value' => '$data->HARGA_PASAR'
                    ),
                    'satuan.SATUAN_NAMA',
                    'HARGA_PRIORITAS',
                    array(
                        'class' => 'MyCButtonColumn',
                        'template' => '{update} {nonaktif} {aktifkan}',
                        'buttons' => array(
                            'nonaktif' => array(
                                'label' => 'Hapus prioritas',
                                'icon' => '<i class="icon-level-down font-bigger2"></i>',
                                'url' => 'array("harga/revoke", "hid"=>"$data->HARGA_ID", "brgid"=>"$data->BARANG_ID")',
                                'click' => 'function(e){
                                            e.preventDefault();
                                            var jawab = confirm("Apa Anda yakin untuk menghapus prioritas harga?");
                                            if(jawab) {
                                                $.post($(this).attr("href"), {"' . Yii::app()->request->csrfTokenName . '":"' . Yii::app()->request->csrfToken . '"});
                                                reloadGrid();
                                            }
                                        }',
                                'visible' => '$data->HARGA_PRIORITAS!=0',
                            ),
                            'aktifkan' => array(
                                'label' => 'Beri prioritas',
                                'icon' => '<i class="icon-level-up font-bigger2"></i>',
                                'url' => 'array("harga/grant", "hid"=>"$data->HARGA_ID", "brgid"=>"$data->BARANG_ID")',
                                'click' => 'function(e){
                                            e.preventDefault();
                                            var jawab = confirm("Apa Anda yakin untuk memberi prioritas harga?");
                                            if(jawab) {
                                                $.post($(this).attr("href"), {"' . Yii::app()->request->csrfTokenName . '":"' . Yii::app()->request->csrfToken . '"});
                                                reloadGrid();
                                            }
                                        }',
                                'visible' => '$data->HARGA_PRIORITAS==0',
                            ),
                        ),
                    ),
                ),
            ));
            ?>
        </div>
    </div>
    <div class="span3">
        <?php $this->renderPartial('/layouts/_rightside') ?>
    </div>
</div>
<script type="text/javascript">
    var root = "<?php echo Yii::app()->baseUrl ?>";
    function reloadGrid() {
        $("#harga-grid").yiiGridView.update("harga-grid");
    }
    function loadSubkategori(obj) {
        if($(obj).val()!=='')
            $('#subkategori').attr('disabled', false);
        else
            $('#subkategori, #barang, #plus').attr('disabled', true);
    }
    function loadBarang(obj) {
        if($(obj).val()!=='')
            $('#barang').attr('disabled', false);
        else
            $('#barang, #plus').attr('disabled', true);
    }
    function openPlus(obj) {
        if($(obj).val()!=='') {
            $('#plus').attr('disabled', false);
            $('#plus').attr('href', root+'/adminsystem/harga/create/brgid/'+$(obj).val());
        }
        else {
            $('#plus').attr('disabled', true);
            $('#plus').attr('href', 'javascript:void(0)');
        }
    }
</script>