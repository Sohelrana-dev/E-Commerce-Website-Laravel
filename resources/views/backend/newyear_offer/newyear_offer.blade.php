@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-8 m-auto">
        <div class="card">
            <div class="card-header">
                <h2>New Year Offer</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('newyear.update', $newyear->first()->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="enter offer title" value="{{ $newyear->first()->title }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Discount</label>
                        <input type="number" class="form-control" name="discount" placeholder="enter offer discount"  value="{{ $newyear->first()->discount }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        <div class="my-3">
                            <img width="200" id="blah" src="{{ asset('uploads/newyear_offer') }}/{{ $newyear->first()->image }}" alt="">
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
@if(session('offer_suc'))
    <script>
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "{{ session('offer_suc') }}",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif
@endsection
