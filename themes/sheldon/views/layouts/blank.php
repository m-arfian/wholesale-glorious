<!DOCTYPE html>
<html>
    <head>
        <!-- Title here -->
        <title><?php echo $this->pageTitle ?></title>
        <?php $themeURL = Yii::app()->theme->baseUrl ?>
        <!-- Description, Keywords and Author -->
        <!--<meta name="description" content="Your description">-->
        <!--<meta name="keywords" content="Your,Keywords">-->
        <!--<meta name="author" content="Jayagrosir.net">-->

        <!-- Google web fonts -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php Yii::app()->clientScript->registerCssFile("$themeURL/css/style.css") ?>
        <!--[if IE]>
        <?php Yii::app()->clientScript->registerCssFile("$themeURL/css/style-ie.css") ?>
        <![endif]-->

        <!-- Favicon -->
        <link rel="shortcut icon" href="#">
    </head>

    <body>
        <div class="out-container">
            <?php echo $content ?>
        </div>

        <?php Yii::app()->clientScript->registerScriptFile("$themeURL/js/respond.min.js", CClientScript::POS_END) //Respond JS for IE8 ?>
        <?php Yii::app()->clientScript->registerScriptFile("$themeURL/js/html5shiv.js", CClientScript::POS_END) //HTML5 Support for IE ?>

    </body>	
</html>