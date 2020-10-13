@extends('layouts.app')
@include('layouts.navbar')
@section('content')
    <div class="container">
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    @if($errors->any()) 
        <div class="alert alert-danger" role="alert">
            <strong>{{$errors->first()}}</strong>
        </div>
    @endif 
    <div class="row">
        <form method="POST" action="{{ route('categories.store') }}">
            {{ csrf_field() }}
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h5><b>New Category</b></h5>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6"> 
                                    <label for="name">Name</label> <strong class="validationSymbolRequired">*</strong> 
                                    <input type="text" class="form-control" id="name" name="name" required value="{{ old('name') }}">
                                </div>
                                <div class="form-group col-md-6"> 
                                    <label for="name">Description</label> <strong class="validationSymbolRequired">*</strong> 
                                    <input type="text" class="form-control" id="name" name="description" required value="{{ old('description') }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-3"></div>
                                <div class="col-md-3"></div>
                                <div class="form-group"> 
                                    <div class="row">
                                        <div class="form-group" >
                                            <button type="button"  onclick="window.location='{{url('/matches/index')}}'"  class="btn btn-success">close</button>
                                            <button type="submit" id="save" class="btn btn-primary"> save</button >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection