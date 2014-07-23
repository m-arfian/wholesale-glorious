<?php
/* @var $this TestimoniController */
/* @var $model Testimoni */
$this->pageTitle = "Detail testimoni - #$model->TESTIMONI_ID";
$this->breadcrumbs = array(
    'Testimoni' => array('testimoni/'),
    $model->TESTIMONI_ID,
);
?>

<div class="blue-block">
    <div class="page-title">
        <h3 class="pull-left"><i class="fa fa-comments"></i> Testimoni <span>Detail testimoni #<?php echo $model->TESTIMONI_ID ?></span></h3>
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
            <div class="widget-head"></div>
            <div class="widget-body">
                <?php
                $this->widget('zii.widgets.CDetailView', array(
                    'data' => $model,
                    'htmlOptions' => array(
                        'class' => 'table table-bordered table-striped table-view',
                    ),
                    'attributes' => array(
                        'TESTIMONI_ID',
                        array(
                            'name' => 'TESTIMONI_DATE',
                            'type' => 'tanggalWaktu',
                            'value' => $model->TESTIMONI_DATE
                        ),
                        'TESTIMONI_NAMA',
                        array(
                            'name' => 'ORDER_ID',
                            'type' => 'orderID',
                            'value' => $model->ORDER_ID,
                        ),
                        'TESTIMONI',
                    ),
                ));
                ?>
            </div>
        </div>
    </div>
</div>