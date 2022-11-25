@extends('welcome')
@section('content')
<form action='save_new_inquiry/{{$id}}' method='post'>
    @csrf
    Start date: <input type='date' name='startDate'>
    <br><br>
    Number of days: <input type='number' name='numOfDays'>
    <br><br>
    <button type='submit'>SAVE</button>
</form>
@endsection