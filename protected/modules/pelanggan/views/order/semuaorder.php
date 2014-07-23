<?php
$this->pageTitle = "Lihat semua order";
?>

<div class="row-fluid">
    <div class="span8">
        <div class="well well-white order-container">
            <ul class="nav nav-pills">
                <?php echo CHtml::tag('li', array('class'=>!isset($orderstatus)?'active':''), CHtml::link('Semua', array('order/')), true) ?>
                <?php foreach(OrderStatus::model()->findAll() as $value){
                    if(isset($orderstatus) && $orderstatus->ORDER_STATUS_NAMA==$value->ORDER_STATUS_NAMA) {
                        echo CHtml::tag('li', array('class'=>'active'), CHtml::link($value->ORDER_STATUS_NAMA, array('filter', 'status'=>strtolower($value->ORDER_STATUS_NAMA))), true);
                        continue;
                    }
                    echo CHtml::tag('li', array(), CHtml::link($value->ORDER_STATUS_NAMA, array('filter', 'status'=>strtolower($value->ORDER_STATUS_NAMA))), true);
                }?>
            </ul>
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
        </div><!--end row-->
    </div>
    <div class="span4">
        <?php $this->renderPartial('/layouts/_rightside', array('registered' => $registered)) ?>
    </div>
</div>
<script>
    $(document).ready(function() {
       $("li.active a").click(function(e) {
           e.preventDefault();
       });
    });
</script>