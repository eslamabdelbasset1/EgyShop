@php
    $id = \Illuminate\Support\Facades\Auth::user()->id;
    $user = App\Models\User::find($id);
@endphp

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
        <li><a href="{{ route('my.orders') }}" class="btn btn-primary btn-sm btn-block">My Orders</a></li>
        <li><a href="{{ route('return.order.list') }}" class="btn btn-primary btn-sm btn-block">Return Orders</a></li>
        <li><a href="{{ route('cancel.orders') }}" class="btn btn-primary btn-sm btn-block">Cancel Orders</a></li>
        <li><a href="{{route('user.logout')}}" class="btn btn-danger btn-sm btn-block">Logout</a></li>
    </ul>
</div>
