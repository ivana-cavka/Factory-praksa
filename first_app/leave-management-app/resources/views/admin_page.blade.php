@extends('welcome')
@section('content')
<button><a href='form_user'>CREATE NEW USER</a></button>
<button><a href='form_user'>CREATE NEW TEAM</a></button>
<button><a href='form_user'>CREATE NEW PROJECT</a></button>
<button><a href='logout'>LOGOUT</a></button>
<div>
    <h5>ADMINISTRATORS:</h4>
    @foreach ($admins as $user)
        <p>name: {{ $user->name }} &#9 email: {{ $user->email }}</p>
    @endforeach
</div>
<div>
    <h5>PROJECT LEADS:</h4>
    @foreach ($prLeads as $user)
        <p>name: {{ $user->name }} &#9 email: {{ $user->email }}</p>
    @endforeach
</div>
<div>
    <h5>TEAM LEADS:</h4>
    @foreach ($tmLeads as $user)
        <p>name: {{ $user->name }} &#9 email: {{ $user->email }}</p>
    @endforeach
</div>
<div>
    <h5>MEMBERS:</h4>
    @foreach ($regulars as $user)
        <p>name: {{ $user->name }} &#9 email: {{ $user->email }}</p>
    @endforeach
</div>

@endsection