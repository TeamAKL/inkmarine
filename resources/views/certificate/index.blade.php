@extends('layouts.master')
@section('content')
   
  <div class="container">
    <a class="btn btn-success btn-lg mb-3" href="{{url('certificate/create')}}" style="padding: 5px 30px;">Add New Certificate</a>

    <table class="table table-hover" style="text-align:center;">
      <thead class="thead-dark">
        <tr>
          
          <th scope="col">Title</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
      @foreach($certificates as $certificate)
        <tr>
          <td>{{$certificate->title}}</td>
          <td>
          <!-- <a class="btn btn-success" href="{{'certificate/'.$certificate->id}}">Detail</a> -->
          <a class="btn btn-primary" style="padding: 0px 20px;" href="{{'certificate/edit/'.$certificate->id}}">Edit</a>
          <a class="btn btn-danger" style="padding: 0px 20px;" href="{{'certificate/del/'.$certificate->id}}">Del</a>

          </td>
        </tr>
      @endforeach
      </tbody>
    </table>


  </div>
@endsection
