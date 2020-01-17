<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="shortcut icon" type="image/png" href="<?php echo base_url() . FAVICON_IMAGE; ?>" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title><?php echo APP_NAME ?></title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <meta name="description" content="<?php echo APP_DESC ?>" />
        <meta name="author" content="<?php echo APP_AUTHOR ?>">

        <link href="<?= base_url('assets_front/') ?>/css/bootstrap.css" rel="stylesheet" />
        <link href="<?= base_url('assets_front/') ?>/css/landing-page.css" rel="stylesheet"/>

        <!--     Fonts and icons     -->
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400,300' rel='stylesheet' type='text/css'>
        <link href="<?= base_url('assets_front/') ?>/css/pe-icon-7-stroke.css" rel="stylesheet" />

    </head>
    <body class="landing-page landing-page1">
        <nav class="navbar navbar-transparent navbar-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button id="menu-toggle" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar bar1"></span>
                    <span class="icon-bar bar2"></span>
                    <span class="icon-bar bar3"></span>
                    </button>
                    <a href="#">
                        <div class="logo-container">
                            <div class="logo">
                                <img src="<?= base_url('assets_front/') ?>/img/new_logo.png" alt="Creative Tim Logo">
                            </div>
                            <div class="brand">
                                Si Umah
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="example" >
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="<?= site_url('auth/login') ?>">
                                <i class="	fa fa-sign-in"></i>
                                    Login
                                </a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
        </nav>
        <div class="wrapper">
            <div class="parallax filter-gradient blue" data-color="blue">
                <div class="parallax-background">
                    <img class="parallax-background-image" src="<?= base_url('assets_front/') ?>/img/template/bg3.jpg">
                </div>
                <div class= "container">
                    <div class="row">
                        
                        <div class="col-md-12  text-center">
                            <br>

                            <div class="description">
                                <h3>Selamat Datang di </h3>
                                <h2>Sistem Informasi Rumah Tidak Layak Huni.</h2>
                                <h5>Dinas Perumahan dan Permukiman Kabupaten Konawe Utara</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section section-gray section-clients">
                <div class="container  text-sm-center text-xs-center text-md-center text-xl-center">
                    <!-- <h4 class="header-text">Friends in high places</h4> -->
                    <p>
                        Si Umah Adalah Sistem informasi yang membantu Dinas Perumahan dan Permukiman Kabupaten Konawe Utara dalam pengelolaan penerimaan bantuan Rumah TIdak Layak Huni ( RTLH )
                    </p>
                </div>
            </div>
            <div class="section section-presentation">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="description ">
                                <h4 class="">SELAMAT TINGGAL PROPOSAL</h4>
                                <p class="text-justify" >Aplikasi Si Umah Memangkas kegiatan dimana tiap-tiap desa harus membuat proposal terlebih dahulu untuk mengajukan permintaan bantuan rumah tidak layak huni</p>
                                <p>
                            </div>
                        </div>
                        <div class="col-md-5 col-md-offset-1 ">
                            <img src="<?= base_url('assets_front/') ?>/img/template/mac.png" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-gray section section-demo">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div id="description-carousel" class="carousel fade" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="item">
                                        <img src="<?= base_url('assets_front/') ?>/img/template/examples/1.PNG" alt="">
                                    </div>
                                    <div class="item active">
                                        <img src="<?= base_url('assets_front/') ?>/img/template/examples/2.PNG" alt="">
                                    </div>
                                    <div class="item">
                                        <img src="<?= base_url('assets_front/') ?>/img/template/examples/3.PNG" alt="">
                                    </div>
                                </div>
                                <ol class="carousel-indicators carousel-indicators-blue hidden">
                                    <li data-target="#description-carousel" data-slide-to="0" class=""></li>
                                    <li data-target="#description-carousel" data-slide-to="1" class="active"></li>
                                    <li data-target="#description-carousel" data-slide-to="2" class=""></li>
                                </ol>
                            </div>
                        </div>
                        <div class="col-md-5 col-md-offset-1">
                            <h4 class="">DATA VALID DAN TEREKAM</h4>
                            <p class="text-justify" >
                                Dengan adanya aplikasi ini, Dinas Perumahan dan Permukiman Kabupaten Konawe Utara mendapatkan data yang valid sehingga pemberian bantuan jadi lebih efektif dan dapat menghindari terjadinya tumpang tindih bantuan sehingga tercapai penyetaraan penerimaan bantuan
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section section-features">
                <div class="container">
                    <h4 class="header-text text-center">Fitur</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card card-blue">
                                <div class="icon">
                                    <i class="pe-7s-note2"></i>
                                </div>
                                <div class="text">
                                    <h4>Pendataan Rumah Tidak Layak Huni</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-blue">
                                <div class="icon">
                                    <i class="pe-7s-albums"></i>
                                </div>
                                <h4>Generate Laporan Verifikasi</h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-blue">
                                <div class="icon">
                                    <i class="pe-7s-diskette"></i>
                                </div>
                                <h4>Rekam penerimaan Bantuan Rumah Tidak Layak Huni</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section section-testimonial">
                <div class="container">
                    <h4 class="header-text text-center">Testimoni</h4>
                    <div id="carousel-example-generic" class="carousel fade" data-ride="carousel">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <div class="mask">
                                    <img src="<?= base_url('assets_front/') ?>/img/faces/face-4.png">
                                </div>
                                <div class="carousel-testimonial-caption">
                                    <p>Bupati Konawe Utara </p>
                                    <h3>"Aplikasi ini sejalan dengan visi Konawe Utara"</h3>
                                </div>
                            </div>
                            <div class="item ">
                                <div class="mask">
                                    <img src="<?= base_url('assets_front/') ?>/img/faces/face-3.png">
                                </div>
                                <div class="carousel-testimonial-caption">
                                    <p>Sekretaris Daerah Konawe Utara</p>
                                    <h3>"Saya mendukung penuh  proyek perubahan ini"</h3>
                                </div>
                            </div>
                            <div class="item ">
                                <div class="mask">
                                    <img src="<?= base_url('assets_front/') ?>/img/faces/face-2.jpeg">
                                </div>
                                <div class="carousel-testimonial-caption">
                                    <p>Kepala Dinas Perumahan</p>
                                    <h3>""</h3>
                                </div>
                            </div>
                        </div>
                        <ol class="carousel-indicators carousel-indicators-blue">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="section section-no-padding">
                <div class="parallax filter-gradient blue" data-color="blue">
                    <div class="parallax-background">
                        <img class ="parallax-background-image" src="<?= base_url('assets_front/') ?>/img/template/bg3.jpg"/>
                    </div>
                    <div class="info">
                        <h1>Pantang Pulang Sebelum Teratapi</h1>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container">
                    <div class="social-area pull-right">
                        <a class="btn btn-social btn-facebook btn-simple">
                        <i class="fa fa-facebook-square"></i>
                        </a>
                        <a class="btn btn-social btn-twitter btn-simple">
                        <i class="fa fa-twitter"></i>
                        </a>
                        <a class="btn btn-social btn-pinterest btn-simple">
                        <i class="fa fa-pinterest"></i>
                        </a>
                    </div>
                    <div class="copyright">
                        &copy; 2019 <a href="#">FIXL Labs</a>
                    </div>
                </div>
            </footer>
        </div>

    </body>
    <script src="<?= base_url('assets_front/') ?>/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="<?= base_url('assets_front/') ?>/js/jquery-ui-1.10.4.custom.min.js" type="text/javascript"></script>
    <script src="<?= base_url('assets_front/') ?>/js/bootstrap.js" type="text/javascript"></script>
    <script src="<?= base_url('assets_front/') ?>/js/awesome-landing-page.js" type="text/javascript"></script>
</html>
