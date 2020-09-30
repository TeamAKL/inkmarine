@extends('layouts.master')
@section('content')
  <div class="container">
  <form action="{{url('ship/update')}}" method="post">
  @csrf
  @method('put')
  <div class="form-group">
    <label for="name">Ship Name</label>
    <input type="text" class="form-control" id="ship_name" name="ship_name" value="{{$ship->ship_name}}">
  </div>
  <div class="form-group">
    <label for="country">Ship Type</label>
    <input type="text" class="form-control" id="ship_type" name="ship_type" value="{{$ship->ship_type}}">
  </div>
  <div class="form-group">
    <label for="company">Company</label>
    
    <select class="form-control" id="company" name="company_id">
     @foreach($companies as $company)
      @if($ship->company_id==$company->id)
      <option value="{{$company->id}}" selected>{{$company->name}}</option>
      @endif
      <option value="{{$company->id}}">{{$company->name}}</option>
     @endforeach

      <!-- <option>2</option>
      <option>3</option> -->
    </select>
   
  </div>
  <div class="form-group">
    <label for="grt">GRT</label>
    <input type="text" class="form-control" id="grt" name="grt" value="{{$ship->grt}}">
  </div>
  <div class="form-group">
    <label for="kw">KW</label>
    <input type="text" class="form-control" id="kw" name="kw" value="{{$ship->kw}}">
  </div>
  <div class="form-group">
    <label for="area">Area</label>
    <input type="text" class="form-control" id="area" name="area" value="{{$ship->area}}">
  </div>

  <button type="submit" class="btn btn-primary">Edit Ship</button>
</form>
  </div>
@endsection