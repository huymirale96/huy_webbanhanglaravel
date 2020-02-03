@extends('website.layout.index')
@section('title', $name)
@section('container')
    <!-- Single Page -->
    <div class="container product-sec1">
        <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
            <div class="titledetail col-md-10 col-lg-10 col-sm-12 col-xs-12">
                {{ $name }}
            </div>
            <div class="newdetail col-md-10 col-lg-10 col-sm-12 col-xs-12">
                {!! $content !!}
            </div>
            <hr>
            <div style="margin: auto" class="col-md-10 col-lg-10 col-sm-12 col-xs-12">
                <div class="fb-comments" data-href="{{ url()->current() }}" data-width="1003"
                     data-numposts="5"></div>
            </div>
        </div>
    </div>
    <!-- //Single Page -->
@stop
