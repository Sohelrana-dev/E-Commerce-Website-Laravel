@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h2>Brand List</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>SL</th>
                        <th>Brand Name</th>
                        <th>Brand Logo</th>
                        <th>Action</th>
                    </tr>

                    @foreach($brands as $sl=>$brand)
                        <tr>
                            <td>{{ $sl+1 }}</td>
                            <td>{{ $brand->brand_name }}</td>
                            <td>
                                <img src="{{ asset('uploads/brand') }}/{{ $brand->brand_logo }}" alt="">
                            </td>
                            <td>
                                <a href="{{ route('brand.delete', $brand->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h2>Add Brand</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Brand</label>
                        <input type="text" class="form-control" placeholder="enter brand name" name="brand_name">
                        @error('brand_name')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Brand Logo</label>
                        <input type="file" class="form-control" name="brand_logo">
                        @error('brand_logo')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3 d-flex justify-content-end">
                        <button class="btn btn-success">Add Brand</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_content')
@if(session('brand_success'))
    <script>
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "{{ session('brand_success') }}",
            showConfirmButton: false,
            timer: 1500
        });

    </script>
@endif
@if(session('brand_delete'))
    <script>
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "{{ session('brand_delete') }}",
            showConfirmButton: false,
            timer: 1500
        });

    </script>
@endif
@endsection
