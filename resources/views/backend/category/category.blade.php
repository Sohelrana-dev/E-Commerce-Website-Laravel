@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <form action="{{ route('check.category') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h2>Category List</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        @if(session('cat_soft_delete'))
                            <div class="alert alert-success">{{ session('cat_soft_delete') }}</div>
                        @endif
                        @if(session('cat_delete'))
                            <div class="alert alert-success">{{ session('cat_delete') }}</div>
                        @endif
                        <tr>
                            <th>
                                @if($category->isNotEmpty())
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" id="chkSelectAll" class="form-check-input">
                                            Checked
                                            <i class="input-frame"></i></label>
                                    </div>
                                @endif
                            </th>
                            <th>SL</th>
                            <th>Category Name</th>
                            <th>Icon</th>
                            <th>Action</th>
                        </tr>
                        @foreach($category as $sl=>$categories)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input chkDel" name="category_id[]"
                                                value="{{ $categories->id }}">
                                            <i class="input-frame"></i></label>
                                    </div>
                                </td>
                                <td>{{ $sl+1 }}</td>
                                <td>{{ $categories->category_name }}</td>
                                <td><img src="{{ asset('uploads/category') }}/{{ $categories->icon }}"
                                        alt="{{ $categories->icon }}"></td>
                                <td>
                                    <a href="{{ route('category.edit', $categories->id) }}"
                                        class="btn btn-primary btn-icon">
                                        <i data-feather="edit"></i>
                                    </a>
                                    <a href="{{ route('category.soft.delete', $categories->id) }}"
                                        class="btn btn-danger ml-2 btn-icon">
                                        <i data-feather="trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    @if($category->isNotEmpty())
                        <button class="btn btn-danger mt-2" type="submit">Move To Trash</button>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h2>Add Category</h2>
            </div>
            <div class="card-body">

                <form action="{{ route('category.add') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @if(session('add_success'))
                        <div class="alert alert-success">{{ session('add_success') }}</div>
                    @endif
                    <div class="mb-3">
                        <label for="" class="form-label">Category Name</label>
                        <input type="text" class="form-control" name="category_name" placeholder="enter category name">
                        @error('category_name')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Icon</label>
                        <input type="file" class="form-control" name="icon">
                        @error('icon')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3 d-flex justify-content-end">
                        <button class="btn btn-success" type="submit">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('footer_content')
<script>
    $("#chkSelectAll").on('click', function () {
        this.checked ? $(".chkDel").prop("checked", true) : $(".chkDel").prop("checked", false);
    })

</script>
@endsection
