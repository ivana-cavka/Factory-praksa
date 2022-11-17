@extends('welcome')
@section('content')
<form action='save_new_team' method='post'>
    @csrf
    Title: <input type='text' name='title'>
    <br><br>
    <button type='submit'>SAVE</button>
</form>
@endsection