@extends('welcome')
@section('content')
USERS:
@foreach ($users as $user)
    <p>This is user {{ $user->id }}</p>
@endforeach
@endsection