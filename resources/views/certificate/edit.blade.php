@extends('layouts.master')
@section('content')
  <div class="container">
    <form action="{{url('certificate/update/')}}" method="post">
    @csrf
    @method('put')
        <div class="form-group">
            <input type="hidden" name="id" id="id" value="{{$certificate->id}}">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$certificate->title}}">
        </div>
        <button type="submit" class="btn btn-primary" style="padding:6px 30px">Edit</button>
    </form>
  </div>
@endsection