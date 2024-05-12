@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-5 m-auto">
        <div class="card">
            <div class="card-header">
                <h2>Subcategory Add</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('subcategory.update', $subcategories->id) }}" method="POST">
                    @csrf
                    @if(session('sub_cat_update'))
                        <div class="alert alert-success">{{ session('sub_cat_update') }}</div>
                    @endif
                    <div class="mb-3">
                        <label for="" class="form-label">Category Name</label>
                        <select name="category">
                            <option value="">Select Category Name</option>
                            @foreach($categories as $category)
                                <option {{ $category->id == $subcategories->category_id?'selected':' ' }} value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Subcategory Name</label>
                        <input type="text" class="form-control" name="subcategory_name" value="{{ $subcategories->subcategory_name }}">
                        @error('subcategory_name')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3 d-flex justify-content-end">
                        <button class="btn btn-success">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
