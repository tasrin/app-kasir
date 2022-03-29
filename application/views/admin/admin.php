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
								Dashboard
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									overview &amp; stats
								</small>
							</h1>
						</div><!-- /.page-header -->
						<div class="row">
							<div class="col-sm-4">
								<div class="infobox infobox-green">
								<div class="infobox-icon">
									<i class="ace-icon fa fa-bar-chart-o"></i>
								</div>

								<div class="infobox-data">
									<span class="infobox-data-number">32</span>
									<div class="infobox-content">Data Barang Masuk</div>
								</div>

								<div class="stat stat-success">78%</div>
								</div>
							</div>
							
							<div class="col-sm-4">
								<div class="infobox infobox-blue">
								<div class="infobox-icon">
									<i class="ace-icon fa fa-signal"></i>
								</div>

								<div class="infobox-data">
									<span class="infobox-data-number">11</span>
									<div class="infobox-content">Data Barang Keluar</div>
								</div>

								<div class="badge badge-success">
									+32%
									<i class="ace-icon fa fa-arrow-up"></i>
								</div>
							 </div>
							</div>

							<div class="col-sm-4">
							 <div class="infobox infobox-pink">
								<div class="infobox-icon">
									<i class="ace-icon fa fa-users"></i>
								</div>

								<div class="infobox-data">
									<span class="infobox-data-number">8</span>
									<div class="infobox-content">Jumlah Users</div>
								</div>
								<div class="stat stat-success">84%</div>
							</div>
						</div>
							
						</div>
						
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								
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
