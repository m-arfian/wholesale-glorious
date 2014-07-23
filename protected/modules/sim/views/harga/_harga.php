<tr>
    <td class="th-shrink">
        <?php //echo $form->labelEx($hrg, "[$id]HARGA_PRIORITAS") ?>
        <?php echo $form->numberField($hrg, "[$id]HARGA_PRIORITAS", array('class' => 'input-sm form-control', 'disabled' => $hrg->isNewRecord)); ?>
        <?php echo $form->error($hrg, "[$id]HARGA_PRIORITAS"); ?>
    </td>
    <td>
        <?php //echo $form->labelEx($hrg, "[$id]SATUAN_ID"); ?>
        <?php echo $form->dropDownList($hrg, "[$id]SATUAN_ID", Satuan::ListYetBarang($brg), array(
            'prompt' => '-- Pilih Satuan --',
            'class' => 'input-sm form-control'
        ))
        ?>
        <?php echo $form->error($hrg, "[$id]SATUAN_ID"); ?>
    </td>
    <td class="th-shrink">
        <?php //echo $form->labelEx($hrg, "[$id]HARGA_NORMAL");  ?>
        <div class="input-group">
            <span class="input-group-addon">Rp.</span>
            <?php echo $form->textField($hrg, "[$id]HARGA_NORMAL", array('class' => 'input-sm form-control input-shrink')); ?>
        </div>
        <?php echo $form->error($hrg, "[$id]HARGA_NORMAL"); ?>
    </td>
    <td class="th-shrink">
        <?php //echo $form->labelEx($hrg, "[$id]HARGA_SALE");  ?>
        <div class="input-group">
            <span class="input-group-addon">Rp.</span>
            <?php echo $form->textField($hrg, "[$id]HARGA_SALE", array('class' => 'input-sm form-control input-shrink')); ?>
        </div>
        <?php echo $form->error($hrg, "[$id]HARGA_SALE"); ?>
    </td>
    <td class="th-shrink">
        <?php //echo $form->labelEx($hrg, "[$id]HARGA_PASAR");  ?>
        <div class="input-group">
            <span class="input-group-addon">Rp.</span>
            <?php echo $form->textField($hrg, "[$id]HARGA_PASAR", array('class' => 'input-sm form-control input-shrink')); ?>
        </div>
        <?php echo $form->error($hrg, "[$id]HARGA_PASAR"); ?>
    </td>
    <td></td>
</tr>