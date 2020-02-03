@extends('admin.layout.index')
@section('title','Thêm nhân viên')
@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Thêm nhân viên
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-7">
                    <div class="box">
                        <div class="box-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('admin.users.post_add_user') }}" method="POST"
                                  accept-charset="utf-8">
                                @csrf
                                <div class="form-group">
                                    <label>Họ tên</label>
                                    <input required placeholder="Họ tên" type="text" name="name"
                                           class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ email</label>
                                    <input required placeholder="email" type="email" name="email"
                                           class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Quyền: </label>
                                    <select name="role" id="">
                                        <option value="2">Admin</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Thêm"
                                           class="btn btn-success pull-right">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop
