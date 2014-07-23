<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/custom/paper.css'); ?>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <div class="lead"><i class="fa fa-tag"></i> Order ID: <?php echo MyFormatter::formatOrderID($data->ORDER_ID); ?></div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <dl class="dl-horizontal">
            <dt>Tanggal order</dt>
            <dd><?php echo MyFormatter::formatTanggal($data->ORDER_DATE) ?></dd>
            <dt>Nomor Resi Ekspedisi</dt>
            <dd><?php echo $data->NO_RESI ?></dd>
        </dl>
    </div>
</div>
<div class="sep"></div>
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <?php $nomor = 1 ?>
        <table class="table table-condensed table-bordered table-hover">
            <tr><th>No.</th><th>Nama Barang</th><th>Jumlah</th><th>Harga per satuan</th><th>Subtotal</th></tr>
            <?php foreach ($data->orderdetail as $detail): ?>
                <tr>
                    <td><?php echo $nomor++; ?></td><td><?php echo $detail->harga->barang->BARANG_NAMA ?></td>
                    <td><?php echo $detail->JUMLAH . " " . $detail->harga->satuan->SATUAN_NAMA ?></td>
                    <td><?php echo MyFormatter::formatUang($detail->HARGA_BELI) ?></td>
                    <td><?php echo MyFormatter::formatUang($detail->JUMLAH * $detail->HARGA_BELI) ?></td>
                </tr>
            <?php endforeach; ?>
            <tr class="font4">
                <td colspan="4" class="text-center">Total</td>
                <td class="text-center"><?php echo $data->getTotal() ?></td>
            </tr>
        </table>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <table class="table">
            <tr>
                <th>Ekspedisi</th>
                <td class="text-center text-danger"><?php echo $data->ekspedisi->EKSPEDISI_NAMA ?></td>
            </tr>
            <tr>
                <th>Biaya kirim</th>
                <td class="text-center text-danger"><?php echo $data->getBiayaKirim() ?></td>
            </tr>
            <tr class="font7">
                <th>Grand total</th>
                <td class="text-center text-success"><?php echo $data->getGrandTotal() ?></td>
            </tr>
        </table>
    </div>
</div>
<?php if(!isset($data->BIAYA_KIRIM)): ?>
<blockquote>
    <small class="text-danger">Mohon tunggu paling lambat hingga 1x24 jam dari sekarang untuk memperoleh Total Biaya karena biaya kirim masih belum ditentukan.</small>
    <small class="text-info">Informasi mengenai Total Biaya akan kami sampaikan melalui halaman ini, email dan sms ke nomor Anda.</small>
</blockquote>
<?php endif ?>
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
        <dl>
            <dt>Dikirim ke alamat</dt>
            <dd><div class="font-bigger2"><?php echo $data->alamatkirim->ALAMAT . '<br>' . Kota::KabOrKota($data->alamatkirim->KOTA_ID) . ' ' . $data->alamatkirim->KODEPOS . ', ' . $data->alamatkirim->provinsi->PROVINSI_NAMA; ?></div></dd>
        </dl>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        <dl>
            <dt>Status Pemesanan</dt>
            <dd><?php echo MyFormatter::formatStatusPesanan($data->ORDER_STATUS_ID) ?></dd>
        </dl>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 col-lg-offset-8 col-md-offset-6">
        <div class="btn-group">
            <?php echo CHtml::link('<i class="fa fa-file-pdf-o"></i> Download nota', array('/cetak/nota', 'kode' => $data->ORDER_ID), array('class' => 'btn btn-sm btn-info')) ?>
            <?php if(empty($data->testimoni)): ?>
                <?php echo CHtml::link('Tinggalkan testimoni', array('/testimoni/isi/', 'o' => $data->ORDER_ID), array('class'=>'btn btn-sm btn-success')) ?>
            <?php endif ?>
        </div>  
    </div>
</div>
<br>