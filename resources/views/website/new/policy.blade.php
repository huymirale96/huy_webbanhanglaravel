@extends('website.layout.index')
@section('title', $name)
@section('container')
    <!-- Single Page -->
    <style>
        .newdetail {
            margin: auto;
            /*text-align: justify;*/
        }

        @media screen and (max-width: 575px) {
            .newdetail img {
                width: 100% !important;
            }
        }

        @media screen and (max-width: 768px) {
            .newdetail img {
                width: 100% !important;
            }
        }

        @media screen and (max-width: 960px) {
            .newdetail img {
                width: 100% !important;
            }
        }

        @media screen and (max-width: 1200px) {
            .newdetail img {
                width: 100% !important;
            }
        }

        @media screen and (max-width: 1536px) {
            .newdetail img {
                width: 100% !important;
            }

            .titledetail {
                padding-top: 20px;
                padding-bottom: 20px;
                line-height: 53px;
                font-size: 45px;
                color: #333;
                font-family: 'Roboto Condensed', sans-serif;
                font-weight: 600;
                margin: 30px auto;
            }
        }
    </style>
    <div class="container product-sec1">
        <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
            <div class="titledetail col-md-10 col-lg-10 col-sm-12 col-xs-12">
                {{ $name }}
            </div>
            <div class="newdetail col-md-10 col-lg-10 col-sm-12 col-xs-12">
                {!! $content !!}
            </div>
            <hr>
        </div>
    </div>
    <!-- //Single Page -->
@stop
