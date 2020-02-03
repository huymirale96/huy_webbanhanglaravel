@extends('website.layout.index')
@section('title', $name)
@section('container')
    <!-- Single Page -->

    <div class="container product-sec1">
        <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
            <div class="titledetail col-md-10 col-lg-10 col-sm-12 col-xs-12">
                {{ $name }}
            </div>
            <div class="bannerdetail col-md-10 col-lg-10 col-sm-12 col-xs-12">
                {!! $content !!}
            </div>
        </div>
    </div>
    <!-- //Single Page -->
@stop
