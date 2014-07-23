<?php $id = $data->BARANG_ID ?>
<?php /* $_desk = nl2br($data->BARANG_DESKRIPSI); $deskripsi = substr($_desk, 0, 50); */ ?>
<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-lg-offset-0 col-md-offset-1">
    <div class="offer offer-warning">
        <div class="shape">
            <div class="shape-text">
                Baru
            </div>
        </div>
        <div class="offer-content">
            <div class="item">
                <!-- Use the below link to put HOT icon -->
                <!--<div class="item-icon new"><span>BARU</span></div>-->
                <!-- Item image -->
                <div class="item-image">
                    <?php echo CHtml::link(CHtml::image($data->subgambar[0]->gambarsmall->GAMBAR_NAMA, '', array('class'=>'img-responsive')), array('katalog/detail', 'id' => Expr::linkForward($data->BARANG_ID, Expr::LINK_BARANG))) ?>
                </div>
                <!-- Item details -->
                <div class="item-details">
                    <!-- Name -->
                    <h5><?php echo CHtml::link($data->BARANG_NAMA, array('katalog/detail', 'id'=>Expr::linkForward($data->BARANG_ID, Expr::LINK_BARANG))) ?></h5>
                    <!-- Para. Note more than 2 lines. -->
                    <hr />
                    <!-- Price -->
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                            <div class="main-price">
                                <?php echo MyFormatter::formatHargaSatuan($data->harga[0]->HARGA_NORMAL, $data->harga[0]->HARGA_SALE, $data->harga[0]->satuan->SATUAN_NAMA); ?>
                            </div>
                        </div>
                        <!-- Add to cart -->
                    </div>

                    <?php echo CHtml::beginForm(array('/katalog/beli'), 'post', array('class' => 'form-inline buy')); ?>
                    <div class="form-group">
                        <?php echo CHtml::hiddenField('id', $id) ?>
                        <?php echo CHtml::numberField('jml', 1, array('class' => 'input-sm form-control', 'min' => '1')) ?>
                        <?php echo CHtml::dropDownList('satuan', $data->harga[0]->SATUAN_ID, Satuan::ListByBarang($id), array('class' => 'input-sm form-control')) ?>
                        <?php
                        echo CHtml::htmlButton('<i class="fa fa-shopping-cart"></i>', array(
                            'class' => 'btn btn-primary btn-sm beli',
                            'data-title' => '+Pesan barang ini',
                            'data-placement' => 'top',
                            'rel' => 'tooltip',
                            'type' => 'submit',
                        ))
                        ?>
                    </div>
                    <?php echo CHtml::tag('div', array('style' => 'display:none', 'class' => 'itemflash'), '', true); ?>
                    <?php echo CHtml::endForm() ?>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    
</div>