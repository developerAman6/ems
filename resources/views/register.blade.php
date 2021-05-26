@extends('display')

@section('content')



  <p>
    Welcome to SK MOTOS GWALIOR.
  </n>login here.
  </P>
  <br>
  <br>
  <form action="/register" method="post">
    @csrf
    <label for="name">NAME:</label><br>
    <input type="text" id="name" name="name"><br>
    <label for="uname">USERNAME:</label><br>
    <input type="text" id="uname" name="uname"><br>
    <label for="mobile">CONTACT</label><br>
    <input type="text" id="mob" name="mob"><br>
    <label for="password">PASSWORD</label><br>
    <input type="password" id="psd" name="password"><br><br>
    <label for="password">CONFIRM PASSWORD</label><br>
    <input type="password" id="cpsd" name="confirmpassword"><br><br>

    <input type="submit" value="Submit">
    <hr>
  </form>
  <a href ="/">LOGIN</a>

@stop
