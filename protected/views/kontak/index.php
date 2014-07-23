<?php
$this->pageTitle = 'Kontak Kami';
$this->breadcrumbs = array(
    'Kontak kami',
);

Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/mail.bootstrap.css');
?>

<!-- Page title -->
<div class="page-title">
    <div class="container">
        <h2><i class="fa fa-envelope color"></i> Kontak kami <small></small></h2>
        <hr>
    </div>
</div>
<!-- Page title -->

<div class="contactus">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                <!-- Contact form -->
                <div class="get-in-touch">
                    <?php echo CHtml::beginForm(array('kirim'), 'post', array('class'=>'form-horizontal', 'role'=>'form')) ?>
                    <h3 class="text-center">Kirim pesan Anda.</h3>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                        <?php echo CHtml::textField('nama', '', array('class'=>'form-control', 'placeholder'=>'Nama', 'required'=>true)) ?>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                        <?php echo CHtml::emailField('email', '', array('class'=>'form-control', 'placeholder'=>'Email Anda', 'required'=>true)) ?>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-comments-o"></i></span>
                        <?php echo CHtml::textArea('isi', '', array('class'=>'form-control', 'placeholder'=>'Pesan', 'required'=>true, 'rows'=>'3')) ?>
                    </div>
                    <?php echo CHtml::htmlButton('<i class="fa fa-reply"></i> Kirim', array('class'=>'btn btn-sm btn-danger btn-block', 'type'=>'submit')) ?>
                    <?php echo CHtml::endForm() ?>
                    
                </div>

            </div>
            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                <div class="cwell">
                    <!-- Address section -->
                    <h5 class="text-center">UD. Amanah Jaya</h5>
                    <div class="address">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                            <address>
                                <!-- Address -->
                                <h6><i class="fa fa-home"></i> Alamat I</h6>
                                Jl. Dupak, Penampungan Pasar Turi<br>
                                Surabaya, Jawa Timur<br>
                                <!-- Phone number -->
                                <abbr title="Handphone"><i class="fa fa-phone"></i></abbr> (081) 217-860-30.
                            </address>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                            <address>
                                <!-- Address -->
                                <h6><i class="fa fa-home"></i> Alamat II</h6>
                                Jl. Kedinding Lor Gg Anggrek 36<br>
                                Surabaya, Jawa Timur<br>
                                <!-- Phone number -->
                                <abbr title="Telepon"><i class="fa fa-phone"></i></abbr> (031) 3724476.<br>
                                <abbr title="Email"><i class="fa fa-envelope-o"></i></abbr> <a href="mailto:cs@jayagrosir.net">cs@jayagrosir.net</a>
                            </address>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <a href="ymsgr:sendIM?muchammad.arfian"><img src="http://opi.yahoo.com/online?u=muchammad.arfian&m=g&t=14&l=us" width="120" /></a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-lg-offset-6 col-md-offset-6 col-sm-offset-6">
                            <?php echo CHtml::image(Yii::app()->baseUrl.'/images/toko/jayagrosir.net logo_small.png', '', array('width'=>120)) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>