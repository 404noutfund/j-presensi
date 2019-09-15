<div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Upload Biometri Wajah</h4>
			</div>
			<form enctype="multipart/form-data" action="<?=base_url();?>biometrik_wajah/uploadImage" method="post">
			<div class="modal-body">
					<label style="cursor: pointer;">
						<p style="padding: 8px 12px; background: #eee; border-radius: 4px; border: 1px solid #ccc;">Pilih Gambar</p>
					    <input type="file" name="fileToUpload" id="fileToUpload" onchange="loadFile(event)"/>
			  	</label>
		  	<img id="output" style="width: 180px; height: 140px; display: none;">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
				<button type="submit" class="btn btn-primary">Simpan</button>
			</div>
  	</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    $('#output').css('display', 'block');
  };
</script>