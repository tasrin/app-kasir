<?php require_once('template/header2/datatables.php'); ?>

<body class="no-skin">
<?php require_once('template/menu2/menu_header.php'); ?>

<?php require_once('template/menu2/menu_atas.php'); ?>
<!-- menu -->
<?php require_once('template/menu2/menu.php'); ?>
<!-- end menu -->

			<div class="main-content">
				<div class="main-content-inner">
					<?php require_once('template/bradcrumb/bradcrumb.php'); ?>

					<div class="page-content">
						<?php require_once('template/menu_setting/settings.php'); ?>

						<div class="page-header">
							<h1>
								<?php echo $title; ?>
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									
								</small>
							</h1>
						</div><!-- /.page-header -->
						<?php if ($pesan = $this->session->flashdata('user_add')) { 
							?>
							 <div class="alert alert-success" align="center">
								<button type="button" class="close" data-dismiss="alert">
									<i class="ace-icon fa fa-times"></i>
								</button>
								<strong><i class="ace-icon fa fa-check"></i>
								Sukses !
								</strong>
								<?php echo $pesan; ?>
							</div>
							<?php
						} elseif($pesan = $this->session->flashdata('user_edit')) {
							?>
							 <div class="alert alert-success" align="center">
								<button type="button" class="close" data-dismiss="alert">
									<i class="ace-icon fa fa-times"></i>
								</button>
								<strong><i class="ace-icon fa fa-check"></i>
								Sukses !
								</strong>
								<?php echo $pesan; ?>
							</div>
							<?php
						}elseif($pesan = $this->session->flashdata('user_delete')) {
							?>
							 <div class="alert alert-success" align="center">
								<button type="button" class="close" data-dismiss="alert">
									<i class="ace-icon fa fa-times"></i>
								</button>
								<strong><i class="ace-icon fa fa-check"></i>
								Sukses !
								</strong>
								<?php echo $pesan; ?>
							</div>
							<?php
						}
						 ?>
						
						
								<a href="#modal-table" role="button" class="btn btn-sm btn-primary" data-toggle="modal"><i class="fa fa-plus"></i> Tambah user</a>
									<a href="<?php echo base_url('user') ?>" role="button" class="btn btn-sm btn-default" target="_blank"><i class="glyphicon glyphicon-print"></i> Cetak user</a>
							
								<!-- PAGE CONTENT BEGINS -->
								<div class="row" style="margin-top: 10px;">
									<div class="col-xs-12">

									
									
										<table id="datatable" class="table  table-bordered table-hover">
											<thead>
												<tr>
													<th>No</th>
													<th>Nama Lengkap</th>
													<th>Username</th>
													<th>Level Caption</th>
													<th>Opsi</th>
												</tr>
											</thead>
					<?php
					$no = 1;
						foreach ($data->result() as $row) { ?>	
												
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $row->nama; ?></td>
						<td><?php echo $row->username; ?></td>
						<td><?php echo $row->level_caption; ?></td>
						<td><center>
                   		<a class="btn btn-sm btn-primary" data-placement="bottom" data-toggle="tooltip" title="Edit Mahasiswa" href="<?php echo base_url("users/Edit_user/".$row->id_user) ?>"><span class="glyphicon glyphicon-edit"></span>
                              </a>
            			<a onclick="return confirm ('Yakin Data <?php echo strtoupper($row->username)?> Ingin Di Hapus.?');" class="btn btn-sm btn-danger tooltips" data-placement="bottom" data-toggle="tooltip" title="Hapus user" href="<?php echo base_url('users/delete_user/'.$row->id_user); ?>"><span class="glyphicon glyphicon-trash"></a>
                            
                            </center>
                        </td>
				</tr>
				<?php
				}

			?>
												

										</table>
									</div><!-- /.span -->
								</div><!-- /.row -->

								<div class="hr hr-18 dotted hr-double"></div>

								

								<?php $this->load->view('users/input_user'); ?>

								<!-- PAGE CONTENT ENDS -->
							
					
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
	
		<?php require_once('template/footer2/footer.php'); ?>

		</div><!-- /.main-container -->
	
		<?php require_once('template/footer2/footer_datatables.php'); ?>

	</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		 $('#datatable').DataTable({
          responsive: true,
                columnDefs: [
                    { responsivePriority: 1, targets: 0 },
                    { responsivePriority: 2, targets: -1 }
                ]
        });
	});
</script>