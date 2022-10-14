<?php require_once('../config.php') ?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <link rel="apple-touch-icon" sizes="57x57" href="../../images/favicons/sheaf-of-rice.png" height="57" width="57">
    <link rel="apple-touch-icon" sizes="60x60" href="../../images/favicons/sheaf-of-rice.png" height="60" width="60">
    <link rel="apple-touch-icon" sizes="72x72" href="../../images/favicons/sheaf-of-rice.png" height="72" width="72">
    <link rel="apple-touch-icon" sizes="76x76" href="../../images/favicons/sheaf-of-rice.png" height="76" width="76">
    <link rel="apple-touch-icon" sizes="114x114" href="../../images/favicons/sheaf-of-rice.png" height="114" width="114">
    <link rel="apple-touch-icon" sizes="120x120" href="../../images/favicons/sheaf-of-rice.png" height="120" width="120">
    <link rel="apple-touch-icon" sizes="144x144" href="../../images/favicons/sheaf-of-rice.png" height="144" width="144">
    <link rel="apple-touch-icon" sizes="152x152" href="../../images/favicons/sheaf-of-rice.png" height="152" width="152">
    <link rel="apple-touch-icon" sizes="180x180" href="../../images/favicons/sheaf-of-rice.png" height="180" width="180">
    <link rel="icon" type="image/png" href="../../images/favicons/sheaf-of-rice.png" sizes="32x32">
    <link rel="icon" type="image/png" href="../../images/favicons/sheaf-of-rice.png" sizes="194x194">
    <link rel="icon" type="image/png" href="../../images/favicons/sheaf-of-rice.png" sizes="96x96">
    <link rel="icon" type="image/png" href="../../images/favicons/sheaf-of-rice.png" sizes="192x192">
    <link rel="icon" type="image/png" href="../../images/favicons/sheaf-of-rice.png" sizes="16x16">
    <link rel="manifest" href="../../images/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="../../images/favicons/sheaf-of-rice.png">
    <meta name="msapplication-config" content="../../images/favicons/browserconfig.xml">
    <meta name="theme-color" content="#66BB6A">
    <link rel="shortcut icon" href="../../images/favicons/sheaf-of-rice.png">
    <title>Vfresh | Người bán</title>
    <link rel="canonical" href="./">
</head>
 <?php require_once('inc/header.php') ?>
<body class="hold-transition login-page">
  <script>
    start_loader()
  </script>
  <style>
      body{
          width:calc(100%);
          height:calc(100%);
          background-image:url('<?= validate_image($_settings->info('cover')) ?>');
          background-repeat: no-repeat;
          background-size:cover;
      }
      #logo-img{
          width:15em;
          height:15em;
          object-fit:scale-down;
          object-position:center center;
      }
      #system_name{
        color:#fff;
        text-shadow: 3px 3px 3px #000;
      }
  </style>
   <?php if($_settings->chk_flashdata('success')): ?>
      <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
      </script>
    <?php endif;?>
  <div class="clear-fix my-2"></div>
<div class="login-box">

  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="./login.php" class="h1"><b>Trang người bán</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Đăng nhập để tiếp tục</p>

      <form id="vlogin-frm" action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" autofocus placeholder="Tên đăng nhập">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Mật khẩu">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row align-item-end">
          <div class="col-8">
            <a href="<?= base_url ?>">Quay về trang chủ</a>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Đăng nhập</button>
          </div>
          <div class="col-12 text-center">
          <a href="<?= base_url.'vendor/register.php' ?>">Tạo tài khoản</a>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->

      <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p> -->
      
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<script>
  $(function(){
    end_loader();
    $('#vlogin-frm').submit(function(e){
        e.preventDefault();
        var _this = $(this)
            $('.err-msg').remove();
        var el = $('<div>')
            el.addClass("alert err-msg")
            el.hide()
        if(_this[0].checkValidity() == false){
            _this[0].reportValidity();
            return false;
            }
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Login.php?f=login_vendor",
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            dataType: 'json',
            error:err=>{
                console.error(err)
                el.addClass('alert-danger').text("An error occured");
                _this.prepend(el)
                el.show('.modal')
                end_loader();
            },
            success:function(resp){
                if(typeof resp =='object' && resp.status == 'success'){
                    location.href= './login.php';
                }else if(resp.status == 'failed' && !!resp.msg){
                    el.addClass('alert-danger').text(resp.msg);
                    _this.prepend(el)
                    el.show('.modal')
                }else{
                    el.text("An error occured");
                    console.error(resp)
                }
                $("html, body").scrollTop(0);
                end_loader()

            }
        })
    })
  })
</script>
</body>
</html>