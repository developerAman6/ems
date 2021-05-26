@extends('display')

@section('content')


    <h4>Here is a list of customers.</h4>
  <hr>
  <table>
    <tr>
      <th>NAME</th>
      <th>MOBILE</th>
      <th>ALT MOBILE</th>
      <th>MODEL</th>
      <th>STATUS</th>
      <th>NEXT DATE</th>
    </tr>

    <?php foreach ($customers as $customer): ?>
      <tr>
        <td><a href="/remarks/{{$customer->cust_id }}">{{$customer->cust_name}}</td></a>
        <td>{{$customer->cust_mobile}} </td>
        <td>{{$customer->alt_mobile}} </td>
        <td>{{$customer->model}} </td>
        <td>{{$customer->status}} </td>
        <td>{{$customer->nd}} </td>
        <td>
      </tr>
    <?php endforeach; ?>
  </table>
  <hr>
  <h3><a href ="/dashboard">Dashboard</a> | <a href ="/create">Add Enquiry</a> | <a href ="/today">Today Followups</a> | <a href ="/pending">Pending Followups</a></h3>

@stop
