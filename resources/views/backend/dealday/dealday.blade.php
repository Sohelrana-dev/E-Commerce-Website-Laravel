@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h2>Left Offer</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('dealday1.update', $dealday1->first()->id ) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="enter offer title"
                            value="{{ $dealday1->first()->title }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Offer Price</label>
                        <input type="number" class="form-control" name="price" placeholder="enter offer price"
                            value="{{ $dealday1->first()->price }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Discount Price</label>
                        <input type="number" class="form-control" name="discount_price"
                            placeholder="enter discount price" value="{{ $dealday1->first()->discount_price }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image"
                            onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        <div class="my-3">
                            <img width="200" id="blah"
                                src="{{ asset('uploads/dealday/left') }}/{{ $dealday1->first()->image }}"
                                alt="">
                        </div>
                    </div>
                    <div class="mb-3 d-flex justify-content-end">
                        <button class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h2>Right Offer</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('dealday2.update', $dealday2->first()->id ) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="enter offer title"
                            value="{{ $dealday2->first()->title }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Offer Price</label>
                        <input type="number" class="form-control" name="price" placeholder="enter offer price"
                            value="{{ $dealday2->first()->price }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Discount Price</label>
                        <input type="number" class="form-control" name="discount_price"
                            placeholder="enter discount price" value="{{ $dealday2->first()->discount_price }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image"
                            onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])">
                        <div class="my-3">
                            <img width="200" id="blah2"
                                src="{{ asset('uploads/dealday/right') }}/{{ $dealday2->first()->image }}"
                                alt="">
                        </div>
                    </div>
                    <div class="mb-3 d-flex justify-content-end">
                        <button class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6"></div>
</div>
@endsection
@section('footer_content')
@if(session('offer1_suc'))
    <script>
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "{{ session('offer1_suc') }}",
            showConfirmButton: false,
            timer: 1500
        });

    </script>

@endif
@endsection
