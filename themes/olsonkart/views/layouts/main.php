<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Title here -->
        <title><?php echo $this->pageTitle ?></title>
        <?php $themeURL = Yii::app()->theme->baseUrl ?>
        <?php $baseURL = Yii::app()->baseUrl ?>
        <meta name="description" content="Jual grosir dan eceran perlengkapan serta atribut berbagai macam seragam">
        <meta name="keywords" content="<?php echo Yii::app()->params['meta'] ?>">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,600italic,600' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Just+Me+Again+Down+Here' rel='stylesheet' type='text/css'>

        <link href="<?php echo $themeURL ?>/css/animate.min.css" rel='stylesheet' type='text/css'>
        <link href="<?php echo $themeURL ?>/css/ddlevelsmenu-base.css" rel='stylesheet' type='text/css'>
        <link href="<?php echo $themeURL ?>/css/ddlevelsmenu-topbar.css" rel='stylesheet' type='text/css'>
        <link href="<?php echo $baseURL ?>/library/fancybox/jquery.fancybox-1.3.4.css" rel='stylesheet' type='text/css'>
        <link href="<?php echo $baseURL ?>/library/yamm/yamm.css" rel='stylesheet' type='text/css'>
        <link href="<?php echo $baseURL ?>/library/datepicker/css/bootstrap-datetimepicker.min.css" rel='stylesheet' type='text/css'>
        <link href="<?php echo $baseURL ?>/library/summernote/summernote.css" rel='stylesheet' type='text/css'>
        <link href="<?php echo $themeURL ?>/css/style.css" rel='stylesheet' type='text/css'>
        <link href="<?php echo $baseURL ?>/css/custom/thumbnail.css" rel='stylesheet' type='text/css'>

        <link rel="shortcut icon" href="<?php echo $baseURL ?>/images/toko/favicon.png" type="image/x-icon">
        <link rel="icon" href="<?php echo $baseURL ?>/images/toko/favicon.png" type="image/x-icon">
        
    </head>

    <body>
        
        <!-- Plugins -->
        <div style="display:none">
            <!--Facebook-->
            <script async>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return;js = d.createElement(s); js.id = id;js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script>
            <!--Twitter-->
            <script async>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
            <!--Google Analytic-->
            <script async>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');ga('create', 'UA-49981311-1', 'jayagrosir.net');ga('send', 'pageview');</script>
            <!--Purechat-->
            <script async data-cfasync="false">(function () { var done = false; var script = document.createElement('script'); script.async = true; script.type = 'text/javascript'; script.src = 'https://widget.purechat.com/VisitorWidget/WidgetScript'; document.getElementsByTagName('HEAD').item(0).appendChild(script); script.onreadystatechange = script.onload = function (e) { if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) { var w = new PCWidget({ c: 'aa0490da-2fa8-4da2-a14b-a3f5659984e1', f: true }); done = true; } }; })();</script>
        </div>
        
        <!-- Logo & Navigation starts -->
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6"></div>
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
                        <div class="search-box">
                            <div class="quick-search">
                                <?php $form = $this->beginWidget('CActiveForm', array(
                                    'id' => 'search-form',
                                    'action' => array('/main/search'),
                                    'method' => 'get',
                                    'htmlOptions' => array(
                                        'class' => 'form-inline'
                                    ),
                                )); ?>
                                <div class="input-group">
                                    <input class="form-control input-sm" type="text" name="key" id="key" placeholder="Cari barang disini">
                                    <span class="input-group-btn">
                                        <button class="btn btn-light btn-default" type="submit" name="search" style="z-index:9"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                                <?php $this->endWidget() ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
                        <div id="ddtopmenubar" class="kart-links pull-right">
                            <ul>
                                <?php if(WebUser::isPelanggan()): ?>
                                <li>
                                    <?php echo CHtml::link('<i class="fa fa-user"></i> '.Yii::app()->user->nama, '', array('rel'=>'ddsubmenu1')) ?>
                                    <ul id="ddsubmenu1" class="ddsubmenustyle">
                                        <li><?php echo CHtml::link('<i class="fa fa-dashboard"></i> Dashboard', array('/pelanggan/')) ?></li>
                                        <li><?php echo CHtml::link('<i class="fa fa-sign-out"></i> Logout', array('/pelanggan/default/logout')) ?></li>
                                    </ul>
                                </li>
                                <?php else: ?>
                                <li><?php echo CHtml::link('<i class="fa fa-lock"></i> Login', array('/pelanggan/default/login')) ?></li>
                                <li><?php echo CHtml::link('<i class="fa fa-sign-in"></i> Daftar', array('/pelanggan/default/daftar')) ?></li>
                                <?php endif ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Logo & Navigation ends -->

        <div class="clearfix"></div>
        
        <!-- Header ends -->
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <!-- Logo and site link -->
                        <div class="logo">
                        	<?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl.'/images/toko/jayagrosir.net logo_small.png','',array('width'=>250)), '/') ?>
                            <h1>Jayagrosir.net, belanja grosir online. Jual atribut dan perlengkapan seragam pramuka, sekolah, paskibra, taekwondo, PNS, karate, hizbul wathan, dan perlengkapan lain</h1>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-3 col-xs-6 col-md-offset-1 col-sm-offset-1">
                        <div class="list wide">
                            <div class="cart-group row">
                                <div class="cart-item col-md-5 col-sm-12 col-xs-5">
                                    <?php echo '<i class="fa fa-shopping-cart font6"></i> &nbsp;<span id="topsum" class="lead">' . OrderTemp::CartSum() . '</span> &nbsp;Barang' ?>
                                </div>
                                <div class="cart-total col-md-7 col-sm-12 col-xs-7">
                                    <?php echo '<span id="toptotal">' . MyFormatter::formatUang(OrderTemp::CartTotal()) . '</span>' ?>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <?php echo CHtml::link('<i class="fa fa-shopping-cart"></i> Lihat keranjang', array('/pelanggan/keranjang'), array('class'=>'btn btn-info btn-sm btn-block')) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-6">
                        <div class="list wide">
                            <!-- Add your phone number here -->
                            <div class="phone">
                                <i class="fa fa-phone"></i> &nbsp;<?php echo Yii::app()->params['kontak']['sms-center'] ?>
                            </div>
                            <hr>
                            <!-- Add your email id here -->
                            <div class="email">
                                <i class="fa fa-envelope-o"></i> &nbsp;<?php echo Yii::app()->params['email']['customer'] ?>
                            </div>
                            <hr>
                            <!-- Add your address here -->
                            <div class="ym">
                                <a href="ymsgr:sendIM?muchammad.arfian"><img src="http://opi.yahoo.com/online?u=muchammad.arfian&m=g&t=1&l=us" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Header ends -->

        <!-- Navigation Starts -->
        <div class="navbar bs-docs-nav" role="banner">

            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span><i class="fa fa-th-list"></i> Menu</span>
                    </button>
                </div>
                <?php $_kategori = Kategori::model()->findAll('KATEGORI_STATUS=1') ?>
                <nav class="collapse navbar-collapse bs-navbar-collapse yamm" role="navigation">
                    <!-- Navigation links starts here -->
                    <ul class="nav navbar-nav">
                        <!-- Main menu -->
                        <li><?php echo CHtml::link('<i class="fa fa-home"></i>', array('/')) ?></li>
                        <!-- Navigation with sub menu. Please note down the syntax before you need. Each and every link is important. -->
                        <li class="dropdown yamm-fw">
                            <?php echo CHtml::link('Katalog <b class="caret"></b>','#',array('class'=>'dropdown-toggle','data-toggle'=>'dropdown')) ?>
                            <!-- Submenus -->
                            <ul class="dropdown-menu">
                                <li class="mega-navbar">
                                    <div class="container">
                                        <div class="row">
                                            <?php foreach ($_kategori as $kat): ?>
                                            <div class="col-sm-2">
                                                <div class="mega-section"><?php echo CHtml::link($kat->KATEGORI_NAMA, array('/katalog/kategori', 'id'=>Expr::linkForward($kat->KATEGORI_ID, Expr::LINK_KATEGORI))) ?><hr class="thin inner-separator"></div>
                                                <ul class="mega-menu">
                                                    <?php foreach ($kat->subkategori as $sub): ?>
                                                    <li><?php echo CHtml::link('<i class="fa fa-tag"></i> '.$sub->SUBKATEGORI_NAMA, array('/katalog/subkategori', 'id'=>Expr::linkForward($sub->SUBKATEGORI_ID, Expr::LINK_SUBKATEGORI))) ?></li>
                                                    <?php endforeach ?>
                                                </ul>
                                            </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li><?php echo CHtml::link('Langkah belanja', array('/langkah-belanja')) ?></li>
                        <li class="dropdown">
                            <?php echo CHtml::link('Informasi pelanggan <b class="caret"></b>', '#', array('class'=>'dropdown-toggle', 'data-toggle'=>'dropdown')) ?>
                            <ul class="dropdown-menu">
                                <li><?php echo CHtml::link('<i class="fa fa-question"></i> FAQ', array('/faq')) ?></li>
                                <li><?php echo CHtml::link('<i class="fa fa-edit"></i> Konfirmasi pembayaran', array('/konfirmasi')) ?></li>
                                <li><?php echo CHtml::link('<i class="fa fa-search"></i> Cek pemesanan', array('/cek-pemesanan')) ?></li>
                                <li><?php echo CHtml::link('<i class="fa fa-comment-o"></i> Testimoni', array('/testimoni')) ?></li>
                                <li><?php echo CHtml::link('<i class="fa fa-credit-card"></i> Pembayaran', array('/pembayaran')) ?></li>
                            </ul>
                        </li> 
                        <li><?php echo CHtml::link('Kontak kami', array('/kontak')) ?></li>
                        <li><?php echo CHtml::link('Tentang kami', array('/tentang')) ?></li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- Navigation Ends -->
        
        <div class="container">
            <?php
            if (!empty($this->breadcrumbs)) {
                if (Yii::app()->controller->route !== 'site/index')
                    $this->breadcrumbs = array_merge(array(Yii::t('zii', 'Home') => Yii::app()->homeUrl), $this->breadcrumbs);

                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                    'homeLink' => false,
                    'tagName' => 'ul',
                    'separator' => '',
                    'activeLinkTemplate' => '<li><a href="{url}">{label}</a> <span class="divider"></span></li>',
                    'inactiveLinkTemplate' => '<li><span>{label}</span></li>',
                    'htmlOptions' => array('class' => 'breadcrumb')
                ));
            }
            ?> <!-- breadcrumbs -->
            <div class="row" id="flashtop">
                <?php echo Yii::app()->user->getFlash('info') ?>
                <div class="col-md-12 col-sm-12 col-xs-12" style="display:none"></div>
            </div>
        </div>
        
        <?php echo $content ?>

        <!-- Footer starts -->
        <footer>
            <div id="fb-root"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                        <div class="fwidget">
                            <ul>
                                <li><?php echo CHtml::link('Langkah belanja', array('/langkah-belanja')) ?><hr class="xthin"/></li>
                                <li><?php echo CHtml::link('FAQ', array('/faq')) ?><hr class="xthin"/></li>
                                <li><?php echo CHtml::link('Pembayaran', array('/pembayaran')) ?><hr class="xthin"/></li>
                                <li><?php echo CHtml::link('Konfirmasi', array('/konfirmasi')) ?><hr class="xthin"/></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                        <div class="fwidget">
                            <ul>
                                <li><?php echo CHtml::link('Keranjang', array('/pelanggan/keranjang')) ?><hr class="xthin"/></li>
                                <li><?php echo CHtml::link('Syarat & ketentuan order', array('/syarat')) ?><hr class="xthin"/></li>
                                <li><?php echo CHtml::link('Cek pemesanan', array('/cek-pemesanan')) ?><hr class="xthin"/></li>
                            </ul>
                        </div>
                    </div>        
                    
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                        <div class="fwidget">
                            <ul>
                                <li><?php echo CHtml::link('Pelanggan', array('/pelanggan')) ?><hr class="xthin"/></li>
                                <li><?php echo CHtml::link('Ingin menjadi supplier kami?', array('/supplier')) ?><hr class="xthin"/></li>
                                <li><?php echo CHtml::link('Kontak kami', array('/kontak')) ?><hr class="xthin"/></li>
                                <li><?php echo CHtml::link('Tentang kami', array('/tentang')) ?><hr class="xthin"/></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                        <div class="fwidget">
                            <h4>Jayagrosir.<span class="color">net</span></h4>
                            <hr />
                            <div class="address">
                                <p><i class="fa fa-home color contact-icon"></i> Kedinding Lor Gg Anggrek 36, Surabaya 60129 Jawa Timur</p>
                                <p><i class="fa fa-phone color contact-icon"></i> <?php echo Yii::app()->params['kontak']['sms-center'] ?></p>
                                <p><i class="fa fa-envelope-o color contact-icon"></i> <?php echo CHtml::link(Yii::app()->params['email']['customer'], 'mailto:'.Yii::app()->params['email']['customer']) ?></p>
                            </div>
                            <div class="social">
                                <div class="fb-like" data-href="https://www.jayagrosir.net" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
                                <div><a href="https://twitter.com/jaya_grosir" class="twitter-follow-button" data-show-count="true" data-size="medium">Follow @jaya_grosir</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <hr class="xthin"/>

                <div class="copy text-center">
                    Copyright 2014 &copy; - Jayagrosir.net
                </div>
            </div>
        </footer>
        <!-- Footer ends -->
        
        <!-- Scroll to top -->
        <span class="totop"><a href="#"><i class="fa fa-chevron-up"></i></a></span> 

        <!-- Javascript files -->
        <script async src="<?php echo $themeURL ?>/js/ddlevelsmenu.js"></script>
        <script async src="<?php echo $themeURL ?>/js/jquery.carouFredSel-6.2.1-packed.js"></script>
        <script async src="<?php echo $themeURL ?>/js/jquery.navgoco.min.js"></script>
        <script async src="<?php echo $themeURL ?>/js/filter.js"></script>
        <script async src="<?php echo $themeURL ?>/js/html5shiv.js"></script>
        <script async src="<?php echo $baseURL ?>/library/fancybox/jquery.fancybox-1.3.4_patch.js"></script>
        <script async src="<?php echo $baseURL ?>/library/datepicker/js/moment-2.5.1.js"></script>
        <script async src="<?php echo $baseURL ?>/library/datepicker/js/bootstrap-datetimepicker.min.js"></script>
        <script async src="<?php echo $baseURL ?>/library/datepicker/js/bootstrap-datetimepicker.id.js"></script>
        <script async src="<?php echo $baseURL ?>/library/summernote/summernote.min.js"></script>
        <script async src="<?php echo $themeURL ?>/js/custom.js"></script>
        
    </body>	
</html>