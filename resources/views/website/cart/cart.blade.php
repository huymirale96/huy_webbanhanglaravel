<!-- cart -->
<div id="modal-order" class="modal fade" aria-hidden="true" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="col-xs-6 col-sm-6 col-md-4 col-lg-4">GIỎ HÀNG CỦA BẠN</span>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                    <tr style=" white-space: nowrap; text-overflow: clip;">
                        <th width="15%">Ảnh</th>
                        <th width="30%">Tên sản phẩm</th>
                        <th width="15%">Giá bán</th>
                        <th width="15%">Số lượng</th>
                        <th width="15%">Tổng tiền (vnđ)</th>
                        <th width="10%">
                            <button id="delete-all-cart" data-url="{{ route('cart.delete_all_cart') }}"
                                    class="btn btn-danger">
                                Xóa hết
                            </button>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="new-row">
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="4">Tổng thanh toán (vnđ)</td>
                        <td colspan="2" id="sum-money"></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <div class="modal-footer text-center">
                <button data-url="{{ route('cart.user_info') }}" id="btn-submit-cart"
                        class="btn btn-success col-xs-5 col-sm-5 col-md-3 col-lg-3">
                    Đặt hàng
                </button>
                <button class="btn btn-danger btn-close col-xs-5 col-sm-5 col-md-3 col-lg-3">
                    Mua tiếp
                </button>
            </div>
        </div>
    </div>
</div>
<!-- info-cart -->
<div id="modal-confirm-order" class="modal fade" aria-hidden="true" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span><h2>THÔNG TIN NGƯỜI NHẬN HÀNG</h2></span>
                <button class="btn btn-danger btn-close">
                    X
                </button>
            </div>
            <div class="modal-body">
                <style>
                    label {
                        font-weight: bold;
                    }
                </style>
                <div class="alert alert-danger" style="display:none"></div>
                <input type="hidden" id="customer_id" value="">
                <div class="row">
                    <div class="form-group col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <label>Họ tên</label>
                        <input class="form-control" required
                               value="" disabled
                               id="customer_name" name="customer_name">
                    </div>
                    <div class="form-group col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <label>Email</label>
                        <input required class="form-control"
                               value="" disabled
                               id="customer_email" name="customer_email">
                    </div>
                    <div class="form-group col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <label>Điện thoại</label>
                        <input required class="form-control"
                               value="" disabled
                               id="customer_phone" name="customer_phone">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 province form-group">
                        <label>Tỉnh, thành phố</label>
                        <select data-url="{{ route('cart.districts') }}" id="province" class="form-control">
                            @foreach($provinces as $province)
                                <option value="{{ $province->id }}">{{ $province->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 district form-group">
                        <label>Quận, huyện</label>
                        <select data-url="{{ route('cart.wards') }}" id="district" class="form-control">
                            @foreach($districts as $district)
                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 ward form-group">
                        <label>Xã, phường</label>
                        <select id="ward" class="form-control">
                            @foreach($wards as $ward)
                                <option value="{{ $ward->id }}">{{ $ward->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Số nhà, ngách, ngõ</label>
                    <input class="form-control" required
                           value=""
                           id="customer_address" name="customer_address">
                </div>
                <div class="form-group">
                    <label>Ghi chú</label>
                    <input class="form-control" id="note" name="note">
                </div>
                <div class="modal-footer text-center">
                    <button id="btn-confirm-order" data-url="{{ route('cart.confirm') }}"
                            class="btn btn-success col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        THANH TOÁN TIỀN MẶT
                    </button>
                    <button id="btn-confirm-order-atm" data-url="{{ route('cart.confirm_vnpay') }}"
                            class="btn btn-warning col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        THANH TOÁN ONLINE
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Order detail -->

