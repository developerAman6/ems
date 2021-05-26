@extends('display')

@section('content')



  <p>
    <h4>Please Enter Your login Credentials here.</h4>
  </P>
  <form action="/maester" method="post">
    @csrf
    <label for="uname">USERNAME:</label><br>
    <input type="text" id="uname" name="name"><br>
    <label for="password">PASSWORD</label><br>
    <input type="password" id="psd" name="password"><br><br>

    <input type="submit" value="Submit">
    <hr>
  </form>
  <a href ="/register">Register</a>

@stop
