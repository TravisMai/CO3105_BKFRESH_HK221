<?php require_once('./config.php'); ?>
 <!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <link rel="apple-touch-icon" sizes="57x57" href="../images/favicons/sheaf-of-rice.png" height="57" width="57">
    <link rel="apple-touch-icon" sizes="60x60" href="../images/favicons/sheaf-of-rice.png" height="60" width="60">
    <link rel="apple-touch-icon" sizes="72x72" href="../images/favicons/sheaf-of-rice.png" height="72" width="72">
    <link rel="apple-touch-icon" sizes="76x76" href="../images/favicons/sheaf-of-rice.png" height="76" width="76">
    <link rel="apple-touch-icon" sizes="114x114" href="../images/favicons/sheaf-of-rice.png" height="114" width="114">
    <link rel="apple-touch-icon" sizes="120x120" href="../images/favicons/sheaf-of-rice.png" height="120" width="120">
    <link rel="apple-touch-icon" sizes="144x144" href="../images/favicons/sheaf-of-rice.png" height="144" width="144">
    <link rel="apple-touch-icon" sizes="152x152" href="../images/favicons/sheaf-of-rice.png" height="152" width="152">
    <link rel="apple-touch-icon" sizes="180x180" href="../images/favicons/sheaf-of-rice.png" height="180" width="180">
    <link rel="icon" type="image/png" href="../images/favicons/sheaf-of-rice.png" sizes="32x32">
    <link rel="icon" type="image/png" href="../images/favicons/sheaf-of-rice.png" sizes="194x194">
    <link rel="icon" type="image/png" href="../images/favicons/sheaf-of-rice.png" sizes="96x96">
    <link rel="icon" type="image/png" href="../images/favicons/sheaf-of-rice.png" sizes="192x192">
    <link rel="icon" type="image/png" href="../images/favicons/sheaf-of-rice.png" sizes="16x16">
    <link rel="manifest" href="../images/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="../images/favicons/sheaf-of-rice.png">
    <meta name="msapplication-config" content="../images/favicons/browserconfig.xml">
    <meta name="theme-color" content="#66BB6A">
    <link rel="shortcut icon" href="../images/favicons/sheaf-of-rice.png">
    <title>Vfresh | Dự án</title>
    <link rel="canonical" href="./">
</head>
<style>
  #header{
    height:70vh;
    width:calc(100%);
    position:relative;
    top:-1em;
  }
  #header:before{
    content:"";
    position:absolute;
    height:calc(100%);
    width:calc(100%);
    background-image:url(<?= validate_image($_settings->info("cover")) ?>);
    background-size:cover;
    background-repeat:no-repeat;
    background-position: center center;
  }
  #header>div{
    position:absolute;
    height:calc(100%);
    width:calc(100%);
    z-index:2;
  }

  #top-Nav a.nav-link.active {
      color: #343a40;
      font-weight: 900;
      position: relative;
  }
  #top-Nav a.nav-link.active:before {
    content: "";
    position: absolute;
    border-bottom: 2px solid #343a40;
    width: 33.33%;
    left: 33.33%;
    bottom: 0;
  }
  @media (max-width:760px){
    #top-Nav a.nav-link.active {
      background: #343a40db;
      color: #fff;
    }
    #top-Nav a.nav-link.active:before {
      content: "";
      position: absolute;
      border-bottom: 2px solid #343a40;
      width: 100%;
      left: 0;
      bottom: 0;
    }
    h1.w-100.text-center.site-title.px-5{
      font-size:2.5em !important;
    }
  }
</style>
<?php require_once('inc/header.php') ?>
  <body class="layout-top-nav layout-fixed layout-navbar-fixed" style="height: auto;">
    <div class="wrapper">
     <?php $page = isset($_GET['page']) ? $_GET['page'] : 'home';  ?>
     <?php require_once('inc/topBarNav.php') ?>
     <?php if($_settings->chk_flashdata('success')): ?>
      <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
      </script>
      <?php endif;?>    
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper pt-5" style="">
        <?php if($page == "home" || $page == "about"): ?>
          <div id="header" class="shadow mb-4">
              <div class="d-flex justify-content-center h-100 w-50 align-items-left flex-column px-4">
                <div class="banner_txtinner" href="../css/responsive.css">
                    <h1 style="font-family: chivo-regular-webfont; font-weight: bold; " href="../font/chivo-regular-webfont.woff"><span style="color: rgb(0, 0, 0);">Cách mạng hóa chuỗi cung ứng hàng hóa nông sản</span></h1>
                    <h4 style="font-family: chivo-regular-webfont" href="../font/chivo-regular-webfont.woff"><br />Thông qua công nghệ thông tin, chúng tôi kết nối khách hàng đến với các trang trại trên khắp Việt Nam qua hình thức B2B</h4>
                </div>
              </div>
          </div>
        <?php endif; ?>
        <!-- Main content -->
        <section class="content ">
          <div class="container">
            <?php 
              if(!file_exists($page.".php") && !is_dir($page)){
                  include '404.html';
              }else{
                if(is_dir($page))
                  include $page.'/index.php';
                else
                  include $page.'.php';

              }
            ?>
          </div>
        </section>
        <!-- /.content -->
  <div class="modal fade rounded-0" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md modal-dialog-centered rounded-0" role="document">
      <div class="modal-content rounded-0">
        <div class="modal-header rounded-0">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body rounded-0">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade rounded-0" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header rounded-0">
        <h5 class="modal-title">Confirmation</h5>
      </div>
      <div class="modal-body rounded-0">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade rounded-0" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog modal-full-height  modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header rounded-0">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="fa fa-arrow-right"></span>
        </button>
      </div>
      <div class="modal-body rounded-0">
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="viewer_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
              <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
              <img src="" alt="">
      </div>
    </div>
  </div>
      </div>
      <!-- /.content-wrapper -->
      <?php require_once('inc/footer.php') ?>
  </body>
</html>
