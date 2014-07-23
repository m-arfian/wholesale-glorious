<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <div class="item">
        <div class="item-icon"><span></span></div>
        <!-- Item image -->
        <div class="item-image">
            <?php echo CHtml::link(CHtml::image($data->gambar->GAMBAR_NAMA, $data->KATEGORI_NAMA, array('class' => 'img-responsive')),
                    array('/katalog/kategori', 'id'=>Expr::linkForward($data->KATEGORI_ID, Expr::LINK_KATEGORI))) ?>
        </div>
        <!-- Item details -->
        <div class="item-details">
            <!-- Name -->
            <h5><?php echo CHtml::link($data->KATEGORI_NAMA, array('/katalog/kategori','id'=>Expr::linkForward($data->KATEGORI_ID, Expr::LINK_KATEGORI))) ?></h5>
            <div class="clearfix"></div>
            <hr />
        </div>
    </div>
</div>