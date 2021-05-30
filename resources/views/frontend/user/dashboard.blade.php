@extends('frontend.layouts.app')

@section('title') {{ __('My Account') }} @endsection

@section('content')
    <div class="product-tabs inner-bottom-xs  wow fadeInUp">
        <div class="row">
            <div class="col-sm-3">
                <ul id="product-tabs" class="nav nav-tabs nav-tab-cell nav-pills">
                    <li class="active"><a data-toggle="tab" href="#dashboard">{{ __('Dashboard') }}</a></li>
                    <li><a data-toggle="tab" href="#order">{{ __('Orders') }}</a></li>
                    <li><a data-toggle="tab" href="#downloads">{{ __('Downloads') }}</a></li>
                    <li><a data-toggle="tab" href="#downloads">{{ __('Downloads') }}</a></li>
                    <li><a href="{{ route('frontend.dashboard.account-details.index') }}">{{ __('Account Details') }}</a></li>
                    <li><a data-toggle="tab" href="#account_details">{{ __('Logout') }}</a></li>
                </ul><!-- /.nav-tabs #product-tabs -->
            </div>
            <div class="col-sm-9">

                <div class="tab-content">

                    <div class="tab-pane in active">
                        <div class="product-tab">

                        </div>
                    </div><!-- /.tab-pane -->

                </div><!-- /.tab-content -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
@endsection
