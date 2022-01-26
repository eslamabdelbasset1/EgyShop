@extends('admin.admin_master')
@section('content')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-8">
                    <div class="box">
                        <div class="box-header with-border">
{{--                            <h3 class="box-title">Category List</h3>--}}
                            <h3 class="box-title">Category List <span class="badge badge-pill badge-danger"> {{ count($categories) }} </span> </h3>

                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Category Icon </th>
                                            <th>Category En</th>
                                            <th>Category Ar </th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td> <span><i class="{{ $category->category_icon }}"></i></span>  </td>
                                            <td>{{$category->category_name_en}}</td>
                                            <td>{{$category->category_name_ar}}</td>
                                            <td>
                                                <a href="{{route('category.edit', $category->id)}}" class="btn btn-info">Edit</a>
                                                <a href="{{route('category.delete', $category->id)}}" id="delete" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->

{{--                Add Brand--}}

                <div class="col-4">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Category </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="post" action="{{ route('category.store') }}" >
                                    @csrf
                                    <div class="form-group">
                                        <h5>Category Name English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="category_name_en" class="form-control" required>
                                            @error('category_name_en')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Category Name Arabic <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="category_name_ar" class="form-control" required>
                                            @error('category_name_ar')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Category Icon <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="category_icon" class="form-control" required>
                                            @error('category_icon')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="text-xs-right">
                                        <button type="submit" class="btn btn-rounded btn-info">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>

            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
@endsection
