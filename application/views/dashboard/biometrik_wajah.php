
<div class="row bb">
	<div class="col-lg-8">
		<form method='post' action="" class="form-inline">
			<div class="container">
				<div class="row">
					<label>Data Pegawai :</label>
					<input type="text" name="search_pegawai" placeholder="Cari pegawai Berdasarkan Nama / NIP" class="form-control" style="width: 250px; margin-bottom: 0px; margin-left: 15px;">
					<button type="submit" class="btn btn-primary" id="btn-search" style="margin-left: 15px;">Submit</button>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="row bb">
	<div class="col-lg-8">
		<div class="thumbnail" style="height: 200px;">
			<div class="caption">
				<div>
					<div class="pull-right">
						<img class="img-responsive" src="<?= base_url().'assets/img/default_profile.png'; ?>" style="width: 170px">
					</div>
				</div>
				<div>
					<p>
						<label style="width: 50px;">NIP</label> 
						<label>: 1234567890</label>
					</p>
					<p>
						<label style="width: 50px;">NAMA</label>
						<label>: MUHAMMAD ALI, SPd</label>
					</p>
					<p>
						<label style="width: 50px;">SKPD</label>
						<label>: DINAS KESEHATAN</label>
					</p>
					<p>
						<label style="width: 70px;">PANGKAT</label>
						<label>: IV/A</label>
					</p>
					<p>
						<label style="width: 70px;">JABATAN</label>
						<label>: SEKRETARIS</label>
					</p>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="thumbnail" style="height:200px;">
			<div class="caption text-center" style="margin-top: 35px;">
			<!-- <form enctype="multipart/form-data">
				<label style="cursor: pointer;">
					<p><span class="fa fa-camera" style="font-size: 50px;"></span></p>
					<p style="padding: 8px 12px; background: #eee; border-radius: 4px; border: 1px solid #ccc;">Ambil Gambar</p>
				    <input type="file" name="fileToUpload" id="fileToUpload"/>
			  	</label>
			  </form> -->
			  <p><span class="fa fa-camera" style="font-size: 50px;"></span></p>
			  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#exampleModal">Ambil Gambar</button>
			  <p>Foto 1 Tampak Depan</p>
			</div>
		</div>
	</div>
</div>

<div id="screenshot" style="text-align:center;">
	<video class="videostream" autoplay></video>
	<img id="screenshot-img">
	<p>
		<button class="capture-button">Capture Video</button>
		<button id="screenshot-button" disabled>Take screenshot</button>
	</p>
</div>

<div class="row">
	<div class="col-lg-12" style="margin-top: 20px;">
		<label>Hasil Gambar Foto</label><br>
		<label>1/12</label><br><br>
	</div>
	<div class="col-lg-2">
		<div class="thumbnail" style="height: 140px">
			<img src="" class="img-rounded">
			<div class="caption text-center">
				Tp. Depan
			</div>
		</div>
	</div>
	<div class="col-lg-2">
		<div class="thumbnail" style="height: 140px">
			<img src="" class="img-rounded">
			<div class="caption text-center">
				Tp. Depan
			</div>
		</div>
	</div>
	<div class="col-lg-2">
		<div class="thumbnail" style="height: 140px">
			<img src="" class="img-rounded">
			<div class="caption text-center">
				Tp. Depan
			</div>
		</div>
	</div>
	<div class="col-lg-2">
		<div class="thumbnail" style="height: 140px">
			<img src="" class="img-rounded">
			<div class="caption text-center">
				Tp. smpg kiri
			</div>
		</div>
	</div>
	<div class="col-lg-2">
		<div class="thumbnail" style="height: 140px">
			<img src="" class="img-rounded">
			<div class="caption text-center">
				Tp. smpg kiri
			</div>
		</div>
	</div>
	<div class="col-lg-2">
		<div class="thumbnail" style="height: 140px">
			<img src="" class="img-rounded">
			<div class="caption text-center">
				Tp. smpg kiri
			</div>
		</div>
	</div>
	<div class="col-lg-2">
		<div class="thumbnail" style="height: 140px">
			<img src="" class="img-rounded">
			<div class="caption text-center">
				Tp. smpg Kanan
			</div>
		</div>
	</div>
	<div class="col-lg-2">
		<div class="thumbnail" style="height: 140px">
			<img src="" class="img-rounded">
			<div class="caption text-center">
				Tp. smpg Kanan
			</div>
		</div>
	</div>
	<div class="col-lg-2">
		<div class="thumbnail" style="height: 140px">
			<img src="" class="img-rounded">
			<div class="caption text-center">
				Tp. smpg Kanan
			</div>
		</div>
	</div>
	<div class="col-lg-2">
		<div class="thumbnail" style="height: 140px">
			<img src="" class="img-rounded">
			<div class="caption text-center">
				Tp. Blkg
			</div>
		</div>
	</div>
	<div class="col-lg-2">
		<div class="thumbnail" style="height: 140px">
			<img src="" class="img-rounded">
			<div class="caption text-center">
				Tp. Blkg
			</div>
		</div>
	</div>
	<div class="col-lg-2">
		<div class="thumbnail" style="height: 140px">
			<img src="" class="img-rounded">
			<div class="caption text-center">
				Tp. Blkg
			</div>
		</div>
	</div>
</div>
<script src="<?=base_url()?>assets/js/main.js"></script>