<?php echo form_open('barang/tambah_barang', array('id' => 'FormTambahBarang')); ?>
<div class='form-group'>
	<label>Kode Barang</label>
	<input type='text' name='kd_barang' class='form-control' placeholder="Ex : 12345">
</div>
<div class='form-group'>
	<label>Nama barang</label>
	<input type='text' name='nama_barang' class='form-control'></div>
<div class='form-group'>
	<label>Jumlah Barang</label>
	<input type='text' name='jumlah_barang' class='form-control'>
</div>
<div class='form-group'>
	<label>Harga Satuan</label>
	<input type='text' name='harga_satuan' class='form-control'>
</div>
<div class="form-group">
		<label>Foto</label>
		<?php echo form_upload(['name'=>'foto', 'class'=>'form-control','id'=>'id-input-file-2']); ?>
</div>
<?php echo form_close(); ?>

<div id='ResponseInput'></div>

<script>
function TambahPelanggan()
{
	$.ajax({
		url: $('#FormTambahBarang').attr('action'),
		type: "POST",
		cache: false,
		data: $('#FormTambahBarang').serialize(),
		dataType:'json',
		success: function(json){
			if(json.status == 1)
			{ 
				
				if(document.getElementById('PelangganArea') != null)
				{
					$('#ResponseInput').html('');

					$('.modal-dialog').removeClass('modal-lg');
					$('.modal-dialog').addClass('modal-sm');
					$('#ModalHeader').html('Berhasil');
					$('#ModalContent').html(json.pesan);
					$('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Okay</button>");
					$('#ModalGue').modal('show');
				}
				else
				{
					$('#ResponseInput').html(json.pesan);
					setTimeout(function(){ 
				   		$('#ResponseInput').html('');
				    }, 3000);
					$('#datatable').DataTable().ajax.reload( null, false );
				}
				
			}
			else 
			{
				$('#ResponseInput').html(json.pesan);
			}
		}
	});
}

$(document).ready(function(){
	var Tombol = "<button type='button' class='btn btn-primary' id='SimpanTambahPelanggan'>Simpan Data</button>";
	Tombol += "<button type='button' class='btn btn-default' data-dismiss='modal'>Tutup</button>";
	$('#ModalFooter').html(Tombol);

	$("#FormTambahBarang").find('input[type=text],textarea,select').filter(':visible:first').focus();

	$('#SimpanTambahPelanggan').click(function(e){
		e.preventDefault();
		TambahPelanggan();
	});

	$('#FormTambahBarang').submit(function(e){
		e.preventDefault();
		TambahPelanggan();
	});
});
</script>