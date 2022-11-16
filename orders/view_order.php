<head>
    <meta charset="utf-8" />
    <title>Review & Rating System in PHP & Mysql using Ajax</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</head>
<?php
require_once('./../config.php');
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT o.*,v.shop_name,v.code as vcode from `order_list` o inner join vendor_list v on o.vendor_id = v.id where o.id = '{$_GET['id']}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
    } else {
?>
<center>Unknown order</center>
<div class="text-right">
    <button class="btn btndefault bg-gradient-dark btn-flat" data-dismiss="modal"><i class="fa fa-times"></i>
        Close</button>
</div>
<?php
        exit;
    }
}
?>
<style>
    #uni_modal .modal-footer {
        display: none
    }

    .prod-img {
        width: calc(100%);
        height: auto;
        max-height: 10em;
        object-fit: scale-down;
        object-position: center center
    }

    .tablecolor {
        background-color: #54c577;
        color: #fff;
    }

    .progress-label-left {
        float: left;
        margin-right: 0.5em;
        line-height: 1em;
    }

    .progress-label-right {
        float: right;
        margin-left: 0.3em;
        line-height: 1em;
    }

    .star-light {
        color: #e9ecef;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-3 border tablecolor"><span class="">Mã đơn</span></div>
        <div class="col-9 border"><span class="font-weight-bolder">
                <?= isset($code) ? $code : '' ?>
            </span></div>
        <div class="col-3 border tablecolor"><span class="">Người bán</span></div>
        <div class="col-9 border"><span class="font-weight-bolder">
                <?= isset($shop_name) ? $vcode . ' - ' . $shop_name : '' ?>
            </span></div>
        <div class="col-3 border tablecolor"><span class="">Địa chỉ giao hàng</span></div>
        <div class="col-9 border"><span class="font-weight-bolder">
                <?= isset($delivery_address) ? $delivery_address : '' ?>
            </span></div>
        <div class="col-3 border tablecolor"><span class="">Trạng thái</span></div>
        <div class="col-9 border"><span class="font-weight-bolder">
                <?php
                $status = isset($status) ? $status : '';
                switch ($status) {
                    case 0:
                        echo '<span class="badge badge-secondary bg-gradient-secondary px-3 rounded-pill">Đang chờ</span>';
                        break;
                    case 1:
                        echo '<span class="badge badge-primary bg-gradient-primary px-3 rounded-pill">Xác nhận</span>';
                        break;
                    case 2:
                        echo '<span class="badge badge-info bg-gradient-info px-3 rounded-pill">Đóng gói</span>';
                        break;
                    case 3:
                        echo '<span class="badge badge-warning bg-gradient-warning px-3 rounded-pill">Đang giao</span>';
                        break;
                    case 4:
                        echo '<span class="badge badge-success bg-gradient-success px-3 rounded-pill">Đã giao</span>';
                        break;
                    case 5:
                        echo '<span class="badge badge-danger bg-gradient-danger px-3 rounded-pill">Đã hủy</span>';
                        break;
                    default:
                        echo '<span class="badge badge-light bg-gradient-light border px-3 rounded-pill">N/A</span>';
                        break;
                }
                ?>
        </div>
    </div>
    <div class="clear-fix mb-2"></div>
    <div id="order-list" class="row">
        <?php
        $gtotal = 0;
        $products = $conn->query("SELECT o.*, p.name as `name`, p.price,p.image_path FROM `order_items` o inner join product_list p on o.product_id = p.id where o.order_id='{$id}' order by p.name asc");
        while ($prow = $products->fetch_assoc()):
            $total = $prow['price'] * $prow['quantity'];
            $gtotal += $total;
        ?>
        <div class="col-12 border">
            <div class="d-flex align-items-center p-2">
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
                        <div class="col-auto px-0 flex-shrink-1 flex-grow-1">
                            <p class="m-0 pl-3"><small class="text-primary">
                                    <?= format_num($prow['quantity']) ?>
                                </small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($status == 4): ?>
        <div class="col-12 border">
            <div class="modal-header">
                <h5 class="modal-title">Viết nhận xét sản phẩm</h5>
            </div>
            <div class="modal-body">
                <h4 class="text-center mt-2 mb-4">
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                </h4>
                <div class="form-group">
                    <input type="text" name="user_name" id="user_name" class="form-control"
                        placeholder="Enter Your Name" />
                </div>
                <div class="form-group">
                    <textarea name="user_review" id="user_review" class="form-control"
                        placeholder="Type Review Here"></textarea>
                </div>
                <div class="form-group text-center mt-4">
                    <button type="button" class="btn btn-primary" id="save_review"
                        style="background-color:#54c577; border-color: #54c577;">Nhận xét</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php endwhile; ?>
<div class="col-12 border">
    <div class="d-flex">
        <div class="col-9 h4 font-weight-bold text-right text-muted">Tổng</div>
        <div class="col-3 h4 font-weight-bold text-right">
            <?= format_num($gtotal) ?>
        </div>
    </div>
</div>
</div>
<div class="clear-fix mb-3"></div>
<div class="text-right">
    <?php if (isset($status) && $status == 0): ?>
    <button class="btn btn-default bg-gradient-danger text-light btn-sm btn-flat" type="button" id="cancel_order">Hủy
        đơn</button>
    <?php endif; ?>
    <button class="btn btn-default bg-gradient-dark text-light btn-sm btn-flat" type="button" data-dismiss="modal"><i
            class="fa fa-times"></i> Đóng</button>
</div>
</div>
<script>
    $(function () {
        $('#cancel_order').click(function () {
            _conf("Bạn có chắc muốn hủy đơn này?", "cancel_order", ['<?= isset($id) ? $id : '' ?>'])
        })
    })
    function cancel_order($id) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=cancel_order",
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

<script>

$(document).ready(function(){

	var rating_data = 0;

    $('#add_review').click(function(){

        $('#review_modal').modal('show');

    });

    $(document).on('mouseenter', '.submit_star', function(){

        var rating = $(this).data('rating');

        reset_background();

        for(var count = 1; count <= rating; count++)
        {

            $('#submit_star_'+count).addClass('text-warning');

        }

    });

    function reset_background()
    {
        for(var count = 1; count <= 5; count++)
        {

            $('#submit_star_'+count).addClass('star-light');

            $('#submit_star_'+count).removeClass('text-warning');

        }
    }

    $(document).on('mouseleave', '.submit_star', function(){

        reset_background();

        for(var count = 1; count <= rating_data; count++)
        {

            $('#submit_star_'+count).removeClass('star-light');

            $('#submit_star_'+count).addClass('text-warning');
        }

    });

    $(document).on('click', '.submit_star', function(){

        rating_data = $(this).data('rating');

    });

    $('#save_review').click(function(){

        var user_name = $('#user_name').val();

        var user_review = $('#user_review').val();

        if(user_name == '' || user_review == '')
        {
            alert("Please Fill Both Field");
            return false;
        }
        else
        {
            $.ajax({
                url:"submit_rating.php",
                method:"POST",
                data:{rating_data:rating_data, user_name:user_name, user_review:user_review},
                success:function(data)
                {
                    $('#review_modal').modal('hide');

                    load_rating_data();

                    alert(data);
                }
            })
        }

    });

    load_rating_data();

    function load_rating_data()
    {
        $.ajax({
            url:"submit_rating.php",
            method:"POST",
            data:{action:'load_data'},
            dataType:"JSON",
            success:function(data)
            {
                $('#average_rating').text(data.average_rating);
                $('#total_review').text(data.total_review);

                var count_star = 0;

                $('.main_star').each(function(){
                    count_star++;
                    if(Math.ceil(data.average_rating) >= count_star)
                    {
                        $(this).addClass('text-warning');
                        $(this).addClass('star-light');
                    }
                });

                $('#total_five_star_review').text(data.five_star_review);

                $('#total_four_star_review').text(data.four_star_review);

                $('#total_three_star_review').text(data.three_star_review);

                $('#total_two_star_review').text(data.two_star_review);

                $('#total_one_star_review').text(data.one_star_review);

                $('#five_star_progress').css('width', (data.five_star_review/data.total_review) * 100 + '%');

                $('#four_star_progress').css('width', (data.four_star_review/data.total_review) * 100 + '%');

                $('#three_star_progress').css('width', (data.three_star_review/data.total_review) * 100 + '%');

                $('#two_star_progress').css('width', (data.two_star_review/data.total_review) * 100 + '%');

                $('#one_star_progress').css('width', (data.one_star_review/data.total_review) * 100 + '%');

                if(data.review_data.length > 0)
                {
                    var html = '';

                    for(var count = 0; count < data.review_data.length; count++)
                    {
                        html += '<div class="row mb-3">';

                        html += '<div class="col-sm-1"><div class="rounded-circle bg-danger text-white pt-2 pb-2"><h3 class="text-center">'+data.review_data[count].user_name.charAt(0)+'</h3></div></div>';

                        html += '<div class="col-sm-11">';

                        html += '<div class="card">';

                        html += '<div class="card-header"><b>'+data.review_data[count].user_name+'</b></div>';

                        html += '<div class="card-body">';

                        for(var star = 1; star <= 5; star++)
                        {
                            var class_name = '';

                            if(data.review_data[count].rating >= star)
                            {
                                class_name = 'text-warning';
                            }
                            else
                            {
                                class_name = 'star-light';
                            }

                            html += '<i class="fas fa-star '+class_name+' mr-1"></i>';
                        }

                        html += '<br />';

                        html += data.review_data[count].user_review;

                        html += '</div>';

                        html += '<div class="card-footer text-right">On '+data.review_data[count].datetime+'</div>';

                        html += '</div>';

                        html += '</div>';

                        html += '</div>';
                    }

                    $('#review_content').html(html);
                }
            }
        })
    }

});

</script>