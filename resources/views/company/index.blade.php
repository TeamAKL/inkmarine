@extends('layouts.master')
@section('content')
  <div class="container">
    <a class="btn btn-lg btn-success mb-3" href="{{url('company/create')}}">Add New Company</a>

    <table class="table table-dark table-hover" style="text-align:center;">
      <thead class="thead">
        <tr>
          <th scope="col">COMPANY NAME</th>
          <th scope="col">COUNTRY</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
      @foreach($companies as $company)
        <tr>
          <th scope="row">{{$company->name}}</th>
          <td>{{$company->country}}</td>
          <td>
          <!-- <a class="btn btn-success" href="{{'company/'.$company->id}}">Detail</a> -->
          <a class="btn btn-primary" style="padding:0px 20px;" href="{{'company/edit/'.$company->id}}">Edit</a>
          <a class="btn btn-danger" style="padding:0px 20px;" href="{{'company/del/'.$company->id}}">Del</a>

          </td>
        </tr>
      @endforeach
      </tbody>
    </table>


  </div>
@endsection