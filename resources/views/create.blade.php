@extends('display')

@section('content')



  <form action="/create" method="post">
    @csrf
    <h4><label for="salesman">Welcome {{$emp_name}}, Enter Deails Correctly !</label></h4>
    <input type="hidden" id="emp_id" name="emp_id" value="{{$emp_id}}">
    <label for="soe">Select Source Of Enquiry:</label>
    <select id="soe" name="soe">
        <option value="counter">Counter</option>
        <option value="field">Field</option>
        <option value="facebook">Facebook</option>
        <option value="telephonic">Telephonic</option>
    </select></BR>

    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" value="Name"><br>
    <label for="mobile">Contact</label><br>
    <input type="text" id="mob" name="mob" value="7987175381"><br><br>

    <label for="ape">SELECT BRAND</label><br>
    <input type="radio" id="ape" name="brand" value="ape">
    <label for="ape">APE</label><br>
    <input type="radio" id="yamaha" name="brand" value="yamaha">
    <label for="yamaha">YAMAHA</label><br>
    <input type="radio" id="other" name="brand" value="other">
    <label for="other">Other</label></BR><br>

    <label for="model">Select Model:</label>
    <select id="model" name="model">
        <option value="r15">R15</option>
        <option value="mt15">MT15</option>
        <option value="fzs">FZS</option>
        <option value="fascino">FASCINO</option>
        <option value="rayzr">RAYZR</option>
        <option value="fz25">FZ25</option>
        <option value="paxx">PAXX</option>
        <option value="ldx">LDX</option>
    </select></BR><br>

    <input type="radio" id="cash" name="mop" value="cash">
    <label for="cash">CASH</label><br>
    <input type="radio" id="finance" name="mop" value="finance">
    <label for="finance">FINANCE</label><br><br>

    <label for="status">STATUS:</label>
    <select id="status" name="status">
        <option value="lineup">LINE UP</option>
        <option value="prospect">PROSPECT</option>
        <option value="hot">HOT</option>
        <option value="warm">WARM</option>
        <option value="cold">COLD</option>
        <option value="other">OTHER</option>
        <option value="exchange">EXCHANGE</option>
        <option value="ni">NI</option>
        <option value="nc">NC</option>
        <option value="sold">SOLD</option>
    </select><br><br>

    <label for="remark">REMARK:</label><br>
    <input type="text" id="remark" name="remark" value="remark"><br><br>

    <label for="nextdate">Enter Next Date Of Followup:</label>
    <input type="date" id="nd" name="nd"><br><br>

    <input type="submit" value="Submit">
  </form>

  <!-- {{var_dump($errors)}} -->
  <!-- @if($errors->any())
    <ul class="alert alert-danger">
      @foreach ($errors as $error)
        <li>{{$error}}</li>
      @endforeach
    </ul>
  @endif -->
  <hr>
  <h3>
  <a href ="/dashboard">Dashboard</a> | <a href ="/today">Today Followups</a> | <a href ="/total">Total Followups</a> | <a href ="/pending">Pending Followups</a></h3>


@stop
