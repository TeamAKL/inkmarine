@extends('layouts.master')
@section('content')
  <div class="container">
  <form action="{{url('company')}}" method="post">
  @csrf
  <div class="form-group">
    <label for="name">Company Name</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Name">
  </div>
  <div class="form-group">
    <label for="country">Country</label>
    <input type="text" class="form-control" id="country" name="country" placeholder="Country">
  </div>

  <button type="submit" class="btn btn-primary">Add Company</button>
</form>
  </div>
@endsection