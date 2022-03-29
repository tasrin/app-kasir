<div id="modal-table" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header no-padding">
				<div class="table-header" style="text-align: center;">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						<span class="white">&times;</span>
					</button>
					Tambah kasir
				</div>
			</div>

			<div class="modal-body no-padding">
				<form action="<?php echo base_url('kasir/add_kasir') ?>" id="validation-form" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<div class="col-md-12">
								<label>Nama Kasir</label>
							<input class="form-control" type="text" name="nama_kasir" value="<?php echo set_value('nama_kasir') ?>" placeholder="Masukan Nama Kasir" required>
							</div>
							<div class="col-md-12">
								<?php echo form_error('nama_kasir', '<span class="text-danger">','</span>') ?>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-md-12">
								<label>No Telepon</label>
							<input class="form-control" type="text" name="no_telepon" value="<?php echo set_value('no_telepon'); ?>" placeholder="Ex : 123456789" required>
							</div>
							<div class="col-md-12">
								<?php echo form_error('no_telepon', '<span class="text-danger">','</span>') ?>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-12">
								<label>Jenis Kelamin</label>
							 <select class="form-control" name="jk">
							 	<option value="Laki-Laki">Laki-Laki</option>
							 	<option value="Perempuan">Perempuan</option>
							 </select>
							</div>
							<div class="col-md-12">
								<?php echo form_error('jk', '<span class="text-danger">','</span>') ?>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-12">
								<label>Alamat</label>
								<textarea class="form-control" name="alamat" style="resize: none;"></textarea>
							</div>
							<div class="col-md-12">
								<?php echo form_error('jk', '<span class="text-danger">','</span>') ?>
							</div>
						</div>	

						<div class="form-group">
							<div class="col-md-12">
								<label>Foto</label>
								<?php echo form_upload(['name'=>'foto', 'class'=>'form-control','id'=>'id-input-file-2']); ?>
							</div>
						</div>					

						<div class="form-group">
							<div class="center">
							<input class="btn btn-sm btn-default" type="reset" value="Batal" >
							<input class="btn btn-sm btn-primary" type="submit" name="" value="Simpan">
							</div>
						</div>
						
					
				</form>
			</div>

			<div class="modal-footer no-margin-top">
				<button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
					<i class="ace-icon fa fa-times"></i>
					Close
				</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
	