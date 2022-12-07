<?php
$user = $conn->query("SELECT * FROM client_list where id ='" . $_settings->userdata('id') . "'");
foreach ($user->fetch_array() as $k => $v) {
	$$k = $v;
}
?>
<?php if ($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
</script>
<?php endif; ?>

<style>
	#cimg {
		width: 200px;
		height: 200px;
		object-fit: scale-down;
		object-position: center center
	}

	a:hover {
		color: #66BB6A;
	}

	.green_btn {
		background: #66BB6A;
		border-radius: 5px;
		border-color: #54c577;
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
<div class="content py-3"></div>
<div class="card card-outline rounded-0 card-primary shadow" style="border-color:#54c577">
	<div class="card-body">
		<div class="container-fluid">
			<div id="msg"></div>
			<form action="" id="manage-user">
				<input type="hidden" name="id" value="<?php echo $_settings->userdata('id') ?>">
				<div class="row">
					<div class="form-group col-md-4">
						<label for="firstname" class="control-label">Tên</label>
						<input type="text" id="firstname" autofocus name="firstname"
							class="form-control form-control-sm form-control-border"
							value="<?= isset($firstname) ? $firstname : "" ?>" required>
					</div>
					<div class="form-group col-md-4">
						<label for="middlename" class="control-label">Tên lót</label>
						<input type="text" id="middlename" name="middlename"
							class="form-control form-control-sm form-control-border"
							value="<?= isset($middlename) ? $middlename : "" ?>" placeholder="Không bắt buộc">
					</div>
					<div class="form-group col-md-4">
						<label for="lastname" class="control-label">Họ</label>
						<input type="text" id="lastname" name="lastname"
							class="form-control form-control-sm form-control-border"
							value="<?= isset($lastname) ? $lastname : "" ?>" required>
					</div>
					<div class="form-group col-md-4">
						<label for="gender" class="control-label">Giới tính</label>
						<select type="text" id="gender" name="gender"
							class="form-control form-control-sm form-control-border select2" required>
							<option <?= isset($gender) && $gender == "Nam" ? 'selected' : '' ?>>Nam</option>
							<option <?= isset($gender) && $gender == "Nữ" ? 'selected' : '' ?>>Nữ</option>
						</select>
					</div>
					<div class="form-group col-md-4">
						<label for="contact" class="control-label">Điện thoại</label>
						<input type="text" id="contact" name="contact"
							class="form-control form-control-sm form-control-border"
							value="<?= isset($contact) ? $contact : "" ?>" required>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-12">
						<label for="address" class="control-label">Địa chỉ</label>
						<textarea rows="3" id="address" name="address" class="form-control form-control-sm rounded-0"
							required><?= isset($address) ? $address : "" ?></textarea>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-6">
						<label for="email" class="control-label">Email</label>
						<input type="email" id="email" name="email"
							class="form-control form-control-sm form-control-border"
							value="<?= isset($email) ? $email : "" ?>" required>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-6">
						<label for="password" class="control-label">Mật khẩu</label>
						<div class="input-group input-group-sm">
							<input type="password" id="password" name="password"
								class="form-control form-control-sm form-control-border">
							<div
								class="input-group-append bg-transparent border-top-0 border-left-0 border-right-0 rounded-0">
								<span
									class="input-group-text bg-transparent border-top-0 border-left-0 border-right-0 rounded-0">
									<a href="javascript:void(0)" class="text-reset text-decoration-none pass_view"> <i
											class="fa fa-eye-slash"></i></a>
								</span>
							</div>
						</div>
					</div>
					<div class="form-group col-md-6">
						<label for="cpassword" class="control-label">Xác nhận mật khẩu</label>
						<div class="input-group input-group-sm">
							<input type="password" id="cpassword"
								class="form-control form-control-sm form-control-border">
							<div
								class="input-group-append bg-transparent border-top-0 border-left-0 border-right-0 rounded-0">
								<span
									class="input-group-text bg-transparent border-top-0 border-left-0 border-right-0 rounded-0">
									<a href="javascript:void(0)" class="text-reset text-decoration-none pass_view"> <i
											class="fa fa-eye-slash"></i></a>
								</span>
							</div>
						</div>
					</div>
					<small class="text-muted"><i>Giữ nguyên nếu như bạn không muốn thay đổi.</i></small>
				</div>
				<div class="row">
					<div class="form-group col-md-6">
						<label for="logo" class="control-label">Hình ảnh</label>
						<input type="file" id="logo" name="img" class="form-control form-control-sm form-control-border"
							onchange="displayImg(this,$(this))" accept="image/png, image/jpeg">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-6 text-center">
						<img src="<?= validate_image(isset($avatar) ? $avatar : "") ?>" alt="Shop Logo" id="cimg"
							class="border border-gray img-thumbnail">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-6">
						<label for="oldpassword" class="control-label">Mật khẩu hiện tại</label>
						<div class="input-group input-group-sm">
							<input type="password" id="oldpassword" name="oldpassword"
								class="form-control form-control-sm form-control-border" reqiured>
							<div
								class="input-group-append bg-transparent border-top-0 border-left-0 border-right-0 rounded-0">
								<span
									class="input-group-text bg-transparent border-top-0 border-left-0 border-right-0 rounded-0">
									<a href="javascript:void(0)" class="text-reset text-decoration-none pass_view"> <i
											class="fa fa-eye-slash"></i></a>
								</span>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="card-footer text-center">
		<button class="btn btn-sm btn-primary green_btn" form="manage-user">Cập nhật</button>
	</div>
</div>
</div>
<script>
	function displayImg(input, _this) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#cimg').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		} else {
			$('#cimg').attr('src', "<?= validate_image(isset($avatar) ? $avatar : "") ?>");
		}
	}

	$(function () {
		$('.pass_view').click(function () {
			var _el = $(this).closest('.input-group')
			var type = _el.find('input').attr('type')
			if (type == 'password') {
				_el.find('input').attr('type', 'text').focus()
				$(this).find('i.fa').removeClass('fa-eye-slash').addClass('fa-eye')
			} else {
				_el.find('input').attr('type', 'password').focus()
				$(this).find('i.fa').addClass('fa-eye-slash').removeClass('fa-eye')

			}
		})
		$('#manage-user').submit(function (e) {
			e.preventDefault();
			var _this = $(this)
			$('.err-msg').remove();
			var el = $('<div>')
			el.addClass("alert err-msg")
			el.hide()
			if (_this[0].checkValidity() == false) {
				_this[0].reportValidity();
				return false;
			}
			if ($('#password').val() != $('#cpassword').val()) {
				el.addClass('alert-danger').text('Password does not match.')
				_this.prepend(el)
				el.show('slow')
				$('html,body').scrollTop(0)
				return false;
			}
			start_loader();
			$.ajax({
				url: _base_url_ + "classes/Users.php?f=save_client",
				data: new FormData($(this)[0]),
				cache: false,
				contentType: false,
				processData: false,
				method: 'POST',
				type: 'POST',
				dataType: 'json',
				error: err => {
					console.error(err)
					el.addClass('alert-danger').text("An error occured");
					_this.prepend(el)
					el.show('.modal')
					end_loader();
				},
				success: function (resp) {
					if (typeof resp == 'object' && resp.status == 'success') {
						location.reload();
					} else if (resp.status == 'failed' && !!resp.msg) {
						el.addClass('alert-danger').text(resp.msg);
						_this.prepend(el)
						el.show('.modal')
					} else {
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