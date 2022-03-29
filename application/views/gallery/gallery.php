<?php require_once('template/header2/gallery.php'); ?>

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
									overview &amp; stats
								</small>
							</h1>
						</div><!-- /.page-header -->
						
						<div class="row">
							<div class="col-md-12">
								<!-- PAGE CONTENT BEGINS -->
								<div>
									<ul class="ace-thumbnails clearfix">
										
									<?php foreach ($data as $row) { ?>
										<li>
											<?php if (!empty($row->foto)): ?>
												<a href="<?php echo base_url('images/'.$row->foto)?>" data-rel="colorbox">
												<img width="190" height="150" alt="150x150" src="<?php echo base_url('images/'.$row->foto)?>" />
												<div class="text">
													<div class="inner"><?php echo $row->nama_barang; ?></div>
												</div>
												</a>
											<?php else: ?>
												<a href="<?php echo base_url('images/no_image/1.png')?>" data-rel="colorbox">
												<img width="190" height="150" alt="150x150" src="<?php echo base_url('images/no_image/1.png')?>" />
												<div class="text">
													<div class="inner"><?php echo $row->nama_barang; ?></div>
												</div>
											</a>

											<?php endif ?>
											

											<div class="tools tools-bottom">
												<a href="#">
													<i class="ace-icon fa fa-link"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-paperclip"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-pencil"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-times red"></i>
												</a>
											</div>
										</li>

									<?php } ?>
										
					
									</ul>
								</div><!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->

						</div><!-- /.row -->

					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			
<?php require_once('template/footer2/footer.php'); ?>
	
</div><!-- /.main-container -->

<?php require_once('template/footer2/footer_gallery_js.php'); ?>

	</body>
</html>
