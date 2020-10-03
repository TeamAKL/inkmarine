@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Create Certificate</h4>
    </div>
    <div class="card-body">
        <form action="{{url('certificate')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Certificate Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
            </div>
            <button type="submit" class="btn btn-primary">Add Certificate</button>
        </form>
    </div>
</div>
@endsection

