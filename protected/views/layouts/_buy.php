<script type="text/javascript">
    function loading(obj) {
        $(obj).attr('disabled', 'disabled');
        $(obj).html('<i class="fa fa-spinner fa-spin"></i>');
    }
    
    function unloading(obj) {
        $(obj).removeAttr('disabled');
        $(obj).html('<i class="fa fa-shopping-cart"></i>');
    }
    
    $(document).ready(function() {
        var root = "<?php echo Yii::app()->createUrl('/') ?>";
        $('form.buy').submit(function(e) {
            var item = $(this);
            $.ajax({
                type: 'POST',
                data: item.serialize(),
                url: item.attr('action'),
                beforeSend: loading(item.find('.btn[type="submit"]')),
                success: function(data) {
                    if (data)
                        item.find('.itemflash').html('<div class="text-success"><i class="fa fa-check"></i> Barang berhasil ditambahkan</div>');
                    else
                        item.find('.itemflash').html('<div class="text-danger"><i class="fa fa-exclamation-circle"></i> Barang gagal ditambahkan</div>');
                    item.find('.itemflash').show('slow').delay(5000).hide('slow');
                },
                complete: function() {
                    $("#topsum").load(root + '/pelanggan/keranjang/keranjangsum');
                    $("#toptotal").load(root + '/pelanggan/keranjang/keranjangtotal');
                    unloading(item.find('.btn[type="submit"]'));
                }
            });
            
             e.preventDefault();
        });
        
    });
</script>