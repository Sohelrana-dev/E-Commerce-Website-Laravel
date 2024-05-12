@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Profile Update</h6>
                @if(session('name_update'))
                    <div class="alert alert-success">{{ session('name_update') }}</div>
                @endif
                <form class="forms-sample" action="{{ route('user.update') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}">
                    </div>
                    <div class="form-group">
                        <label>Email address</label>
                        <input type="email" class="form-control" value="{{ auth()->user()->email }}" name="email">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Password Update</h6>
                @if(session('name_update'))
                    <div class="alert alert-success">{{ session('name_update') }}</div>
                @endif
                @if(session('pass_success'))
                    <div class="alert alert-success">{{ session('pass_success') }}</div>
                @endif
                <form class="forms-sample" action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Current Password</label>
                        <input type="password" class="form-control" name="current_password">
                        @if(session('pass_error'))
                            <strong class="text-danger">{{ session('pass_error') }}</strong>
                        @endif
                        @error('current_password')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" class="form-control" name="password">
                        @error('password')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation">
                        @error('password_confirmation')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">photo Update</h6>
                @if(session('photo_suc'))
                    <div class="alert alert-success">{{ session('photo_suc') }}</div>
                @endif
                <form class="forms-sample" action="{{ route('photo.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Photo</label>
                        <input type="file" class="form-control" name="photo">
                        @error('photo')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
