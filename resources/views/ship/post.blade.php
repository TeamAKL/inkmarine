@extends('layouts.master')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8"> 
        <div class="card">
          <div class="card-body">
            <form action="{{url('ship')}}" method="post">
              @csrf
              <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label" style="padding-left:15%;">Ship Name :</label>
                <input type="text" class="form-control col-md-6" id="ship_name" name="ship_name" placeholder="Enter Ship Name">
              </div>
              <div class="form-group row">
                <label for="country" class="col-md-4 col-form-label" style="padding-left:15%;">Ship Type :</label>
                <input type="text" class="form-control col-md-6" id="ship_type" name="ship_type" placeholder="Enter Ship Type">
              </div>
              <div class="form-group row">
                <label for="company" class="col-md-4 col-form-label" style="padding-left:15%;">Company :</label>
                
                <select class="form-control col-md-6" id="company" name="company_id">
                @foreach($companies as $company)
                  <option value="{{$company->id}}">{{$company->name}}</option>
                @endforeach

                  <!-- <option>2</option>
                  <option>3</option> -->
                </select>
              
              </div>
              <div class="form-group row">
                <label for="grt" class="col-md-4 col-form-label" style="padding-left:15%;">GRT :</label>
                <input type="text" class="form-control col-md-6" id="grt" name="grt" placeholder="Enter Grt">
              </div>
              <div class="form-group row">
                <label for="kw" class="col-md-4 col-form-label" style="padding-left:15%;">KW :</label>
                <input type="text" class="form-control col-md-6" id="kw" name="kw" placeholder="Enter Kw">
              </div>
              <div class="form-group row">
                <label for="area" class="col-md-4 col-form-label" style="padding-left:15%;">Area :</label>
                <input type="text" class="form-control col-md-6" id="area" name="area" placeholder="Area">
              </div>

              <button type="submit" class="btn btn-primary" style="margin-left:68.3%;padding:7px 25px;">Add Ship</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection