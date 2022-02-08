@php
      $id = \Illuminate\Support\Facades\Auth::user()->id;
        $user = \App\Models\User::find($id);
@endphp
@extends('frontend.main_master')
@section('title', ' user profile')
@section('content')
    <div class="body-content">
        <div class="container">
            <div class="row ">
                @include('frontend.common.user_sidebar')
                <div class="col-md-2"></div>
                <div class="col-md-6">
                    <div class="card">
                        <h3 class="text-center"><span class="text-danger">Hi...</span>
                            <strong>{{\Illuminate\Support\Facades\Auth::user()->name}}</strong>
                            Welcome to Egy Online Shop
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
