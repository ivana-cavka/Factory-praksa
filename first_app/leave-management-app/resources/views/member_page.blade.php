@extends('welcome')
@section('content')
<div>
    <button><meta http-equiv="refresh" content="10; url=/" /><a href='/form_inquiry/{{$user->id}}'>CREATE NEW INQUIRY</a></button>
    <button><a href='/logout'>LOGOUT</a></button>
</div>

@if ($user->role == "member")
<div name="forMembers">
    <div>
        <h4>MY PROJECT:</h4>
        <p>title: {{ $project->title }} &#9 lead: {{ $projectLead->name }} </p>
    </div>
    <div>
        <h4>MY TEAM:</h4>
        <p>title: {{ $team->title }} &#9 lead: {{ $teamLead->name }}</p>
    </div>
    <hr>
</div>
@endif

@if ($user->role == "project lead")
<div name="forProjectLeads">
    <div>
        <h4>MY TEAM:</h4>
        <p>title: {{ $team->title }} &#9 lead: {{ $teamLead->name }}</p>
        <hr>
        <h4>MY PROJECT</h4> 
        title: {{ $project->title }}
        <div>
            <h4>MEMBERS:</h4>
            @foreach ($projectMembers as $member)
                <p>name: {{ $member->name }} &#9 email: {{ $member->email }} 
                    &#9 inquiries: 
                    @foreach ($inquiriesByProjectMembers[$member->id] as $inquiry)
                        @if ($inquiry->teamLeadApproval && $inquiry->projectTeamApproval)
                            &#9<a href="">&#9745</a>
                        @elseif ($inquiry->teamLeadApproval || $inquiry->projectTeamApproval)
                            &#9<a href="">&quest</a>
                        @else
                            &#9<a href="">&#9746</a>
                        @endif
                    @endforeach
                </p>
            @endforeach
        </div>
    </div>
    <hr>
</div>
@endif

@if ($user->role == "team lead")
<div name="forTeamLeads">
    <div>
        <h4>MY PROJECT:</h4>
        <p>title: {{ $project->title }} &#9 lead: {{ $projectLead->name }} </p>
        <hr>
        <h4>MY TEAM</h4> 
        title: {{ $team->title }}
        <div>
            <h4>MEMBERS:</h4>
            @foreach ($teamMembers as $member)
                <p>name: {{ $member->name }} &#9 email: {{ $member->email }} 
                    &#9 inquiries: 
                    @foreach ($inquiriesByTeamMembers[$member->id] as $inquiry)
                        @if ($inquiry->teamLeadApproval && $inquiry->projectTeamApproval)
                            &#9<a href="">&#9745</a>
                        @elseif ($inquiry->teamLeadApproval || $inquiry->projectTeamApproval)
                            &#9<a href="">&quest</a>
                        @else
                            &#9<a href="">&#9746</a>
                        @endif
                    @endforeach
                </p>
            @endforeach
        </div>
    </div>
    <hr>
</div>
@endif

<div name="forAll">
    <h4>MY INQUIRIES:</h4>
    @foreach ($inquiries as $inquiry)
    <p>status: @if ($inquiry->teamLeadApproval && $inquiry->projectTeamApproval)
            &#9<a href="">&#9745</a>
        @elseif ($inquiry->teamLeadApproval || $inquiry->projectTeamApproval)
            &#9<a href="">&quest</a>
        @else
            &#9<a href="">&#9746</a>
        @endif
    start date: {{ $inquiry->startDate }}  &#9 number of days: {{ $inquiry->numOfDays }}</p>
    @endforeach
</div>
@endsection