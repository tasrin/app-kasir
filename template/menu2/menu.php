<ul class="nav nav-list">
					<li class="active">
						<a href="<?php echo base_url() ?>">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>

					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-desktop"></i>
							<span class="menu-text">
								Master Data
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="<?php echo base_url('barang') ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Data Barang
								</a>
								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="<?php echo base_url('transaksi') ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Transaksi
								</a>

								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="<?php echo base_url('transaksi/history') ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									History Transaksi
								</a>

								<b class="arrow"></b>
							</li>
						</ul><!-- /.nav-list -->
				</li>
				<li class="">
						<a href="<?php echo base_url('gallery') ?>">
							<i class="menu-icon fa fa-image"></i>
							 Gallery

						</a>
				</li>
				<li class="">
						<a href="<?php echo base_url('users') ?>">
							<i class="menu-icon fa fa-users"></i>
							Data Users
						</a>

						<b class="arrow"></b>
					</li>

					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-book"></i>
							<span class="menu-text"> Laporan </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="<?php echo base_url('laporan/transaksi') ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Penjualan
								</a>

								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="<?php echo base_url('laporan/barang') ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Data Barang
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
</ul>
<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
		<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
</div>
</div>