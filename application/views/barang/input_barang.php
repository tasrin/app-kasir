<div id="modal-table" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header no-padding">
				<div class="table-header" style="text-align: center;">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						<span class="white">&times;</span>
					</button>
					Tambah barang
				</div>
			</div>

			<div class="modal-body no-padding">
				<form action="<?php echo base_url('barang/add_barang') ?>" id="validation-form" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<div class="col-md-12">
								<label>Kode Barang</label>
							<input class="form-control" type="text" name="kd_barang" value="<?php echo set_value('kd_barang') ?>" placeholder="Ex : Kode123" >
							</div>
							<div class="col-md-12">
								<?php echo form_error('kd_barang', '<span class="text-danger">','</span>') ?>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-md-12">
								<label>Nama Barang</label>
							<input class="form-control" type="text" name="nama_barang" value="<?php echo set_value('nama_barang'); ?>" placeholder="Ex : Asus Model C4" >
							</div>
							<div class="col-md-12">
								<?php echo form_error('nama_barang', '<span class="text-danger">','</span>') ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<label>Jumlah Barang</label>
							<input class="form-control" type="text" name="jumlah_barang" value="<?php echo set_value('jumlah_barang'); ?>" placeholder="Masukan Jumlah Barang" >
							</div>
							<div class="col-md-12">
								<?php echo form_error('jumlah_barang', '<span class="text-danger">','</span>') ?>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-12">
								<label>Harga Satuan</label>
							<input class="form-control" type="text" name="harga_satuan" value="<?php echo set_value('harga_satuan'); ?>" placeholder="Ex : 1000000" >
							</div>
							<div class="col-md-12">
								<?php echo form_error('harga_satuan', '<span class="text-danger">','</span>') ?>
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
	