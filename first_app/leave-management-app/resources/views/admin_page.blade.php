@extends('welcome')
@section('content')
<div>
    <button><a href='form_user'>CREATE NEW USER</a></button>
    <button><a href='form_team'>CREATE NEW TEAM</a></button>
    <button><a href='form_project'>CREATE NEW PROJECT</a></button>
    <button><a href='logout'>LOGOUT</a></button>
</div>
<div>
    <div>
        <h4>ADMINISTRATORS:</h4>
        @foreach ($admins as $user)
            <p>name: {{ $user->name }} &#9 email: {{ $user->email }}</p>
        @endforeach
    </div>
    <div>
        <h4>PROJECT LEADS:</h4>
        @foreach ($prLeads as $user)
            <p>name: {{ $user->name }} &#9 email: {{ $user->email }}</p>
        @endforeach
    </div>
    <div>
        <h4>TEAM LEADS:</h4>
        @foreach ($tmLeads as $user)
            <p>name: {{ $user->name }} &#9 email: {{ $user->email }}</p>
        @endforeach
    </div>
    <div>
        <h4>MEMBERS:</h4>
        @foreach ($regulars as $user)
            <p>name: {{ $user->name }} &#9 email: {{ $user->email }}</p>
        @endforeach
    </div>
</div>
<hr>
<div>
    <div>
        <h4>PROJECTS:</h4> 
        @foreach ($projects as $project)
            <p>title: {{ $project->title }} &#9 lead: &#9 members: </p>
        @endforeach
    </div>
    <hr>
    <div>
        <h4>TEAMS:</h4>
        @foreach ($teams as $team)
            <p>title: {{ $team->title }} &#9 lead: &#9 members: </p>
        @endforeach
    </div>
    <hr>
    <div>
        <h4>INQUIRIES:</h4>
        @foreach ($inquiries as $inquiry)
            <p>employee: &#9 start date: {{ $inquiry->startDate }}  &#9 number of days: {{ $inquiry->numOfDays }}</p>
        @endforeach
    </div>
</div>
@endsection