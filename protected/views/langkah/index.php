<?php
$this->pageTitle = 'Langkah Belanja';
$this->breadcrumbs = array(
    'Langkah belanja',
);

Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/timeline.bootstrap.css');
?>

<!-- Page title -->
<div class="page-title">
    <div class="container">
        <h2><i class="fa fa-random color"></i> Langkah Belanja <small></small></h2>
        <hr>
    </div>
</div>
<!-- Page title -->

<div class="howto">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="timeline">
                    <li>
                        <div class="timeline-badge"><i class="fa fa-location-arrow"></i></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">1. Pilih barang dari katalog</h4>
                                <hr class="inner-separator">
                            </div>
                            <div class="timeline-body">
                                <p>Cari dan pilih barang yang Anda ingin pesan melalui <?php echo CHtml::link('katalog', array('/katalog')) ?>.</p>
                                <p>Tentukan barang yang ingin dipesan, pilih jumlah barang dan satuan yang dihendaki lalu klik tombol 
                                    <?php echo CHtml::htmlButton('<i class="fa fa-shopping-cart"></i>', array('class'=>'btn btn-primary btn-sm')) ?> 
                                    atau <?php echo CHtml::htmlButton('<i class="fa fa-shopping-cart"></i> Pesan barang ini', array('class'=>'btn btn-primary btn-sm')) ?>.
                                </p>
                            </div>
                        </div>
                        <div class="timeline-body-image"><?php echo CHtml::image(Yii::app()->baseUrl.'/images/toko/maskot/Pilih_small.png') ?></div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-badge warning"><i class="fa fa-shopping-cart"></i></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">2. Cek keranjang Anda</h4>
                                <hr class="inner-separator">
                            </div>
                            <div class="timeline-body">
                                <p>Buka <?php echo CHtml::link('keranjang', array('/pelanggan/keranjang')) ?> Anda untuk melihat seluruh barang yang telah Anda pilih.</p>
                                <p>Edit jumlah dan satuan barang apabila perlu.</p>
                            </div>
                        </div>
                        <div class="timeline-body-image"><?php echo CHtml::image(Yii::app()->baseUrl.'/images/toko/maskot/Keranjang_small.png') ?></div>
                    </li>
                    <li>
                        <div class="timeline-badge danger"><i class="fa fa-truck"></i></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">3. Isi data pada formulir checkout</h4>
                                <hr class="inner-separator">
                            </div>
                            <div class="timeline-body">
                                <p>Isi formulir <?php echo CHtml::link('checkout', array('/pelanggan/checkout')) ?> dengan data pribadi yang benar. Seluruh data pada formulir ini akan digunakan dalam proses pengiriman dan pembayaran</p>
                            </div>
                        </div>
                        <div class="timeline-body-image"><?php echo CHtml::image(Yii::app()->baseUrl.'/images/toko/maskot/Daftar_small.png') ?></div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-badge info"><i class="fa fa-credit-card"></i></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">4. Lakukan pembayaran</h4>
                                <hr class="inner-separator">
                            </div>
                            <div class="timeline-body">
                                <p>Pembayaran dapat dilakukan melalui transfer melalui rekening bank yang telah kami sediakan. Untuk penggunaan rekber, silahkan kontak kami terlebih dahulu.</p>
                                <p>Pembayaran tunai dan COD (Cash on delivery) juga bisa dilakukan apabila pihak pelanggan bersedia dan membuat janji sebelumnya.</p>
                            </div>
                        </div>
                        <div class="timeline-body-image"><?php echo CHtml::image(Yii::app()->baseUrl.'/images/toko/maskot/Bayar_small.png') ?></div>
                    </li>
                    <li>
                        <div class="timeline-badge success"><i class="fa fa-desktop"></i></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">5. Konfirmasikan pembayaran</h4>
                                <hr class="inner-separator">
                            </div>
                            <div class="timeline-body">
                                <p>Beritahu kami apabila Anda sudah melakukan transfer pembayaran pesanan Anda melalui halaman <?php echo CHtml::link('konfirmasi', array('/konfirmasi')) ?></p>
                                <p>Lebih cepat Anda melakukan transfer dan konfirmasi, semakin cepat kami akan memproses pemesanan Anda.</p>
                            </div>
                        </div>
                        <div class="timeline-body-image"><?php echo CHtml::image(Yii::app()->baseUrl.'/images/toko/maskot/Kurir_small.png') ?></div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-badge"><i class="fa fa-thumbs-o-up"></i></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">6. Tinggalkan testimoni</h4>
                                <hr class="inner-separator">
                            </div>
                            <div class="timeline-body">
                                <p>Barang diterima dengan cepat atau lambat? Pelayanan oke atau bikin bete? Sampaikan semuanya melalui testimoni pelanggan pada halaman <?php echo CHtml::link('ini', array('/testimoni')) ?>.</p>
                                <p class="text-center text-primary">Untuk kami dan Demi Anda.</p>
                            </div>
                        </div>
                        <div class="timeline-body-image"><?php echo CHtml::image(Yii::app()->baseUrl.'/images/toko/maskot/Jempol_small.png') ?></div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="sep-bor"></div>
    </div>
</div>