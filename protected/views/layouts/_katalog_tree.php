<?php $kategoris = Kategori::model()->findAllByAttributes(array('KATEGORI_STATUS' => Kategori::AKTIF)) ?>
<div class="blocky">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Section title -->
                <div class="section-title">
                    <h4><i class="fa fa-tags color"></i> &nbsp;<span class="freestyle">Lihat daftar katalog kami!</span></h4>
                </div>    

                <div class="row">
                    <div class="col-md-12">
                        <div class="tree">
                            <ul class="row">
                                <?php foreach ($kategoris as $kategori): ?>
                                <li class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                    <span class="label label-danger"><i class="fa fa-th-large"></i> <?php echo CHtml::link($kategori->KATEGORI_NAMA, array('/katalog/kategori','id'=>Expr::linkForward($kategori->KATEGORI_ID, Expr::LINK_KATEGORI))) ?></span>
                                    <ul>
                                        <?php foreach ($kategori->subkategori as $subkategori): ?>
                                        <li>
                                            <span class="label label-primary"><i class="fa fa-tag"></i> <?php echo CHtml::link($subkategori->SUBKATEGORI_NAMA, array('/katalog/subkategori','id'=>Expr::linkForward($subkategori->SUBKATEGORI_ID, Expr::LINK_SUBKATEGORI))) ?></span>
                                        </li>
                                        <?php endforeach ?>
                                    </ul>
                                </li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
</script>