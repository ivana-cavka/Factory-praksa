@extends('welcome')
@section('content')
<p>status: @if ($inquiry->teamLeadApproval + $inquiry->projectTeamApproval == 4)
            &#9 &#9745
        @elseif ($inquiry->teamLeadApproval + $inquiry->projectTeamApproval < 2)
            &#9 &quest
        @else
            &#9 &#9746
        @endif
</p>
<meta http-equiv="refresh" content="10; url=/" />
<form action='update_inquiry/{{$inquiry->id}}' method='post'>
@csrf
<p>team lead approval: {{ $inquiry->teamLeadApproval }}  
    @if ($user->role == 'team lead')
    <input type="radio" id="no" name="team lead approval" value="1"> <label for="no">NO</label><br>
    <input type="radio" id="yes" name="team lead approval" value="2"> <label for="yes">YES</label><br>
    <button type='submit'>SAVE</button>
    @endif
</p>
<p>project lead approval: {{ $inquiry->projectLeadApproval }}
    @if ($user->role == 'project lead')
    <input type="radio" id="no" name="project lead approval" value="1"> <label for="no">NO</label><br>
    <input type="radio" id="yes" name="project lead approval" value="2"> <label for="yes">YES</label><br>
    <button type='submit'>SAVE</button>
    @endif
</p>
</form>
<p>start date: {{ $inquiry->startDate }}</p>
<p>number of days: {{ $inquiry->numOfDays }}</p>
@endsection