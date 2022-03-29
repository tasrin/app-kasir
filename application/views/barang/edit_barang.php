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
								<!-- PAGE CONTENT BEGINS -->
							<div class="row" style="margin-top: 10px;">
								<div class="col-xs-12">
									<form action="<?php echo base_url("Barang/Update_Barang/") ?>" method="post" class="form-horizontal form-label-left" novalidate enctype="multipart/form-data">
        
        <?php if (!empty($data)): ?>
                <?php echo form_hidden('kd_barang', $data->kd_barang); ?>
        <?php endif ?>
        <div class="row">
          <div class="col-lg-3">
              <legend>Edit Foto</legend>
            <div class="list-group">
            <a href="" class="list-group-item">
            <?php if (!empty($data->foto)): ?>
              
              <img src="<?php echo base_url('images/'.$data->foto) ?>" alt="" style="width: 200px;height: 230px;">
              <?php else: ?>

              <img src="<?php echo base_url('images/user.png') ?>" alt="" style="width: 200px;height: 230px;">
              <?php endif ?>
            </a> 
            
                <?php echo form_upload(['name'=>'foto',
                                        'value'=>set_value('foto'),'id'=>'id-input-file-2']); ?>
            <br>    
             
            </div>
          </div>
          <div class="col-lg-6">
            <legend>Edit Barang</legend>

                       <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12" for="name">nama barang <span class="required">*</span>
                        </label>
                        <div class="col-md-9">
                         <?php if (!empty($data)): ?>
                           <?php echo form_input(['name' => 'nama_barang' ,
                              'class' => 'form-control',
                              'placeholder' => 'nama_barang',
                              'maxlength' => '100',
                              'required' => 'required',
                              'value' => set_value('nama_barang', $data->nama_barang)
                              ]);
                           ?>
                         <?php else: ?>
                           <?php echo form_input(['name' => 'nama_barang' ,
                              'class' => 'form-control',
                              'placeholder' => 'nama_barang',
                              'maxlength' => '100',
                              'required' => 'required',
                              'value' => set_value('nama_barang')
                              ]);
                           ?>
                         <?php endif ?>

                         
                        <div class="col-md-6">
                         <?php echo form_error('nama_barang','<div class="text-danger">','</div>'); ?>
                       </div>

                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12" for="name">Jumlah Barang <span class="required">*</span>
                        </label>
                        <div class="col-md-9">
                         <?php if (!empty($data)): ?>
                           <?php echo form_input(['name' => 'jumlah_barang' ,
                              'class' => 'form-control',
                              'placeholder' => 'jumlah_barang',
                              'maxlength' => '100',
                              'required' => 'required',
                              'value' => set_value('jumlah_barang', $data->jumlah_barang)
                              ]);
                           ?>
                         <?php else: ?>
                           <?php echo form_input(['name' => 'nama_barang' ,
                              'class' => 'form-control',
                              'placeholder' => 'jumlah_barang',
                              'maxlength' => '100',
                              'required' => 'required',
                              'value' => set_value('jumlah_barang')
                              ]);
                           ?>
                         <?php endif ?>

                         
                        <div class="col-md-6">
                         <?php echo form_error('jumlah_barang','<div class="text-danger">','</div>'); ?>
                       </div>

                        </div>
                      </div>


                        <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12" for="name">harga_satuan <span class="required">*</span>
                        </label>
                        <div class="col-md-9">
                         <?php if (!empty($data)): ?>
                           <?php echo form_input(['name' => 'harga_satuan' ,
                              'class' => 'form-control',
                              'placeholder' => 'harga_satuan',
                              'maxlength' => '100',
                              'required' => 'required',
                              'value' => set_value('harga_satuan', $data->harga_satuan)
                              ]);
                           ?>
                         <?php else: ?>
                           <?php echo form_input(['name' => 'harga_satuan' ,
                              'class' => 'form-control',
                              'placeholder' => 'harga_satuan',
                              'maxlength' => '100',
                              'required' => 'required',
                              'value' => set_value('harga_satuan')
                              ]);
                           ?>
                         <?php endif ?>

                         
                        <div class="col-md-6">
                         <?php echo form_error('harga_satuan','<div class="text-danger">','</div>'); ?>
                       </div>
                        </div>
                      </div>
  
                    
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                 
                         
                          <button id="send" type="submit" name="update" class="btn btn-primary"> <span class="glyphicon glyphicon-edit"></span> Edit</button>
                           <a href="<?php echo base_url('barang/') ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</a>
                        </div>
                      </div>

                    </form>
									
								</div><!-- /.span -->
							</div><!-- /.row -->

								
					
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
	
		<?php require_once('template/footer2/footer.php'); ?>

		</div><!-- /.main-container -->

		<?php require_once('template/footer2/footer_datatables.php'); ?>

	</body>
</html>
