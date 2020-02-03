@extends('admin.layout.index')
@section('title','Trang cá nhân')
@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Trang cá nhân
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong id="alert">{{ $message }}</strong>
                        </div>
                    @endif
                    @if ($message = Session::get('error'))
                        <div class="alert alert-error alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong id="alert">{{ $message }}</strong>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                @endif
                <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Thông tin cá nhân</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form role="form" action="{{ route('admin.post-profile') }}" method="POST"
                                  accept-charset="utf-8"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Họ tên</label>
                                        <input type="text" value="{{ $name }}" name="name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" disabled value="{{ $email }}" name="email"
                                               class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Ảnh đại diện</label>
                                        <label for="avatar" class="btn btn-success">Tải lên</label>
                                        <input id="avatar" onchange="preview_ava()" style="visibility:hidden;"
                                               type="file"
                                               name="avatar">
                                        <img id="img" style="border-radius: 50%; max-height: 170px"
                                             @if ($avatar !== null)
                                             src="{{ asset('storage/app/users/' . $avatar) }}"
                                             @else src="{{ asset('storage/app/users/user-default.png') }}" @endif>
                                        <div id="preview"></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Quyền: </label>
                                        <span> {{ ($role === config('const.ADMIN')) ? 'ADMIN' : 'SUPER ADMIN' }} </span>
                                    </div>
                                    <div class="form-group">
                                        <label>Ngày đăng ký: </label>
                                        <span> {{ date('d/m/Y - H:i:s', strtotime($created_at)) }}</span>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-danger pull-right">Lưu</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.box -->
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Đổi mật khẩu</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form class="form-horizontal" action="{{ route('admin.change-password') }}" method="POST">
                                @csrf
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Mật khẩu cũ</label>
                                        <div class="col-sm-6">
                                            <input required type="password" class="form-control"
                                                   placeholder="Nhập mật khẩu cũ" name="cur_password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Mật khẩu mới</label>
                                        <div class="col-sm-6">
                                            <input required type="password" class="form-control" name="password"
                                                   placeholder="Nhập mật khẩu mới">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Xác nhận mật khẩu mới</label>
                                        <div class="col-sm-6">
                                            <input required type="password" class="form-control"
                                                   name="password_confirmation"
                                                   placeholder="Nhập lại mật khẩu mới">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-danger pull-right">OK</button>
                                </div>
                                <!-- /.box-footer -->
                            </form>
                        </div>
                    </div>
                    <!--/.col (right) -->
                </div>
            </div>
        </section>
    </div>
@stop
