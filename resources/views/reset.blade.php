@extends('display')

@section('content')



  <p>
    <h4>Please Enter Your New login Credentials here.</h4>
  </P>
  <form action="/reset" method="post">
    @csrf
    <label for="password">Enter Old Password</label><br>
    <input type="password" id="psd" name="password"><br>
    <label for="newpassword">Enter New Password</label><br>
    <input type="password" id="npsd" name="newpassword"><br>
    <label for="confirmpassword">Confirm New Password</label><br>
    <input type="password" id="cpsd" name="confirmpassword"><br><br>

    <input type="submit" value="Submit">
    <hr>
  </form>
  <a href ="/dashboard">Dashboard</a>

@stop
