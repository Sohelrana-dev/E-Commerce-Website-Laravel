@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>Inventory For, <strong>{{ $product->product_name }}</strong></h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Sl</th>
                        <th>color Name</th>
                        <th>Size Name</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($inventories as $sl=>$inventory)
                    <tr>
                        <td>{{ $sl+1 }}</td>
                        <td>{{ $inventory->rel_to_color->color_name }}</td>
                        <td>{{ $inventory->rel_to_size->size_name }}</td>
                        <td>{{ $inventory->quantity}}</td>
                        <td><a href="{{ route('inventory.delete', $inventory->id) }}" class="btn btn-danger">Delete</a></td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h2>Add Inventory</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('inventory.store', $product->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="text" disabled class="form-control" value="{{ $product->product_name }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Color Name</label>
                        <select name="color_id" id="" class="form-select">
                            <option value="">select color</option>
                            @foreach ($colors as $color)
                            <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Size Name</label>
                        <select name="size_id" id="" class="form-select">
                            <option value="">select size</option>
                            @foreach (App\Models\Size::where('category_id', $product->category_id)->get() as $size)
                            <option value="{{ $size->id }}">{{ $size->size_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Quantity</label>
                        <input type="number" class="form-control" placeholder="enter product quantity" name="quantity">
                    </div>
                    <div class="mb-3 d-flex justify-content-end">
                        <button class="btn btn-success" type="submit">Add Inventory</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('footer_content')
@if (session('inventory_suc'))
<script>
     Swal.fire({
            position: "top-end",
            icon: "success",
            title: "{{ session('inventory_suc') }}",
            showConfirmButton: false,
            timer: 1500
        });
</script>
@endif
@if (session('inventory_delete'))
<script>
     Swal.fire({
            position: "top-end",
            icon: "success",
            title: "{{ session('inventory_delete') }}",
            showConfirmButton: false,
            timer: 1500
        });
</script>
@endif
@endsection
