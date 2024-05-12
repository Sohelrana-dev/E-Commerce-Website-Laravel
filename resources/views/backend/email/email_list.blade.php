@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <h2>Email List</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>SL</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($emails as $sl=>$email)
                    <tr>
                        <td>{{ $sl+1 }}</td>
                        <td>{{ $email->email }}</td>
                        <td><a href="" class="btn btn-success">Send Offer</a></td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

