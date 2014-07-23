<?php
/* @var $this TestimoniController */
/* @var $model Testimoni */
$this->pageTitle = "Testimoni";
$this->breadcrumbs = array(
    'Testimoni',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#testimoni-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="blue-block">
    <div class="page-title">
        <h3 class="pull-left"><i class="fa fa-comments"></i> Testimoni <span></span></h3>
        <?php $this->renderPartial('/layouts/_breadcrumb') ?>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div class="page-content page-tables">
        
        <div class="row" id="flashtop">
            <?php echo Yii::app()->user->getFlash('info') ?>
            <div class="col-md-12 col-sm-12 col-xs-12" style="display:none"></div>
        </div>
        
        <div class="widget">
            <div class="search-form" style="display:none">
                <?php $this->renderPartial('_search', array('model' => $model)) ?>
            </div><!-- search-form -->
            <div class="widget-head">
                <?php echo CHtml::link('<i class="fa fa-search-plus"></i> Pencarian testimoni', '#', array('class' => 'btn btn-xs btn-black search-button')); ?>
            </div>
            <div class="widget-body">
                <div class="table-responsive">
                    <?php
                    $this->widget('zii.widgets.grid.CGridView', array(
                        'id' => 'testimoni-grid',
                        'dataProvider' => $model->search(),
                        //styling pagination
                        'pager' => array(
                            'header' => '',
                            'selectedPageCssClass' => 'active',
                            'hiddenPageCssClass' => 'disabled',
                            'htmlOptions' => array('class' => 'pagination'),
                        ),
                        'pagerCssClass' => 'pagination',
                        //end styling pagination
                        'summaryText' => 'Menampilkan {start} - {end} dari {count} testimoni',
                        'emptyText' => '<div class="alert alert-error">Tidak ada data testimoni ditampilkan</div>',
                        'showTableOnEmpty' => false,
                        'itemsCssClass' => 'table table-bordered table-striped table-hover table-condensed',
                        'columns' => array(
                            'TESTIMONI_ID',
                            array(
                                'name' => 'TESTIMONI_DATE',
                                'type' => 'tanggalWaktu',
                                'value' => '$data->TESTIMONI_DATE'
                            ),
                            'TESTIMONI_NAMA',
                            'ORDER_ID',
                            'TESTIMONI',
                            array(
                                'class' => 'MyCButtonColumn',
                                'template' => '{view}'
                            ),
                        ),
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>