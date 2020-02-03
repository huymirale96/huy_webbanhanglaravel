@extends('admin.layout.index')
@section('title','Danh sách nhân viên')
@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Danh sách nhân viên
            </h1>
        </section>
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
    @endif
    <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <table id="table" class="table-hover table table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ảnh đại diện</th>
                                    <th>Tên nhân viên</th>
                                    <th>Email</th>
                                    <th>Ngày đăng ký</th>
                                    <th>Trạng thái</th>
                                    <th>Tùy chọn</th>
                                </tr>
                                </thead>
                                <tbody id="tbody">
                                @foreach($accounts as $account)
                                    <tr id="account{{ $account->id }}">
                                        <td>{{ $account->id }}</td>
                                        <td>
                                            @if ($account->avatar !== null)
                                                <img style="max-height: 70px; border-radius: 50%"
                                                     src="{{asset('storage/app/users/' . $account->avatar)}}">
                                            @else <img style="max-height: 70px; border-radius: 50%"
                                                       src="{{asset('storage/app/users/user-default.png')}}">
                                            @endif
                                        </td>
                                        <td>{{ $account->name }}</td>
                                        <td>{{ $account->email }}</td>
                                        <td>{{ date('d/m/Y - H:i:s', strtotime($account->created_at)) }}</td>
                                        <td class="status">
                                            @switch ($account->status)
                                                @case (config('const.ACTIVE')) Đang hoạt động @break
                                                @case (config('const.UN_VERIFIED')) Chờ xác thực @break
                                                @case (config('const.OUT')) Đã nghỉ việc @break
                                            @endswitch
                                        </td>
                                        <td class="function">
                                            <button data-url="{{ route('admin.users.disable', $account) }}"
                                                    data-id="{{ $account->id }}"
                                                    class="btn btn-danger on btn-del-account @if($account->status == config('const.OUT')) hidden @endif">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            <button data-url="{{ route('admin.users.reset', $account) }}"
                                                    data-id="{{ $account->id }}"
                                                    class="btn btn-warning on btn-reset-account @if($account->status == config('const.OUT') ) hidden @endif">
                                                <i class="fas fa-sync-alt"></i>
                                            </button>
                                            <button data-url="{{ route('admin.users.restore', $account->id) }}"
                                                    data-id="{{ $account->id }}"
                                                    class="btn btn-primary off btn-restore-account @if($account->status == config('const.ACTIVE') || $account->status == config('const.UN_VERIFIED')) hidden @endif">
                                                <i class="fas fa-trash-restore"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div><!--/.row-->
@stop
