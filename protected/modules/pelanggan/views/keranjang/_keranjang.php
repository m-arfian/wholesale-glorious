<?php $barang = 0 ?>
<?php $condition = (OrderTemp::CartSum() == 0) ?>

<?php if (!$condition): ?>
<table class="table table-striped table-bordered table-condensed">
    <thead>
        <tr>
            <th>Gambar</th>
            <th>Nama Barang</th>
            <th>Detail</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($ordertemp as $row): ?>
            <?php if ($barang == $row->harga->BARANG_ID): continue; ?>
            <?php else: ?>
                <tr id="<?php echo $row->ORDER_TEMP_ID ?>">
                    <td>
                        <?php
                        echo CHtml::link(CHtml::image($row->harga->barang->subgambar[0]->gambaricon->GAMBAR_NAMA), $row->harga->barang->subgambar[0]->gambarlarge->GAMBAR_NAMA, array(
                            'class' => 'fancy', 'title' => $row->harga->barang->subgambar[0]->SUB_TITLE))
                        ?>
                    </td>
                    <td>
                        <?php echo CHtml::link($row->harga->barang->BARANG_NAMA, array('/katalog/detail', 'id' => Expr::linkForward($row->harga->BARANG_ID, Expr::LINK_BARANG))) ?>
                    </td>
                    <td>
                        <table class="table">
                            <tr><th>Harga</th><th>Jumlah</th><th>Subtotal</th><th></th></tr>
                            <?php foreach (OrderTemp::SplitItem($row->harga->BARANG_ID) as $item): ?>
                                <tr id="<?php echo $item->ORDER_TEMP_ID ?>">
                                    <td>
                                        <?php echo MyFormatter::formatUang(Harga::NormalOrSale($item->HARGA_ID)) . ' / ' . $item->harga->satuan->SATUAN_NAMA ?>
                                    </td>
                                    <td>
                                        <?php echo CHtml::beginForm(array('/pelanggan/keranjang/update'), 'post', array('class' => 'form-inline update')); ?>
                                            <div class="input-group">
                                                <?php echo CHtml::hiddenField('ordertempid', $item->ORDER_TEMP_ID) ?>
                                                <?php echo CHtml::numberField('jumlah', $item->JUMLAH, array('class' => 'form-control input-sm', 'min' => 1)) ?>
                                                <div class="input-group">
                                                    <?php echo CHtml::dropDownList('satuan', $item->harga->SATUAN_ID, Satuan::ListByBarang($item->harga->BARANG_ID), array('class' => 'form-control input-sm')) ?>
                                                    <span class="input-group-btn">
                                                        <?php echo CHtml::htmlButton('<i class="fa fa-check"></i>', array(
                                                            'class' => 'btn btn-success btn-sm',
                                                            'type' => 'submit'
                                                        )) ?>
                                                    </span>
                                                </div>
                                            </div>
                                        <?php echo CHtml::endForm() ?>
                                    </td>
                                    <td>
                                        <?php echo MyFormatter::formatUang($item->JUMLAH * (Harga::NormalOrSale($item->HARGA_ID))) ?>
                                    </td>
                                    <td>
                                        <?php echo CHtml::htmlButton('<i class="fa fa-trash-o"></i>', array(
                                            'class' => 'btn btn-sm btn-danger delete tip',
                                            'data-title' => 'Hapus',
                                            'order' => $item->ORDER_TEMP_ID,
                                            'token' => Yii::app()->request->csrfTokenName .';'. Yii::app()->request->csrfToken 
                                        )) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </td>
                </tr>
                <?php $barang = $row->harga->BARANG_ID ?>
            <?php endif; ?>
        <?php endforeach; ?>
        <tr>
            <td colspan="3" class="lead"><div class="pull-right">Total <span id="carttotal"><?php echo MyFormatter::formatUang(OrderTemp::CartTotal()) ?></div></span></td>
        </tr>
    </tbody>
</table>
<?php else: ?>
<div class="alert alert-danger">Belum ada barang di keranjang</div>
<?php endif ?>

<div class="row">
    <div class="col-md-6 col-sm-8 col-xs-8">
        <div class="font3">Catatan:</div>
        <blockquote><small>Harga total pada tabel keranjang belum termasuk biaya kirim.</small></blockquote>
    </div>
    <div class="col-md-6 col-sm-4 col-xs-4">
        <div class="cart-btn-fin">
            <div class="row">
                <?php echo CHtml::link('<i class="fa fa-reply-all"></i> Kembali belanja', array('/katalog/'), array(
                    'class' => 'btn btn-warning col-md-4 col-sm-12 col-xs-12 col-md-offset-1'
                )) ?>
                <?php echo CHtml::link('<i class="fa fa-truck"></i> Selesai belanja', array('/pelanggan/checkout'), array(
                    'class' => 'btn btn-primary col-md-4 col-sm-12 col-xs-12 col-md-offset-1 tip',
                    'disabled' => $condition,
                    'style' => $condition ? 'cursor:not-allowed' : 'cursor:pointer',
                    'data-title' => $condition ? 'Anda harus memesan minimal satu barang terlebih dahulu' : 'Pengiriman barang',
                )) ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function loading(obj) {
        $(obj).attr('disabled', 'disabled');
        $(obj).html('<i class="fa fa-spinner fa-spin"></i>');
    }
    
    $(document).ready(function() {
        var root = "<?php echo Yii::app()->createUrl('/') ?>";

        $("button.delete").click(function() {
            var conf = confirm('Apa Anda yakin untuk menghapus barang ini dari keranjang?');
            if(conf) {
                var token = $(this).attr('token').split(';');
                $.ajax({
                    type: 'POST',
                    url: root + '/pelanggan/keranjang/hapus',
                    data: 'ordertempid=' + $(this).attr('order') + '&' + token[0] + '=' + token[1],
                    beforeSend: loading($(this)),
                    success: function(data) {
                        $("#flashtop > div").html('<div class="alert alert-success fade in font3"><i class="fa fa-trash-o"></i> Barang berhasil dihapus</div>');
                        $("#flashtop > div").show('slow').delay(5000).hide('slow');
                    },
                    complete: function() {
                        $.get(root + '/pelanggan/keranjang/partial', function(cart) {
                            $("#cart_container").html(cart);
                        });
                        $("#toptotal").load(root + '/pelanggan/keranjang/keranjangtotal');
                        $("#topsum").load(root + '/pelanggan/keranjang/keranjangsum');
                    }
                });
            }
        });

        $("form.update").submit(function(e) {
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                beforeSend: loading($(this).find('.btn')),
                success: function(data) {
                    $("#flashtop > div").html('<div class="alert alert-success fade in font3"><i class="fa fa-check"></i> Keranjang berhasil dirubah</div>');
                    $("#flashtop > div").show('slow').delay(5000).hide('slow');
                },
                complete: function() {
                    $.get(root + '/pelanggan/keranjang/partial', function(cart) {
                        $("#cart_container").html(cart);
                    });
                    $("#toptotal").load(root + '/pelanggan/keranjang/keranjangtotal');
                }
            });
            
            e.preventDefault();
        });
    });
</script>