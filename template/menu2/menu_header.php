<div id="navbar" class="navbar navbar-default          ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="index.html" class="navbar-brand" style="text-align: center;">
						<small>
							<i class="fa fa-map"> </i>
							Mentari Computer Bau-Bau <small style="font-size: 11px;text-align: center;"><?php echo " <span class='label label-lg label-success'> Anda Login Sebagai : ".strtoupper($this->session->userdata('level')); ?></small>	
						</small>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<?php if (!empty($this->session->userdata('foto'))): ?>
									<img class="nav-user-photo" src="<?php echo base_url('images/'.$this->session->userdata('foto')); ?> "/>
									<?php else: ?>
									<img class="nav-user-photo" src="<?php echo base_url() ?>images/no_image/user.png" alt="Jason's Photo" />
								<?php endif ?>
								
								<i><?php echo $this->session->userdata('username'); ?></i>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="#">
										<i class="ace-icon fa fa-cog"></i>
										Settings
									</a>
								</li>

								<li>
									<a href="profile.html">
										<i class="ace-icon fa fa-user"></i>
										Profile
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a onclick="return confirm('yakin ingin keluar dari sistem??')" href="<?php echo base_url('login/logout') ?>">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>