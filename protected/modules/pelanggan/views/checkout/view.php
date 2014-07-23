<?php
$this->pageTitle = "Pemesanan Sukses!";
?>

<!-- Page title -->
<div class="page-title">
    <div class="container">
        <h2><i class="fa fa-tag color"></i> Order ID: <?php echo MyFormatter::formatOrderID($order->ORDER_ID) ?> <small></small></h2>
        <hr />
    </div>
</div>
<!-- Page title -->

<div class="ordersuccess">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="pull-right">Waktu order: <?php echo MyFormatter::formatTanggalWaktu($order->ORDER_DATE) ?></div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                <table class="table table-striped table-bordered">
                    <tr><th>Nama Pelanggan</th><td><?php echo $order->alamatkirim->pelanggan->NAMA ?></td></tr>
                    <tr><th>Jenis Kelamin</th><td><?php echo MyFormatter::formatKelamin($order->alamatkirim->pelanggan->KELAMIN) ?></td></tr>
                    <tr><th>Alamat Lengkap</th><td><?php echo $order->alamatkirim->ALAMAT ?></td></tr>
                    <tr><th>Kode Pos</th><td><?php echo $order->alamatkirim->KODEPOS ?></td></tr>
                    <tr><th>Kota</th><td><?php echo $order->alamatkirim->kota->KOTA_NAMA ?></td></tr>
                    <tr><th>Provinsi</th><td><?php echo $order->alamatkirim->provinsi->PROVINSI_NAMA ?></td></tr>
                    <tr><th>Email</th><td><?php echo $order->alamatkirim->pelanggan->EMAIL ?></td></tr>
                    <tr><th>No. Handphone</th><td><?php echo $order->alamatkirim->pelanggan->HP ?></td></tr>
                </table>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                <table class="table table-condensed table-striped table-bordered">
                    <?php $nomor = 1 ?>
                    <tr><th>No.</th><th>Nama Barang</th><th>Jumlah satuan</th><th>Harga / satuan</th><th>Subtotal</th></tr>
                    <?php foreach ($order->orderdetail as $detail): ?>
                        <tr>
                            <td><?php echo $nomor++ ?></td>
                            <td><?php echo $detail->harga->barang->BARANG_NAMA ?></td>
                            <td><?php echo $detail->JUMLAH . " " . $detail->harga->satuan->SATUAN_NAMA ?></td>
                            <td><?php echo MyFormatter::formatUang($detail->HARGA_BELI) ?></td>
                            <td><?php echo MyFormatter::formatUang($detail->JUMLAH * $detail->HARGA_BELI) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <th colspan="4" class="font3 text-center">Total</th>
                        <td class="font3 text-center"><?php echo $order->getTotal() ?></td>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-center">Jasa Ekspedisi - &nbsp;<i><?php echo $order->ekspedisi->EKSPEDISI_NAMA ?></i></th>
                        <td class="text-center"><i><?php echo $order->getBiayaKirim() ?></i></td>
                    </tr>
                    <tr class="success">
                        <th colspan="4" class="lead text-center">Grand Total</th>
                        <td class="lead text-center"><?php echo $order->getGrandTotal() ?></td>
                    </tr>
                </table>
                
                <div class="text-danger">
                    <ul class="fa-ul">
                        <?php if(!isset($order->BIAYA_KIRIM)): ?>
                        <li><i class="fa-li fa fa-exclamation-triangle"></i>Biaya pengiriman akan ditentukan secepatnya.
                        Kami sarankan untuk menunggu sampai informasi biaya pengiriman muncul sebelum melakukan transfer.</li>
                        <?php endif ?>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <blockquote>
                    <p>Simpan nomor Order ID untuk keperluan komunikasi lebih lanjut mengenai order Anda.</p>
                    <small>Segera hubungi admin atau operator kami apabila terjadi kesalahan.</small>
                    <small>Halaman ini bersifat temporer. Untuk selanjutnya, cek order Anda <?php echo CHtml::link('disini', array('/cek-pemesanan')) ?></small>
                    <!--<small>Baca <?php echo CHtml::link('Syarat dan ketentuan pelanggan', array('/syarat'))  ?>. Penting!</small>-->
                </blockquote>
            </div>
        </div>
    </div>
</div>