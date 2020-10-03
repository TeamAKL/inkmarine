@extends('layouts.master')
@section('content')
  <div class="container">
  <form action="{{url('ship')}}" method="post">
  @csrf
  <div class="form-group">
    <label for="name">Ship Name</label>
    <input type="text" class="form-control" id="ship_name" name="ship_name" placeholder="Enter Ship Name">
  </div>
  <div class="form-group">
    <label for="country">Ship Type</label>
    <input type="text" class="form-control" id="ship_type" name="ship_type" placeholder="Enter Ship Type">
  </div>
  <div class="form-group">
    <label for="company">Company</label>
    
    <select class="form-control" id="company" name="company_id">
     @foreach($companies as $company)
      <option value="{{$company->id}}">{{$company->name}}</option>
     @endforeach

      <!-- <option>2</option>
      <option>3</option> -->
    </select>
   
  </div>
  <div class="form-group">
    <label for="grt">GRT</label>
    <input type="text" class="form-control" id="grt" name="grt" placeholder="Enter Grt">
  </div>
  <div class="form-group">
    <label for="kw">KW</label>
    <input type="text" class="form-control" id="kw" name="kw" placeholder="Enter Kw">
  </div>
  <div class="form-group">
    <label for="area">Area</label>
    <input type="text" class="form-control" id="area" name="area" placeholder="Area">
  </div>

  <button type="submit" class="btn btn-primary">Add Ship</button>
</form>
  </div>
@endsection