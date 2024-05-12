@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h2>Color List</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Sl</th>
                        <th>Color Name</th>
                        <th>Color</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($colors as $sl=>$color)
                    <tr>
                        <td>{{ $sl+1 }}</td>
                        <td>{{ $color->color_name }}</td>
                        <td>
                            <i style="display: inline-block; background:{{ $color->color_name == 'N/A' ? $color->color_name:$color->color_code }}; width:70px; height:30px; color:{{ $color->color_name == 'N/A'?$color->color_name:'transparent' }};">{{ $color->color_name == 'N/A'?$color->color_name:'color' }}</i>
                        </td>
                        <td><a href="{{ route('color.delete', $color->id) }}" class="btn btn-danger">Delete</a></td>
                    </tr>
                    @endforeach

                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>Size List</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($categories as $category)
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>{{ $category->category_name }}</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Sl</th>
                                        <th>Size</th>
                                        <th>Action</th>
                                    </tr>

                                    @foreach (App\Models\Size::where('category_id', $category->id)->get() as $sl=>$size)

                                    <tr>
                                        <td>{{ $sl+1 }}</td>
                                        <td>{{ $size->size_name }}</td>
                                        <td><a href="{{ route('size.delete', $size->id) }}" class="btn btn-danger">Delete</a></td>
                                    </tr>
                                    @endforeach
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
                <h2>Add Color</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('color.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Color Name</label>
                        <input type="text" class="form-control" placeholder="enter color name" name="color_name">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Color Code</label>
                        <input type="text" class="form-control" placeholder="enter color code" name="color_code">
                    </div>
                    <div class="mb-3 d-flex justify-content-end">
                        <button class="btn btn-success" type="submit">Add Color</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header">
                <h2>Add Size</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('size.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <select name="category_id" id="" class="forn-select">
                            <option value="">select category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Size Name</label>
                        <input type="text" class="form-control" placeholder="enter size name" name="size_name">
                    </div>
                    <div class="mb-3 d-flex justify-content-end">
                        <button class="btn btn-success" type="submit">Add Size</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_content')
@if (session('color_suc'))
<script>
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "{{ session('color_suc') }}",
            showConfirmButton: false,
            timer: 1500
        });
</script>
@endif
@if (session('size_suc'))
<script>
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "{{ session('size_suc') }}",
            showConfirmButton: false,
            timer: 1500
        });
</script>
@endif
@if (session('color_del'))
<script>
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "{{ session('color_del') }}",
            showConfirmButton: false,
            timer: 1500
        });
</script>
@endif
@if (session('size_del'))
<script>
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "{{ session('size_del') }}",
            showConfirmButton: false,
            timer: 1500
        });
</script>
@endif
@endsection
