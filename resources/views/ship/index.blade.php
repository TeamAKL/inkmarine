@extends('layouts.master')
@section('content')
   <div class="container">
   <table class="table table-dark table-hover" style="text-align:center;">
  <thead class="thead">
    <tr>
      <th scope="col">SHIP NAME</th>
      <th scope="col">SHIP TYPE</th>
      <th scope="col">COMPANY</th>
      <th scope="col">GRT</th>
      <th scope="col">KW</th>
      <th scope="col">AREA</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
   @foreach($ships as $ship)
    <tr>
      <th scope="row">{{$ship->ship_name}}</th>
      <td scope="row">{{$ship->ship_type}}</td>
      <td scope="row">
      @foreach($companies as $company)
       @if($ship->company_id==$company->id)
        {{$company->name}}
       @endif
       @endforeach 
      </td>
      <td scope="row">{{$ship->grt}}</td>
      <td scope="row">{{$ship->kw}}</td>
      <td scope="row">{{$ship->area}}</td>

      <td>
      <!-- <a class="btn btn-success" href="{{'ship/'.$ship->id}}">Detail</a> -->
      <a class="btn btn-primary" style="padding:0px 20px;" href="{{'ship/edit/'.$ship->id}}">Edit</a>
      <a class="btn btn-danger" style="padding:0px 20px;" href="{{'ship/del/'.$ship->id}}">Del</a>

      </td>
    </tr>
   @endforeach
  </tbody>
</table>

<a class="btn btn-lg btn-success" href="{{url('ship/create')}}">Add New Ship</a>

   </div>
@endsection