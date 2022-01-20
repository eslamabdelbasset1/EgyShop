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
                             Change Your Password
                        </h3>
                        <div class="card-body">
                            <form method="POST" action="{{route('user.updatePassword')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <h5>Old Password <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="password" name="current_password" class="form-control"
                                                       id="current_password" wire:model.defer="state.current_password" autocomplete="current-password" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h5>New Password <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="password" name="password" class="form-control" required
                                                       id="password" wire:model.defer="state.password" autocomplete="new-password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h5>Confirm Password <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="password" name="password_confirmation" class="form-control" required
                                                       id="password_confirmation"  wire:model.defer="state.password_confirmation" autocomplete="new-password">
                                            </div>
                                        </div>
                                        <div class="text-xs-right">
                                            <button type="submit" class="btn btn-rounded btn-info">Save</button>
                                        </div>
                                    </div>
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
