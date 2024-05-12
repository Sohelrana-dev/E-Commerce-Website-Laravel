@extends('layouts.admin');

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h2>User List</h2>
            </div>
            <div class="card-body">
                @if(session('user_delete'))
                    <div class="alert alert-success">{{ session('user_delete') }}</div>
                @endif
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                    @foreach($abc as $sl=>$abcd)
                        <tr>
                            <td>{{ $sl+1 }}</td>
                            <td>
                                @if($abcd->photo == null)
                                    <img src="{{ Avatar::create($abcd->name)->toBase64() }}" alt="">
                                @else
                                    <img src="{{ asset('uploads/users') }}/{{ $abcd->photo }}"
                                        alt="">
                                @endif
                            </td>
                            <td>{{ $abcd->name }}</td>
                            <td>{{ $abcd->email }}</td>
                            <td>
                                <a href="{{ route('user.delete', $abcd->id) }}"
                                    class="btn btn-danger btn-icon">
                                    <i data-feather="trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h2>Add New User</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('user.add') }}" method="POST">
                    @csrf

                    @if (session('add_success'))
                    <div class="alert alert-success">{{ session('add_success') }}</div>
                    @endif
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="enter user name" value="{{ old('name') }}">
                        @error('name')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" placeholder="enter email" value="{{ old('email') }}">
                        @error('email')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="password">
                        @error('password')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password"
                            placeholder="confirm password">
                        @error('confirm_password')
                            <strong class="text-danger"> {{ $message }}</strong>
                        @enderror
                        @if(session('con_err'))
                        <strong class="text-danger">{{ session('con_err') }}</strong>
                        @endif
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
