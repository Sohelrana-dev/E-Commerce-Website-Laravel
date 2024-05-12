@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h2>Product Full View</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>SL</th>
                        <td>1</td>
                    </tr>
                    <tr>
                        <th>Category Name</th>
                        <td>{{ $product->rel_to_cat->category_name }}</td>
                    </tr>
                    <tr>
                        <th>Subcategory Name</th>
                        <td>{{ $product->rel_to_subcat->subcategory_name }}</td>
                    </tr>
                    <tr>
                        <th>Brand Name</th>
                        <td>{{ $product->rel_to_brand->brand_name }}</td>
                    </tr>
                    <tr>
                        <th>Product Name</th>
                        <td>{{ $product->product_name }}</td>
                    </tr>
                    <tr>
                        <th>Product price</th>
                        <td>{{ $product->price }} &#2547;</td>
                    </tr>
                    <tr>
                        <th>Discount</th>
                        <td>{{ $product->discount }} %</td>
                    </tr>
                    <tr>
                        <th>After Discount</th>
                        <td>{{ $product->after_discount }} &#2547;</td>
                    </tr>
                    <tr>
                        <th>Tag</th>
                        <td>{{ $product->tag }}</td>
                    </tr>
                    <tr>
                        <th>Short Description</th>
                        <td>{!! $product->short_desp !!}</td>
                    </tr>
                    <tr>
                        <th>Long Description</th>
                        <td>{!! $product->long_desp !!}</td>
                    </tr>
                    <tr>
                        <th>Add Info</th>
                        <td>{!! $product->add_info !!}</td>
                    </tr>
                    <tr>
                        <th>Preview Image</th>
                        <td><img src="{{ asset('uploads/product/preview') }}/{{ $product->preview }}" alt=""></td>
                    </tr>
                    <tr>
                        <th>Thumbnail Image</th>
                        <td>
                            @foreach ($thumbnails as $thumbnail)
                            <img width="50px" src="{{ asset('uploads/product/thumbnail') }}/{{ $thumbnail->thumbnail }}" alt="">
                            @endforeach
                        </td>
                    </tr>

                </table>
            </div>
        </div>
    </div>
</div>
@endsection
