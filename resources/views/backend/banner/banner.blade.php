@extends('layouts.admin')
@section('content')
 <div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h2>Banner List</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>SL</th>
                        <th>Banner Title</th>
                        <th>Banner Image</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($banners as $sl=>$banner)
                    <tr>
                        <td>{{ $sl+1 }}</td>
                        <td>{{ $banner->banner_title }}</td>
                        <td><img src="{{ asset('uploads/frontend/banner') }}/{{ $banner->banner_image }}" alt=""></td>
                        <td><a href="" class="btn btn-danger">Delete</a></td>
                    </tr>

                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">

        <div class="card">
            <div class="card-header">
                <h2>Add Banner</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Banner Title</label>
                        <input type="text" class="form-control" name="banner_title" placeholder="enter banner title">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Banner Image</label>
                        <input type="file" class="form-control" name="banner_image">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Page Link</label>
                        <select name="category_id" class="form-select" id="">
                            <option value="">select category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 d-flex justify-content-end">
                        <button class="btn btn-success" type="submit">Add Banner</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
 </div>
@endsection
@section('footer_content')
@if(session('banner_suc'))
    <script>
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "{{ session('banner_suc') }}",
            showConfirmButton: false,
            timer: 1500
        });

    </script>

@endif
@endsection
