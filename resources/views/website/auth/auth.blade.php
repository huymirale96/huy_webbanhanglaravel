<!-- login -->
<div class="modal fade" id="modal-login" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">ĐĂNG NHẬP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span style="color: red" id="message"></span>
                <div class="form-group">
                    <label class="col-form-label">Email</label>
                    <input id="i-email" type="text" class="form-control" placeholder="Email" name="email" required>
                </div>
                <div class="form-group">
                    <label class="col-form-label">Mật khẩu</label>
                    <input id="i-password" type="password" class="form-control" placeholder="Mật khẩu" name="Password"
                           required>
                </div>
                <div class="sub-w3l">
                    <div class="custom-control custom-checkbox mr-sm-2">
                        <input name="remember" {{ old('remember') ? 'checked' : '' }} type="checkbox" class="custom-control-input" id="customControlAutosizing">
                        <label class="custom-control-label" for="customControlAutosizing">Ghi nhớ đăng nhập</label>
                    </div>
                </div>
                <div class="right-w3l">
                    <input id="btn-login" data-url="{{ route('customer.login') }}" type="submit" class="form-control"
                           value="OK">
                </div>
                <p class="text-center dont-do mt-3">
                    <a id="btn-modal-forgot-password" href="#" data-toggle="modal" data-target="#modal-forgot-password">
                        Quên mật khẩu ?
                    </a>
                </p>
                <p class="text-center dont-do mt-3">Bạn chưa có tài khoản ?
                    <a href="#" data-toggle="modal" data-target="#modal-register">
                        Đăng ký
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Forgot password -->
<div class="modal fade" id="modal-forgot-password" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">QUÊN MẬT KHẨU</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" style="display:none"></div>
                <span style="color: red" id="message"></span>
                <div class="form-group">
                    <label class="col-form-label">Hãy điền địa chỉ email của bạn</label>
                    <input id="fp-email" type="text" class="form-control" placeholder="Email" name="email" required>
                </div>
                <div class="right-w3l">
                    <input id="btn-forgot-password" data-url="{{ route('customer.forgot_password') }}" type="submit" class="form-control"
                           value="OK">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /end forgot password -->

<!-- register -->
<div class="modal fade" id="modal-register" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ĐĂNG KÝ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" style="display:none"></div>
                <span style="color: red" id="message"> </span>
                <div class="form-group">
                    <label class="col-form-label">Họ tên *</label>
                    <input id="u-name" type="text" class="form-control" placeholder=" " name="name">
                </div>
                <div class="form-group">
                    <label class="col-form-label">Email *</label>
                    <input id="u-email" type="email" class="form-control" placeholder=" " name="email">
                </div>
                <div class="form-group">
                    <label class="col-form-label">Điện thoại *</label>
                    <input id="u-phone" type="text" class="form-control" placeholder=" " name="phone">
                </div>
                <div class="form-group">
                    <label class="col-form-label">Địa chỉ *</label>
                    <input id="u-address" type="text" class="form-control" placeholder=" " name="address">
                </div>
                <div class="form-group">
                    <label class="col-form-label">Mật khẩu *</label>
                    <input id="u-password" type="password" class="form-control" placeholder=" " name="password">
                </div>
                <div class="form-group">
                    <label class="col-form-label">Nhập lại mật khẩu *</label>
                    <input id="u-confirm-password" type="password" class="form-control" placeholder=" "
                           name="Confirm Password">
                </div>
                <div class="right-w3l">
                    <button id="btn-register" data-url="{{ route('customer.register') }}" type="submit"
                            class="form-control btn btn-success">OK
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Profile--}}
<div class="modal fade" id="modal-profile" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">TÀI KHOẢN CỦA TÔI</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" style="display:none"></div>
                <div class="form-group">
                    <label class="col-form-label">Họ tên</label>
                    <input id="m-name" type="text" class="form-control" name="name"
                           required>
                </div>
                <div class="form-group">
                    <label class="col-form-label">Email</label>
                    <input id="m-email" type="text" class="form-control" name="email">
                </div>
                <div class="form-group">
                    <label class="col-form-label">Số điện thoại</label>
                    <input id="m-phone" type="text" class="form-control" name="phone"
                           required>
                </div>
                <div class="form-group">
                    <label class="col-form-label">Địa chỉ</label>
                    <input id="m-address" type="text" class="form-control" name="address"
                           required>
                </div>
                <div class="right-w3l">
                    <input id="btn-change-profile" data-url="{{ route('customer.change_profile') }}" type="submit"
                           class="form-control"
                           value="OK">
                    <button id="btn-modal-changepass" class="btn btn-warning" data-toggle="modal" data-target="#modal-password">
                        Đổi mật khẩu
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- /Profile--}}

<!-- Change password -->
<div class="modal fade" id="modal-password" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">ĐỔI MẬT KHẨU</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" style="display:none"></div>
                <div class="form-group">
                    <label class="col-form-label">Nhập mật khẩu hiện tại</label>
                    <input id="current_password" placeholder="Mật khẩu cũ" type="password" name="current_password"
                           class="form-control">
                </div>
                <div class="form-group">
                    <label class="col-form-label">Mật khẩu mới</label>
                    <input placeholder="Mật khẩu mới" id="new-password" type="password" name="new_password"
                           class="form-control" required autocomplete="new-password">
                </div>
                <div class="form-group">
                    <label class="col-form-label">Xác nhận mật khẩu mới</label>
                    <input placeholder="Xác nhận mật khẩu" id="password-confirm" type="password" class="form-control"
                           name="password_confirmation" required
                           autocomplete="new-password">
                </div>
                <div class="right-w3l">
                    <button data-url="{{ route('customer.change_password') }}" class="btn btn-success" id="btn-submit-change-password">Xác nhận</button>
                    <button class="btn btn-warning" id="btn-close-changepass">
                        Hủy
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Change password -->
