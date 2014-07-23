<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'JAYA Grosir',
    'theme'=>'olsonkart',
    'defaultController' => 'main',
    'timeZone' => 'Asia/Jakarta',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'ext.YiiMailer.YiiMailer',
        //'application.helpers.*',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '123456',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
             'ipFilters' => array('127.0.0.1', '::1'),
//            'ipFilters' => array('103.27.206.202'),
        ),
        'pelanggan',
        'supplier',
        'sim',
    ),
    // application components
    'components' => array(
        'request'=>array(
            'enableCsrfValidation'=>true,
            'enableCookieValidation'=>true,
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'class' => 'WebUser',
            'loginUrl' => array('/pelanggan/default/login'),
        ),
        'session' => array(
            'sessionName' => '_jg',
            'cookieMode' => 'only',
            'class' => 'system.web.CDbHttpSession',
            'connectionID' => 'db',
            'sessionTableName' => 'session_log',
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',        //controller/action/parameter[num]
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',  // module/controller/action/parameter[num]
                
                /* -- katalog -- */
                '<controller:katalog>' => 'katalog/',
                '<controller:katalog>/<action:\w+>' => 'katalog/<action>',
                '<controller:katalog>/<action:\w+>/<id:(\w+-?)+>' => 'katalog/<action>/id/<id>',
                
                /* -- cek pemesanan -- */
                '<controller:cek-pemesanan>' => 'cek/',
                '<controller:cek-pemesanan>/<action:\w+>' => 'cek/<action>',
                '<controller:cek-pemesanan>/<action:\w+>/<id:\w+>' => 'cek/<action>/id/<id>',
                
                /* -- langkah belanja -- */
                '<controller:langkah-belanja>' => 'langkah/',
                
                /* -- SIM -- */
                
            ),
            'showScriptName' => false,
        ),
        'clientScript' => array(
            'scriptMap' => array(
                // map scripts from assets to your favourite versions (maybe CDN)
                'jquery.js' => 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js',
                'jquery.ui.js' => '//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js',
                'jquery.ui.smoothness.css' => '//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.min.css',
                'bootstrap.css' => 'http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css',
                'bootstrap.js' => 'http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js',
                'font-awesome.css' => 'http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css',
                /*  YII */
                'yii.main.css' => '/jayagrosir/css/main.css',
                'yii.form.css' => '/jayagrosir/css/form.css',
            ),
            'packages' => array(
                // here's a package named 'jquery'
                // it registers 3 JS and 2 css files, also note using scriptMap alias
                'jquery' => array(
                    'js' => array(
                        'jquery.js',
                    ),
                ),
                'jqueryui' => array(
                    'js' => array(
                        'jquery.ui.js',
                    ),
                    'css' => array(
                        'jquery.ui.smoothness.css',
                    ),
                    'depends' => array('jquery'),
                ),
                'bootstrap' => array(
                    'js' => array(
                        'bootstrap.js',
                    ),
                    'css' => array(
                        'bootstrap.css',
                        'font-awesome.css',
                    ),
                    'depends' => array('jquery'), // this package depends on jquery package
                ),
                'yii' => array(
                    'css' => array(
                        'yii.main.css',
                        'yii.form.css',
                    ),
                )
            ),
        ),
        /*
          'db' => array(
          'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/testdrive.db',
          ),
         * 
         */
        // uncomment the following to use a MySQL database
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=jayagrosir',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'compaq',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'main/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
        'format' => array(
            'class' => 'MyFormatter'
        ),
        'ePdf' => array(
            'class' => 'ext.yii-pdf.EYiiPdf',
            'params' => array(
                'mpdf' => array(
                    'librarySourcePath' => 'application.vendors.mpdf.*',
                    'constants' => array(
                        '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                    ),
                    'class' => 'mpdf',
                    'defaultParams' => array(// More info: http://mpdf1.com/manual/index.php?tid=184
                        'mode' => '', //  This parameter specifies the mode of the new document.
                        'format' => 'A5', // format A4, A5, ...
                        'default_font_size' => 0, // Sets the default document font size in points (pt)
                        'default_font' => '', // Sets the default font-family for the new document.
                        'mgl' => 15, // margin_left. Sets the page margins for the new document.
                        'mgr' => 15, // margin_right
                        'mgt' => 16, // margin_top
                        'mgb' => 16, // margin_bottom
                        'mgh' => 9, // margin_header
                        'mgf' => 9, // margin_footer
                        'orientation' => 'P', // landscape or portrait orientation
                    )
                ),
            ),
        ),
//        'bootstrap' => array(
//            'class' => 'bootstrap.components.Bootstrap',
//        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        // 'upload' => array(
        //     'produk' => '/../jayagrosir/images/produk/',
        //     'pelanggan' => '/../jayagrosir/images/pelanggan/',
        //     'lain' => '/../jayagrosir/images/toko/lain/',
        // ),
        // 'alert' => array(
        //     'form_ok' => 'Data berhasil disimpan.',
        //     'form_invalid' => 'Kesalahan input pada form. Isi form dengan benar untuk melanjutkan.',
        //     'system_failed' => 'Uups, mohon maaf! Terjadi error. Silahkan coba kembali setelah beberapa saat atau laporkan pada operator kami.',
        //     'cart_update' => 'Keranjang berhasil diubah',
        //     'username_exist' => 'Username sudah dipakai oleh pelanggan lain, silahkan coba gunakan username yang berbeda.',
        //     'username_ok' => 'Username tersedia.',
        //     'register_ok' => 'Terima kasih Anda telah mendaftarkan diri sebagai anggota Jayagrosir.net.<br>
        //         Silahkan cek inbox/spam email untuk mengaktifkan akun Anda melalui link aktifasi yang telah kami kirimkan.',
        //     'email_ok' => 'Pesan email berhasil terkirim. Terima kasih sudah menghubungi kami.',
        //     'email_failed' => 'Pesan email gagal dikirim. Coba beberapa saat lagi atau laporkan pada operator kami.',
        //     'aktifasi_ok' => 'Selamat! Akun Jayagrosir.net milik Anda kini telah aktif.',
        //     'aktifasi_failed' => 'Mohom maaf, link aktifasi Anda salah. Silahkan hubungi operator kami untuk mendapat tindak lanjut.',
        //     'aktifasi_denied' => 'Akun Anda sudah diaktifasi sebelumnya. Untuk masuk ke halaman pelanggan, silahkan coba login melalui halaman ini.',
        //     'order_ok' => 'Barang berhasil ditambahkan pada keranjang',
        //     'order_failed' => 'Uups! Terjadi kesalahan pada proses order barang. Silahkan coba kembali beberapa saat',
        //     'order_mail_sent' => 'Terima kasih atas order Anda. Pesan konfirmasi pemesanan telah kami kirimkan ke alamat email Anda.'
        // ),
        'tahun' => 2014,
        'email' => array(
            'customer' => 'cs@jayagrosir.net',
            'admin' => 'admin@jayagrosir.net',
            'no-reply' => 'noreply@jayagrosir.net',
            'info' => 'info@jayagrosir.net'
        ),
        'kontak' => array(
            'sms-center' => '085-731-71-0407 (sms center)',
            'founder' => '085-731-71-0407',
        ),
        'var' => array(
            'aktifasi_delimiter' => '!',
            'aktifasi_split_to' => 3,
            'link_separator' => '-',
        ),
        'meta' => 'perlengkapan, atribut, pramuka, pns, karate, taekwondo, paskib, paskibra, sekolah, hizbul wathan',
    ),
);