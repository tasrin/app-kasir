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

						<?php if ($pesan = $this->session->flashdata('barang_add')) { 
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

						} elseif($pesan = $this->session->flashdata('barang_edit')) {
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
						}elseif($pesan = $this->session->flashdata('barang_delete')) {
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
						
						
								
					<a href="<?php echo base_url('barang/tambah_barang') ?>" id="tambah_barang" role="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i> Tambah Barang</a>
								<!-- PAGE CONTENT BEGINS -->
								<div class="row" style="margin-top: 10px;">
									<div class="col-xs-12">

									
									
										<table id="datatable" class="table table-bordered table-hover nowrap responsive">
											<thead>
												<tr>
													<th>No</th>
													<th>Kode Barang</th>
													<th>Nama barang</th>
													<th>Jumlah barang</th>
													<th>Harga Satuan</th>
													<th>Jumlah * Harga</th>
													<th>Opsi</th>
												</tr>
											</thead>
					<?php
					$no = 1;
						foreach ($data as $row) { ?>	
												
					<tr class="record">
						<td><?php echo $no++; ?></td>
						<td><?php echo strtoupper($row->kd_barang); ?></td>
						<td><?php echo ucwords($row->nama_barang); ?></td>
						<td><?php echo ucwords($row->jumlah_barang); ?></td>
						<td><?php echo "Rp. ".str_replace(',', '.', number_format($row->harga_satuan)); ?></td>
						<td><?php echo "Rp. ".str_replace(',', '.', number_format($row->total_jumlah)); ?></td>
						<td><center>
                   		<a class="btn btn-sm btn-primary" data-placement="bottom" data-toggle="tooltip" title="Edit Mahasiswa" href="<?php echo base_url("barang/Edit_barang/".$row->kd_barang) ?>"><span class="glyphicon glyphicon-edit"></span>
                              </a>
            			<a  onclick="return confirm ('Yakin Data <?php echo $row->nama_barang ?> Ingin Di Hapus.?');" class="btn btn-sm btn-danger tooltips" data-placement="bottom" data-toggle="tooltip" title="Hapus Mahasiswa" href="<?php echo base_url('barang/delete_barang/'.$row->kd_barang); ?>"><span class="glyphicon glyphicon-trash"></a>
                            </center>
                        </td>
				</tr>
				<?php
				}

			?>
			<tr class="record">
				<td colspan="3" style="padding: 15px;"><b>Total</b></td>
				<td colspan="" style="padding: 15px;"><b><?php echo $sum_jumlah->total_jumlah_barang; ?></b></td>
				<td colspan="" style="padding: 15px;"><b><?php echo "Rp. ".str_replace(',', '.', number_format($sum_harga->total_harga)); ?></b></td>
				<td colspan="2"></td>

			</tr>
										</table>
									</div><!-- /.span -->
								</div><!-- /.row -->

								<div class="hr hr-18 dotted hr-double"></div>

								

								<?php $this->load->view('barang/input_barang'); ?>

								<!-- PAGE CONTENT ENDS -->
							
					
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
	
		<?php require_once('template/footer2/footer.php'); ?>

		</div><!-- /.main-container -->
	
		<?php require_once('template/footer2/footer_datatables.php'); ?>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>vendor/js2/datetimepicker/jquery.datetimepicker.css"/>
		<script src="<?php echo base_url(); ?>vendor/js2/datetimepicker/jquery.datetimepicker.js"></script>

	</body>
</html>
<script type="text/javascript">
$('#ModalGue').on('hide.bs.modal', function () {
	   setTimeout(function(){ 
	   		$('#ModalHeader, #ModalContent, #ModalFooter').html('');
	   }, 500);
	});


$(document).ready(function() {
var dataTable = $('#').DataTable( {
			
		} );

 $(".delbutton").click(function(){
 var element = $(this);
 var del_id = element.attr("id");
 var info = 'kd_barang=' + del_id;
 if(confirm("Anda yakin akan menghapus?")){
 var url = "<?php echo base_url('barang/delete_barang/')?>";
 $.ajax({
 type: "POST",
 url : url,
 data: info,
 success: function(){
 }
 });
 
 $(this).parents(".record").animate({ opacity: "hide" }, "slow");
 }
 
 return false;
 });
 
});

$(document).on('click', '#tambah_barang', function(e){
	e.preventDefault();

	$('.modal-dialog').removeClass('modal-sm');
	$('.modal-dialog').removeClass('modal-lg');
	$('#ModalHeader').html('Tambah Barang');
	$('#ModalContent').load($(this).attr('href'));
	$('#ModalGue').modal('show');
});
</script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>vendor/js2/datatables/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>vendor/js2/datatables/js/dataTables.bootstrap.js"></script>