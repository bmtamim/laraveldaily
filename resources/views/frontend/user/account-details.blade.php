@extends('frontend.layouts.app')

@section('title') {{ __('My Account') }} @endsection

@section('content')
    <div class="product-tabs inner-bottom-xs  wow fadeInUp">
        <div class="row">
            <div class="col-sm-3">
                <ul id="product-tabs" class="nav nav-tabs nav-tab-cell nav-pills">
                    <li><a data-toggle="tab" href="#dashboard">{{ __('Dashboard') }}</a></li>
                    <li><a data-toggle="tab" href="#order">{{ __('Orders') }}</a></li>
                    <li><a data-toggle="tab" href="#downloads">{{ __('Downloads') }}</a></li>
                    <li><a data-toggle="tab" href="#downloads">{{ __('Downloads') }}</a></li>
                    <li class="active"><a
                            href="{{ route('frontend.dashboard.account-details.index') }}">{{ __('Account Details') }}</a>
                    </li>
                    <li><a  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('user-logout-dashboard').submit();">{{ __('Logout') }}</a>
                        <form id="user-logout-dashboard" action="{{ route('logout') }}" class="d-none" method="POST">
                            @csrf
                        </form>
                    </li>
                </ul><!-- /.nav-tabs #product-tabs -->
            </div>
            <div class="col-sm-9">

                <div class="tab-content">

                    <div class="tab-pane in active">
                        <div class="product-tab">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if(session()->has('accountMsg'))
                                <div class="alert alert-danger">
                                    {{ session()->get('accountMsg') }}
                                </div>
                            @endif
                            <form action="{{ route('frontend.dashboard.account-details.update', auth()->id()) }}"
                                  method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="name">{{ __('Name') }}</label>
                                            <input type="text" class="form-control" name="name" placeholder="Name"
                                                   value="{{ auth()->user()->name }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="email">{{ __('Email') }}</label>
                                            <input type="text" class="form-control" name="email" placeholder="Email"
                                                   value="{{ auth()->user()->email }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="email">{{ __('Phone') }}</label>
                                            <input type="tel" class="form-control" name="phone" placeholder="Phone"
                                                   value="{{ auth()->user()->phone }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="photo">{{ __('Profile Photo') }}</label>
                                            <input type="file" class="form-control" id="photo" name="photo" onchange="document.getElementById('profileImagePreview').src = window.URL.createObjectURL(this.files[0])">
                                            <img id="profileImagePreview" src="{{ auth()->user()->profile_photo_url }}" alt="{{ __('Profile Photo') }}" width="100px" height="auto">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <fieldset>
                                            <legend>{{ __('Password change') }}</legend>
                                            <div class="form-group">
                                                <label
                                                    for="currentPassword">{{ __('Current password (leave blank to leave unchanged)') }}</label>
                                                <input type="password" id="currentPassword" class="form-control"
                                                       name="currentPassword">
                                            </div>
                                            <div class="form-group">
                                                <label
                                                    for="newPassword">{{ __('New password (leave blank to leave unchanged)') }}</label>
                                                <input type="password" id="newPassword" class="form-control"
                                                       name="newPassword">
                                            </div>
                                            <div class="form-group">
                                                <label for="newPassword">{{ __('Confirm new password') }}</label>
                                                <input type="password" id="confirmPassword" class="form-control"
                                                       name="confirmPassword">
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ __('Save Changes') }}</button>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.tab-pane -->

                </div><!-- /.tab-content -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
@endsection
