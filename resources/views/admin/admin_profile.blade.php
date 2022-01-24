@extends('admin.admin_master')
@section('content')
    <div class="container-full">

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- /.box -->
                <div class="box box-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
{{--                    style="background: url({{asset('backend/images/gallery/full/10.jpg')}}) center center;"--}}
                    <div class="widget-user-header bg-black">
                        <h3 class="widget-user-username">Admin Name: {{$profile->name}}</h3>
                        <h6 class="widget-user-desc">Admin Email: {{$profile->email}}</h6>
                        <a href="{{route('admin.profile.edit')}}" style="float: right;"
                        class="btn btn-rounded btn-success mb-4"> Edit Profile</a>
                    </div>
                    <div class="widget-user-image">
                        <img class="rounded-circle"
                             src="{{ (!empty($profile->profile_photo_path)) ?
                            url('upload/admin/profile/'.$profile->profile_photo_path)
                            : url('upload/admin/profile/no_image.jpg')}}"
                             alt="User Avatar">
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">12K</h5>
                                    <span class="description-text">FOLLOWERS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 br-1 bl-1">
                                <div class="description-block">
                                    <h5 class="description-header">550</h5>
                                    <span class="description-text">FOLLOWERS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">158</h5>
                                    <span class="description-text">TWEETS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
