<?php
$this->pageTitle = "Checkout";
$this->breadcrumbs = array(
    'Pelanggan' => array('/pelanggan'),
    'Checkout'
);
?>

<!-- Page title -->
<div class="page-title">
    <div class="container">
        <h2><i class="fa fa-truck color"></i> Checkout <small></small></h2>
        <hr />
    </div>
</div>
<!-- Page title -->

<!-- Page content -->
<div class="checkout">
    <div class="container">
        <?php if (!WebUser::isPelanggan()): ?>
            <div class="panel panel-info">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                            <p class="text-center text-danger font5">Dapatkan keuntungan lebih dengan mendaftar sebagai pelanggan kami</p><br/>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                <ul class="fa-ul">
                                    <li><i class="fa-li fa fa-check-square-o"></i>Proses belanja lebih cepat</li>
                                    <li><i class="fa-li fa fa-check-square-o"></i>Pengelolaan pemesanan dan keuangan Anda</li>
                                    <li>
                                        <i class="fa-li fa fa-check-square-o"></i>Pemesanan periodik secara otomatis <span class="label label-warning">Coming soon</span>
                                        <?php echo CHtml::htmlButton('<i class="fa fa-question"></i>', array(
                                            'class' => 'btn btn-danger btn-focus btn-xs pop',
                                            'title' => 'Pemesanan Periodik',
                                            'data-content' => 'Pemesanan periodik merupakan fitur pelanggan yang bisa melakukan pemesanan secara otomatis dan terjadwal. Fitur ini akan sangat berguna apabila Anda ingin pengiriman barang tertentu secara berkala.',
                                        )) ?>
                                    </li>
                                    <li><i class="fa-li fa fa-check-square-o"></i>Berkesempatan mendapatkan potongan harga</li>
                                    <li><i class="fa-li fa fa-check-square-o"></i>Beserta keuntungan-keuntungan yang lain</li>
                                </ul>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 hidden-xs">
                                <?php //echo CHtml::image() ?>
                            </div>
                            <?php //echo CHtml::linkButton('<i class="fa fa-signin"></i> Daftar Sekarang', array('class' => 'btn btn-warning btn-sm font3')) ?>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <h3>Punya akun? Masuk disini.</h3>
                            <div class="form">
                                <?php
                                $form = $this->beginWidget('CActiveForm', array(
                                    'id' => 'login-pelanggan',
                                    'enableAjaxValidation' => false,
                                    'enableClientValidation' => true,
                                    'clientOptions' => array(
                                        'validateOnSubmit' => true,
                                        'validateOnChange' => false
                                    ),
                                    'htmlOptions' => array(
                                        'role' => 'form',
                                    )
                                ));
                                ?>

                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <?php echo $form->textField($loginform, 'username', array('class' => 'form-control input-lg', 'placeholder' => 'Username')) ?>
                                </div>
                                <?php echo $form->error($loginform, 'username') ?>
                                
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <?php echo $form->passwordField($loginform, 'password', array('class' => 'form-control input-lg', 'placeholder' => 'Password')) ?>
                                </div>
                                <?php echo $form->error($loginform, 'password') ?>

                                <div class="form-group">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs6">
                                        <div class="checkbox">
                                            <label>
                                                <?php echo $form->checkBox($loginform, 'rememberMe'); ?>
                                                <?php echo $form->label($loginform, 'rememberMe'); ?>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs6">
                                        <?php echo CHtml::submitButton('Masuk', array('class' => 'btn btn-primary btn-sm')); ?>
                                    </div>
                                </div>

                                <?php $this->endWidget(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="form">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'pengiriman-form',
                'enableClientValidation' => true,
                'enableAjaxValidation' => false,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'validateOnChange' => false
                ),
                'htmlOptions' => array(
                    'class' => 'form-horizontal',
                ))) ?>
            
            <?php if (WebUser::isPelanggan()): ?>
            <div class="row">
                <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-3">
                    <div class="form-group">
                        <?php echo CHtml::label('Pilih alamat: ', 'list_alamat', array('class' => 'col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label')); ?>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <div class="input-group">
                                <?php echo CHtml::dropDownList('list_alamat', '', AlamatPengiriman::ListByPelanggan(Yii::app()->user->getState('pelanggan')), array(
                                    'ajax' => array(
                                        'type' => 'POST',
                                        'dataType' => 'json',
                                        'url' => array('ubahalamat'),
                                        'data' => array('list_alamat' => 'js:this.value', Yii::app()->request->csrfTokenName => Yii::app()->request->csrfToken),
                                        'beforeSend' => 'function() {
                                            $("#refresh").show();
                                        }',
                                        'success' => 'function(data) {
                                            $("#AlamatPengiriman_ALAMAT").val(data.ALAMAT);
                                            $("#AlamatPengiriman_KODEPOS").val(data.KODEPOS);
                                            $("#AlamatPengiriman_PROVINSI_ID").val(data.PROVINSI_ID);
                                            $("#AlamatPengiriman_KOTA_ID").append($("<option>", {
                                                value: data.KOTA_ID,
                                                text: data.KOTA_NAMA,
                                            }));
                                            $("#AlamatPengiriman_KOTA_ID").val(data.KOTA_ID);
                                        }',
                                        'complete' => 'function() {
                                            $("#refresh").hide();
                                        }'
                                    ),
                                    'data-title' => 'Pilih alamat yang telah tersimpan pada akun Anda',
                                    'data-placement' => 'right',
                                    'rel' => 'tooltip',
                                    'class' => 'form-control',
                                ));
                                ?>
                                <span class="input-group-addon addon-nobg"><i id="refresh" class="fa fa-refresh fa-spin" style="display:none"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div><hr>
            <?php endif; ?>
            
            <h4>Detail Pengiriman & Alamat</h4><br />
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 col-lg-offset-1 col-md-offset-1">
                    <div class="form-group">
                        <?php echo $form->labelEx($order, 'EKSPEDISI_ID', array('class' => 'col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label')) ?>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <?php echo $form->error($order, 'EKSPEDISI_ID'); ?>
                            <?php
                            echo $form->dropDownList($order, 'EKSPEDISI_ID', Ekspedisi::ListKonvensional(), array(
                                'prompt' => '-- Pilih Ekspedisi --',
                                'class' => 'form-control',
                                'disabled' => $order->EKSPEDISI_ID == Ekspedisi::EKSP_NON_KONV,
                            )) ?>
                            <div class="compactRadioGroup" style="margin-top:5px">
                                <?php echo CHtml::checkBox('EKSP_NON_KONV', $order->EKSPEDISI_ID == Ekspedisi::EKSP_NON_KONV, array('id' => 'EKSP_NON_KONV', 'value' => '2', 'onchange' => 'ekspedisi(this)')) ?>
                                <?php echo CHtml::label('Ekspedisi Non-konvensional', 'EKSP_NON_KONV') ?>
                            </div>
                            <?php echo CHtml::link('Ketahui bedanya disini', array('bedaekspedisi'), array('class' => 'fancy')) ?>
                            <blockquote class="text-warning" style="margin-top:10px"><small>Catatan: Abaikan pilihan ekspedisi apabila Anda ingin mengambil barang secara langsung.</small></blockquote>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <?php echo $form->labelEx($alamat, 'ALAMAT', array('class' => 'col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label')); ?>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <?php echo $form->textArea($alamat, 'ALAMAT', array('class' => 'form-control userdata', 'rows' => '3')); ?>
                            <?php echo $form->error($alamat, 'ALAMAT'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($alamat, 'KODEPOS', array('class' => 'col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label')); ?>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <?php echo $form->textField($alamat, 'KODEPOS', array('class' => 'form-control userdata')); ?>
                            <?php echo $form->error($alamat, 'KODEPOS'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($alamat, 'PROVINSI_ID', array('class' => 'col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label')); ?>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <?php
                            echo $form->dropDownList($alamat, 'PROVINSI_ID', Provinsi::ListAll(), array(
                                'prompt' => '-- Pilih Provinsi --',
                                'class' => 'form-control userdata',
                                'ajax' => array(
                                    'type' => 'POST',
                                    'url' => array('ubahkota'),
                                    'update' => '#AlamatPengiriman_KOTA_ID',
                                ),
                            ))
                            ?>
                            <?php echo $form->error($alamat, 'PROVINSI_ID'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($alamat, 'KOTA_ID', array('class' => 'col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label')) ?>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <?php echo $form->dropDownList($alamat, 'KOTA_ID', $kota, array(
                                'prompt' => isset($alamat->PROVINSI_ID) ? '-- Pilih kota --' : '-- Pilih Provinsi terlebih dulu --' ,
                                'class' => 'form-control userdata'
                            )) ?>
                            <?php echo $form->error($alamat, 'KOTA_ID') ?>
                        </div>
                    </div>
                </div>
            </div>

            <h4>Detail Pelanggan</h4><br />
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 col-lg-offset-1 col-md-offset-1">
                    <div class="form-group">
                        <?php echo $form->labelEx($pelanggan, 'NAMA', array('class' => 'col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label')); ?>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <?php echo $form->textField($pelanggan, 'NAMA', array('class' => 'form-control userdata')); ?>
                            <?php echo $form->error($pelanggan, 'NAMA'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($pelanggan, 'KELAMIN', array('class' => 'col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label')); ?>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <div class="compactRadioGroup">
                                <?php echo $form->radioButtonList($pelanggan, 'KELAMIN', array('L' => 'Laki-laki', 'P' => 'Perempuan'), array('class' => 'userdata')); ?>
                            </div>
                            <?php echo $form->error($pelanggan, 'KELAMIN'); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <?php echo $form->labelEx($pelanggan, 'EMAIL', array('class' => 'col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label')); ?>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <?php echo $form->emailField($pelanggan, 'EMAIL', array('class' => 'form-control userdata')) ?>
                            <?php echo $form->error($pelanggan, 'EMAIL'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($pelanggan, 'HP', array('class' => 'col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label')); ?>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <?php echo $form->telField($pelanggan, 'HP', array('class' => 'form-control userdata')); ?>
                            <?php echo $form->error($pelanggan, 'HP'); ?>
                        </div>
                    </div>
                </div>
            </div>

            <h4>Punya tips, saran atau pesan mengenai order Anda? Tuliskan pesan Anda disini.</h4><br />
            <div class="row">
                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 col-lg-offset-1 col-md-offset-1">
                    <?php echo $form->labelEx($order, 'ORDER_MSG', array('class' => 'col-lg-2 col-md-2 col-sm-2 col-xs-2 control-label')) ?>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                        <?php
                        echo $form->textArea($order, 'ORDER_MSG', array(
                            'placeholder' => 'Tinggalkan pesan Anda dengan jelas disini agar kami bisa melayani pemesanan Anda dengan lebih baik',
                            'class' => 'form-control smnote',
                            'rows' => '5'
                        ))
                        ?>
                    </div>
                </div>
            </div>

            <h4>Verifikasi</h4><br/>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 col-lg-offset-1 col-md-offset-1">
                    <?php if (CCaptcha::checkRequirements()): ?>
                        <?php echo $form->labelEx($order, 'verifyCode', array('class' => 'col-lg-5 col-md-5 col-sm-4 col-xs-4 control-label')); ?>
                        <div class="col-lg-7 col-md-7 col-sm-8 col-xs-8">
                            <?php $this->widget('CCaptcha'); ?>
                            <?php echo $form->textField($order, 'verifyCode', array('placeholder' => 'Masukkan kode', 'class' => 'form-control')); ?>
                            <?php echo $form->error($order, 'verifyCode'); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
                    <?php echo $form->labelEx($order, 'paktaOrder', array('class' => 'col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label')) ?>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <div class="checkbox">
                            <?php
                            echo $form->checkBoxList($order, 'paktaOrder', array(
                                '1' => '<span>Saya mengerti dan setuju dengan ' . CHtml::link("Syarat dan Persetujuan", array('/syarat'), array('target'=>'_blank')) . ' yang diajukan.</span>',
                            ))
                            ?>
                        </div>
                        <?php echo $form->error($order, 'paktaOrder'); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
                        <br />
                        <?php echo CHtml::htmlButton('<i class="fa fa-check"></i> Pesan sekarang', array(
                            'class' => 'btn btn-warning btn-block',
                            'type' => 'submit',
                            'disabled' => OrderTemp::CartSum() == 0,
                        )) ?>
                    </div>
                </div>
            </div>
            <?php $this->endWidget() ?>
        </div>
        <hr class="colorgraph">
    </div>
</div>

<script type="text/javascript">
    var root = "<?php echo Yii::app()->createUrl('/') ?>";
    
    function ekspedisi(nonkonv) {
        if(nonkonv.checked) {
            $('#Order_EKSPEDISI_ID').val('');
            $('#Order_EKSPEDISI_ID').attr('disabled', 'disabled');
        }
        else
            $('#Order_EKSPEDISI_ID').removeAttr('disabled');  
    }

    $(document).ready(function() {
        <?php if (WebUser::isPelanggan()) echo '$(".userdata").prop("disabled", true);' ?>
    });
</script>