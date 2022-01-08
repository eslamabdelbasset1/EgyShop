@extends('admin.admin_master')
@section('content')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Admin Change Password</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form action="{{route('admin.updatePassword')}}" method="POST">
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
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
@endsection
