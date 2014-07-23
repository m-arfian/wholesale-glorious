<?php
$this->pageTitle = "Daftar baru";
$this->breadcrumbs = array(
    'Pelanggan' => array('/pelanggan'),
    'Daftar'
);
?>

<!-- Page title -->
<div class="page-title">
    <div class="container">
        <h2><i class="fa fa-users color"></i> Form pendaftaran anggota baru <small></small></h2>
        <hr>
    </div>
</div>
<!-- Page title -->

<div class="blocky">
    <div class="container">
        <div class="form">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'daftar-form',
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'validateOnChange' => true,
                ),
                'htmlOptions' => array(
                    'class' => 'form-horizontal',
                    'enctype' => 'multipart/form-data',
                ),
            ));
            ?>
            <div class="row">

                <?php // echo $form->errorSummary($registered) ?>
                <?php // echo $form->errorSummary($pelanggan) ?>
                <?php // echo $form->errorSummary($alamat) ?>
                
                <p class="note">Isian dengan tanda <span class="required">*</span> wajib diisi.</p>
                
                <div class="col-lg-6 col-sm-6 col-xs-12 pull-left">
                    <div class="register-login">
                        <div class="cool-block">
                            <div class="cool-block-bor">
                                <h3>Data Akun</h3>
                                <div class="form-group">
                                    <?php echo $form->labelEx($registered, 'USERNAME', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                        <?php echo $form->textField($registered, 'USERNAME', array('class' => 'form-control', 'onchange' => 'cekusername(this.value)')); ?>
                                        <span id="cekusername" class="badge badge-warning" style="display:none">Mengecek username...</span>
                                        <?php echo $form->error($registered, 'USERNAME'); ?>
                                        <div class="row" id="usernamenotif" style="display:none"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php echo $form->labelEx($registered, 'PASS', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                        <?php echo $form->passwordField($registered, 'PASS', array('class' => 'form-control')); ?>
                                        <?php echo $form->error($registered, 'PASS'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php echo $form->labelEx($registered, 'REPEATPASS', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                        <?php echo $form->passwordField($registered, 'REPEATPASS', array('class' => 'form-control')); ?>
                                        <?php echo $form->error($registered, 'REPEATPASS'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 col-sm-6 col-xs-12 pull-right">
                    <div class="register-login">
                        <div class="cool-block">
                            <div class="cool-block-bor">
                                <h3>Data Pribadi</h3>
                                <div class="form-group">
                                    <?php echo $form->labelEx($pelanggan, 'NAMA', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                        <?php echo $form->textField($pelanggan, 'NAMA', array('class' => 'form-control')); ?>
                                        <?php echo $form->error($pelanggan, 'NAMA'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php echo $form->labelEx($pelanggan, 'KELAMIN', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')); ?>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                        <div class="compactRadioGroup">
                                            <?php echo $form->radioButtonList($pelanggan, 'KELAMIN', array('L' => 'Laki-laki', 'P' => 'Perempuan')); ?>
                                        </div>
                                        <?php echo $form->error($pelanggan, 'KELAMIN'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php echo $form->labelEx($pelanggan, 'EMAIL', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5  control-label')); ?>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                        <?php echo $form->emailField($pelanggan, 'EMAIL', array('class' => 'form-control', 'onchange' => 'cekemail(this.value)')); ?>
                                        <span id="cekemail" class="badge badge-warning" style="display:none">Mengecek email...</span>
                                        <?php echo $form->error($pelanggan, 'EMAIL'); ?>
                                        <div class="row" id="emailnotif" style="display:none"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php echo $form->labelEx($pelanggan, 'HP', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5  control-label')); ?>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                        <?php echo $form->telField($pelanggan, 'HP', array('class' => 'form-control')); ?>
                                        <?php echo $form->error($pelanggan, 'HP'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php echo $form->labelEx($gambar, 'GAMBAR_NAMA', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5  control-label')); ?>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                        <?php echo $form->fileField($gambar, 'GAMBAR_NAMA'); ?>
                                        <?php echo $form->error($gambar, 'GAMBAR_NAMA'); ?>
                                    </div>
                                </div>
                                <?php if (CCaptcha::checkRequirements()): ?>
                                    <div class="form-group">
                                        <?php echo $form->labelEx($registered, 'CAPTCHA', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5  control-label')); ?>
                                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                            <?php $this->widget('CCaptcha'); ?>
                                            <?php echo $form->textField($registered, 'CAPTCHA', array('placeholder' => 'Masukkan kode', 'class' => 'form-control')); ?>
                                            <?php echo $form->error($registered, 'CAPTCHA'); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>   
                    </div>
                </div>
                
                <div class="col-lg-6 col-sm-6 col-xs-12 pull-left">
                    <div class="register-login">
                        <div class="cool-block">
                            <div class="cool-block-bor">
                                <h3>Alamat Pribadi</h3>
                                <div class="form-group">
                                    <?php echo $form->labelEx($alamat, 'ALAMAT', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5  control-label')); ?>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                        <?php echo $form->textArea($alamat, 'ALAMAT', array('class' => 'form-control')); ?>
                                        <?php echo $form->error($alamat, 'ALAMAT'); ?>
                                    </div>
                                </div>                             
                                <div class="form-group">
                                    <?php echo $form->labelEx($alamat, 'KODEPOS', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5  control-label')); ?>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                        <?php echo $form->textField($alamat, 'KODEPOS', array('class' => 'form-control')); ?>
                                        <?php echo $form->error($alamat, 'KODEPOS'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php echo $form->labelEx($alamat, 'PROVINSI_ID', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5  control-label')); ?>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                        <?php
                                        echo $form->dropDownList($alamat, 'PROVINSI_ID', Provinsi::ListAll(), array(
                                            'class' => 'form-control',
                                            'prompt' => '-- Pilih Provinsi --',
                                            'ajax' => array(
                                                'type' => 'POST',
                                                'url' => array('ubahkota'),
                                                'update' => '#AlamatPengiriman_KOTA_ID',
                                            ),
                                        ));
                                        ?>
                                        <?php echo $form->error($alamat, 'PROVINSI_ID'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php echo $form->labelEx($alamat, 'KOTA_ID', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5  control-label')); ?>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                        <?php
                                        echo $form->dropDownList($alamat, 'KOTA_ID', $kota, array(
                                            'class' => 'form-control',
                                            'prompt' => '-- Pilih Provinsi terlebih dulu --',
                                        ));
                                        ?>
                                        <?php echo $form->error($alamat, 'KOTA_ID'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><hr/>
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
                    <?php
                    echo CHtml::htmlButton('<i class="fa fa-check"></i> Simpan', array(
                        'class' => 'btn btn-success btn-block',
                        'type' => 'submit',
                    )) ?>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                    <?php
                    echo CHtml::htmlButton('<i class="fa fa-refresh"></i> Ulangi', array(
                        'class' => 'btn btn-danger btn-block',
                        'type' => 'reset',
                    )) ?>
                </div>
            </div>
            <?php $this->endWidget(); ?>
        </div>
        <hr class="colorgraph">
    </div>
</div>

<script type="text/javascript">
	
    function cekusername(value) {
        if($.trim(value) !== '') {
        	if($.trim(value).length > <?php echo Registered::ACCOUNT_MINLENGTH ?> && $.trim(value).length <= <?php echo Registered::ACCOUNT_MAXLENGTH ?>) {
	            $("#cekusername").fadeIn('slow');
	            $.ajax({
	                url: '<?php echo Yii::app()->baseUrl ?>/pelanggan/default/cekusername',
	                type: 'POST',
	                data: 'username=' + value + '&<?php echo Yii::app()->request->csrfTokenName.'='.Yii::app()->request->csrfToken ?>',
	                success: function(data) {
	                    if (data > 0)
	                        $("#usernamenotif").html('<div class="errorMessage"><?php echo Message::_alert('username_exist') ?></div>');
	                    else
	                        $("#usernamenotif").html('<div class="successMessage"><?php echo Message::_alert('username_ok') ?></div>');
	                    
	                    $("#cekusername").fadeOut('fast');
	                    $("#usernamenotif").fadeIn('slow');
	                }
	            });
        	}
        	else
        		$("#usernamenotif").fadeOut('fast');
        }
    }
    
    function cekemail(value) {
        if($.trim(value) !== '') {
            $("#cekemail").fadeIn('slow');
            $.ajax({
                url: '<?php echo Yii::app()->baseUrl ?>/pelanggan/default/cekemail',
                type: 'POST',
                data: 'email=' + value + '&<?php echo Yii::app()->request->csrfTokenName.'='.Yii::app()->request->csrfToken ?>',
                success: function(data) {
                    if (data > 0)
                        $("#emailnotif").html('<div class="errorMessage"><?php echo Message::_alert('email_exist') ?></div>');
                    else
                        $("#emailnotif").html('<div class="successMessage"><?php echo Message::_alert('email_available') ?></div>');
                    
                    $("#cekemail").fadeOut('fast');
                    $("#emailnotif").fadeIn('slow');
                }
            });
        }
    }

    $(document).ready(function() {

    });
</script>