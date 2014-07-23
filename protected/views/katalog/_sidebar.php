<?php $_kategori = Kategori::model()->findAllByAttributes(array('KATEGORI_STATUS'=>Kategori::AKTIF)) ?>
<div class="sidey">
    <ul class="nav">
        <?php foreach ($_kategori as $kat): ?>
        <li>
            <?php echo CHtml::link($kat->KATEGORI_NAMA, '#') ?>
            <ul>
                <?php foreach ($kat->subkategori as $sub): ?>
                <li class="sidebar-child" style="display:none">
                    <?php echo CHtml::link($sub->SUBKATEGORI_NAMA, array('/katalog/subkategori','id'=>Expr::linkForward($sub->SUBKATEGORI_ID, Expr::LINK_SUBKATEGORI))) ?>
                </li>
                <?php endforeach; ?>
            </ul>
        </li>
        <?php endforeach; ?>
    </ul>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('li.sidebar-child').removeAttr('style');
    });
</script>