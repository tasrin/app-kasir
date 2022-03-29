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
									<form action="<?php echo base_url("users/update_user/") ?>" method="post" class="form-horizontal form-label-left" novalidate enctype="multipart/form-data">
        
        <?php if (!empty($data)): ?>
                <?php echo form_hidden('id_user', $data->id_user); ?>
        <?php endif ?>
        <div class="row">
          <div class="col-lg-9">
            <legend>Edit user</legend>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">nama user <span class="required">*</span>
                        </label>
                        <div class="col-md-9">
                         <?php if (!empty($data)): ?>
                           <?php echo form_input(['name' => 'username' ,
                              'class' => 'form-control',
                              'placeholder' => 'username',
                              'maxlength' => '100',
                              'required' => 'required',
                              'value' => set_value('username', $data->username)
                              ]);
                           ?>
                         <?php else: ?>
                           <?php echo form_input(['name' => 'username' ,
                              'class' => 'form-control',
                              'placeholder' => 'username',
                              'maxlength' => '100',
                              'required' => 'required',
                              'value' => set_value('username')
                              ]);
                           ?>
                         <?php endif ?>

                         
                        <div class="col-md-6">
                         <?php echo form_error('username','<div class="text-danger">','</div>'); ?>
                       </div>

                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3">Password Baru</label>
                        <div class="col-md-9">
                        <input class="form-control" type="password" name="password" value="<?php echo set_value('password'); ?>" placeholder="Ex : 123456789" required>
                        <div class="col-md-9 row">
                          <?php echo form_error('password', '<span class="text-danger">','</span>') ?>
                        </div>
                        </div>
                        
                      </div>
                      <div class="form-group">
                       <label class="control-label col-md-3">Konfirmasi Password</label>
                        <div class="col-md-9">
                        <input class="form-control" type="password" name="confirm_password" value="<?php echo set_value('confirm_password'); ?>" placeholder="Konfirmasi password" required>
                        <div class="col-md-9 row">
                          <?php echo form_error('confirm_password', '<span class="text-danger">','</span>') ?>
                        </div>
                        </div>
                        
                      </div>


                       

                        <div class="item form-group">
                        <label class="control-label col-md-3">Level <span class="required"></span>
                        </label>
                        <div class="col-md-9">
                         <select name="level" class="form-control">
                          <?php if (!empty($data->level)) {
                            ?>  
  <option value="admin" <?php if ($data->level == "admin") echo "selected='selected'";?>  >Admin</option>
  <option value="kasir" <?php if ($data->level == "kasir") echo "selected='selected'";?>  >Kasir</option>
                            <?php
                          } else {
                            ?>
                            <option value="admin">Admin</option>
                            <option value="kasir">Kasir</option>
   
                            <?php
                          }
                           ?>
 
                          </select>
                         
                        <div class="col-md-6">
                         <?php echo form_error('jk','<div class="text-danger">','</div>'); ?>
                       </div>
                        </div>
                      </div>

                     
                      
  
                    
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                 
                         
                          <button id="send" type="submit" name="update" class="btn btn-primary"> <span class="glyphicon glyphicon-edit"></span> Edit</button>
                           <a href="<?php echo base_url('users/') ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</a>
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
