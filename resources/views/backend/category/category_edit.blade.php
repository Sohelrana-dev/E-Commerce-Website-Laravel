@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-6 m-auto">
        <div class="card">
            <div class="card-header">
                <h2>Category Edit</h2>
            </div>
            <div class="card-body">
                @if(session('cat_update'))
                    <div class="alert alert-success">{{ session('cat_update') }}</div>
                @endif
                @if(session('category_update'))
                    <div class="alert alert-success">{{ session('category_update') }}</div>
                @endif
                <form action="{{ route('category.update', $category->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Category Name</label>
                        <input type="text" class="form-control" name="category_name"
                            value="{{ $category->category_name }}">
                        @error('category_name')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Icon</label>
                        <input type="file" class="form-control" name="icon">
                        <img class="mt-2 ml-5" width="100" height="100"
                            src="{{ asset('uploads/category') }}/{{ $category->icon }}" alt="">
                    </div>
                    <div class="mb-3 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
