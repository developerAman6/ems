@extends('display')

@section('content')

    <h4><a href ="/dashboard">ENQUIRY DASHBOARD</a> | <a href ="/logout">LOGOUT</a> | <a href ="/reset">PASSWORD RESET</a></h4>
    <hr>
    <table>
    <tr>
      <th>NAME</th>
      <th>IN PROGRESS</th>
      <th>EMI COLLECTED</th>
      <th>CLEAR</th>
      <th>SEASE</th>
      <th>NOT CONNECTED</th>
      <th>SEASED</th>
      <th>BAD DEBTS</th>
      <th>TOTAL</th>
    </tr>
    <?php foreach ($counts as $count): ?>

    <tr>
      <td>{{$count['name']}} </td>
      <td>{{$count['inprogress']}} </td>
      <td>{{$count['emicollected']}} </td>
      <td>{{$count['clear']}} </td>
      <td>{{$count['sease']}} </td>
      <td>{{$count['nc']}} </td>
      <td>{{$count['seased']}} </td>
      <td>{{$count['baddebts']}} </td>
      <td>{{$count['total']}} </td>
    </tr>


    <?php endforeach; ?>
  </table>

  <hr>
  <h3><a href ="/recoverycreate">Add Customer</a> | <a href ="/recoverytoday">Recovery Today Followups</a> | <a href ="/recoverytotal">Recovery Total Followups</a> | <a href ="/recoverypending">Recovery Pending Followups</a></h3>
@stop
