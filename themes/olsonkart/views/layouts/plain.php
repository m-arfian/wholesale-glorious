<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Title here -->
        <title><?php echo $this->pageTitle ?></title>
        <?php $themeURL = Yii::app()->theme->baseUrl ?>
        <?php $baseURL = Yii::app()->baseUrl ?>
        <!-- Description, Keywords and Author -->
        <meta name="description" content="Your description">
        <meta name="keywords" content="Your,Keywords">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,600italic,600' rel='stylesheet' type='text/css'>

        <!-- Styles -->
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/main.css'); ?>
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/form.css'); ?>
        <!-- Bootstrap CSS -->
        <?php Yii::app()->clientScript->registerCssFile($themeURL . '/css/bootstrap.min.css'); ?>
        <!-- Font awesome CSS -->
        <?php Yii::app()->clientScript->registerCssFile($themeURL . '/css/font-awesome.min.css'); ?>
        <!-- Custom CSS -->
        <?php Yii::app()->clientScript->registerCssFile($themeURL . '/css/style.css'); ?>

        <!-- Favicon -->
        <link rel="shortcut icon" href="#">
        
    </head>

    <body>
        <!-- Logo & Navigation starts -->
        <!-- Logo & Navigation ends -->
        
        <!-- Header starts -->
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <!-- Logo and site link -->
                        <div class="logo">
                            <h1><?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl.'/images/toko/jayagrosir.net logo_small.png','',array('width'=>250)), array('/')) ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <hr class="hrblue">
        <!-- Header ends -->

        <!-- Navigation Starts -->
        <div class="row">
            <div class="pull-right">
                <?php echo CHtml::link('<i class="fa fa-home"></i>', array('/')) ?>
            </div>
        </div>
        <!-- Navigation Ends -->
        
        <?php echo $content ?>
        
        <!-- Footer starts -->
        <footer>
            <div id="fb-root"></div>
            <div class="container">

                <div class="row">

                    <div class="col-md-4 col-sm-4">
                        <div class="fwidget">

                            <h4>Oslon de<span class="color">'</span> Techno</h4>
                            <hr />
                            <p>Duis leo risus, vehicula luctus nunc.  Quiue rhoncus, a sodales enim arcu quis turpis. Duis leo risus, condimentum ut posuere ac, vehicula luctus nunc.  Quisque rhoncus, a sodales enim arcu quis turpis.</p>

                            <div class="social">
                                <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                                <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                                <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
                                <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
                                <a href="#" class="pinterest"><i class="fa fa-pinterest"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div class="fwidget">
                            <h4>Categories</h4>
                            <hr />
                            <ul>
                                <li><a href="#">Sed eu leo orci, condimentum gravida metus</a></li>
                                <li><a href="#">Etiam at nulla ipsum, in rhoncus purus</a></li>
                                <li><a href="#">Fusce vel magna faucibus felis dapibus facilisis</a></li>
                                <li><a href="#">Vivamus scelerisque dui in massa</a></li>
                                <li><a href="#">Pellentesque eget adipiscing dui semper</a></li>
                            </ul>
                        </div>
                    </div>        



                    <div class="col-md-4 col-sm-4">
                        <div class="fwidget">

                            <h4>Get In Touch</h4>
                            <hr />
                            <div class="address">
                                <p><i class="fa fa-home color contact-icon"></i> #12, Plot No.14, Raj Karmara Street, </p>
                                <p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 5th Stage, Koramangala, Madiwala,</p>
                                <p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Bangalore - 493922, Karananana.</p>
                                <p><i class="fa fa-phone color contact-icon"></i> +94-948-323-5532</p>
                                <p><i class="fa fa-envelope-o color contact-icon"></i> <a href="mailto:something@gmail.com">some.thing@gmail.com</a></p>
                            </div>

                        </div>
                    </div>

                </div>



                <hr />

                <div class="copy text-center">
                    Copyright 2013 &copy; - <a href="http://responsivewebinc.com/bootstrap-themes">Bootstrap Themes</a>
                </div>
            </div>
        </footer>
        <!-- Footer ends -->

        <!-- Plugins -->
        <div style="display:none">
            <!--Facebook-->
            <script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return;js = d.createElement(s); js.id = id;js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script>
            <!--Twitter-->
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
            <!--Google Analytic-->
            <script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');ga('create', 'UA-49981311-1', 'jayagrosir.net');ga('send', 'pageview');</script>
            <!--Purechat-->
            <script data-cfasync="false">(function () { var done = false; var script = document.createElement('script'); script.async = true; script.type = 'text/javascript'; script.src = 'https://widget.purechat.com/VisitorWidget/WidgetScript'; document.getElementsByTagName('HEAD').item(0).appendChild(script); script.onreadystatechange = script.onload = function (e) { if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) { var w = new PCWidget({ c: 'aa0490da-2fa8-4da2-a14b-a3f5659984e1', f: true }); done = true; } }; })();</script>
        </div>
        
        <!-- Scroll to top -->
        <span class="totop"><a href="#"><i class="fa fa-chevron-up"></i></a></span> 

        <!-- Javascript files -->
        <!-- Dropdown menu -->
        <script src="<?php echo $themeURL ?>/js/ddlevelsmenu.js"></script>
        <!-- CaroFredSel -->
        <script src="<?php echo $themeURL ?>/js/jquery.carouFredSel-6.2.1-packed.js"></script> 
        <!-- Countdown -->
        <script src="<?php echo $themeURL ?>/js/jquery.countdown.min.js"></script>
        <!-- jQuery Navco -->
        <script src="<?php echo $themeURL ?>/js/jquery.navgoco.min.js"></script>
        <!-- Filter for support page -->
        <script src="<?php echo $themeURL ?>/js/filter.js"></script>
        <!-- Respond JS for IE8 -->
        <script src="<?php echo $themeURL ?>/js/respond.min.js"></script>
        <!-- HTML5 Support for IE -->
        <script src="<?php echo $themeURL ?>/js/html5shiv.js"></script>
        <!-- Fancybox -->
        <script src="<?php echo $baseURL ?>/library/fancybox/jquery.fancybox-1.3.4_patch.js"></script>
        <!-- Bootstrap datepicker -->
        <script src="<?php echo $baseURL ?>/library/datepicker/js/moment-2.4.0.js"></script>
        <script src="<?php echo $baseURL ?>/library/datepicker/js/bootstrap-datetimepicker.min.js"></script>
        <script src="<?php echo $baseURL ?>/library/datepicker/js/bootstrap-datetimepicker.id.js"></script>
        <!-- Summernote -->
        <script src="<?php echo Yii::app()->baseUrl ?>/library/summernote/summernote.min.js"></script>
        <!-- Custom JS -->
        <script src="<?php echo $themeURL ?>/js/custom.js"></script>
        
    </body>	
</html>