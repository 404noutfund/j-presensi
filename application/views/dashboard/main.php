<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<title><?=$judul?> | SIPRETI Kota Malang</title>
	<meta name="keywords" content="Sistem Informasi Kepegawaian" />
	<meta name="description" content="Website Sistem Informasi Manajemen ASN Kota Malang">
	<meta name="author" content="CV. JTech">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="theme-color" content="#1962ff">
	<base href="<?=base_url()?>">
	<link rel="shortcut icon" href="<?=base_url()?>assets/img/logo.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?=base_url()?>assets/img/ico/logo.png">
	<link rel="icon" sizes="192x192" href="<?=base_url()?>assets/img/ico/logo.png">

	<!-- Fonts and icons -->
	<link rel="stylesheet" href="<?=base_url()?>assets/iconfonts/material-icons.css" />
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
	<link rel="stylesheet" href="<?=base_url()?>assets/css/font-awesome.min.css" />

	<!-- CSS Files -->
	<link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?=base_url()?>assets/css/material-kit.css" rel="stylesheet"/>
	<link href="<?=base_url()?>assets/css/demo.css" rel="stylesheet" />
	<link href="<?=base_url()?>assets/css/home.css" rel="stylesheet" />

	
	
	<script src="<?=base_url()?>assets/js/jquery.min.js"></script>
	
	<script>const BASE_URL='<?=base_url()?>';</script>
	<link rel="stylesheet" type="text/css" href="plugins/jgrowl/jquery.jgrowl.min.css" />
	<script src="plugins/jgrowl/jquery.jgrowl.min.js"></script>
	<script>
		function jg(content,title) { $.jGrowl(content,{ header:title,position:'bottom-right',life:3000,animateOpen:{height:'show'} }); }
		
	</script>
	<style>
	.navbar-color-on-scroll{
		/*background: linear-gradient(to bottom, rgb(107, 73, 234) 0%, rgb(45, 110, 185) 100%);*/
		background: linear-gradient(-180deg,#f53d2d,#f63);
	}
	.box-body {width:100%}
	.dt-panelmenu,.dt-panelfooter {width:100%}
	.dt-panelmenu {margin:1em 0}
	/*.dataTables_length {float:left}
	.dataTables_length label {display:inline-block}
	.dataTables_filter {float:right}
	.dataTables_paginate {float:right}
	.dataTables_paginate ul li a {padding:8px 12px;background:#ddd;text-decoration:none;margin-left:3px;border-radius:4px;color:#212529}
	.dataTables_paginate ul li.active a {padding:10px 14px;background:#ccc;font-weight:bold}
	.dataTables_paginate ul li a:hover {background:#ccc}
	.dataTables_info {float:left}
	.dataTables_scroll,.dataTable.table {width:100%}
	.dataTables_scroll {border-radius:.5em;box-shadow:0 0 20px -6px rgba(0,0,0,.3),0 0 20px -6px rgba(0,0,0,.3);}
	.dataTables_scrollHead {background:#e2ffef;border-radius:.5em .5em 0 0}
	.dataTables_scrollBody {background:#fff;border-radius:0 0 .5em .5em}
	.dataTables_wrapper {overflow-x:visible}*/
	tr.even{
		background-color: #fff !important;
	}
	.table > tbody td{
		color: #000;
		font-weight: 400;
	}
	.table > thead{
		background-color: #bedeff;
	}
	.table > thead > tr > th {
		vertical-align: bottom;
		border-bottom: 2px solid #ddd;
	}
	input[type=search]{
		border: 1px solid #ddd;
	}
	.input-group .input-group-btn{
		padding:0px !important;
	}

	.form-section{
		border-bottom: 1px solid #ddd;font-weight: 400;
		color: #088c60;
		font-size: 20px;
	}
	.input-group-btn:last-child > .btn, .input-group-btn:last-child > .btn-group {

    z-index: 2;
    margin-left: -1px;
    height: 36px;
    padding-top: 8px;

}
.error-block{
	color: red;

font-size: 12px;

margin-top: 0px;

padding-top: 0px;
}
/*.panel a{
	color: #fff !important;
}*/
.table th{
	background-color: #eee;
}
 .panel-footer {
    background-color: #fdfdfd;
    padding: 0px 10px;
}
.panel-filter .panel-heading{
	background-color: #2b9d72   !important;
}
.panel-filter .panel-heading a{
	color: #fff !important;
}
	.fg-inline {white-space:nowrap}
	.fg-inline .form-group {display:inline-block;margin-right:8px}
	.form-control, .form-group .form-control {background-color:#fff}
	.form-control[readonly],
	.form-control:read-only,
	.form-control:-moz-read-only,
	.form-group .form-control[readonly],
	.form-group .form-control:read-only,
	.form-group .form-control:-moz-read-only {background-color:rgba(0,0,0,.08) !important}
	.modal-backdrop {display:none !important}
	.modal-content .modal-header {

		border-bottom: 1px dashed #ddd;
		padding-top: 24px;
		padding-right: 24px;
		padding-bottom: 10px;
		padding-left: 24px;

	}
	.dropdown-menu li > a {
    margin: 2px !important;
}
	.modal-title {
		margin: 0;
		line-height: 1.42857143;
		color: #5b4da2;
	}
	.table-ti td {white-space:nowrap}
	.table-ti td > * {display:inline-block !important}
	.navbar .navbar-nav > .active > a, .navbar .navbar-nav > .active > a:hover, .navbar .navbar-nav > .active > a:focus {
		color: inherit;
		/*background-color: rgba(255, 255, 255, 0.32);*/
	}
	.form-control[disabled], fieldset[disabled] .form-control, .form-group .form-control[disabled], fieldset[disabled] .form-group .form-control {
		background-image: none;
		border-bottom: 1px dotted #D2D2D2;
		background-color: #cccccc6e;
	}
	.dropdown-menu li > a {
		margin:0px;
		/*padding-right: 0px;*/
	}
	.navbar .navbar-nav > li > .dropdown-menu {

		margin-top: 0;
		width: -moz-max-content;
		max-width: 400px;
		overflow-y: auto;
		overflow-x:hidden;
		max-height: 400px;

	}
	.form-group label{
		font-weight: 500;
	}
	.navbar-transparent .navbar-nav {
		width: 100%;
		margin-top: 30px;
		border-radius: 3px;
		/*background-color: #3c52c4;*/
	}
	.navbar-color-on-scroll:not(.navbar-transparent) .logo-container .logo{
		display: none
	}
	.navbar-color-on-scroll:not(.navbar-transparent) .logo-container .brand .subjudul{
		display: none
	}
	.navbar-color-on-scroll:not(.navbar-transparent) .brand {
		font-size: 25px !important;
		padding-top: 5px;
	}
	.modal.fade.out.in {
		background-color: #27272882;;
	}
	#p_alert p{
		margin-bottom: 0px;
	}

	#div_alert h4{
		border-bottom: 1px solid #b9a2a2;
		margin-bottom: 5px;
		padding-bottom: 5px;
		font-size: 1.6rem;
		padding-left: 0px;
		margin-left: 0px;
		font-weight: 600;
	}
</style>
</head>
<?php flush(); ?>

<body class="index-page">
	<?php echo $modal; ?>

	<?php echo $navbar; ?>

	<div class="wrapper">
		<?php echo $header; ?>
		<div class="main main-raised">
			<div class="section section-basic">
				<div class="container-fluid">
				  <?php if ($active_link != ("detail_registrasi_shift")){ ?>
					<h2><?=$judul?></h2>
					<div class="content-wrapper" style="margin-top:2em">
				  <?php }else{ ?>
					<div class="content-wrapper">
				  <?php } ?>
						<div class="clearfix"></div>
						<?php echo $content; ?>
					</div>

				</div>
			</div>
		</div>
		<?php echo $footer; ?>
	</div>

	<?php echo $loader; ?>

	<!-- Sart Modal -->
	<!--  End Modal -->


	<!--   Core JS Files   ... I hate Bootstrap 3 :"""V Bootstrap 4 yang terbaik dan responsive beneran! -->
	<script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
	<script src="<?=base_url()?>assets/js/material.min.js"></script>

	<!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
	<script src="<?=base_url()?>assets/js/bootstrap-datepicker.js"></script>

	<!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
	<script src="<?=base_url()?>assets/js/material-kit.js"></script>

	<script src="plugins/form/jquery.form.min.js"></script>
	
	<script src="plugins/moment/moment-with-locales.js"></script>

	
	<script src="<?=base_url()?>assets/js/basic.js"></script>
	<script src="<?=base_url()?>assets/js/home.js"></script>
	<!-- <script src="<?=base_url()?>assets/js/form.js"></script> -->
	<script>
		$(document).ready(function(){
			var a = $(".nav.navbar-nav > li >ul > li.active")[0].parentElement.parentElement;
			a.className = 'dropdown active';

		});
		function show_error(res){
			var alert = '';
			for(var key in res.message){
				alert += res.message[key];
			}
			$('#div_alert').show();
			$('#p_alert').html(alert);
			$('html, body').animate({
				scrollTop: ($('body').offset().top)
			},500);
		}

		function fail_delete(){
			jg('<?=dom_img_jg_alert?> Data Gagal Dihapus.','Gagal!');
		}

		function logout(){
			if (!confirm('Apakah Anda Yakin Ingin Logout?')) return false;
			show_loading(0);
			$.ajax({
				type: "POST",
				url: BASE_URL+'login/out',
				contentType: false,
				processData: false,
				dataType: 'json',   
				success: function(res){
					if(res.status == 'success'){
						jg('<?=dom_img_jg_check?> '+res.message,'Sukses!');
						setTimeout(function(){ window.location.href = BASE_URL+'login';hide_loading(); }, 2000);
						
					}else{
						fail_delete();
						hide_loading();
					}
				},
				error: function(){
					fail_delete();
					hide_loading();
				},
			});
		}
		
	</script>
	<?php
		if ($this->session->flashdata('fail')):
		$alert = $this->session->flashdata('fail');
	?>
        <script type="text/javascript">
        	var alert = '<?= $alert ?>';
            jg('<?=dom_img_jg_alert?> '+alert,'Gagal!');
        </script>
  <?php endif; ?>
  <?php
		if ($this->session->flashdata('success')):
		$alert = $this->session->flashdata('success');
	?>
        <script type="text/javascript">
        	var alert = '<?= $alert ?>';
            jg('<?=dom_img_jg_check?> '+alert,'Success!');
        </script>
  <?php endif; ?>
</body>
</html>
