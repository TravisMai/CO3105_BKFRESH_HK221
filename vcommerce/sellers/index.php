<!--?php 
$category_ids = isset($_GET['cids']) ? $_GET['cids'] : 'all';
?>
<div class="content py-3">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-outline rounded-0 card-primary shadow">
                <div class="card-body">
                    <div class="list-group">
                        <div class="list-group-item list-group-item-action">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input custom-control-input-primary custom-control-input-outline cat_all" type="checkbox" id="cat_all" <?= !is_array($category_ids) && $category_ids =='all' ? "checked" : "" ?>>
                                <label for="cat_all" class="custom-control-label"> Tất cả</label>
                            </div>
                        </div>
                        <?php 
                        $categories = $conn->query("SELECT * FROM `vendor_list` where delete_flag = 0 and status = 1 order by `id` asc ");
                        while($row = $categories->fetch_assoc()):
                        ?>
                        <div class="list-group-item list-group-item-action">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input custom-control-input-primary custom-control-input-outline cat_item" type="checkbox" id="cat_item<?= $row['id'] ?>" <?= in_array($row['id'],explode(',',$category_ids)) ? "checked" : '' ?> value="<?= $row['id'] ?>">
                                <label for="cat_item<?= $row['id'] ?>" class="custom-control-label"> <?= $row['shop_name'] ?></label>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="col-md-8">
            <div class="card card-outline card-primary shadow rounded-0">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row justify-content-center mb-3">
                            <div class="col-lg-8 col-md-10 col-sm-12">
                                <form action="" id="search-frm">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text">Tìm kiếm</span></div>
                                        <input type="search" id="search" class="form-control" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
                                        <div class="input-group-append"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row" id="product_list">
                            <?php 
                            $swhere = "";
                            if(!empty($category_ids)):
                            if($category_ids !='all'){
                                $swhere = " and p.category_id in ({$category_ids}) ";
                            }
                            if(isset($_GET['search']) && !empty($_GET['search'])){
                                $swhere .= " and (v.contact LIKE '%{$_GET['search']}%' or v.tax_id LIKE '%{$_GET['search']}%' or v.email LIKE '%{$_GET['search']}%' or v.shop_owner LIKE '%{$_GET['search']}%' or v.shop_name LIKE '%{$_GET['search']}%') ";
                            }

                            $products = $conn->query("SELECT DISTINCT v.*, s.name as shop_type_name, v.id as seller_id FROM `product_list` p inner join vendor_list v on p.vendor_id = v.id inner join shop_type_list s on s.id = v.shop_type_id where v.delete_flag = 0 and v.`status` =1 order by RAND()");
                            while($row = $products->fetch_assoc()):
                            ?>
                            <div class="col-lg-4 col-md-6 col-sm-12 product-item">
                                <a href="./?page=sellers/view_seller&id=<?= $row['seller_id'] ?>" class="card shadow rounded-0 text-reset text-decoration-none">
                                <div class="product-img-holder position-relative">
                                    <img src="<?= validate_image($row['avatar']) ?>" alt="Product-image" class="img-top product-img bg-gradient-gray">
                                </div>
                                    <div class="card-body border-top border-gray">
                                        <h5 class="card-title text-truncate w-100"><?= $row['shop_name'] ?></h5>
                                        <div class="d-flex w-100">
                                            <div class="col-auto px-0"><small class="text-muted">Chủ doanh nghiệp:&nbsp;  </small></div>
                                            <div class="col-auto px-0 flex-shrink-1 flex-grow-1"><p class="text-truncate m-0"><small class="text-muted"><?= $row['shop_owner'] ?></small></p></div>
                                        </div>
                                        <div class="d-flex">
                                            <div class="col-auto px-0"><small class="text-muted">Mã số thuế:&nbsp;  </small></div>
                                            <div class="col-auto px-0 flex-shrink-1 flex-grow-1"><p class="text-truncate m-0"><small class="text-muted"><?= $row['tax_id'] ?></small></p></div>
                                        </div>
                                        <div class="d-flex">
                                            <div class="col-auto px-0"><small class="text-muted">Chuyên về:&nbsp;  </small></div>
                                            <div class="col-auto px-0 flex-shrink-1 flex-grow-1"><p class="text-truncate m-0"><small class="text-muted"><?= $row['shop_type_name'] ?></small></p></div>
                                        </div>
                                        <div class="d-flex">
                                            <div class="col-auto px-0"><small class="text-muted">Điện thoại:&nbsp;  </small></div>
                                            <div class="col-auto px-0 flex-shrink-1 flex-grow-1"><p class="text-truncate m-0"><small class="text-muted"><?= $row['contact'] ?></small></p></div>
                                        </div>
                                        <div class="d-flex">
                                            <div class="col-auto px-0"><small class="text-muted">Email:&nbsp;  </small></div>
                                            <div class="col-auto px-0 flex-shrink-1 flex-grow-1"><p class="text-truncate m-0"><small class="text-muted"><?= $row['email'] ?></small></p></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php endwhile; ?>
                            <?php else: ?>
                                <div class="col-12 text-center">
                                    Xin chọn ít nhất 1 sản phẩm.
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        if($('#cat_all').is(':checked') == true){
            $('.cat_item').prop('checked',true)
        }
        if($('.cat_item:checked').length == $('.cat_item').length){
            $('#cat_all').prop('checked',true)
        }
        $('.cat_item').change(function(){
            var ids = [];
            $('.cat_item:checked').each(function(){
                ids.push($(this).val())
            })
            location.href="./?page=sellers"
        })
        $('#cat_all').change(function(){
            if($(this).is(':checked') == true){
                $('.cat_item').prop('checked',true)
            }else{
                $('.cat_item').prop('checked',false)
            }
            $('.cat_item').trigger('change')
        })
        $('#search-frm').submit(function(e){
            e.preventDefault()
            var q = "search="+$('#search').val()
            if('<?= !empty($category_ids) && $category_ids !='all' ?>' == 1){
                q += "&cids=<?= $category_ids ?>"
            }
            location.href="./?page=sellers"

        })
    })
</script-->
<?php 
$vendor_ids = isset($_GET['vids']) ? $_GET['vids'] : 'all';
?>
<div class="content py-3">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-outline rounded-0 card-primary shadow">
                <div class="card-body">
                    <div class="list-group">
                        <div class="list-group-item list-group-item-action">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input custom-control-input-primary custom-control-input-outline cat_all" type="checkbox" id="cat_all" <?= !is_array($vendor_ids) && $vendor_ids =='all' ? "checked" : "" ?>>
                                <label for="cat_all" class="custom-control-label"> Tất cả</label>
                            </div>
                        </div>
                        <?php 
                        $vendors = $conn->query("SELECT * FROM `shop_type_list` where delete_flag = 0 and status = 1 order by `name` asc ");
                        while($row = $vendors->fetch_assoc()):
                        ?>
                        <div class="list-group-item list-group-item-action">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input custom-control-input-primary custom-control-input-outline cat_item" type="checkbox" id="cat_item<?= $row['id'] ?>" <?= in_array($row['id'],explode(',',$vendor_ids)) ? "checked" : '' ?> value="<?= $row['id'] ?>">
                                <label for="cat_item<?= $row['id'] ?>" class="custom-control-label"> <?= $row['name'] ?></label>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-outline card-primary shadow rounded-0">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row justify-content-center mb-3">
                            <div class="col-lg-8 col-md-10 col-sm-12">
                                <form action="" id="search-frm">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text" style="background-color:#C7F2A4">Tìm kiếm</span></div>
                                        <input type="search" id="search" class="form-control" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
                                        <div class="input-group-append"><span class="input-group-text" style="background-color:#C7F2A4"><i class="fa fa-search"></i></span></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row" id="product_list">
                            <?php 
                            $swhere = "";
                            if(!empty($vendor_ids)):
                            if($vendor_ids !='all'){
                                $swhere = "in ({$vendor_ids}) ";
                            }
                            if(isset($_GET['search']) && !empty($_GET['search'])){
                                $swhere .= " and (v.shop_name LIKE '%{$_GET['search']}%' or v.shop_owner LIKE '%{$_GET['search']}%' or v.contact LIKE '%{$_GET['search']}%' or v.email LIKE '%{$_GET['search']}%') ";
                            }

                            $sellers = $conn->query("SELECT *, st.name as'shop_type', v.id as 'vendor_id'  FROM `vendor_list` v inner join shop_type_list st on st.id = v.shop_type_id where v.delete_flag = 0 and v.status =1 {$swhere} order by RAND()");
                            while($row = $sellers->fetch_assoc()):
                            ?>
                            <div class="col-lg-4 col-md-6 col-sm-12 product-item">
                                <a href="./?page=sellers/view_seller&id=<?= $row['vendor_id'] ?>" class="card shadow rounded-0 text-reset text-decoration-none">
                                <div class="product-img-holder position-relative">
                                    <img src="<?= validate_image($row['avatar']) ?>" alt="Product-image" class="img-top product-img" style="background-color:#f2faf4">
                                </div>
                                    <div class="card-body border-top border-gray">
                                        <h5 class="card-title text-truncate w-100"><?= $row['shop_name'] ?></h5>
                                        <div class="d-flex w-100">
                                            <div class="col-auto px-0"><small class="text-muted">Chủ doanh nghiệp: &nbsp </small></div>
                                            <div class="col-auto px-0 flex-shrink-1 flex-grow-1"><p class="text-truncate m-0"><small class="text-muted"><?= $row['shop_owner'] ?></small></p></div>
                                        </div>
                                        <div class="d-flex">
                                            <div class="col-auto px-0"><small class="text-muted">Danh mục: &nbsp </small></div>
                                            <div class="col-auto px-0 flex-shrink-1 flex-grow-1"><p class="text-truncate m-0"><small class="text-muted"><?= $row['shop_type'] ?></small></p></div>
                                        </div>
                                        <?php if($_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 3): ?>
                                        <div class="d-flex">
                                            <div class="col-auto px-0"><small class="text-muted">Liên lạc: &nbsp </small></div>
                                            <div class="col-auto px-0 flex-shrink-1 flex-grow-1"><p class="text-truncate m-0"><small class="text-muted"><?= $row['contact'] ?></small></p></div>
                                        </div>
                                        <div class="d-flex">
                                            <div class="col-auto px-0"><small class="text-muted">Email: &nbsp </small></div>
                                            <div class="col-auto px-0 flex-shrink-1 flex-grow-1"><p class="text-truncate m-0"><small class="text-muted"><?= $row['email'] ?></small></p></div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </a>
                            </div>
                            <?php endwhile; ?>
                            <?php else: ?>
                                <div class="col-12 text-center">
                                    Xin chọn ít nhất 1 sản phẩm.
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        if($('#cat_all').is(':checked') == true){
            $('.cat_item').prop('checked',true)
        }
        if($('.cat_item:checked').length == $('.cat_item').length){
            $('#cat_all').prop('checked',true)
        }
        $('.cat_item').change(function(){
            var ids = [];
            $('.cat_item:checked').each(function(){
                ids.push($(this).val())
            })
            location.href="./?page=sellers&vids="+(ids.join(","))
        })
        $('#cat_all').change(function(){
            if($(this).is(':checked') == true){
                $('.cat_item').prop('checked',true)
            }else{
                $('.cat_item').prop('checked',false)
            }
            $('.cat_item').trigger('change')
        })
        $('#search-frm').submit(function(e){
            e.preventDefault()
            var q = "search="+$('#search').val()
            if('<?= !empty($vendor_ids) && $vendor_ids !='all' ?>' == 1){
                q += "&vids=<?= $vendor_ids ?>"
            }
            location.href="./?page=sellers&"+q;

        })
    })
</script>