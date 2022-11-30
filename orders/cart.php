<style>
    .prod-img {
        width: calc(100%);
        height: auto;
        max-height: 10em;
        object-fit: scale-down;
        object-position: center center
    }

    .cong_tru {
        background-color: #54c577;
        border-color: #54c577;
    }

    .cong_tru:hover {
        background-color: #558b4b;
    }
</style>
<div class="content py-3">
    <div class="card card-outline card-primary rounded-0 shadow-0">
        <div class="card-header">
            <h5 class="card-title">Giỏ hàng của tôi</h5>
        </div>
        <div class="card-body">
            <div id="cart-list">
                <div class="row">
                    <?php
                $gtotal = 0;
                $vendors = $conn->query("SELECT * FROM `vendor_list` where id in (SELECT vendor_id from product_list where id in (SELECT product_id FROM `cart_list` where client_id ='{$_settings->userdata('id')}')) order by `shop_name` asc");
                while ($vrow = $vendors->fetch_assoc()):
                ?>
                    <div class="col-12 border">
                        <span>Người bán: <b>
                                <?= $vrow['code'] . " - " . $vrow['shop_name'] ?>
                            </b></span>
                    </div>
                    <div class="col-12 border p-0">
                        <?php
                    $vtotal = 0;
                    $products = $conn->query("SELECT c.*, p.name as `name`, c.price,p.image_path FROM `cart_list` c inner join product_list p on c.product_id = p.id where c.client_id = '{$_settings->userdata('id')}' and p.vendor_id = '{$vrow['id']}' order by p.name asc");
                    while ($prow = $products->fetch_assoc()):
                        $total = $prow['price'] * $prow['quantity'];
                        $gtotal += $total;
                        $vtotal += $total;
                        ?>
                        <div class="d-flex align-items-center border p-2">
                            <div class="col-2 text-center">
                                <a href="./?page=products/view_product&id=<?= $prow['product_id'] ?>"><img
                                        src="<?= validate_image($prow['image_path']) ?>" alt=""
                                        class="img-center prod-img border bg-gradient-gray"></a>
                            </div>
                            <div class="col-auto flex-shrink-1 flex-grow-1">
                                <h4><b>
                                        <?= $prow['name'] ?>
                                    </b></h4>
                                <div class="d-flex">
                                    <div class="col-auto px-0"><small class="text-muted">Giá: </small></div>
                                    <div class="col-auto px-0 flex-shrink-1 flex-grow-1">
                                        <p class="m-0 pl-3"><small class="text-primary">
                                                <?= format_num($prow['price']) ?>
                                            </small></p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="col-auto px-0"><small class="text-muted">Số lượng: </small></div>
                                    <div class="col-auto">
                                        <div class="" style="width:10em">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend"><button
                                                        class="btn btn-primary min-qty cong_tru"
                                                        data-id="<?= $prow['id'] ?>" type="button"><i
                                                            class="fa fa-minus"></i></button></div>
                                                <input type="text" value="<?= $prow['quantity'] ?>"
                                                    class="form-control text-center" readonly="readonly">
                                                <div class="input-group-append"><button
                                                        class="btn btn-primary plus-qty cong_tru"
                                                        data-id="<?= $prow['id'] ?>" type="button"><i
                                                            class="fa fa-plus"></i></button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto flex-shrink-1 flex-grow-1">
                                        <button class="btn btn-flat btn-outline-danger btn-sm rem_item"
                                            data-id="<?= $prow['id'] ?>"><i class="fa fa-times"></i> Xóa</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 text-right">
                                <?= format_num($total) ?>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                    <div class="col-12 border">
                        <div class="d-flex">
                            <div class="col-9 text-right font-weight-bold text-muted">Tổng</div>
                            <div class="col-3 text-right font-weight-bold">
                                <?= format_num($vtotal) ?>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <div class="col-12 border">
                        <div class="d-flex">
                            <div class="col-9 h4 font-weight-bold text-right text-muted">Tổng đơn</div>
                            <div class="col-3 h4 font-weight-bold text-right">
                                <?= format_num($gtotal) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clear-fix mb-2"></div>
    <div class="text-right">
        <a href="./?page=orders/checkout" class="btn btn-flat btn-primary btn-sm cong_tru"><i
                class="fa fa-money-bill-wave"></i> Thanh toán</a>
    </div>
</div>
<script>
    $(function () {
        $('.plus-qty').click(function () {
            var group = $(this).closest('.input-group')
            var qty = parseFloat(group.find('input').val()) + 1;
            group.find('input').val(qty)
            var cart_id = $(this).attr('data-id')
            var el = $('<div>')
            el.addClass('alert alert-danger')
            el.hide()
            start_loader()
            $.ajax({
                url: _base_url_ + 'classes/Master.php?f=update_cart_qty',
                method: 'POST',
                data: { cart_id: cart_id, quantity: qty },
                dataType: 'json',
                error: err => {
                    console.error(err)
                    alert_toast('An error occurred.', 'error')
                    end_loader()
                },
                success: function (resp) {
                    if (resp.status == 'success') {
                        location.reload()
                    } else if (!!resp.msg) {
                        el.text(resp.msg)
                        $('#msg').append(el)
                        el.show('slow')
                        $('html, body').scrollTop(0)
                    } else {
                        el.text("An error occurred. Please try to refresh this page.")
                        $('#msg').append(el)
                        el.show('slow')
                        $('html, body').scrollTop(0)
                    }
                    end_loader()
                }
            })

        })
        $('.min-qty').click(function () {
            var group = $(this).closest('.input-group')
            if (parseFloat(group.find('input').val()) == 1) {
                return false;
            }
            var qty = parseFloat(group.find('input').val()) - 1;
            group.find('input').val(qty)
            var cart_id = $(this).attr('data-id')
            var el = $('<div>')
            el.addClass('alert alert-danger')
            el.hide()
            start_loader()
            $.ajax({
                url: _base_url_ + 'classes/Master.php?f=update_cart_qty',
                method: 'POST',
                data: { cart_id: cart_id, quantity: qty },
                dataType: 'json',
                error: err => {
                    console.error(err)
                    alert_toast('An error occurred.', 'error')
                    end_loader()
                },
                success: function (resp) {
                    if (resp.status == 'success') {
                        location.reload()
                    } else if (!!resp.msg) {
                        el.text(resp.msg)
                        $('#msg').append(el)
                        el.show('slow')
                        $('html, body').scrollTop(0)
                    } else {
                        el.text("An error occurred. Please try to refresh this page.")
                        $('#msg').append(el)
                        el.show('slow')
                        $('html, body').scrollTop(0)
                    }
                    end_loader()
                }
            })

        })
        $('.rem_item').click(function () {
            _conf("Bạn chắc chắn xóa sản phẩm này khỏi giỏ hàng?", 'delete_cart', [$(this).attr('data-id')])
        })
    })
    function delete_cart($id) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=delete_cart",
            method: "POST",
            data: { id: $id },
            dataType: "json",
            error: err => {
                console.log(err)
                alert_toast("An error occured.", 'error');
                end_loader();
            },
            success: function (resp) {
                if (typeof resp == 'object' && resp.status == 'success') {
                    location.reload();
                } else {
                    alert_toast("An error occured.", 'error');
                    end_loader();
                }
            }
        })
    }
</script>