@extends('backpack::layout')

@section('after_styles')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection

@section('header')
    <section class="content-header">
        <h1>
            Generate Jobs Report
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ backpack_url() }}">{{ config('backpack.base.project_name') }}</a></li>
            <li class="active">{{ trans('backpack::base.dashboard') }}</li>
        </ol>
    </section>
@endsection


@section('content')
    <div class="row" id="app">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="box-title">
                    </div>
                </div>
                <div class="box-body">
                </div>
            </div>
        </div>
    </div>
@endsection
