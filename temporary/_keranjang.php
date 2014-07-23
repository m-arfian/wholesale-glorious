<table class="table table-striped table-bordered table-condensed">
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
        <?php foreach ($ordertemp as $row): ?>
            <tr id="<?php echo $row->ORDER_TEMP_ID ?>">
                <td>
                    <?php echo CHtml::link(CHtml::image($row->harga->barang->subgambar[0]->gambar->GAMBAR_NAMA, '', array('width' => '50'))) ?>
                </td>
                <td>
                    <?php echo CHtml::link($row->harga->barang->BARANG_NAMA, array('/katalog/produkdetail', 'id' => $row->harga->BARANG_ID)) ?>
                </td>
                
                <td id="cartharga">
                    <?php echo MyFormatter::formatUang(Harga::NormalOrSale($row->HARGA_ID)) . " / " . $row->harga->satuan->SATUAN_NAMA ?>
                </td>
                <td>
                    <?php echo CHtml::numberField('jml', $row->JUMLAH, array('class' => 'input-mini', 'min' => 1)) ?>
                    <?php echo CHtml::dropDownList('sat', $row->harga->SATUAN_ID, Satuan::ListByBarang($row->harga->BARANG_ID), array('class' => 'input-small')) ?>
                    <?php echo CHtml::htmlButton('<i class="icon-ok"></i>', array('class' => 'btn btn-primary btn-mini', 'style' => 'margin-bottom:10px;display:none;', 'id' => 'update')) ?></td>
                <td id="cartsubtotal">
                    <?php echo MyFormatter::formatUang($row->JUMLAH * (Harga::NormalOrSale($row->HARGA_ID))) ?>
                </td>
                <td>
                    <button id="del" class="btn btn-small btn-danger" data-title="Hapus" data-stack="<?php echo $row->ORDER_TEMP_ID ?>" data-placement="top" rel="tooltip"><i class="icon-trash"></i></button>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="4" class="lead"><div class="pull-right">Total</div></td>
            <td colspan="2" class="lead"><div id="carttotal"><?php echo MyFormatter::formatUang(OrderTemp::CartTotal()) ?></div></td>
        </tr>
    </tbody>
</table>