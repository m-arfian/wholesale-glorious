<?php

echo CHtml::ajaxButton('<i class="icon-shopping-cart"></i>', Yii::app()->createUrl('/katalog/beli'), array(
    'type' => 'POST',
    'beforeSend' => "function(){
                                alert($(this).attr('data-stack'));
                                alert($(input[name=\"jml[$id]\"]).val());
                                alert($(select[name=\"satuan[$id]\"]).val());
                            }",
    'success' => "function(data){
                                $(\"#flashitem_.$id\").html('<div class=\'font-bigger3\'><i class=\'icon-ok-circle\'></i> Barang berhasil ditambahkan</div>');
                                $(\"#flashitem_$id\").show('slow').delay(7000).hide('slow');
                            }",
    'data' => array(
        'id' => "$(this).attr('data-stack')",
        'jml' => "$(input[name=\"jml[$id]\"]).val()",
        'satuan' => "$(select[name=\"satuan[$id]\"]).val()"
    )
        ), array(//htmlOptions
    'class' => 'btn btn-primary btn-small',
    'data-title' => '+Pesan barang ini',
    'data-placement' => 'top',
    'data-stack' => "$id",
    'rel' => 'tooltip',
    'id' => 'beli',
        )
);
?>