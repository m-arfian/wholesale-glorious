<?php $id = $data->SUBKATEGORI_ID ?>
<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
    <div class="item">
        <div class="item-icon"><span></span></div>
        <!-- Item image -->
        <div class="item-image">
            <?php /* echo CHtml::link(CHtml::image($data->gambar->GAMBAR_NAMA, $data->SUBKATEGORI_NAMA, array('class' => 'img-responsive')),
                    array('/katalog/subkategori', 'id'=>Expr::linkForward($data->SUBKATEGORI_ID, Expr::LINK_SUBKATEGORI))) */ ?>
        </div>
        <!-- Item details -->
        <div class="item-details">
            <!-- Name -->
            <h5><?php echo CHtml::link($data->SUBKATEGORI_NAMA, array('/katalog/subkategori','id'=>Expr::linkForward($data->SUBKATEGORI_ID, Expr::LINK_SUBKATEGORI))) ?></h5>
            <div class="clearfix"></div>
            <hr />
        </div>
    </div>
</div>