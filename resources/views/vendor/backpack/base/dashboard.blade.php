@extends('backpack::layout')

@section('after_styles')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection


@section('header')
    <section class="content-header">
        <h1>
            {{ trans('backpack::base.dashboard') }}
            <small>{{ trans('backpack::base.first_page_you_see') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ backpack_url() }}">{{ config('backpack.base.project_name') }}</a></li>
            <li class="active">{{ trans('backpack::base.dashboard') }}</li>
        </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="box-title">{{ trans('backpack::base.login_status') }}</div>
                </div>

                <div class="box-body">
                    {{ trans('backpack::base.logged_in') }}
                    @if(backpack_user()->hasRole('admin|vti'))
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Courses</span>
                                    <span class="info-box-number">
                                        {!! App\Models\Course::count() !!}
                                        <small>courses</small>
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Service Providers</span>
                                    <span class="info-box-number"> {!! App\Models\BioProfile::count() !!}
                                        <small>providers</small>
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div id="app">
                                {{--<jobs-chart-component></jobs-chart-component>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
