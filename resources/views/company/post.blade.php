@extends('layouts.master')
@section('content')
  <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8"> 
            <div class="card">
              <div class="card-body">
                <form action="{{url('company')}}" method="post">
                  @csrf
                  <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label" style="padding-left:12%;">Company Name :</label>
                    <input type="text" class="form-control col-md-6" id="name" name="name" placeholder="Enter Company Name" required>
                  </div>
                  <div class="form-group row">
                    <label for="country" class="col-md-4 col-form-label" style="padding-left:12%;">Country :</label>
                    <input type="text" class="form-control col-md-6" id="country" name="country" placeholder="Country" required>
                  </div>

                  <button type="submit" class="btn btn-primary" style="margin-left:67.3%;">Add Company</button>
                </form>
              </div>
            </div>
        </div>
      </div>
  </div>
@endsection