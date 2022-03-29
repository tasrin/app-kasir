<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">


<?php require_once('template/header/header.php'); ?>
<body>
   <?php require_once('template/navbar/navbar.php'); ?>
    <!-- LOGO HEADER END-->
   <?php require_once('template/menu/menu.php'); ?>
    <!-- MENU SECTION END-->
   
        <div class="container content-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">silahkan Masukkan Username Dan Password Anda Yang benar</h4>

                </div>

            </div>
            <div class="row">
                 <div class="col-md-4">
                        <div class="panel panel-info">
                        <div class="panel-heading">
                           <h4 align="center">Silahkan Anda Login Untuk Masuk Di sistem</h4>
                        </div>
                        <div class="panel-body">
                            <form action="<?php echo base_url('login/login_user') ?>" method="post" novalidate>
                                <?php if ($pesan = $this->session->flashdata('login_response')): ?>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                          <div class="alert alert-danger" role="alert">
                                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <span class="sr-only">Pesan:</span>
                                            <?php echo $pesan; ?>
                                          </div>           
                                        </div>
                                    </div>
                                </div>
                                <?php endif ?>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="text" class="form-control" name="username" id="exampleInputEmail1" placeholder="Enter email" autofocus="" />
                                     <div class="row">
                                         <div class="col-md-12">
                                        <?php echo form_error('username','<div class="text-danger">','</div>'); ?>
                                    </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" />
                                     <div class="row">
                                         <div class="col-md-12">
                                        <?php echo form_error('password','<div class="text-danger">','</div>'); ?>
                                    </div>
                                    </div>
                                  </div>
                                   <div class="form-group">
                                    <input id="" type="submit" value="Login" class="btn btn-lg btn-primary btn-block">
                                  </div>     
                            </form>
                        </div>
                            </div>
                        </div>
         <div class="col-md-8">
                    <div class="alert alert-info">
                        <p style="text-align: justify;">Masukkan username dan password anda yang benar untuk masuk di sistem, anda akan di alihkan di halaman admin jika validasi telah berhasil.</p>
                         <strong> Langkah-langkah untuk masuk di halaman sistem sebagai berikut  :</strong>
                        <ol>
                            <li>
                                Jika Belum Memilik Hak Akses..Anda Meminta hak akses kepada admin dulu untuk masuk.
                            </li>
                            <li>
                                jika anda telah di beri akses atau sudah memiliki akun ,,silhkan masukan username dan password anda.
                            </li>
                            <li>
                                jika level user anda adalah admin/kasir maka anda akan di bawah kehalaman sistem data admin.
                            </li>
                            <li>
                                jika anda login bukan admin/kasir dan hanya sebagai user biasa maka anda tidak dapat melakukan perubahan data.
                            </li>
                        </ol>
                       
                    </div>
                </div>

            </div>
        </div>
    <!-- CONTENT-WRAPPER SECTION END-->
   <?php include 'template/footer/footer.php'; ?>
   <script src="<?php echo base_url() ?>vendor/dist/jquery.textArea.js"></script>
  <script type="text/javascript">
jQuery(document).ready(function() {

  $("#textarea").textareaCounter({
    txtElem:'textarea',
        charElem:'charCount',
        lineElem:'lineCount',
        progElem:'progress-percent',
        progPerc:'progPercentage',
        txtCount:'100',
        lineCount:'10',
        charPerLine:'20',
  });
});
  </script>

</body>
</html>
