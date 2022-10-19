<?php
if(isset($_GET['id']) > 0){
    $qry = $conn->query("SELECT *, st.name as'shop_type', p.name as 'product_name', v.id as 'vendor_id'  FROM `vendor_list` v inner join `product_list` p on p.vendor_id = v.id inner join `shop_type_list` st on st.id = v.shop_type_id where v.delete_flag = 0 and v.id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }else{
        echo "<script> alert('Unkown Product ID.'); location.replace('./?page=sellers') </script>";
        exit;
    }
}else{
    echo "<script> alert('Product ID is required.'); location.replace('./?page=sellers') </script>";
    exit;
}
?>
<style>
    #prod-img-holder {
        height: auto;
        width: 100%;
        overflow: hidden;
    }

    #prod-img {
        object-fit: scale-down;
        height: auto;
        width: 100%;
        transition: transform .3s ease-in;
    }
    #prod-img-holder:hover #prod-img{
        transform:scale(1.5);
    }
    .hah{}
    .hah:hover{
        color:#54c577;
    }
</style>
<div class="content py-3">
    <div class="card card-outline card-primary rounded-0 shadow">
        <div class="card-header">
            <h5 class="card-title"><b>Chi tiết doanh nghiệp</b></h5>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <div id="msg"></div>
                <div class="row">
                    <div class="col-lg-4 col-md-5 col-sm-12 text-center">
                        <div class="position-relative overflow-hidden" id="prod-img-holder">
                            <img src="<?= validate_image(isset($avatar) ? $avatar : "") ?>" alt="<?= $row['avatar'] ?>" id="prod-img" class="img-thumbnail" style="background-color:#f2faf4">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-7 col-sm-12">
                        <h3><b><?= $shop_name ?></b></h3>
                        <div class="d-flex w-100">
                            <div class="col-auto px-0"><small class="text-muted">Chủ doanh nghiệp: &nbsp; </small></div>
                            <div class="col-auto px-0 flex-shrink-1 flex-grow-1"><p class="m-0"><small class="text-muted"><?= $shop_owner ?></small></p></div>
                        </div>
                        <div class="d-flex">
                            <div class="col-auto px-0"><small class="text-muted">Lĩnh vực: &nbsp;  </small></div>
                            <div class="col-auto px-0 flex-shrink-1 flex-grow-1"><p class="m-0"><small class="text-muted"><?= $shop_type ?></small></p></div>
                        </div>
                        <?php if($_settings->userdata('id') <= 0): ?>
                            <a href="<?php echo base_url ?>login.php">
                                <span style="text-decoration: none;
                                    font-size: 17px;
                                    background: #D2001A;
                                    border-radius: 5px;
                                    margin:10px;
                                    color: #fff;
                                    text-decoration: none;
                                    padding: 16px 25px;
                                    display: inline-block;
                                    font-size: 16px;
                                    position: relative;
                                    transition: all ease 0.5s;
                                    -webkit-transition: all ease 0.5s;
                                    -moz-transition: all ease 0.5s;"><i class="	fa fa-times"></i> &nbsp; Đăng nhập để kết nối</span>
                            </a>
                        <?php endif; ?>

                        <?php if($_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 3): ?>
                        <div class="d-flex">
                            <div class="col-auto px-0"><small class="text-muted">Điện thoại: &nbsp; </small></div>
                            <div class="col-auto px-0 flex-shrink-1 flex-grow-1"><p class="m-0"><small class="text-muted"><?= $contact ?></small></p></div>
                        </div>
                        <div class="d-flex">
                            <div class="col-auto px-0"><small class="text-muted">Email: &nbsp; </small></div>
                            <div class="col-auto px-0 flex-shrink-1 flex-grow-1"><p class="m-0"><small class="text-muted"><?= $email ?></small></p></div>
                        </div>
                        <div class="d-flex">
                            <div class="col-auto px-0"><small class="text-muted">Mã số thuế: &nbsp; </small></div>
                            <div class="col-auto px-0 flex-shrink-1 flex-grow-1"><p class="m-0"><small class="text-muted"><?= $tax_id ?></small></p></div>
                        </div>
                        <!--div class="row align-items-end">
                            <div class="col-md-3 form-group">
                                <button class="btn btn-primary btn-flat" type="button" href="../" style="margin:10px; background-color:#54c577"><i class="fa fa-spinner"></i> &nbsp;Kết nối với doanh nghiệp</button>
                            </div>
                        </div-->
                            <a href="<?php echo base_url ?>">
                                <span style="text-decoration: none;
                                    font-size: 17px;
                                    background: #54c577;
                                    border-radius: 5px;
                                    margin:10px;
                                    color: #fff;
                                    text-decoration: none;
                                    padding: 16px 25px;
                                    display: inline-block;
                                    font-size: 16px;
                                    position: relative;
                                    transition: all ease 0.5s;
                                    -webkit-transition: all ease 0.5s;
                                    -moz-transition: all ease 0.5s;"><i class="fa fa-spinner"></i> &nbsp; Bắt đầu kết nối</span>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-4 col-md-7 col-sm-12">
                        <h3><b>Nhà cung cấp có gì?</b></h3>
                        <?php 
                        $products = $conn->query("SELECT p.*, v.shop_name as vendor, c.name as `category` FROM `product_list` p inner join vendor_list v on p.vendor_id = v.id inner join category_list c on p.category_id = c.id where p.delete_flag = 0 and p.`status` =1 and v.id = '{$_GET['id']}'");
                        while($row = $products->fetch_assoc()):
                        ?>
                            <a href="./?page=products/view_product&id=<?= $row['id'] ?>">
                                <h5 class="card-title text-truncate w-100 hah"><i class="fas fa-seedling fa-spin" style="color:#54c577"></i> &nbsp; <?= $row['name'] ?></h5>
                            </a>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function add_to_cart(){
        var pid = '<?= isset($id) ? $id : '' ?>';
        var qty = $('#qty').val();
        var el = $('<div>')
        el.addClass('alert alert-danger')
        el.hide()
        $('#msg').html('')
        start_loader()
        $.ajax({
            url:_base_url_+'classes/Master.php?f=add_to_cart',
            method:'POST',
            data:{product_id:pid,quantity:qty},
            dataType:'json',
            error:err=>{
                console.error(err)
                alert_toast('An error occurred.','error')
                end_loader()
            },
            success:function(resp){
                if(resp.status =='success'){
                    location.reload()
                }else if(!!resp.msg){
                    el.text(resp.msg)
                    $('#msg').append(el)
                    el.show('slow')
                    $('html, body').scrollTop(0)
                }else{
                    el.text("An error occurred. Please try to refresh this page.")
                    $('#msg').append(el)
                    el.show('slow')
                    $('html, body').scrollTop(0)
                }
                end_loader()
            }
        })
    }
    $(function(){
        $('#add_to_cart').click(function(){
            if('<?= $_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 3 ?>'){
                add_to_cart();
            }else{
                location.href = "./login.php"
            }
        })
    })
</script>