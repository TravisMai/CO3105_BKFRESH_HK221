<style>
    
</style>

<script>
    function resizeIframe(obj) {
      obj.style.height = obj.contentWindow.document.documentElement.scrollHeight + 'px';
    }
</script>

<div class="col-lg-12 py-5">
    <div class="contain-fluid">
        <div class="clear-fix mb-3"></div>
        <h3 class="text-center" style="color:#54c577"><b>Doanh nghiệp</b></h3>
        <center><hr class="w-25"></center>
        <div class="row" id="product_list">
            <?php 
            $products = $conn->query("SELECT DISTINCT v.*, s.name as shop_type_name FROM `product_list` p inner join vendor_list v on p.vendor_id = v.id inner join shop_type_list s on s.id = v.shop_type_id where v.delete_flag = 0 and v.`status` =1 order by RAND() limit 4");
            while($row = $products->fetch_assoc()):
            ?>
            <div class="col-lg-3 col-md-6 col-sm-12 product-item">
                <div class="product-img-holder position-relative">
                    <img src="<?= validate_image($row['avatar']) ?>" alt="Product-image" class="img-top product-img" style="background-color:#f2faf4">
                </div>
                    <div class="card-body border-top border-gray">
                        <h5 class="card-title text-truncate w-100"><?= $row['shop_name'] ?></h5>
                        <div class="d-flex w-100">
                            <div class="col-auto px-0"><small class="text-muted">Chủ doanh nghiệp: &nbsp;  </small></div>
                            <div class="col-auto px-0 flex-shrink-1 flex-grow-1"><p class="text-truncate m-0"><small class="text-muted"><?= $row['shop_owner'] ?></small></p></div>
                        </div>
                        <div class="d-flex">
                            <div class="col-auto px-0"><small class="text-muted">Lĩnh vực: &nbsp;  </small></div>
                            <div class="col-auto px-0 flex-shrink-1 flex-grow-1"><p class="text-truncate m-0"><small class="text-muted"><?= $row['shop_type_name'] ?></small></p></div>
                        </div>
                        <?php if($_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 3): ?>
                        <div class="d-flex">
                            <div class="col-auto px-0"><small class="text-muted">Điện thoại: &nbsp;  </small></div>
                            <div class="col-auto px-0 flex-shrink-1 flex-grow-1"><p class="text-truncate m-0"><small class="text-muted"><?= $row['contact'] ?></small></p></div>
                        </div>
                        <div class="d-flex">
                            <div class="col-auto px-0"><small class="text-muted">Email: &nbsp;  </small></div>
                            <div class="col-auto px-0 flex-shrink-1 flex-grow-1"><p class="text-truncate m-0"><small class="text-muted"><?= $row['email'] ?></small></p></div>
                        </div>
                        <?php endif; ?>
                    </div>
                </a>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>

<div class="col-lg-12 py-5">
    <div class="contain-fluid">
        <div class="clear-fix mb-3"></div>
        <h3 class="text-center" style="color:#54c577"><b>Sản phẩm</b></h3>
        <center><hr class="w-25"></center>
        <div class="row" id="product_list">
            <?php 
            $products = $conn->query("SELECT p.*, v.shop_name as vendor, c.name as `category` FROM `product_list` p inner join vendor_list v on p.vendor_id = v.id inner join category_list c on p.category_id = c.id where p.delete_flag = 0 and p.`status` =1 order by RAND() limit 8");
            while($row = $products->fetch_assoc()):
            ?>
            <div class="col-lg-3 col-md-6 col-sm-12 product-item">
                <a href="./?page=products/view_product&id=<?= $row['id'] ?>" class="card shadow rounded-0 text-reset text-decoration-none">
                <div class="product-img-holder position-relative">
                    <img src="<?= validate_image($row['image_path']) ?>" alt="Product-image" class="img-top product-img"  style="background-color:#f2faf4">
                </div>
                    <div class="card-body border-top border-gray">
                        <h5 class="card-title text-truncate w-100"><?= $row['name'] ?></h5>
                        <div class="d-flex w-100">
                            <div class="col-auto px-0"><small class="text-muted">Người bán: &nbsp  </small></div>
                            <div class="col-auto px-0 flex-shrink-1 flex-grow-1"><p class="text-truncate m-0"><small class="text-muted"><?= $row['vendor'] ?></small></p></div>
                        </div>
                        <div class="d-flex">
                            <div class="col-auto px-0"><small class="text-muted">Danh mục:  &nbsp </small></div>
                            <div class="col-auto px-0 flex-shrink-1 flex-grow-1"><p class="text-truncate m-0"><small class="text-muted"><?= $row['category'] ?></small></p></div>
                        </div>
                        <div class="d-flex">
                            <div class="col-auto px-0"><small class="text-muted">Giá mong muốn:  &nbsp </small></div>
                            <div class="col-auto px-0 flex-shrink-1 flex-grow-1"><p class="m-0 pl-3"><small class="text-primary"><?= format_num($row['price']) ?></small></p></div>
                        </div>
                        <p class="card-text truncate-3 w-100"><?= strip_tags(html_entity_decode($row['description'])) ?></p>
                    </div>
                </a>
            </div>
            <?php endwhile; ?>
        </div>
        <div class="clear-fix mb-2"></div>
        <div class="text-center">
            <a href="./?page=products" class="btn btn-large btn-primary rounded-pill col-lg-3 col-md-5 col-sm-12" style="background-color:#54c577">Khám phá thêm sản phẩm</a>
        </div>
    </div>
</div>

<div class=" py-5">
    <div class="contain-fluid">
        <div class="clear-fix mb-3"></div>
        <h3 class="text-center" style="color:#54c577"><b>BkFresh ở đâu ?</b></h3>
        <center><hr class="w-25"></center>
        <div align="center"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2046.5192422326704!2d106.65690861992293!3d10.772420648932444!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752ec3c161a3fb%3A0xef77cd47a1cc691e!2sHo%20Chi%20Minh%20City%20University%20of%20Technology%20(HCMUT)!5e0!3m2!1sen!2s!4v1665920802261!5m2!1sen!2s" width=100% height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" frameborder="0" scrolling="no" onload="resizeIframe(this)"></iframe></div>
    </div>
</div>