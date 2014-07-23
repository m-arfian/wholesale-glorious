<style type="text/css">
    @media print {
        body{
            background: white !important;
        }
        .side-border{
            border: 1px solid #333;
            padding: 15px;
        }
        .centered{
            text-align: center !important;
        }
        .small-font{
            font-size: 10px;
        }
        hr{
            margin: 5px 0px 0px 0px;
            padding: 0px;
        }
        table.border-bottom td{
            border-top: 1px solid #ccc;
        }
        .petunjuk{
            margin-top: 20px;
            font-size: 10px;
        }
    }
</style>
<div class="side-border">
    <table width="100%">
        <tr>
            <td width="10%">
                <img src="<?php echo Yii::app()->baseUrl ?>/images/toko/jayagrosir.net logo_small.png" height="40px">
            </td>
            <td halign="right">
                <h4>Belanja grosir lengkap, murah, dan cepat</h4>
                <p><small>http://www.jayagrosir.net</small></p>
            </td>
        </tr>
    </table>
    <hr>
    <h4>Nota pemesanan barang</h4>
    <table width="100%">
        <tr>
            <td valign="top">Order ID</td>
            <td valign="top">:</td>
            <td valign="top"><?php echo MyFormatter::formatOrderID($order->ORDER_ID) ?></td>
        </tr>
        <tr>
            <td width="150px">Nama pemesan</td>
            <td width="15px">:</td>
            <td>
                <?php echo $order->alamatkirim->pelanggan->KELAMIN == 'L' ? 'Sdr./Bpk. ' : 'Sdri./Ibu. ' ?>
                <?php echo $order->alamatkirim->pelanggan->NAMA ?>
            </td>
        </tr>
        <tr>
            <td valign="top">Kontak</td>
            <td valign="top">:</td>
            <td valign="top"><?php echo $order->alamatkirim->pelanggan->HP . ' - ' . $order->alamatkirim->pelanggan->EMAIL ?></td>
        </tr>
        <tr>
            <td valign="top">Alamat pengiriman</td>
            <td valign="top">:</td>
            <td valign="top"><?php echo $order->alamatkirim->ALAMAT ?></td>
        </tr>
        <tr>
            <td valign="top">Kota</td>
            <td valign="top">:</td>
            <td valign="top"><?php echo Kota::KabOrKota($order->alamatkirim->KOTA_ID) . ', ' . $order->alamatkirim->KODEPOS ?></td>
        </tr>
        <tr>
            <td valign="top">Provinsi</td>
            <td valign="top">:</td>
            <td valign="top"><?php echo $order->alamatkirim->provinsi->PROVINSI_NAMA ?></td>
        </tr>
    </table>
</div>
<div class="side-border">
    <table width="100%" class="border-bottom">
        <?php $no = 1 ?>
        <tr><th>No</th><th>Nama barang</th><th>Harga per satuan</th><th>Jumlah</th><th>Subtotal</th></tr>
        <?php foreach ($order->orderdetail as $detail): ?>
        <tr>
            <td valign="top"><?php echo $no++ ?></td>
            <td valign="top"><?php echo $detail->harga->barang->BARANG_NAMA ?></td>
            <td valign="top"><?php echo MyFormatter::formatUang($detail->HARGA_BELI) ?></td>
            <td valign="top"><?php echo $detail->JUMLAH.' '.$detail->harga->satuan->SATUAN_NAMA ?></td>
            <td valign="top"><?php echo MyFormatter::formatUang($detail->JUMLAH * $detail->HARGA_BELI) ?></td>
        </tr>
        <?php endforeach ?>
        <tr><td colspan="4" valign="top" class="centered"><strong>Total</strong></td><td><strong><?php echo $order->getTotal() ?></strong></td></tr>
        <tr><td colspan="4" valign="top" class="centered"><strong>Ekspedisi </strong><?php echo $order->ekspedisi->EKSPEDISI_NAMA ?></td>
            <td><strong><?php echo $order->getBiayaKirim() ?></strong></td></tr>
        <tr><td colspan="4" valign="top" class="centered"><h4>Grand Total</h4></td><td><h4><?php echo $order->getGrandTotal() ?></h4></td></tr>
    </table>
    
    <div style="margin-top:10px;margin-bottom:10px;"></div>
    <p class="small-font"><i>Dicetak pada : <?php echo MyFormatter::formatTanggalWaktu(date('Y-m-d H:i:s')); ?></i></p>
</div>
<div class="petunjuk">
    <ul>
        <li><strong>Dilarang memalsukan nota ini.</strong> Akibat karena pemalsuan nota bukan merupakan tanggung jawab jayagrosir.net.</li>
        <li>Lembar ini bisa menjadi bukti pemesanan barang.</li>
    </ul>
</div>