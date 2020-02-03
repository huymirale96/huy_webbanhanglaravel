@extends('website.layout.index')
@section('title', 'Tin tức')
@section('container')
    <div class="ads-grid py-sm-5 py-6">
        <div class="container py-xl-4 py-lg-2">
            <div class="row">
                <div class="agileinfo-ads-display col-lg-12">
                    <div class="wrapper">
                        <!-- first section -->
                        <div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
                            <h3 class="heading-tittle text-center font-italic">Chuyên mục tin công nghệ</h3>
                        </div>
                        <!-- //first section -->
                    </div>
                    <style>
                        @media screen and (max-width: 575px) {
                            .newimg img {
                                width: 100% !important;
                            }
                        }

                        @media screen and (max-width: 768px) {
                            .newimg img {
                                width: 100% !important;
                            }
                        }

                        @media screen and (max-width: 960px) {
                            .newimg img {
                                width: 100% !important;
                            }
                        }

                        @media screen and (max-width: 1200px) {
                            .newimg img {
                                width: 100% !important;
                            }
                        }

                        @media screen and (max-width: 1536px) {
                            .newimg img {
                                width: 100% !important;
                            }
                        }

                        .titledetail {
                            line-height: 45px;
                            font-size: 28px;
                            color: #333;
                            font-family: 'Roboto Condensed', sans-serif;
                            font-weight: 600;
                            margin: 30px auto;
                        }

                        .newdescription {
                            line-height: 35px;
                            font-size: 20px;
                            color: #333;
                            text-align: justify;
                            font-family: 'Roboto Condensed', sans-serif;
                            /*margin: 30px auto;*/
                        }

                        .newdetail {
                            padding: 10px !important;
                        }
                    </style>
                    @foreach ($news as $new)
                        <a href="{{ route('new_detail', $new->slug) }}">
                            <div class="row product-sec1 newdetail">
                                <div class="col-md-5 col-lg-5 col-sm-6">
                                    <div class="newimg">
                                        <img src="{{ asset('storage/app/news/' . $new->image) }}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-7 col-lg-7 col-sm-6">
                                    <div class="titledetail">
                                        {{ $new->name }}
                                    </div>
                                    <div class="newdescription">
                                        {!! $new->description !!}
                                    </div>
                                    <div>
                                        <span style="float: right">Ngày đăng {{ date('d/m/Y - H:i:s', strtotime($new->created_at)) }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="clearfix"></div>
                <div class="pagination" style="margin: 30px auto">
                    {!! $news->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
