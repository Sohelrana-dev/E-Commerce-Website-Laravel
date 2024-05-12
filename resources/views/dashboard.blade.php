@extends('layouts.admin')

@section('content')
<h1>Welcome to Dashboard, <strong class="text-primary">{{ auth()->user()->name }}</strong></h1>
@endsection
