<!-- Left Content -->
<style>
    @media (max-width: 960px) {
        #left-content {
            display: none;
        }
    }
</style>
<div id="left-content" class="col-lg-2 mt-lg-0 mt-4 p-lg-0">
    <div class="side-bar p-sm-4 p-3">
        <form action="">
            <!-- price -->
            <div class="range border-bottom py-2">
                <h3 class="agileits-sear-head mb-3">Theo giá</h3>
                <div class="w3l-range">
                    <div class="custom-control custom-radio">
                        <input @if (isset($gia) && $gia == 'duoi-1-trieu') checked @endif type="radio" id="price1" name="gia"
                               value="duoi-1-trieu" class="custom-control-input">
                        <label class="custom-control-label" for="price1">Dưới 1 triệu</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input @if (isset($gia) && $gia == 'tu-1-3-trieu') checked @endif type="radio" id="price2" name="gia"
                               value="tu-1-3-trieu" class="custom-control-input">
                        <label class="custom-control-label" for="price2">Từ 1-3 triệu</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input @if (isset($gia) && $gia == 'tu-3-7-trieu') checked @endif type="radio" id="price3" name="gia"
                               value="tu-3-7-trieu" class="custom-control-input">
                        <label class="custom-control-label" for="price3">Từ 3-7 triệu</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input @if (isset($gia) && $gia == 'tu-7-12-trieu') checked @endif type="radio" id="price4" name="gia"
                               value="tu-7-12-trieu" class="custom-control-input">
                        <label class="custom-control-label" for="price4">Từ 7-12 triệu</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input @if (isset($gia) && $gia == 'tu-12-17-trieu') checked @endif type="radio" id="price5"
                               name="gia" value="tu-12-17-trieu" class="custom-control-input">
                        <label class="custom-control-label" for="price5">Từ 12-17 triệu</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input @if (isset($gia) && $gia == 'tren-17-trieu') checked @endif type="radio" id="price6" name="gia"
                               value="tren-17-trieu" class="custom-control-input">
                        <label class="custom-control-label" for="price6">Trên 17 triệu</label>
                    </div>
                </div>
            </div>
            <!-- //price -->
            <!-- brand -->
            <div class="left-side border-bottom py-2">
                <h3 style="margin-top: 17px" class="agileits-sear-head mb-3">Theo hãng</h3>
                @foreach($brands as $brand)
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" value="{{ $brand->id }}" class="custom-control-input"
                               id="{{ $brand->slug }}" name="hang[]"
                               @if(isset($hang) && in_array($brand->id, $hang)) checked @endif>
                        <label class="custom-control-label" for="{{ $brand->slug }}">{{ $brand->name }}</label>
                    </div>
                @endforeach
            </div>
            <!-- //brand -->
            <!-- order by -->
            <div class="left-side border-bottom py-2">
                <h3 style="margin-top: 17px" class="agileits-sear-head mb-3">Sắp xếp</h3>
                <div class="custom-control custom-radio">
                    <input @if (isset($sap_xep) && $sap_xep == 'gia-tang-dan') checked @endif value="gia-tang-dan" type="radio" id="priceup" name="sap_xep" class="custom-control-input">
                    <label class="custom-control-label" for="priceup">Giá tăng dần</label>
                </div>
                <div class="custom-control custom-radio">
                    <input @if (isset($sap_xep) && $sap_xep == 'gia-giam-dan') checked @endif value="gia-giam-dan" type="radio" id="pricedown" name="sap_xep" class="custom-control-input">
                    <label class="custom-control-label" for="pricedown">Giá giảm dần</label>
                </div>
                <div class="custom-control custom-radio">
                    <input @if (isset($sap_xep) && $sap_xep == 'moi-nhat') checked @endif value="moi-nhat" type="radio" id="newest" name="sap_xep" class="custom-control-input">
                    <label class="custom-control-label" for="newest">Mới nhất</label>
                </div>
            </div>
            <!-- //order by -->
            <input style="margin-top: 17px" type="submit" class="btn col-md-12 btn-info" value="OK">
        </form>
    </div>
</div>
<!-- /Left Content -->
