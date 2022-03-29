<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="utf-8" />
	<title><?php echo $title; ?></title>
	<meta name="description" content="Static &amp; Dynamic Tables" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
	<!-- bootstrap & fontawesome -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>vendor/dist/css/style.css">
    <script src="<?php echo base_url()?>vendor/dist/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url()?>vendor/dist/js/jquery.migrate.js"></script>
    <script src="<?php echo base_url()?>vendor/dist/js/emoji.min.js"></script>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url()?>vendor/dist/password.min.css" />
    <script src="<?php echo base_url()?>vendor/dist/password.min.js"></script>

	<link rel="stylesheet" href="<?php echo base_url() ?>vendor/css/jquery-ui.custom.min.css" />
	<link rel="stylesheet" href="<?php echo base_url() ?>vendor/css/chosen.min.css" />

	<link rel="stylesheet" href="<?php echo base_url() ?>vendor/css/bootstrap-colorpicker.min.css" />
	<link rel="stylesheet" href="<?php echo base_url() ?>vendor/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo base_url() ?>vendor/font-awesome/4.5.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="<?php echo base_url() ?>vendor/css/fonts.googleapis.com.css" />
	<link rel="stylesheet" href="<?php echo base_url() ?>vendor/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
	<link rel="stylesheet" href="<?php echo base_url() ?>vendor/css/ace-skins.min.css" />
	<link rel="stylesheet" href="<?php echo base_url() ?>vendor/css/ace-rtl.min.css" />
	<script src="<?php echo base_url() ?>vendor/js/ace-extra.min.js"></script>

	<style type="text/css">
		th,td{
			text-align: center;
		}

#my-grid th {
	border-color:#C9DCEA;
	background-color: #deeffc; 
	background-color: -moz-linear-gradient(top,  #deeffc 0%, #d7e6f2 100%); 
	background-color: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#deeffc), color-stop(100%,#d7e6f2)); 
	background-color: -webkit-linear-gradient(top,  #deeffc 0%,#d7e6f2 100%); 
	background-color: -o-linear-gradient(top,  #deeffc 0%,#d7e6f2 100%); 
	background-color: -ms-linear-gradient(top,  #deeffc 0%,#d7e6f2 100%); 
	background-color: linear-gradient(to bottom,  #deeffc 0%,#d7e6f2 100%); 
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#deeffc', endColorstr='#d7e6f2',GradientType=0 ); 
}

.judul-transaksi {
	margin-top: 5px;
	margin-bottom: 15px;
}

.table-responsive {
	overflow: hidden;
}

.alert {
	margin-bottom: 0px;
}

#daftar-autocomplete { 
	list-style:none; 
	margin:0; 
	padding:0; 
	width:100%;
}

#daftar-autocomplete li {
	padding: 5px 10px 5px 10px; 
	background:#FAFAFA; 
	border-bottom:#ddd 1px solid;
}

#daftar-autocomplete li:hover,
#daftar-autocomplete li.autocomplete_active { 
	background:#2a84ae; 
	color:#fff; 
	cursor: pointer;
}

#hasil_pencarian{ 
	padding: 0px; 
	display: none; 
	position: absolute; 
	max-height: 350px;
	overflow: auto;
	border:1px solid #ddd;
	z-index: 1;
}

.TotalBayar {
	text-align: right;
	margin-bottom: 20px;
}

.TotalBayar h2 {
	margin-top: 0px;
	margin-bottom: 0px;
}

.info_pelanggan {
	margin-bottom: 0px;
}

.info_pelanggan td {
	padding: 2px;
	text-align: left;
}

#LoadingDulu {
	position: fixed;
	top:0px;
	width: 100%;
	z-index: 1;
}

#LoadingContent {
	height: 30px;
	margin: auto;
	width: 180px;
	background: #ff005e;
	text-align: center;
	line-height: 29px;
	font-weight: bold;
	color: #fff;
}

	</style>


	    <script type="text/javascript">
        jQuery(document).ready(function($) {
          // emojis 😁! See #password5 for more details
          emojione.imageType = 'svg';
          emojione.sprints = true;
          emojione.imagePathSVGSprites = 'https://github.com/Ranks/emojione/raw/master/assets/sprites/emojione.sprites.svg';

          // Linked to username input
          $('#password').password({
            showPercent: true,
            // minimumLength: 6,
            enterPass: emojione.unicodeToImage('<span style="color:red;">Masukan Type password anda 🔜'),
            shortPass: emojione.unicodeToImage('<span style="color:red;">Kemanan Terlalu pendek 🤕'),
            badPass: emojione.unicodeToImage('<span style="color:red;">Kemanan kurang Baik! 😷'),
            goodPass: emojione.unicodeToImage('<span style="color:red;">Keamanan Baik! 👍'),
            strongPass: emojione.unicodeToImage('<span style="color:red;">Kemanan Sangat Baik. 🙃')
          });

          // Custom events (enables button on certain score)
          // Check the readme for a detailed list of events
          $('#submit').attr('disabled', true);
          $('#password').on('password.score', function (e, score) {
            if (score > 39) {
              $('#submit').removeAttr('disabled');
            } else {
              $('#submit').attr('disabled', true);
            }
          });


        });
    </script>
	<script>
		var habiscuy;
		$(document).on({
			ajaxStart: function() { 
				habiscuy = setTimeout(function(){
					$("#LoadingDulu").html("<div id='LoadingContent'><i class='fa fa-spinner fa-spin'></i> Mohon tunggu ....</div>");
					$("#LoadingDulu").show();
				}, 500);
			},
			ajaxStop: function() { 
				clearTimeout(habiscuy);
				$("#LoadingDulu").hide(); 
			}
		});
		</script>
</head>
