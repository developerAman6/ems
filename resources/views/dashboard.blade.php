@extends('display')

@section('content')

    <h4><a href ="/logout">LOGOUT</a> | <a href ="/reset">PASSWORD RESET</a></h4>
    <hr>
    <table>
    <tr>
      <th>NAME</th>
      <th>LINE UP</th>
      <th>PROSPECT</th>
      <th>HOT</th>
      <th>WARM</th>
      <th>COLD</th>
      <th>EXCHANGE</th>
      <th>OTHER</th>
      <th>NI</th>
      <th>NC</th>
      <th>SOLD</th>
      <th>TOTAL</th>
    </tr>
    <?php foreach ($counts as $count): ?>

    <tr>
      <td>{{$count['name']}} </td>
      <td>{{$count['lineup']}} </td>
      <td>{{$count['prospect']}} </td>
      <td>{{$count['hot']}} </td>
      <td>{{$count['warm']}} </td>
      <td>{{$count['cold']}} </td>
      <td>{{$count['exchange']}} </td>
      <td>{{$count['other']}} </td>
      <td>{{$count['ni']}} </td>
      <td>{{$count['nc']}} </td>
      <td>{{$count['sold']}} </td>
      <td>{{$count['total']}} </td>

    </tr>

    <?php endforeach; ?>
    
  </table>

  <hr>
  <h3><a href ="/create">Add Enquiry</a> | <a href ="/today">Today Followups</a> | <a href ="/total">Total Followups</a> | <a href ="/pending">Pending Followups</a></h3>
@stop
