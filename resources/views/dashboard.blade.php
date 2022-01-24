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
                <div class="col-md-2">
                    <br><br>
                    <img src="{{ (!empty($user->profile_photo_path)) ?
                            url('upload/user/profile/'.$user->profile_photo_path)
                            : url('upload/user/profile/no_image.jpg')}}" alt=""
                    class="card-img-top my-4" style="border-radius: 50%; width: 150px">

                   <ul class="list-group list-group-flush">
                        <li><a href="{{route('dashboard')}}" class="btn btn-primary btn-sm btn-block">Home</a></li>
                        <li><a href="{{route('user.profile')}}" class="btn btn-primary btn-sm btn-block">Profile Update</a></li>
                        <li><a href="{{route('user.changePassword')}}" class="btn btn-primary btn-sm btn-block">Change Password</a></li>
                        <li><a href="{{route('user.logout')}}" class="btn btn-danger btn-sm btn-block">Logout</a></li>
                   </ul>
                </div>
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
