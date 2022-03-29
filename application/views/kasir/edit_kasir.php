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
									<form action="<?php echo base_url("kasir/update_kasir/") ?>" method="post" class="form-horizontal form-label-left" novalidate enctype="multipart/form-data">
        
        <?php if (!empty($data)): ?>
                <?php echo form_hidden('id_kasir', $data->id_kasir); ?>
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
            <legend>Edit kasir</legend>

                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">nama kasir <span class="required">*</span>
                        </label>
                        <div class="col-md-9">
                         <?php if (!empty($data)): ?>
                           <?php echo form_input(['name' => 'nama_kasir' ,
                              'class' => 'form-control',
                              'placeholder' => 'nama_kasir',
                              'maxlength' => '100',
                              'required' => 'required',
                              'value' => set_value('nama_kasir', $data->nama_kasir)
                              ]);
                           ?>
                         <?php else: ?>
                           <?php echo form_input(['name' => 'nama_kasir' ,
                              'class' => 'form-control',
                              'placeholder' => 'nama_kasir',
                              'maxlength' => '100',
                              'required' => 'required',
                              'value' => set_value('nama_kasir')
                              ]);
                           ?>
                         <?php endif ?>

                         
                        <div class="col-md-6">
                         <?php echo form_error('nama_kasir','<div class="text-danger">','</div>'); ?>
                       </div>

                        </div>
                      </div>

                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">No telepon <span class="required">*</span>
                        </label>
                        <div class="col-md-9">
                         <?php if (!empty($data)): ?>
                           <?php echo form_input(['name' => 'no_telepon' ,
                              'class' => 'form-control',
                              'placeholder' => 'no_telepon',
                              'maxlength' => '100',
                              'required' => 'required',
                              'value' => set_value('no_telepon', $data->no_telepon)
                              ]);
                           ?>
                         <?php else: ?>
                           <?php echo form_input(['name' => 'no_telepon' ,
                              'class' => 'form-control',
                              'placeholder' => 'no_telepon',
                              'maxlength' => '100',
                              'required' => 'required',
                              'value' => set_value('no_telepon')
                              ]);
                           ?>
                         <?php endif ?>

                         
                        <div class="col-md-6">
                         <?php echo form_error('no_telepon','<div class="text-danger">','</div>'); ?>
                       </div>
                        </div>
                      </div>

                        <div class="item form-group">
                        <label class="control-label col-md-3">Jenis Kelamin <span class="required"></span>
                        </label>
                        <div class="col-md-9">
                         <select name="jk" class="form-control">
  <option value="Laki-laki" <?php if ($data->jk == "Laki-laki") echo "selected='selected'";?>  >Laki-laki</option>
  <option value="Perempuan" <?php if ($data->jk == "Perempuan") echo "selected='selected'";?>  >Perempuan</option>
                          </select>
                         
                        <div class="col-md-6">
                         <?php echo form_error('jk','<div class="text-danger">','</div>'); ?>
                       </div>
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3">Alamat <span class="required"></span>
                        </label>
                        <div class="col-md-9">
                         <?php if (!empty($data)): ?>
                           <?php echo form_input(['name' => 'alamat' ,
                              'class' => 'form-control',
                              'placeholder' => 'no_telepon',
                              'maxlength' => '100',
                              'required' => 'required',
                              'value' => set_value('alamat', $data->alamat)
                              ]);
                           ?>
                         <?php else: ?>
                           <?php echo form_input(['name' => 'alamat' ,
                              'class' => 'form-control',
                              'placeholder' => 'alamat',
                              'maxlength' => '100',
                              'required' => 'required',
                              'value' => set_value('alamat')
                              ]);
                           ?>
                         <?php endif ?>
                         
                        <div class="col-md-9">
                         <?php echo form_error('alamat','<div class="text-danger">','</div>'); ?>
                       </div>
                        </div>
                      </div>
                      
  
                    
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                 
                         
                          <button id="send" type="submit" name="update" class="btn btn-primary"> <span class="glyphicon glyphicon-edit"></span> Edit</button>
                           <a href="<?php echo base_url('kasir/') ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</a>
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
