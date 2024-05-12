@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h2>Product List</h2>
                <a href="{{ route('product') }}" class="btn btn-primary"><i data-feather="plus"></i>Add New Product</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>SL</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>After Discount</th>
                        <th>Preview</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($products as $sl=>$product)
                    <tr>
                        <td>{{ $sl+1 }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->price }} &#2547;</td>
                        <td>{{ $product->discount == ''?0:$product->discount }}%</td>
                        <td>{{ $product->after_discount }} &#2547;</td>
                        <td> <img src="{{ asset('uploads/product/preview/') }}/{{ $product->preview }}" alt=""></td>
                        <td>
                            <div class="checkbox">
                                  <input type="checkbox" {{ $product->status == 1?'checked':''  }} data-id="{{ $product->id }}" data-toggle="toggle" class="status" value="{{ $product->status }}">
                              </div>
                        </td>
                        <td>
                            <a href="{{ route('inventory', $product->id) }}" class="btn btn-success btn-icon ">
                                <i data-feather="archive"></i>
                            </a>
                            <a href="{{ route('product.view', $product->id) }}" class="btn btn-primary btn-icon mx-3">
                                <i data-feather="eye"></i>
                            </a>
                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-info btn-icon mx-2">
                                <i data-feather="edit"></i>
                            </a>
                            <a href="{{ route('product.delete', $product->id) }}"
                                class="btn btn-danger ml-2 btn-icon">
                                <i data-feather="trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_content')
<script>
    $('.status').change(function(){

        if ($(this).val() != 1 ) {
            $(this).attr('value', 1)
        }
        else{
            $(this).attr('value', 0)
        }

        var product_id = $(this).attr('data-id');
        var status = $(this).val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/getProductList',
            type: 'post',
            data: { 'product_id': product_id, 'status':status },
            success: function (data) {
            }
        })
    })
</script>
@endsection


