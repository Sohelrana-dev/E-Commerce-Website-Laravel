@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h2>Subcategory List</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($categories as $category)
                        <div class="col-lg-6 mb-2">
                            <div class="card">
                                <div class="card-header">
                                    <h3>{{ $category->category_name }}</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-hover">
                                        <tr>
                                            <th>SL</th>
                                            <th>Subcategory Name</th>
                                            <th>Action</th>
                                        </tr>
                                        @forelse (App\Models\Subcategory::where('category_id', $category->id)->get() as $sl => $subcategory)
                                            <tr>
                                                <td>{{ $sl+1 }}</td>
                                                <td>{{ $subcategory->subcategory_name }}</td>
                                                <td>
                                                    <a href="{{ route('subcategory.edit', $subcategory->id) }}"
                                                        class="btn btn-primary btn-icon">
                                                        <i data-feather="edit"></i>
                                                    </a>
                                                    <a class="btn btn-danger ml-2 btn-icon del-btn"
                                                        data-link="{{ route('subcategory.delete', $subcategory->id) }}">
                                                        <i data-feather="trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center" colspan="3">No Data Found</td>
                                            </tr>
                                        @endforelse
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h2>Subcategory Add</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('subcategory.add') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Category Name</label>
                        <select name="category">
                            <option value="">Select Category Name</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Subcategory Name</label>
                        <input type="text" class="form-control" name="subcategory_name"
                            placeholder="enter subcategory name">
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

@section('footer_content')
<script>
    $('.del-btn').click(function () {
        var link = $(this).attr('data-link');

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
            }
        });
    })

</script>
@if(session('sub_cat_del'))
    <script>
        Swal.fire({
            title: "Deleted!",
            text: "{{ session('sub_cat_del') }}",
            icon: "success"
        });

    </script>
@endif
@if(session('sub_cat_add'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            title: "{{ session('sub_cat_add') }}"
        });

    </script>
@endif
@if(session('exit'))
    <div class="alert alert-warning"></div>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "warning",
            title: "{{ session('exit') }}"
        });

    </script>
@endif
@endsection
