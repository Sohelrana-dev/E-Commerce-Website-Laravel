@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h2>Left Offer</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('offer1.update', $offer1->first()->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Title</label>
                        <input type="text" class="form-control" placeholder="enter offer title" name="title" value="{{ $offer1->first()->title }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Price</label>
                        <input type="number" class="form-control" placeholder="enter offer price" name="price" value="{{ $offer1->first()->price }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Discount Price</label>
                        <input type="number" class="form-control" placeholder="enter discount price" name="discount_price" value="{{ $offer1->first()->discount_price }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Offer Date</label>
                        <input type="date" class="form-control" name="date" value="{{ $offer1->first()->date }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        <div class="my-2">
                            <img width="200" id="blah" src="{{ asset('uploads/offer/left') }}/{{ $offer1->first()->image }}" alt="">
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
                <form action="{{ route('offer2.update', $offer2->first()->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Title</label>
                        <input type="text" class="form-control" placeholder="enter offer title" name="title" value="{{ $offer2->first()->title }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Sub Title</label>
                        <input type="text" class="form-control" placeholder="enter offer subtitle" name="sub_title" value="{{ $offer2->first()->sub_title }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])">
                        <div class="my-2">
                            <img width="200" id="blah2" src="{{ asset('uploads/offer/right') }}/{{ $offer2->first()->image }}" alt="">
                        </div>
                    </div>
                    <div class="mb-3 d-flex justify-content-end">
                        <button class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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

