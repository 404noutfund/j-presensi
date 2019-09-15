<?php
$this->view('comp/Loader');
?>

<!-- Navbar -->
<nav class="navbar navbar-fixed-top">
<!-- <nav class="navbar navbar-transparent navbar-fixed-top navbar-color-on-scroll"> -->
	<div class="container">
		<div class="row">
	        <div class="navbar-header" style="margin-left:0">
		    	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-index">
		        	<span class="sr-only">Toggle navigation</span>
		        	<span class="icon-bar"></span>
		        	<span class="icon-bar"></span>
		        	<span class="icon-bar"></span>
		    	</button>
		    	<a href="<?= base_url(); ?>">
		        	<div class="logo-container">
		                <img src="<?= base_url('assets/img/logo/logo-sipreti.png'); ?>" class="pull-left" style="width: 250px;margin-top:10px">
					</div>
		      	</a>
		    </div>

		    <div class="collapse navbar-collapse" id="navigation-index">
		    	<ul class="nav navbar-nav navbar-right" id="nav-right">
			    	<li <?= $active_link == 'index'?'class="active"':'' ?>>
						<a href="<?= base_url() ?>dashboard"><i class="material-icons">dashboard</i> Dashboard</a>
					</li>
					
					<li class="dropdown">
	            		<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
							<span>Laporan</span>
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu dropdown-menu-right">                    	
							<li class="<?= $active_link == 'absensi_2017'?'active':'' ?>">
								<a href="<?= base_url() ?>absensi_2017">Daftar Hadir Pegawai</a>
							</li>
							<li class="<?= $active_link == 'laporan_rekap_perbulan'?'active':'' ?>">
								<a href="<?= base_url() ?>laporan_rekap_perbulan">Rekap Absensi Bulanan</a>
							</li>
							<!-- <li class="<?= $active_link == 'kehadiran'?'active':'' ?>">
								<a href="<?= base_url() ?>kehadiran">Daftar Hadir OPD</a>
							</li> -->
							<li class="<?= $active_link == 'tppns'?'active':'' ?>">
								<a href="<?= base_url() ?>tppns">TPPNS</a>
							</li>
	                    </ul>
					</li>
					<li class="dropdown">
	            		<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
							<span>Manajemen Sistem</span>
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu dropdown-menu-right">                    	
							<li class="<?= $active_link == 'backup_database'?'active':'' ?>">
								<a href="<?= base_url() ?>backup/database">Backup Database</a>
							</li>
							<li class="<?= $active_link == 'backup_aplikasi'?'active':'' ?>">
								<a href="<?= base_url() ?>backup/aplikasi">Backup Aplikasi</a>
							</li>
							<li class="<?= $active_link == 'backup_konfigurasi'?'active':'' ?>">
								<a href="<?= base_url() ?>backup/konfigurasi">Backup Konfigurasi</a>
							</li>
	                    </ul>
					</li>
					<li class="dropdown">
	            		<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
							<span>Master Data</span>
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu dropdown-menu-right"> 
							<li class="<?= $active_link == 'dataabsen'?'active':'' ?>">
								<a href="<?= base_url() ?>dataabsen" class="dropdown-item">Sebaran Absen Pegawai</a>
							</li>                   	
							<li class="<?= $active_link == 'pegawai'?'active':'' ?>">
								<a href="<?= base_url() ?>pegawai" class="dropdown-item">Data Pegawai OPD</a>
							</li>
							<li class="<?= $active_link == 'tambah_peg'?'active':'' ?>">
								<a href="<?= base_url() ?>tambah_peg" class="dropdown-item">Registrasi Serial</a>
							</li>
							<li class="<?= $active_link == 'adminmgnt_2016'?'active':'' ?>">
								<a href="<?= base_url() ?>adminmgnt" class="dropdown-item">Admin SKPD</a>
							</li>
							<li class="<?= $active_link == 'registrasi_shift'?'active':'' ?>">
								<a href="<?= base_url() ?>registrasi_shift" class="dropdown-item">Registrasi Shift</a>
							</li>
							<li class="<?= $active_link == 'emp_schedule'?'active':'' ?>">
								<a href="<?= base_url() ?>emp_schedule">Jam Kerja OPD</a>
							</li>
							<li class="<?= $active_link == 'bobot_jabatan'?'active':'' ?>">
								<a href="<?= base_url() ?>bobot_jabatan">Bobot Jabatan</a>
							</li>
	                    </ul>
					</li>
					<li class="dropdown">
	            		<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
							<span>Olah Data</span>
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu dropdown-menu-right">                    	
							<li class="<?= $active_link == 'manual_absensi'?'active':'' ?>">
								<a href="<?= base_url() ?>transaksi">Manual Absensi</a>
							</li>                  	
							<li class="<?= $active_link == 'upload'?'active':'' ?>">
								<a href="<?= base_url() ?>upload">Upload Data Presensi</a>
							</li>
							<li class="<?= $active_link == 'biometrik_wajah'?'active':'' ?>">
								<a href="<?= base_url() ?>biometrik_wajah">Biometrik Wajah</a>
							</li>
	                    </ul>
					</li>
					<li class="dropdown">
	            		<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
							<span>Pengaturan</span>
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu dropdown-menu-right">                    	
							<li class="<?= $active_link == 'permission'?'active':'' ?>">
								<a href="<?= base_url() ?>permission">Hak Akses</a>
							</li>                  	
							<li class="<?= $active_link == 'device'?'active':'' ?>">
								<a href="<?= base_url() ?>device">Pengaturan Absensi</a>
							</li>                	
							<li class="<?= $active_link == 'pengaturan'?'active':'' ?>">
								<a href="<?= base_url() ?>pengaturan">Pengaturan</a>
							</li>
							<li class="<?= $active_link == 'validasi_rekap'?'active':'' ?>">
								<a href="<?= base_url() ?>validasi_rekap">Validasi Rekap</a>
							</li>                	
							<li class="<?= $active_link == 'harga_jabatan'?'active':'' ?>">
								<a href="<?= base_url() ?>harga_jabatan">Pengaturan Harga Jabatan</a>
							</li>
	                    </ul>
					</li>
	            	<li id="mn_akun" class="dropdown">
	            		<a href="#" class="dropdown-toggle" data-toggle="dropdown" rel="tooltip" title="<img src='assets/img/default_profile.png' class='pp-32 pull-left' style='margin-right:10px'>Anda masuk sebagai:<br><strong>Admin</strong>" data-container="#navigation-index" data-placement="bottom" data-html="true">
							Akun
							<b class="caret"></b>
						</a>
	                	<ul class="dropdown-menu dropdown-menu-right" style="width:220px;overflow:hidden">
	                        <li class="li-akun"><img src="assets/img/default_profile.png" class="img-rounded img-responsive img-raised pull-left pp-64"><h4><?= $session['user_name'] ?></h4><p><small>Administrator</small></p></li>
	                        <li class="divider"></li>
	                        <li class="divider"></li>
	                        <li id="ms_logout"><a href="javascript:void(0)" onclick="logout()"><i class="fa fa-sign-out"></i>&nbsp;&nbsp;Keluar</a></li>
	                    </ul>
	            	</li>

		    	</ul>
		    </div>
		</div>
	</div>
</nav>
<!-- End Navbar -->

<!-- Sart Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					<i class="material-icons">clear</i>
				</button>
				<h4 class="modal-title">Akun Anda</h4>
			</div>
			<div class="modal-body row">
				<div class="col-sm-4">
					<img src="assets/img/pengguna/1.jpg" class="img-rounded img-responsive img-raised" style="width:100%">
				</div>
				<div class="col-sm-8">
					<h4 style="margin-top:0;font-weight:500"><?= $user_sess->username ?> <small>(<?= $user_sess->username ?>)</small></h4>
					<table class="table table-condensed table-nw-f">
					<tr><td>Nama Pengguna</td><td><?= $user_sess->username ?></td></tr>
					<tr><td>Jenis Kelamin</td><td>Laki-laki</td></tr>
					<tr><td>Motto</td><td>isi motto</td></tr>
					<tr><td>Email</td><td><a href="mailto:admin@gmail.com">admin@gmail.com</a></td></tr>
					<tr><td>Tanggal Bergabung</td><td><?=date('j/n/Y H:i:s')?></td></tr>
					<tr><td>Login Terakhir</td><td><?=date('j/n/Y H:i:s')?></td></tr>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<a class="btn btn-success"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Sunting Profil</a>
				<a class="btn btn-danger" href="Logout">Log Out</a>
			</div>
		</div>
	</div>
</div>
<!--  End Modal -->

<script>
$(function() {
	$('#mn_akun > a').on('show.bs.tooltip',function() {
		var elm = $(this).data('bs.tooltip').tip();
		$(elm).find('.tooltip-inner').css({'max-width':'none','white-space':'nowrap'});
		//console.log(elm[0].outerHTML);
		//I hate Bootstrap 3 :"V ngetiknya jadi kepanjangan
	});
	$('.dropdown').on('shown.bs.dropdown',function() {
		$(this).find('> a').tooltip('destroy');
	}).on('hidden.bs.dropdown',function() {
		$(this).find('> a').tooltip();
		$(this).find('[data-toggle="popover"]').popover('hide');
	}).on('click','.dropdown-menu',function(e) {
		e.stopPropagation();
	});
	$('.menu-grup[data-trigger="click"]').on('hidden.bs.popover',function() {
		$(this).trigger('blur');
	});
});
</script>