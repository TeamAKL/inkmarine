<!-- @extends('layouts.master')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8"> 
        <div class="card">
          <div class="card-body">
            <form action="{{url('ship')}}" method="post">
              @csrf
              <div class="form-group row">
                <label for="name" class="col-md-3 offset-md-1 col-form-label">Ship Name :</label>
                <input type="text" class="form-control col-md-6" id="ship_name" name="ship_name" placeholder="Enter Ship Name" required>
              </div>
              <div class="form-group row">
                <label for="country" class="col-md-3 offset-md-1 col-form-label">Ship Type :</label>
                <input type="text" class="form-control col-md-6" id="ship_type" name="ship_type" placeholder="Enter Ship Type" required>
              </div>
              <div class="form-group row">
                <label for="company" class="col-md-3 offset-md-1 col-form-label">Company :</label>
                
                <select class="form-control col-md-6" id="company" name="company_id">
                @foreach($companies as $company)
                  <option value="{{$company->id}}">{{$company->name}}</option>
                @endforeach

                
                </select>
              
              </div>
              <div class="form-group row">
                <label for="grt" class="col-md-3 offset-md-1 col-form-label">GRT :</label>
                <input type="text" class="form-control col-md-6" id="grt" name="grt" placeholder="Enter Grt" required>
              </div>
              <div class="form-group row">
                <label for="kw" class="col-md-3 offset-md-1 col-form-label">KW :</label>
                <input type="text" class="form-control col-md-6" id="kw" name="kw" placeholder="Enter Kw" required>
              </div>
              <div class="form-group row">
                <label for="area" class="col-md-3 offset-md-1 col-form-label">Area :</label>
                <input type="text" class="form-control col-md-6" id="area" name="area" placeholder="Area" required>
              </div>

              <div class="row">
                <button type="submit" class="btn btn-primary col-md-3 offset-md-7">Add Ship</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection -->