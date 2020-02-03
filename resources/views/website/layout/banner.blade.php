<!-- banner -->
<link rel="stylesheet" href="css/new-style.css">
<div class="row">
    <div class="col-md-1"></div>
    <style>
        #banner-img img {
            width: 100%;
        }
    </style>
    <div id="demo" class="carousel slide col-md-12 col-sm-12 col-xs-12" data-ride="carousel">
        <!-- Indicators -->
        <ul class="carousel-indicators">
            @foreach ($banners as $key => $item)
                @if ($key == 0)
                    <li data-target="#demo" data-slide-to="0" class="active"></li>
                @else
                    <li data-target="#demo" data-slide-to="{{ $key }}"></li>
                @endif
            @endforeach
        </ul>

        <!-- The slideshow -->
        <div id="banner-img" class="carousel-inner">
            @foreach ($banners as $key => $item)
                @if ($key == 0)
                    <div class="carousel-item active">
                        <a rel="{{ $item->name }}" href="{{ route('promotion_detail', $item->slug) }}">
                            <img src="{{ asset('storage/app/banners/' . $item->image) }}">
                        </a>
                    </div>
                @else
                    <div class="carousel-item">
                        <a rel="{{ $item->name }}" href="{{ route('promotion_detail', $item->slug) }}">
                            <img src="{{ asset('storage/app/banners/' . $item->image) }}">
                        </a>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>
    {{--    <div id="div-new" class="new col-md-3">--}}
    {{--        <h3><b>TIN CÔNG NGHỆ</b></h3>--}}
    {{--        @foreach($news as $key => $item)--}}
    {{--            @if ($key <= 3 )--}}
    {{--                <a href="{{ route('new.detail', $item->slug) }}">--}}
    {{--                    <div class="row item-new">--}}
    {{--                        <img class="col-md-5" src="{{asset('storage/app/news/'.$item->image)}}">--}}
    {{--                        <div class="new-title col-md-7">--}}
    {{--                            <span id="name">{{ $item->name }}</span></br>--}}
    {{--                            <span id="date"><i class="far fa-calendar-alt"></i> {{ date('d/m/Y - H:i:s', strtotime($item->created_at)) }}</span>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </a>--}}
    {{--            @endif--}}
    {{--        @endforeach--}}
    {{--    </div>--}}
</div>

<!-- //banner -->
