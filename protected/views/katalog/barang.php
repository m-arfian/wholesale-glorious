<?php
$this->pageTitle = $detail->BARANG_NAMA;
$this->breadcrumbs = array(
    'Katalog' => array('katalog/'),
    $detail->subkategori->kategori->KATEGORI_NAMA => array('kategori', 'id'=>Expr::linkForward($detail->subkategori->KATEGORI_ID, Expr::LINK_KATEGORI)),
    $detail->subkategori->SUBKATEGORI_NAMA => array('subkategori', 'id'=>Expr::linkForward($detail->SUBKATEGORI_ID, Expr::LINK_SUBKATEGORI)),
    $detail->BARANG_NAMA
);

$itemOnCart = OrderTemp::CekCartItem($detail->BARANG_ID);
?>

<!-- Page title -->
<div class="page-title">
    <div class="container">
        <h2><i class="fa fa-desktop color"></i> Detail Barang <small><?php echo $detail->BARANG_NAMA ?></small></h2>
        <hr />
    </div>
</div>
<!-- Page title -->

<div class="shop-item">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="single-item">
                    <div class="row">
                        <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
                            <div class="item-image text-center">
                                <?php
                                echo CHtml::link(CHtml::image($detail->subgambar[0]->gambarmedium->GAMBAR_NAMA, $detail->subgambar[0]->SUB_TITLE),
                                        $detail->subgambar[0]->gambarlarge->GAMBAR_NAMA, array(
                                            'rel' => 'productphoto', 'title' => $detail->subgambar[0]->SUB_TITLE
                                )) ?>
                            </div>
                            <div class="item-image-thumb text-center">
                                <?php foreach ($detail->subgambar as $i => $subgambar): ?>
                                    <?php if ($i == 0) continue; ?>
                                    <?php echo CHtml::link(CHtml::image($subgambar->gambaricon->GAMBAR_NAMA, $subgambar->SUB_TITLE, array('width' => 76)),
                                            $subgambar->gambarlarge->GAMBAR_NAMA, array('rel' => 'productphoto', 'title' => $subgambar->SUB_TITLE)) ?>
                                <?php endforeach; ?>
                            </div><!--end flexslider-thumb-->
                            <small class="text-warning">* Klik gambar untuk memperbesar</small>
                        </div>
                        <div class="col-lg-7 col-md-6 col-sm-6 col-xs-12">
                            <!-- Title -->
                            <h4><?php echo $detail->BARANG_NAMA ?></h4>
                            <h5 class="text-center">
                                <strong><?php echo MyFormatter::formatHargaSatuan($detail->harga[0]->HARGA_NORMAL, $detail->harga[0]->HARGA_SALE, $detail->harga[0]->satuan->SATUAN_NAMA) ?></strong>
                                <br><small><?php echo CHtml::link('Lihat harga lainnya', '#daftarharga', array('class' => 'tabharga')) ?></small>
                            </h5>
                            <hr class="thin">
                            
                            <dl class="dl-horizontal dl-condensed">
                                <dt>Kategori</dt>
                                <dd><?php echo $detail->subkategori->kategori->KATEGORI_NAMA . ' - ' . $detail->subkategori->SUBKATEGORI_NAMA ?></dd>

                                <dt>Stok</dt>
                                <dd><?php echo $detail->stokstatus->STOK_STATUS_NAMA ?></dd>

                                <dt>Kustomisasi</dt>
                                <dd>
                                    <?php if($detail->CUSTOMABLE == Barang::CUSTOMABLE)
                                        echo '<span class="text-success"><i class="fa fa-check"></i> Bisa</span>';
                                    else
                                        echo '<span class="text-danger"><i class="fa fa-ban"></i> Tidak bisa</span>';
                                    ?>
                                </dd>
                                <dd>
                                    <?php echo CHtml::link('Apa itu kustomisasi?', '#', array(
                                        'class' => 'pop',
                                        'title' => 'Kustomisasi',
                                        'data-content' => 'Kustomisasi adalah penambahan atribut tertentu kepada barang (bordir, sablon, dll). Contoh paling umum adalah penambahan bordir logo/nama sekolah pada dasi dan topi sekolah.',
                                    )) ?>
                                </dd>
                            </dl>

                            <?php echo CHtml::tag('div', array('class' => 'text-info oncart', 'style' => $itemOnCart ? 'display:none' : ''), '<i class="fa fa-check-circle"></i> Barang ini sudah ada di keranjang', true) ?>

                            <?php echo CHtml::beginForm(array('/katalog/beli'), 'post', array('class' => 'form-inline buy')); ?>
                            <div class="form-group">
                                <?php echo CHtml::hiddenField('id', $detail->BARANG_ID) ?>
                                <?php echo CHtml::numberField('jml', 1, array('class' => 'input-sm form-control', 'min' => '1')) ?>
                                <?php echo CHtml::dropDownList('satuan', $detail->harga[0]->SATUAN_ID, Satuan::ListByBarang($detail->BARANG_ID), array('class' => 'input-sm form-control')) ?>
                                <?php
                                if ($itemOnCart)
                                    echo CHtml::htmlButton('<i class="fa fa-shopping-cart"></i> Pesan barang ini', array(
                                        'class' => 'btn btn-primary btn-sm beli baru tip',
                                        'data-title' => '+Pesan barang ini',
                                        'data-placement' => 'top',
                                        'type' => 'submit',
                                    ));
                                else
                                    echo CHtml::htmlButton('<i class="fa fa-plus"></i> Pesan barang ini', array(
                                        'class' => 'btn btn-success btn-sm beli plus tip',
                                        'data-title' => '+Tambah jumlah barang di keranjang',
                                        'data-placement' => 'top',
                                        'type' => 'submit',
                                    ));
                                ?>
                            </div>
                            <?php echo CHtml::tag('div', array('style' => 'display:none', 'class' => 'itemflash'), '', true) ?>
                            <?php echo CHtml::endForm() ?>

                            <!-- Share button -->

                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 col-lg-offset-5 col-md-offset-2">
                            <?php echo CHtml::label('Pilihan variasi barang', 'grupee', array('class' => 'pull-right')) ?>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                            <?php echo CHtml::dropDownList('grupee', $detail->BARANG_LINK, Barang::ListGrupee($detail->BGRUP_ID), array(
                                'class' => 'form-control',
                                'onchange' => 'swap(this.value)',
                            )) ?>
                        </div>
                    </div>
                </div><br>

                <!-- Description, specs and review -->
                <ul id="detailtab" class="nav nav-tabs">
                    <!-- Use uniqe name for "href" in below anchor tags -->
                    <li class="active">
                        <a href="#deskripsi" data-toggle="tab">Deskripsi</a>
                    </li>
                    <li>
                        <a href="#spesifikasi" data-toggle="tab">Spesifikasi</a>
                    </li>
                    <li>
                        <a href="#daftarharga" data-toggle="tab">Daftar Harga</a>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div id="detailcontent" class="tab-content">
                    <!-- Description -->
                    <div class="tab-pane fade in active" id="deskripsi">
                        <p><?php echo $detail->BARANG_DESKRIPSI ?></p>
                    </div>

                    <!-- Sepcs -->
                    <div class="tab-pane fade" id="spesifikasi">
                        <?php echo MyFormatter::formatJson1ToTable($detail->BARANG_SPEK) ?>
                    </div>

                    <!-- Review -->
                    <div class="tab-pane fade" id="daftarharga">
                        <dl class="dl-horizontal">
                            <?php foreach ($harga as $daftar): ?>
                                <dt class="dt-condensed"><?php echo $daftar->satuan->SATUAN_NAMA ?></dt>
                                <dd><?php echo MyFormatter::formatHarga($daftar->HARGA_NORMAL, $daftar->HARGA_SALE) ?></dd>
                            <?php endforeach; ?>
                        </dl>
                    </div>
                </div>

            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <?php $this->renderPartial('_sidebar') ?>
            </div>
        </div>
        <hr class="colorgraph">
    </div>
</div>
<br />

<script type="text/javascript">
    $('meta[name="keywords"]').attr('content', '<?php echo $meta ?>');
    
    function swap(val) {
        window.location.assign("<?php echo Yii::app()->baseUrl . '/katalog/detail/' ?>" + val);
    }
    
    function loading(obj) {
        $(obj).attr('disabled', 'disabled');
        $(obj).html('<i class="fa fa-spinner fa-spin"></i>');
    }
    
    function unloading(obj) {
        $(obj).removeAttr('disabled');
    }
    
    $(document).ready(function() {
        var root = "<?php echo Yii::app()->createUrl('/') ?>";
        
        $("a[rel=productphoto]").fancybox({
            'transitionIn'  : 'none',
            'transitionOut' : 'none',
            'titlePosition' : 'over',
            'titleFormat'   : function(title, currentArray, currentIndex, currentOpts) {
                return '<span id="fancybox-title-over">Foto ' +  (currentIndex + 1) + ' / ' + currentArray.length + ' ' + title + '</span>';
            }
	});
        
        $('form.buy').submit(function(e) {
            var item = $(this);
            var button = item.find('.btn[type="submit"]');
            $.ajax({
                type: 'POST',
                data: item.serialize(),
                url: item.attr('action'),
                beforeSend: loading(item.find('.btn[type="submit"]')),
                success: function(data) {
                    if (data) {
                        item.find('.itemflash').html('<div class="text-success"><i class="fa fa-check"></i> Barang berhasil ditambahkan</div>');
                        button.html('<i class="fa fa-plus"></i> Pesan barang ini');
                        button.removeClass('btn-primary baru').addClass('btn-success plus');
                        $('.oncart').show();
                    }
                    else
                        item.find('.itemflash').html('<div class="text-danger"><i class="fa fa-exclamation-circle"></i> Barang gagal ditambahkan</div>');
                    
                    item.find('.itemflash').show('slow').delay(5000).hide('slow');
                },
                complete: function() {
                    $("#topsum").load(root + '/pelanggan/keranjang/keranjangsum');
                    $("#toptotal").load(root + '/pelanggan/keranjang/keranjangtotal');
                    unloading(button);
                }
            });
            
             e.preventDefault();
        });
    });
    
    $('.tabharga').click(function (e) {
        $('#detailtab a[href="#daftarharga"]').tab('show');
        e.preventDefault();
    });
    
</script>