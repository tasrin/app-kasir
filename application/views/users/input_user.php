<div id="modal-table" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header no-padding">
				<div class="table-header" style="text-align: center;">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						<span class="white">&times;</span>
					</button>
					Tambah user
				</div>
			</div>

			<div class="modal-body no-padding">
				<form action="<?php echo base_url('users/add_user') ?>" id="validation-form" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<div class="col-md-12">
								<label>Nama Lengkap</label>
							<input class="form-control" type="text" name="nama" value="<?php echo set_value('nama') ?>" placeholder="Masukan Nama Lengkap" required>
							</div>
							<div class="col-md-12">
								<?php echo form_error('username', '<span class="text-danger">','</span>') ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<label>Username</label>
							<input class="form-control" type="text" name="username" value="<?php echo set_value('username') ?>" placeholder="Masukan Nama user" required>
							</div>
							<div class="col-md-12">
								<?php echo form_error('username', '<span class="text-danger">','</span>') ?>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-md-12">
								<label>Password</label>
							<input class="form-control" type="password" id="password" name="password" value="<?php echo set_value('password'); ?>" placeholder="Ex : 123456789" required>
							</div>
							<div class="col-md-12">
								<?php echo form_error('password', '<span class="text-danger">','</span>') ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<label>Confirm Password</label>
							<input class="form-control" type="password" name="confirm_password" value="<?php echo set_value('confirm_password'); ?>" placeholder="Konfirmasi password" required>
							</div>
							<div class="col-md-12">
								<?php echo form_error('confirm_password', '<span class="text-danger">','</span>') ?>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-12">
								<label>Level</label>
							 <select class="form-control" name="level">
							 	<?php foreach ($level->result() as $row) {
							 		echo "<option value=".$row->id_akses.">".$row->label."</option>";
							 	} ?>
							 </select>
							</div>
							<div class="col-md-12">
								<?php echo form_error('level', '<span class="text-danger">','</span>') ?>
							</div>
						</div>
				

						<div class="form-group">
							<div class="center">
							<input class="btn btn-sm btn-default" type="reset" value="Batal" >
							<input class="btn btn-sm btn-primary" type="submit" id="submit" value="Simpan">
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
	