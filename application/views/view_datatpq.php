  <!-- Begin Page Content -->
  <div class="container-fluid">
  	<!-- Page Heading -->
  	<div class="d-sm-flex align-items-center justify-content-between mb-4">
  		<h1 class="h3 mb-0 text-gray-800"><?php echo $title;?></h1>
  	</div>

  	<div class="row">
  		<div class="col-xl-8 col-lg-7">
  			<div class="card shadow mb-4">
  				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
  					<h6 class="m-0 font-weight-bold text-primary">Data Identitas TPQ</h6>
  					<div class="dropdown no-arrow">
  						<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  							<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
  						</a>
  						<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
						  <a class="dropdown-item" href="#EditIdentitas" data-target="#EditIdentitas" data-toggle="modal">Edit</a>
  						</div>
  					</div>
  				</div>
  				<div class="card-body">
				  	<form>
						<div class="form-group">
							<label>Kepala TPQ</label>
							<input type="text" id="kepala_tpq" name="kepala_tpq" class="form-control" disabled>
						</div>
						<div class="form-group">
							<label>Nama TPQ</label>
							<input type="text" id="nama_tpq" name="nama_tpq" class="form-control" disabled>
						</div>
						<div class="form-group">
							<label>NSPP</label>
							<input type="text" id="nspp" name="nspp" class="form-control" disabled>
						</div>
						<div class="form-group">
							<label>Alamat TPQ</label>
							<input type="text" id="alamat_tpq" name="alamat_tpq" class="form-control" disabled>
						</div>
						<div class="form-group">
							<label>Telepon</label>
							<input type="text" id="telp_tpq" name="telp_tpq" class="form-control" disabled>
						</div>
					</form>
  				</div>
  			</div>
  		</div>

  		<div class="col-xl-4 col-lg-5">
  			<div class="card shadow mb-4">
  				<!-- Card Header - Dropdown -->
  				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
  					<h6 class="m-0 font-weight-bold text-primary">Logo TPQ</h6>
  					<div class="dropdown no-arrow">
  						<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  							<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
  						</a>
  						<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
						  <a class="dropdown-item" href="#UploadLogo" data-target="#UploadLogo" data-toggle="modal">Edit</a>
  						</div>
  					</div>
  				</div>
  				<!-- Card Body -->
  				<div class="card-body">
				  <div class="text-center">
				  	<img id="logoTPQ" class="img-fluid">
				  </div>
  				</div>
  			</div>
  		</div>
  	</div>
	</div>

	<div class="modal fade" id="UploadLogo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  		<div class="modal-dialog modal-dialog-centered" role="document">
  			<div class="modal-content">
  				<div class="modal-header">
  					<h5 class="modal-title">Upload Logo TPQ</h5>
  					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  						<span aria-hidden="true">&times;</span>
  					</button>
  				</div>
  				<div class="modal-body">
				<form method='post' enctype="multipart/form-data">
					<div class="form-group">
						<label for="exampleFormControlFile1">Silahkan Pilih Gambar</label>
						<input type='file' name='file1' id='file1' class="form-control-file" >
					</div>
					<div class="form-group">
						<input type='button' class='btn btn-info' value='Upload' id='btn_upload1'>
					</div>
				</form>
  				</div>
  			</div>
  		</div>
	</div>

	<div class="modal fade" id="EditIdentitas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  		<div class="modal-dialog modal-dialog-centered" role="document">
  			<div class="modal-content">
  				<div class="modal-header">
  					<h5 class="modal-title">Ubah Identitas TPQ</h5>
  					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  						<span aria-hidden="true">&times;</span>
  					</button>
  				</div>
  				<div class="modal-body">
				  	<form method="POST" id="dataForm">
					  <div class="form-group">
							<label>Kepala TPQ</label>
							<input type="text" id="kepala_tpq1" name="kepala_tpq1" class="form-control">
						</div>
						<div class="form-group">
							<label>Nama TPQ</label>
							<input type="text" id="nama_tpq1" name="nama_tpq1" class="form-control">
						</div>
						<div class="form-group">
							<label>NSPP</label>
							<input type="text" id="nspp1" name="nspp1" class="form-control">
						</div>
						<div class="form-group">
							<label>Alamat TPQ</label>
							<input type="text" id="alamat_tpq1" name="alamat_tpq1" class="form-control">
						</div>
						<div class="form-group">
							<label>Telepon</label>
							<input type="text" id="telp_tpq1" name="telp_tpq1" class="form-control">
						</div>
						<div class="form-group">
							<input type='button' class='btn btn-info' value='Ubah' id='btn_update'>
						</div>
					</form>
  				</div>
  			</div>
  		</div>
	</div>
		  <script type='text/javascript'>
			$(document).ready(function(){
				getKetTPQ();
				$('#btn_upload1').click(function(){
					var fd = new FormData();
					var files = $('#file1')[0].files[0];
					fd.append('file',files);
					$.ajax({
						url: '<?= base_url("DataTPQ/updateLogoTPQ"); ?>',
						type: 'post',
						data: fd,
						contentType: false,
						processData: false,
						success: function(response){
							if(response != 0){
								toastr.success('Data gambar telah diubah!', 'Created!!', { showMethod: 'slideDown', hideMethod: 'slideUp', timeOut: 2000});
							}else{
								wal.fire('Ooppss!!', 'Harap periksa proses upload!', 'error');
							}
							setInterval(function(){ location.reload(); }, 2500);
						}
					});
				});
				$('#btn_update').click(function(){
					if($('#kepala_tpq1').val() == '') {
						Swal.fire('Ooppss!!', 'Mohon Mengisi Nama Kepala TPQ', 'warning');
					}else if($('#nama_tpq1').val() == '') {
						Swal.fire('Ooppss!!', 'Mohon Mengisi Nama TPQ!', 'warning');
					}else if($('#nspp1').val() == '') {
						Swal.fire('Ooppss!!', 'Mohon Mengisi NSPP TPQ!', 'warning');
					}else if($('#alamat_tpq1').val() == '') {
						Swal.fire('Ooppss!!', 'Mohon Mengisi Alamat TQP!', 'warning');
					}else if($('#telp_tpq1').val() == '') {
						Swal.fire('Ooppss!!', 'Mohon Mengisi Telepon TPQ!', 'warning');
					}
					else {
						$.ajax({
						url: '<?= base_url("DataTPQ/updateData"); ?>',
						type: 'POST',
						dataType: 'JSON',
						data: $('#dataForm').serialize(),
						success: function(result) {
							if(result.ping == 200) {
							toastr.success('Data TPQ telah diupdate!', 'Updated!!', { showMethod: 'slideDown', hideMethod: 'slideUp', timeOut: 2000});
							} else {
							Swal.fire('Ooppss!!', 'Harap periksa proses update!', 'error');
							}
							setInterval(function(){ location.reload(); }, 2500);
						}
						});
					}
				});
			});

			function getKetTPQ() {
			$.getJSON('<?= base_url("GetData/getKetTPQ"); ?>', function(data) {
				    file1 = "<?php echo base_url('"+data[0].logo_tpq+"'); ?>";
					$("#logoTPQ").attr("src", file1);
					$('#kepala_tpq').val(data[0].kepala_tpq);
					$('#nama_tpq').val(data[0].nama_tpq);
					$('#nspp').val(data[0].nspp);
					$('#alamat_tpq').val(data[0].alamat_tpq);
					$('#telp_tpq').val(data[0].telp_tpq);

					$('#kepala_tpq1').val(data[0].kepala_tpq);
					$('#nama_tpq1').val(data[0].nama_tpq);
					$('#nspp1').val(data[0].nspp);
					$('#alamat_tpq1').val(data[0].alamat_tpq);
					$('#telp_tpq1').val(data[0].telp_tpq);		
				});
			}
			</script>
