<?php
$this->pageTitle = 'FAQ';
$this->breadcrumbs = array(
    'FAQ',
);
?>

<!-- Page title -->
<div class="page-title">
    <div class="container">
        <h2><i class="fa fa-question-circle color"></i> Frequently Asked Question <small>(Pertanyaan yang sering diajukan)</small></h2>
        <hr>
    </div>
</div>
<!-- Page title -->

<div class="faq">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h3 class="text-center">Umum dan Pemesanan</h3><hr class="inner-separator">
                <div class="panel-group" id="faq_umum">
                    <?php foreach ($UMUM as $umum): ?>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <?php echo CHtml::link($umum->FAQ_TANYA, "#$umum->FAQ_ID", array(
                                    'class' => 'accordion-toggle',
                                    'data-toggle' => 'collapse',
                                    'data-parent' => '#faq_umum',
                                )) ?>
                            </h4>
                        </div>
                        <div id="<?php echo $umum->FAQ_ID ?>" class="panel-collapse collapse" style="height: auto;">
                            <div class="panel-body">
                                <?php echo $umum->FAQ_JAWAB ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
                
                <h3 class="text-center">Pembayaran</h3><hr class="inner-separator">
                <div class="panel-group" id="faq_bayar">
                    <?php foreach ($PEMBAYARAN as $bayar): ?>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <?php echo CHtml::link($bayar->FAQ_TANYA, "#$bayar->FAQ_ID", array(
                                    'class' => 'accordion-toggle',
                                    'data-toggle' => 'collapse',
                                    'data-parent' => '#faq_bayar'
                                )) ?>
                            </h4>
                        </div>
                        <div id="<?php echo $bayar->FAQ_ID ?>" class="panel-collapse collapse" style="height: auto;">
                            <div class="panel-body">
                                <?php echo $bayar->FAQ_JAWAB ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
        <hr class="colorgraph">
    </div>
</div>