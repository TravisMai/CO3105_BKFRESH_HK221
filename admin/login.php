<?php require_once('../config.php') ?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
<?php require_once('inc/header.php') ?>

<body class="hold-transition login-page">
  <script>
    start_loader()
  </script>
  <style>
    body {
      width: calc(100%);
      height: calc(100%);
      background-image: url('<?= validate_image($_settings->info('cover')) ?>');
      background-repeat: no-repeat;
      background-size: cover;
    }

    #logo-img {
      width: 15em;
      height: 15em;
      object-fit: scale-down;
      object-position: center center;
    }

    #system_name {
      color: #fff;
      text-shadow: 3px 3px 3px #000;
    }

    a:hover {
      color: #66BB6A;
    }

    .green_btn {
      background: #66BB6A;
      border-radius: 5px;
      color: #fff;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      position: relative;
      overflow: hidden;
    }

    .green_btn_text {
      border-radius: 5px;
      color: #66BB6A;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      position: relative;
      overflow: hidden;
    }

    .green_btn_text:hover {
      opacity: 1;
      -webkit-transform: scale(1, 1);
      transform: scale(1, 1);
      color: #558b4b;
    }

    .green_btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 1;
      opacity: 0;
      background-color: rgba(40, 95, 43, 0.5);
      -webkit-transition: all 0.4s;
      -moz-transition: all 0.4s;
      -o-transition: all 0.4s;
      transition: all 0.4s;
      -webkit-transform: scale(0.5, 1);
      transform: scale(0.5, 1);
    }

    .green_btn:hover::before {
      opacity: 1;
      -webkit-transform: scale(1, 1);
      transform: scale(1, 1);
    }

    .green_btn:hover {
      opacity: 1;
      -webkit-transform: scale(1, 1);
      transform: scale(1, 1);
      background-color: #558b4b;
    }

    .green_btn span {
      position: relative;
      z-index: 2;
    }

    input:hover {
      border-color: #54c577
    }
  </style>
  <div class="clear-fix my-2"></div>
  <div class="login-box">

    <!-- /.login-logo -->
    <div class="card card-outline card-primary" style="border-color:#54c577">
      <div class="card-header text-center">
        <a href="./" class="h1"><b>Quản trị</b></a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Đăng nhập để tiếp tục</p>

        <form id="login-frm" action="" method="post">
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
              <a href="<?= base_url ?>"class="green_btn_text">Quay về trang chủ</a>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat green_btn">Đăng nhập</button>
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
    $(document).ready(function () {
      end_loader();
    })
  </script>
</body>

</html>