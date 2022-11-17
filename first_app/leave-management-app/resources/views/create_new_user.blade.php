@extends('welcome')
@section('content')
<form action='save_new_user' method='post'>
    @csrf
    Name: <input type='text' name='name'>
    <br><br>
    Email: <input type='text' name='email'>
    <br><br>
    Password: <input type='text' name='password'>
    <br><br>
    Role: 
    <select name="role">
        <option value="admin">ADMIN</option>
        <option value="project lead">PROJECT LEAD</option>
        <option value="team lead">TEAM LEAD</option>
        <option value="member">MEMBER</option>
    </select>
    <br><br>
    Max leave days: <input type='number' name='maxLeaveDays'>
    <br><br>
    Team: --TO DO--
    <br><br>
    Project: --TO DO--
    <br><br>
    <button type='submit'>SAVE</button>
</form>
@endsection