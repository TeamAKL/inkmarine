@extends('layouts.master')
@section('content')
  <div class="container">
  <form action="{{url('company/update')}}" method="post">
  @csrf
  @method('put')
  <div class="form-group">
    <input type="hidden" name="id" id="id" value="{{$company->id}}">
    <label for="name">Company Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{$company->name}}">
  </div>
  <div class="form-group">
    <label for="country">Country</label>
    <input type="text" class="form-control" id="country" name="country" value="{{$company->country}}">
  </div>

  <button type="submit" class="btn btn-primary">Edit Company</button>
</form>
  </div>
@endsection