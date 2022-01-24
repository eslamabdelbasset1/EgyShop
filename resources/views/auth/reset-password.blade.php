@extends('frontend.main_master')
@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{route('user.index')}}">Home</a></li>
                    <li class='active'>Rest Password</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <div class="body-content">
        <div class="container">
            <div class="sign-in-page">
                <div class="row">
                    <!-- Sign-in -->
                    <div class="col-sm-6 sign-in m-auto mb-5">
                        {{--                        <h4 class="">Sign in</h4>--}}
                        <p class="">Rest your password?</p>

                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                            <div class="form-group">
                                <label class="info-title" for="email">Email Address <span>*</span></label>
                                <input type="email" class="form-control unicase-form-control text-input"
                                       id="email" name="email" :value="old('email', $request->email)" required autofocus>
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="password">New Password <span>*</span></label>
                                <input type="password" class="form-control unicase-form-control text-input"
                                       id="password"  name="password" required autocomplete="new-password">
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="password_confirmation">Confirm Password <span>*</span></label>
                                <input type="password" class="form-control unicase-form-control text-input"
                                       id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
                            </div>
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Reset Password</button>
                        </form>
                    </div>
                    <!-- Sign-in -->
                    @include('frontend.includes.brands')
                </div><!-- /.row -->
            </div><!-- /.sigin-in-->

        </div>
    </div>
@endsection
