
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>SIPRETI KOTA MALANG</title>
    <!-- <title><?=$judul?> | SIPRETI KOTA MALANG</title> -->
    <meta name="keywords" content="Sistem Informasi, SIM, PDAM, Tirta Patriot, Bekasi" />
    <meta name="description" content="Website Sistem Informasi Manajemen PDAM Tirta Patriot Kota Bekasi">
    <meta name="author" content="Taufik Nur Rahmanda (CV. JTech)">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="theme-color" content="#1962ff">
	<base href="<?=base_url()?>">
    <link rel="shortcut icon" href="assets/img/logo.png">
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/ico/logo76.png">
	<link rel="icon" sizes="192x192" href="<?= base_url('assets/img/ico/logo.png'); ?>">

	<!-- Font CSS (Via CDN) -->
	<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700'>
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700">

	<!-- Theme CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/skin/default_skin/css/theme.css'); ?>">
	<!-- Admin Panels CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/admin-tools/admin-plugins/admin-panels/adminpanels.css'); ?>">
	<!-- Admin Forms CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/admin-tools/admin-forms/css/admin-forms.css'); ?>">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/admin.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/portal.css'); ?>">

	<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>

	<!-- jgrowl -->
	<link rel="stylesheet" href="<?php echo base_url('plugins/jgrowl/jquery.jgrowl.min.css'); ?>" />
	<script src="<?php echo base_url('plugins/jgrowl/jquery.jgrowl.min.js'); ?>"></script>
	<script>
	function jg(content,title) { $.jGrowl(content,{ header:title,position:'bottom-right',life:3000,animateOpen:{height:'show'} }); }
	</script>
</head>
<?php flush(); ?>
<body class="external-page sb-l-c sb-r-c">
<style type="text/css">
    @media (min-width: 770px) {
        .keterangan{
            margin-top: 100px;
        }
    }
</style>

    <!-- Start: Settings Scripts -->
    <script>
        var boxtest = localStorage.getItem('boxed');

        if (boxtest === 'true') {
            document.body.className += ' boxed-layout';
        }
    </script>
    <!-- End: Settings Scripts -->

    <!-- Start: Main -->
    <div id="main" class="animated fadeIn">

        <!-- Start: Content -->
        <section id="content_wrapper">

            <!-- begin canvas animation bg -->
            <div id="canvas-wrapper">
                <canvas id="demo-canvas"></canvas>
            </div>

            <!-- Begin: Content -->
            <section id="content">

                <div class="admin-form theme-orange" id="login1" style="margin-top:40px;">
                    
                    <div class="panel panel-orange mt10 br-n" style="background:none">

                        <div class="panel-heading heading-border bg-white" style="padding-left: 27px;">
                            <div class="section row mn" style="line-height: 1.5;">
								<div class="col-sm-12">
									<a href="./">
									<img src="assets/img/logo_malang.png" class="pull-left" style="margin:0 15px 5px 0" width="50" height="55"/>
									<span class="pull-left" style="margin:5px 10px 0 0;color:#ee4d2d;font-size:17px">
										Sistem Informasi Presensi Terkini <br>
										Pemerintah Kota Malang
									</span>
									</a>
								</div>
                            </div>
                        </div>


						<form id="form_login" method="POST" action="<?= base_url('login/validation')?>">
                            <div class="panel-body bg-light p30">
                                <div class="row">
                                    <div class="col-sm-5 col-sm-push-7 pl30" style="vertical-align:middle" >
                                        <center><h3 style="margin-top:0;"> Selamat Datang di SIPRETI <br/>Kota Malang  </h3></center>
										
                                         <div class="hidden-sm hidden-md hidden-lg" style="height:2em"></div>
									</div>
                                    <div class="col-sm-7 col-sm-pull-5 pr30" style="border-right:1px solid #ddd">

                                        <div class="section">
                                            <label for="username" class="field-label text-muted fs18 mb10">Username</label>
                                            <label for="username" class="field prepend-icon">
                                                <input type="text" name="username" id="username" class="gui-input" placeholder="Isikan Username anda"  autofocus value="BAG121004">
                                                <label for="username" class="field-icon"><i class="fa fa-user"></i>
                                                </label>
                                            </label>
                                        </div>
                                        <!-- end section -->

                                        <div class="section">
                                            <label for="username" class="field-label text-muted fs18 mb10">Password</label>
                                            <label for="password" class="field prepend-icon">
                                                <input type="password" name="password" id="password" class="gui-input" placeholder="Isikan Password Anda" value="MadLion">
                                                <label for="password" class="field-icon"><i class="fa fa-lock"></i>
                                                </label>
                                            </label>
                                        </div>
                                        <!-- end section -->

                                        <div class="section" align="right">
                                            <label for="username" class="field-label text-muted fs18 mb10"><button type="submit" class="button btn-primary">Masuk</button></label>
                                        </div>
                                        <!-- end section -->

                                    </div>
                                </div>
                            </div>
                            <!-- end .form-body section -->
                            <div class="panel-footer clearfix p10 ph15">
                                <label class="switch block switch-primary pull-left input-align mt10">
                                    <input type="checkbox" name="remember" id="remember" checked>
                                    <label for="remember" data-on="YES" data-off="NO"></label>
                                    <span>Tetap masuk</span>
                                </label>
                            </div>
                            <!-- end .form-footer section -->
                        </form>
                    </div>
                </div>

            </section>
            <!-- End: Content -->

        </section>
        <!-- End: Content-Wrapper -->

    </div>
    <!-- End: Main -->
	
	<?php $this->view('comp/LoaderFreeze'); ?>

    <!-- BEGIN: PAGE SCRIPTS -->

    <!-- Bootstrap -->
    <script src="assets/admin/js/bootstrap/bootstrap.min.js"></script>

    <!-- Page Plugins -->
    <script src="assets/admin/js/pages/login/EasePack.min.js"></script>
    <script src="assets/admin/js/pages/login/rAF.js"></script>
    <script src="assets/admin/js/pages/login/TweenLite.min.js"></script>
    <script src="assets/admin/js/pages/login/login.js"></script>

    <!-- Theme Javascript -->
    <script src="assets/admin/js/utility/utility.js"></script>
    <script src="assets/admin/js/main.js"></script>

    <script src="plugins/form/jquery.form.min.js"></script>

    <!-- Page Javascript -->
    <script>
        $(function() {

            "use strict";

            // Init Theme Core      
            Core.init();

            // Init CanvasBG and pass target starting location
            CanvasBG.init({
                Loc: {
                    x: window.innerWidth / 2,
                    y: window.innerHeight / 3.3
                },
            });

        });

        $('#form_login').ajaxForm({
				beforeSubmit: function() {
					show_loading(0);
				},
				"type":"POST",
				"dataType":'json',
				success: function(res) {
					hide_loading();
					if (res.status == "success") {
						window.location.reload();
					}else{
						jg('<?=dom_img_jg_alert?> '+res.message,'Login Gagal!');
					}
				}
			});
    </script>

 <?php
		if ($this->session->flashdata('alert')):
		$alert = $this->session->flashdata('alert');
	?>
        <script type="text/javascript">
            jg('<?=dom_img_jg_alert?> Silakan Login Terlebih Dahulu','Gagal!');
        </script>
  <?php endif; ?>

    <!-- END: PAGE SCRIPTS -->
</body>
</html>
