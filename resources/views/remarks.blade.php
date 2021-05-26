@extends('display')

@section('content')

    <h4>Here is a list of customers.</h4>
    <hr>
    <table>
    <tr>
      <th>DATE</th>
      <th>REMARK</th>
      <th>ND</th>
    </tr>

  <?php foreach ($followups as $followup): ?>
    <tr>
      <td>{{$followup->tdate}} </td>
      <td>{{$followup->remark}} </td>
      <td>{{$followup->nd}} </td>
    </tr>
  <?php endforeach; ?>
  </table>
  <hr>
  <form action="/remark" method="post">
    @csrf
    <label for="status">STATUS:</label>
    <select id="status" name="status">
        <option value="line up">LINE UP</option>
        <option value="prospect">PROSPECT</option>
        <option value="hot">HOT</option>
        <option value="warm">WARM</option>
        <option value="cold">COLD</option>
        <option value="other">OTHER</option>
        <option value="exchange">EXCHANGE</option>
        <option value="ni">NI</option>
        <option value="nc">NC</option>
        <option value="sold">SOLD</option>
    </select><br>
    <label for="remark">Enter Customers Remark:</label><br>
    <input type="text" id="remark" name="remark"><br>
    <label for="date">Enter Next Followup Date:</label><br>
    <input type="date" id="nd" name="nd"><br>
    <input type="hidden" name = "cust_id" value="{{$followups[0]->cust_id}}">
    <input type="submit" value="Submit">
  </form>
  <hr>
  <h3><a href ="/create">New Enquiry</a> | <a href ="/total">Total Followups</a> | <a href ="/pending">Pending Followups</a></h3>
@stop
