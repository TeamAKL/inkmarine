@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8"> 
            <div class="card">
                <div class="card-header">
                    <h4>Create Certificate</h4>
                </div>
                <div class="card-body">
                    <form action="{{url('certificate')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="title" class="col-md-3 offset-md-1 col-form-label text-md-right">Certificate Title</label>
                            <input type="text" class="form-control col-md-6" id="title" name="title" placeholder="Enter title" required>
                        </div>
                        <div class="row">
                           <button type="submit" class="btn btn-primary col-md-3 offset-md-7">Add Certificate</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

