<div class="well well-white">
    <div class="row-fluid">
        <div class="span6"><div class="lead"><i class="icon-tag"></i> Order #<?php echo MyFormatter::formatAddDash($data->ORDER_ID); ?></div></div>
        <div class="span6">
            <dl class="dl-horizontal">
                <dt>Tanggal order</dt>
                <dd><?php echo MyFormatter::formatDateFormat($data->ORDER_DATE) ?></dd>
                <dt>Nomor Resi</dt>
                <dd><?php echo $data->NO_RESI ?></dd>
            </dl>
        </div>
    </div>
    <div class="row-fluid">
        <?php if(is_null($data->BIAYA_KIRIM) || empty($data->BIAYA_KIRIM))
            echo MyFormatter::alertWarning('Biaya Kirim masih belum ditentukan, disarankan untuk menunggu hingga biaya kirim sudah ditentukan sebelum Anda mulai melakukan transaksi/transfer.<br>Pemberitahuan akan disampaikan melalui halaman ini, Nomor HP dan Email Anda')
        ?>
    </div>
    <div class="row-fluid">
        <div class="span12 ticket">
            <table class="table table-condensed table-striped">
                <?php $nomor = 1; $grandtotal = 0; ?>
                <tr><th>No.</th><th>Nama Barang</th><th>Jumlah</th><th>Harga per satuan</th><th>Subtotal</th></tr>
                <?php foreach ($data->orderdetail as $detail): ?>
                    <tr><td><?php echo $nomor++; ?></td><td><?php echo $detail->harga->barang->BARANG_NAMA ?></td>
                        <td><?php echo $detail->JUMLAH . " " . $detail->harga->satuan->SATUAN_NAMA ?></td>
                        <td><?php echo MyFormatter::formatUang($detail->HARGA_BELI) ?></td>
                        <td><?php echo MyFormatter::formatUang(($total = $detail->JUMLAH * $detail->HARGA_BELI)) ?></td>
                    </tr>
                    <?php $grandtotal+=$total; ?>
                <?php endforeach; ?>
                <tr><th colspan="3"><?php echo "Jasa Ekspedisi: &nbsp;"; echo $data->EKSPEDISI_ID == 1 ? '<i>Belum ditentukan</i>' : $data->ekspedisi->EKSPEDISI_NAMA; ?></th>
                    <td>Biaya kirim &nbsp;<i class="icon-arrow-right"></i></td><td><?php echo (is_null($data->BIAYA_KIRIM) || empty($data->BIAYA_KIRIM)) ? '<i>Belum ditentukan</i>' : MyFormatter::formatUang($data->BIAYA_KIRIM) ?></td>
                </tr>
                <tr><th colspan="4" class="lead labels total">Total</th><td class="label label-success block"><span class="lead"><?php echo MyFormatter::formatUang($grandtotal + $data->BIAYA_KIRIM) ?></span></td></tr>
            </table>
        </div>
    </div>
    <div class="row-fluid ticket-status">
        <div class="span8">
            <dl>
                <dt>Dikirim ke alamat</dt>
                <dd><div class="font-bigger2"><?php echo $data->alamat->ALAMAT . '<br>' . Kota::KabOrKota($data->alamat->KOTA_ID) . ' ' . $data->alamat->KODEPOS . ', ' . $data->alamat->provinsi->PROVINSI_NAMA; ?></div></dd>
            </dl>
        </div>
        <div class="span4">
            <dl>
                <dt>Status Pemesanan</dt>
                <dd><?php echo MyFormatter::formatStatusPesanan($data->ORDER_STATUS_ID) ?></dd>
            </dl>
        </div>
    </div>
</div>
<br>