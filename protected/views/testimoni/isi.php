<?php
$this->pageTitle = 'Isi testimoni';
$this->breadcrumbs = array(
    'Testimoni' => array('/testimoni'),
    'Isi',
);
?>

<div class="testimoni blocky">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-2">
                <div class="cool-block">
                    <div class="cool-block-bor form">
                        <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'testimoni-form',
                            'enableAjaxValidation' => false,
                            'enableClientValidation' => true,
                            'clientOptions' => array(
                            	'validateOnChange' => false,
                            	'validateOnSubmit' => true,
                            ),
                            'htmlOptions' => array(
                                'role' => 'form',
                                'class' => 'form-horizontal'
                            )
                        ));
                        ?>
                        <h3 class="text-center"><i class="fa fa-comments color"></i> Testimoni pelanggan</h3><hr class="inner-separator">
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 col-lg-offset-1 col-md-offset-1">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                    <?php
                                    echo $form->textField($testimoni, 'ORDER_ID', array(
                                        'class' => 'form-control input-sm tip order-id',
                                        'data-title' => 'Order ID dari pemesanan barang sebelumnya',
                                        'placeholder' => 'Order ID',
                                        'size' => 25, 'maxlength' => 25,
                                    ))
                                    ?>
                                </div>
                                <?php echo $form->error($testimoni, 'ORDER_ID') ?>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon text-danger"><i class="fa fa-user"></i></span>
                                    <?php
                                    echo $form->textField($testimoni, 'TESTIMONI_NAMA', array(
                                        'class' => 'form-control input-sm tip order-id',
                                        'data-title' => 'Nama Anda',
                                        'placeholder' => 'Nama Anda',
                                        'size' => 25, 'maxlength' => 25,
                                    ))
                                    ?>
                                </div>
                                <?php echo $form->error($testimoni, 'TESTIMONI_NAMA') ?>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 col-lg-offset-1 col-md-offset-1">
                                <div class="input-group">
                                    <span class="input-group-addon text-danger"><i class="fa fa-comments"></i></span>
                                    <?php
                                    echo $form->textArea($testimoni, 'TESTIMONI', array(
                                        'class' => 'form-control input-sm',
                                        'placeholder' => 'Testimoni',
                                        'rows' => 3, 'cols' => 50,
                                    ))
                                    ?>
                                </div>
                                <?php echo $form->error($testimoni, 'TESTIMONI') ?>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 col-lg-offset-1 col-md-offset-1">
                                <?php echo CHtml::htmlButton('<i class="fa fa-sign-in"></i> Kirim', array('class' => 'btn btn-lg btn-primary btn-block', 'type' => 'submit')) ?>
                                <br>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                                <?php echo CHtml::htmlButton('<i class="fa fa-refresh"></i> Ulangi', array('class' => 'btn btn-lg btn-danger btn-block', 'type' => 'reset')) ?>
                            </div>
                        </div>
                        
                        <?php $this->endWidget(); ?>
                        
                    </div><!-- form -->
                </div>
            </div>
        </div>

        <hr class="colorgraph">
    </div>
</div>
<script type="text/javascript">
//    var root = "<?php echo Yii::app()->createUrl('/') ?>";
//
//    function cekorderid(objek) {
//        var val = ($(objek).val()).replace('-','');
//        $.ajax({
//            type: 'POST',
//            data: 'orderid=' + val + '&<?php echo Yii::app()->request->csrfTokenName . '=' . Yii::app()->request->csrfToken ?>',
//            url: root + '/testimoni/validasi',
//            beforeSend: function() {
//                $(objek).siblings('.input-group-addon').find('i').removeClass('fa-tag').addClass('fa-refresh fa-spin');
//            },
//            success: function(data) {
//                if (data) {
//                    $('button[type="submit"]').removeAttr('disabled');
//                    $('.innerflash').html('<div class="alert alert-sm alert-success"><i class="fa fa-check"></i> Order ID valid</div>');
//                }
//                else {
//                    $('button[type="submit"]').attr('disabled', true);
//                    $('.innerflash').html('<div class="alert alert-sm alert-danger"><i class="fa fa-ban"></i> Order ID invalid!</div>');
//                }
//            },
//            complete: function() {
//                $(objek).siblings('.input-group-addon').find('i').removeClass('fa-refresh fa-spin').addClass('fa-tag');
//            }
//        });
//    }
    
</script>