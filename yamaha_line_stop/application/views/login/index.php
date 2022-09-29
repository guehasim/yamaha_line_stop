<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Yamaha My Live</title>
  
    <!-- Bootstrap 4.0-->
    <link rel="stylesheet" href="<?=base_url('assets')?>/login/vendor_components/bootstrap/dist/css/bootstrap.min.css">
    
    <!-- Bootstrap extend-->
    <link rel="stylesheet" href="<?=base_url('assets')?>/login/css/bootstrap-extend.css">
    
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url('assets')?>/login/css/master_style.css">

    <!-- skins -->
    <link rel="stylesheet" href="<?=base_url('assets')?>/login/css/skins/_all-skins.css">
    
    <!-- main-nav -->
    <link href="<?=base_url('assets')?>/login/css/main-nav.css" rel="stylesheet" />    

    <!-- toast CSS -->
    <link href="<?=base_url('assets')?>/login/vendor_components/jquery-toast-plugin-master/src/jquery.toast.css" rel="stylesheet">
</head>
<body class="hold-transition bg-img" style="background-image: url(<?=base_url('assets')?>/login/images/bg.jpg)" data-overlay="6">
    
    <div class="auth-2-outer row align-items-center h-p100 m-0">
        <div class="auth-2">

          <div class="auth-logo font-size-30">
            <img src="<?=base_url('assets/login/images/logo.png')?>" alt="" height="100">
          </div>
          <!-- /.login-logo -->
          <div class="auth-body">
            <p class="auth-msg">Please Complete Form To Signin</p>
            <div>
              <?php echo $this->session->flashdata('msg'); ?>
            </div>

            <form action="<?php echo base_url(); ?>login/aksi_login" method="post" class="form-element">
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Enter your username" name="user">
                <span class="ion ion-email form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Enter your password" name="pass">
                <span class="ion ion-locked form-control-feedback"></span>
              </div>
              <div class="row">
                <!-- /.col -->
                <div class="col-12 text-center">
                  <button type="submit" class="btn btn-block mt-10 text-white bg-danger-gradient">SIGN IN</button>
                </div>
                <!-- /.col -->
              </div>
            </form>
          </div>
        </div>
    
    </div>
    

    <!-- jQuery 3 -->
    <script src="<?=base_url('assets')?>/login/vendor_components/jquery-3.3.1/jquery-3.3.1.js"></script>
    
    <!-- popper -->
    <script src="<?=base_url('assets')?>/login/vendor_components/popper/dist/popper.min.js"></script>
    
    <!-- Bootstrap 4.0-->
    <script src="<?=base_url('assets')?>/login/vendor_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- toast -->
    <script src="<?=base_url('assets')?>/login/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
          var notif     = '<?=get_notif()?>';
          var get_report = '<?=get_report()?>';

          if (notif != '') {
              notif = notif.split('#');
              switch (notif[0]) {
                  case 'info':
                      buildNotif('warning', notif[1]);
                      break;
                  case 'success':
                      buildNotif('success', notif[1]);
                      break;
                  case 'error':
                      buildNotif('error', notif[1]);
                      break;
              }
          }

          function buildNotif(colorName, text) {
            $.toast({
                heading: 'Notifications',
                text: text,
                position: 'top-right',
                loaderBg: '#ff6849',
                icon: colorName,
                hideAfter: 3500,
                stack: 6
            });
          }

          if(get_report != '') {
              if(get_report.indexOf('printkwitansi') == -1) {
                 window.open(get_report,'_blank'); 
             }else {
                  window.open(get_report,'_blank');
                  var newreport = get_report.replace('printkwitansi','printlampiran');
                  window.open(newreport,'_blank');
             } 
          }
      });
  </script>

</body>

<!-- Mirrored from hyper-admin-templates.multipurposethemes.com/main-horizontal/pages/auth_login2.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 02 Jan 2019 08:41:45 GMT -->
</html>
