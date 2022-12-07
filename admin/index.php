<?php require_once('../config.php'); ?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
<?php require_once('inc/header.php') ?>

<body class="sidebar-mini layout-fixed control-sidebar-slide-open layout-navbar-fixed sidebar-mini-md sidebar-mini-xs"
  data-new-gr-c-s-check-loaded="14.991.0" data-gr-ext-installed="" style="height: auto;">
  <div class="wrapper">
    <?php require_once('inc/topBarNav.php') ?>
    <?php require_once('inc/navigation.php') ?>

    <?php $page = isset($_GET['page']) ? $_GET['page'] : 'home'; ?>
    <?php if ($_settings->chk_flashdata('success')): ?>
    <script>
      alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
    <?php endif; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper pt-3" style="min-height: 567.854px;">

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <?php
            if (!file_exists($page . ".php") && !is_dir($page)) {
              include '404.html';
            } else {
              if (is_dir($page))
                include $page . '/index.php';
              else
                include $page . '.php';

            }
            ?>
        </div>
      </section>
      <!-- /.content -->

      <div class="modal fade" id="uni_modal" role='dialog'>
        <div class="modal-dialog modal-md modal-dialog-centered rounded-0" role="document">
          <div class="modal-content rounded-0">
            <div class="modal-header rounded-0">
              <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body rounded-0">
            </div>
            <div class="modal-footer rounded-0">
              <button type="button" class="btn btn-sm btn-flat btn-primary" id='submit'
                onclick="$('#uni_modal form').submit()">Lưu</button>
              <button type="button" class="btn btn-sm btn-flat btn-secondary" data-dismiss="modal">Hủy</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="uni_modal_right" role='dialog'>
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
          <div class="modal-content rounded-0">
            <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
            <img src="" alt="">
          </div>
        </div>
      </div>
      <div class="modal fade" id="confirm_modal" role='dialog'>
        <div class="modal-dialog modal-md modal-dialog-centered rounded-0" role="document">
          <div class="modal-content">
            <div class="modal-header rounded-0">
              <h5 class="modal-title">Xác nhận</h5>
            </div>
            <div class="modal-body rounded-0">
              <div id="delete_content"></div>
            </div>
            <div class="modal-footer rounded-0">
              <button type="button" class="btn btn-sm btn-flat btn-primary" id='confirm' onclick="">Tiếp tục</button>
              <button type="button" class="btn btn-sm btn-flat btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-wrapper -->
    <?php require_once('inc/footer.php') ?>
</body>

</html>