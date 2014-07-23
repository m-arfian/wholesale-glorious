<?php
$this->pageTitle = "Keranjang";
?>

<div class="row-fluid">
    <div class="span12">
        <div class="panel panel-primary">
            <div class="panel-heading">Keranjang</div>
            <table class="table table-striped table-cart">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0; ?>
                    <?php foreach ($ordertemp as $row): ?>
                        <tr id="<?php echo $row->ORDER_TEMP_ID ?>">
                            <td><?php echo CHtml::link(CHtml::image($row->harga->barang->subgambar[0]->gambar->GAMBAR_NAMA, '', array('width' => '50'))) ?></td>
                            <td><?php echo CHtml::link($row->harga->barang->BARANG_NAMA, array('/katalog/produkdetail', 'id' => $row->harga->BARANG_ID)) ?></td>
                            <td id="cartharga"><?php echo MyFormatter::formatUang(Harga::NormalOrSale($row->HARGA_ID))." / ".$row->harga->satuan->SATUAN_NAMA ?></td>
                            <td id="<?php echo $i ?>"><?php echo CHtml::numberField("jml[$i]", $row->JUMLAH, array('class'=>'input-mini', 'min'=>1)) . " " . CHtml::dropDownList("sat[$i]", $row->harga->SATUAN_ID, Satuan::ListByBarang($row->harga->BARANG_ID), array('class'=>'input-small')) ?>
                                <?php echo CHtml::htmlButton('<i class="icon-ok"></i>', array('class'=>'btn btn-primary btn-mini', 'style'=>'margin-bottom:10px;display:none;', 'id'=>'update_'.$i)) ?></td>
                            <td id="cartsubtotal"><?php echo MyFormatter::formatUang($row->JUMLAH * (Harga::NormalOrSale($row->HARGA_ID))) ?></td>
                            <td><button id="del_<?php echo $row->harga->BARANG_ID ?>" class="btn btn-small btn-danger" data-title="Hapus" data-stack="<?php echo $row->ORDER_TEMP_ID ?>" data-placement="top" rel="tooltip"><i class="icon-trash"></i></button></td>
                            <?php $i++; ?>
                        </tr>
                    <?php endforeach; ?>
                        <tr>
                            <td colspan="4" class="lead"><div class="pull-right">Total</div></td>
                            <td colspan="2" class="lead"><div id="carttotal"><?php echo MyFormatter::formatUang(OrderTemp::CartTotal()) ?></div></td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div><!--end span12-->

</div><!--end row-->

<div class="row-fluid">
    <div class="span8">
        <div>
            <div class="font-bigger3">Catatan:</div>
            <blockquote>Harga total pada tabel keranjang diatas belum termasuk biaya kirim.</blockquote>
        </div>
    </div><!--end span8-->

    <div class="span4">
        <div>
            <?php echo CHtml::link('<i class="icon-reply-all"></i> Kembali belanja', array('/katalog/'), array('class'=>'btn btn-success span6')) ?>
            
            <?php echo CHtml::htmlButton('<i class="icon-truck"></i> Selesai belanja', array(
                //'onclick'=>Yii::app()->createUrl('checkout/'),
                'class'=>'btn btn-primary span6',
                'disabled'=> OrderTemp::CartTotal()==0,
            )) ?>
        </div>
    </div><!--end span4-->
</div>
<script>
    $(document).ready(function() {
        
        $("button[id^='del']").click(function() {
            var row = $(this).parents("tr");
            $.ajax({
                type        : 'POST',
                url         : '<?php echo Yii::app()->createUrl('/pelanggan/keranjang/hapus') ?>',
                data        : 'ordertempid=' + $(this).attr('data-stack'),
                success     : function(data) {
                    row.hide('slow');
                    $("#flashtop > div").html('<div class="alert alert-success fade in font-bigger3"><i class="icon-trash"></i> Barang berhasil dihapus</div>');
                    $("#flashtop > div").show('slow').delay(10000).hide('slow');
                },
                complete    : function() {
                    $("#carttotal").load('<?php echo Yii::app()->createUrl('/pelanggan/keranjang/keranjangtotal') ?>');
                    $("#toptotal").load('<?php echo Yii::app()->createUrl('/pelanggan/keranjang/keranjangtotal') ?>');
                    $("#topsum").load('<?php echo Yii::app()->createUrl('/pelanggan/keranjang/keranjangsum') ?>');
                }
            });
        });
        
        $("td:nth-child(4)").focusin(function(){
            $(this).children("button[id^='update']").fadeIn('slow');
        });
        
        $("td:nth-child(4)").focusout(function(){
            $(this).children("button[id^='update']").fadeOut('slow');
        });
        
        $("button[id^='update']").click(function(){
            var order = $(this).parents("tr").attr("id");
            var sat = $(this).siblings("select").val();
            var jum = $(this).siblings("input").val();
            var row = $(this).parents("tr");
            
            $.ajax({
                type        : 'POST',
                url         : '<?php echo Yii::app()->createUrl('/pelanggan/keranjang/update') ?>',
                data        : 'ordertempid=' + order + '&satuan=' + sat + '&jumlah=' + jum,
                success     : function(data) {
                    var decode = $.parseJSON(data);
                    
                    $("#flashtop > div").html('<div class="alert alert-success fade in font-bigger3"><i class="icon-ok"></i> Barang berhasil dirubah</div>');
                    $("#flashtop > div").show('slow').delay(10000).hide('slow');
                    
                    row.children("#cartharga").load('<?php echo Yii::app()->createUrl('/pelanggan/keranjang/harga/hargaid') ?>'+'/'+decode.harga);
                    row.children("#cartsubtotal").load('<?php echo Yii::app()->createUrl('/pelanggan/keranjang/subtotal/hargaid') ?>'+'/'+decode.harga+'/jumlah/'+decode.jumlah);
                },
                complete    : function() {
                    $("#carttotal").load('<?php echo Yii::app()->createUrl('/pelanggan/keranjang/keranjangtotal') ?>');
                    $("#toptotal").load('<?php echo Yii::app()->createUrl('/pelanggan/keranjang/keranjangtotal') ?>');
                }
            });
        });
    });
</script>