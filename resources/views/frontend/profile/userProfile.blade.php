@extends('frontend.main_master')
@section('content')
    @extends('frontend.main_master')
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
                        <a href="{{route('dashboard')}}" class="btn btn-primary btn-sm btn-block">Home</a>
                        <a href="{{route('user.profile')}}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
                        <a href="{{route('user.changePassword')}}" class="btn btn-primary btn-sm btn-block">Change Password</a>
                        <a href="{{route('user.logout')}}" class="btn btn-danger btn-sm btn-block">Logout</a>
                    </ul>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-6">
                    <div class="card">
                        <h3 class="text-center"><span class="text-danger">Hi...</span>
                            <strong>{{\Illuminate\Support\Facades\Auth::user()->name}}</strong>
                             Update Your Profile
                        </h3>
                        <div class="card-body">
                            <form method="POST" action="{{route('user.updateProfile')}}" enctype="multipart/form-data">
                                @csrf
                                @csrf
                                <div class="form-group">
                                    <label class="info-title" for="name">Name</label>
                                    <input type="text" class="form-control unicase-form-control text-input"
                                           id="name" name="name" value="{{$user->name}}" autofocus autocomplete="name">
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="email">Email Address</label>
                                    <input type="email" class="form-control unicase-form-control text-input" id="email"
                                           name="email" value="{{$user->email}}">
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="phone">Phone Number</label>
                                    <input type="number" value="{{$user->phone}}" name="phone" class="form-control unicase-form-control text-input" id="phone" >
                                </div>
                                <div class="form-group">
                                    <h5>Profile Image</h5>
                                    <div class="controls">
                                        <input type="file" name="profile_photo_path" class="form-control"
                                               id="image" required>
                                    </div>
                                </div>
                                <div class="text-xs-right">
                                    <button type="submit" class="btn btn-rounded btn-info">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@endsection
