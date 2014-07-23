<!DOCTYPE html>
<html>
    <head>
        <!-- Title here -->
        <title><?php echo $this->pageTitle ?></title>
        <!-- Description, Keywords and Author -->
        <!--<meta name="description" content="Your description">-->
        <!--<meta name="keywords" content="Your,Keywords">-->
        <?php $themeURL = Yii::app()->theme->baseUrl ?>
        <?php $baseURL = Yii::app()->baseUrl ?>

        <!-- Google web fonts -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php //Yii::app()->clientScript->registerCssFile("$themeURL/css/jquery.gritter.css") ?>
        <?php //Yii::app()->clientScript->registerCssFile("$themeURL/css/bootstrap-switch.css") ?>
        <?php //Yii::app()->clientScript->registerCssFile("$themeURL/css/jquery.dataTables.css") ?>
        <?php //Yii::app()->clientScript->registerCssFile("$themeURL/css/rateit.css") ?>
        <?php //Yii::app()->clientScript->registerCssFile("$themeURL/css/prettyPhoto.css") ?>
        <?php Yii::app()->clientScript->registerCssFile("$themeURL/css/fullcalendar.css") ?>
        <?php Yii::app()->clientScript->registerCssFile("$baseURL/library/fancybox/jquery.fancybox-1.3.4.css") ?>
        <?php Yii::app()->clientScript->registerCssFile("$baseURL/library/datepicker/css/bootstrap-datetimepicker.min.css") ?>
        <?php Yii::app()->clientScript->registerCssFile("$baseURL/library/summernote/summernote.css") ?>
        <?php Yii::app()->clientScript->registerCssFile("$themeURL/css/style.css") ?>
        <?php Yii::app()->clientScript->registerCssFile("$themeURL/css/custom.css") ?>
        <!--[if IE]>
        <link href='<?php echo $themeURL ?>/css/style-ie.css' rel='stylesheet' type='text/css'>
        <![endif]-->

        <!-- Favicon -->
        <link rel="shortcut icon" href="#">
    </head>

    <body>
        <!-- Quick setting box starts -->
        <!-- Quick setting box ends -->

        <div class="out-container">
            <div class="outer">
                <!-- Sidebar starts -->
                <div class="sidebar">
                    <!-- Logo starts -->
                    <div class="logo">
                        <h1><?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl.'/images/toko/jayagrosir.net logo_small.png','',array('width'=>200)), Yii::app()->baseUrl.'/') ?></h1>
                    </div>
                    <!-- Logo ends -->

                    <!-- Sidebar buttons starts -->
                    <div class="sidebar-buttons text-center">
                        <!-- User button -->
                        <div class="btn-group">
                            <a href="profile.html" class="btn btn-black btn-xs"><i class="fa fa-user"></i></a>
                            <a href="profile.html" class="btn btn-danger btn-xs"><?php echo Yii::app()->user->nama ?></a>
                        </div>
                        <!-- Logout button -->
                        <div class="btn-group">
                            <?php echo CHtml::htmlButton('<i class="fa fa-power-off"></i>', array('class'=>'btn btn-black btn-xs')) ?>
                            <?php echo CHtml::link('Logout', array('default/logout'), array('class'=>'btn btn-danger btn-xs')) ?>
                        </div>
                    </div>
                    <!-- Sidebar buttons ends -->

                    <!-- Sidebar search -->
                    <div class="sidebar-search">
                        <form class="form-inline" role="form">
                            <div class="input-group">
                                <input type="text" class="form-control" id="s" placeholder="Type Here to Search...">
                                <!-- Search button -->
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <!-- Sidebar search -->

                    <!-- Sidebar navigation starts -->

                    <div class="sidebar-dropdown"><a href="#">Navigation</a></div>

                    <div class="sidey">
                        <ul class="nav">
                            <!-- Main navigation. Refer Notes.txt files for reference. -->

                            <!-- Use the class "current" in main menu to hightlight current main menu -->
                            <li class="current"><?php echo CHtml::link('<i class="fa fa-desktop"></i> Dashboard', array('/sim')) ?></li>
                            <li><?php echo CHtml::link('<i class="fa fa-inbox"></i> Manajemen Barang', array('barang/')) ?></li>
                            <li><?php echo CHtml::link('<i class="fa fa-truck"></i> Manajemen Order', array('order/')) ?></li>
                            <li><?php echo CHtml::link('<i class="fa fa-user"></i> Manajemen Pelanggan', array('pelanggan/')) ?></li>

                            <li class="has_submenu">
                                <a href="#">
                                    <i class="fa fa-folder-open"></i> Data Master <span class="label label-darky">10</span>
                                    <!-- Icon to show dropdown -->
                                    <span class="caret pull-right"></span>
                                </a>
                                <!-- Sub navigation -->
                                <ul>
                                    <!-- Use the class "active" in sub menu to hightlight current sub menu -->
                                    <li><?php echo CHtml::link('<i class="fa fa-caret-right"></i> Kategori', array('kategori/')) ?></li>
                                    <li><?php echo CHtml::link('<i class="fa fa-caret-right"></i> Subkategori', array('subkategori/')) ?></li>
                                    <li><?php echo CHtml::link('<i class="fa fa-caret-right"></i> Rekening', array('rekening/')) ?></li>
                                    <li><?php echo CHtml::link('<i class="fa fa-caret-right"></i> Gambar', array('gambar/')) ?></li>
                                    <li><?php echo CHtml::link('<i class="fa fa-caret-right"></i> Ekspedisi', array('ekspedisi/')) ?></li>
                                    <li><?php echo CHtml::link('<i class="fa fa-caret-right"></i> Provinsi', array('provinsi/')) ?></li>
                                    <li><?php echo CHtml::link('<i class="fa fa-caret-right"></i> Kota', array('kota/')) ?></li>
                                    <li><?php echo CHtml::link('<i class="fa fa-caret-right"></i> Satuan barang', array('satuan/')) ?></li>
                                    <li><?php echo CHtml::link('<i class="fa fa-caret-right"></i> Satuan waktu', array('waktu/')) ?></li>
                                    <li><?php echo CHtml::link('<i class="fa fa-caret-right"></i> Tag', array('tag/')) ?></li>
                                    <li><?php echo CHtml::link('<i class="fa fa-caret-right"></i> Order status', array('orderstatus/')) ?></li>
                                </ul>
                            </li>   

                            <li><?php echo CHtml::link('<i class="fa fa-exclamation-triangle"></i> Konfirmasi', array('konfirmasi/')) ?></li>
                            <li><?php echo CHtml::link('<i class="fa fa-comments"></i> Testimoni', array('testimoni/')) ?></li>
                        </ul>               
                    </div>
                    <!-- Sidebar navigation ends -->

                </div>
                <!-- Sidebar ends -->

                <!-- Mainbar starts -->
                <div class="mainbar">

                    <!-- Page heading starts -->
                    <div class="page-head">
                        <div class="container">
                            <div class="row">
                                <!-- Page heading -->
                                <div class="col-md-3 col-sm-6 col-xs-6">
                                    <h2><i class="fa fa-desktop"></i> SIM Jayagrosir.net</h2>
                                </div>
                                <!-- Mini status -->
                                <div class="col-md-6 col-sm-0 hidden-sm hidden-xs"></div>
                                <!-- Icons -->
                                <div class="col-md-3 col-sm-6 col-xs-6"></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Page heading ends -->
                    
                    <!-- Hero status starts -->
                    <div class="hero-status">
                        <div class="container">
                            <div class="hero-block-two">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-3 text-center">
                                        <i class="fa fa-truck"></i>
                                    </div>
                                    <!-- Labels -->
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <h5><?php echo CHtml::link('Order', array('/sim/order')) ?></h5>
                                        <h3 class="label label-warning"><?php echo MyFormatter::formatAngka(Yii::app()->db->createCommand('SELECT COUNT(*) FROM `order`')->queryScalar()) ?></h3>
                                    </div>

                                </div>
                            </div>

                            <div class="hero-block-two">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-3 text-center">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <!-- Labels -->
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <h5><?php echo CHtml::link('Pelanggan terdaftar', array('/sim/pelanggan')) ?></h5>
                                        <h3 class="label label-primary"><?php echo MyFormatter::formatAngka(Yii::app()->db->createCommand('SELECT COUNT(*) FROM registered')->queryScalar()) ?></h3>
                                    </div>

                                </div>
                            </div>

                            <div class="hero-block-two">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-3 text-center">
                                        <i class="fa fa-inbox"></i>
                                    </div>
                                    <!-- Labels -->
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <h5><?php echo CHtml::link('Barang', array('/sim/barang')) ?></h5>
                                        <h3 class="label label-success"><?php echo MyFormatter::formatAngka(Yii::app()->db->createCommand('SELECT COUNT(*) FROM barang')->queryScalar()) ?></h3>
                                    </div>

                                </div>
                            </div>
                            
                            <div class="hero-block-two">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-3 text-center">
                                        <i class="fa fa-cubes"></i>
                                    </div>
                                    <!-- Labels -->
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <h5><?php echo CHtml::link('Supplier', array('/sim/supplier')) ?></h5>
                                        <h3 class="label label-danger"><?php echo MyFormatter::formatAngka(Yii::app()->db->createCommand('SELECT COUNT(*) FROM supplier')->queryScalar()) ?></h3>
                                    </div>

                                </div>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <!-- Hero status ends -->
                    
                    <?php echo $content ?>

                </div>
                <!-- Mainbar ends -->

                <div class="clearfix"></div>
            </div>
        </div>

        <!-- Scroll to top -->
        <span class="totop"><a href="#"><i class="fa fa-chevron-up"></i></a></span> 

        <!-- Javascript files -->
        <?php Yii::app()->clientScript->registerScriptFile("$themeURL/js/sparkline.js", CClientScript::POS_END) ?>
        <!--[if lte IE 8]>
            <script type="text/javascript" src="<?php echo $themeURL ?>/js/excanvas.min.js"></script>
        <![endif]-->
        <?php Yii::app()->clientScript->registerScriptFile("$themeURL/js/jquery.flot.min.js", CClientScript::POS_END) ?>
        <?php Yii::app()->clientScript->registerScriptFile("$themeURL/js/jquery.flot.pie.min.js", CClientScript::POS_END) ?>
        <?php Yii::app()->clientScript->registerScriptFile("$themeURL/js/jquery.flot.resize.min.js", CClientScript::POS_END) ?>
        <?php Yii::app()->clientScript->registerScriptFile("$themeURL/js/jquery.knob.js", CClientScript::POS_END) ?>
        <?php Yii::app()->clientScript->registerScriptFile("$themeURL/js/jquery.slimscroll.min.js", CClientScript::POS_END) ?>
        <?php Yii::app()->clientScript->registerScriptFile("$themeURL/js/fullcalendar.min.js", CClientScript::POS_END) ?>
        <?php Yii::app()->clientScript->registerScriptFile("$themeURL/js/respond.min.js", CClientScript::POS_END) ?>
        <?php Yii::app()->clientScript->registerScriptFile("$themeURL/js/html5shiv.js", CClientScript::POS_END) ?>
        <?php Yii::app()->clientScript->registerScriptFile("$themeURL/js/custom.notification.js", CClientScript::POS_END) ?>
        <?php Yii::app()->clientScript->registerScriptFile("$baseURL/library/fancybox/jquery.fancybox-1.3.4_patch.js", CClientScript::POS_END) ?>
        <?php Yii::app()->clientScript->registerScriptFile("$baseURL/library/datepicker/js/moment-2.5.1.js", CClientScript::POS_END) ?>
        <?php Yii::app()->clientScript->registerScriptFile("$baseURL/library/datepicker/js/bootstrap-datetimepicker.min.js", CClientScript::POS_END) ?>
        <?php Yii::app()->clientScript->registerScriptFile("$baseURL/library/datepicker/js/bootstrap-datetimepicker.id.js", CClientScript::POS_END) ?>
        <?php Yii::app()->clientScript->registerScriptFile("$baseURL/library/summernote/summernote.min.js", CClientScript::POS_END) ?>
        <?php Yii::app()->clientScript->registerScriptFile("$themeURL/js/custom.js", CClientScript::POS_END) ?>
                    
    </body>	
</html>