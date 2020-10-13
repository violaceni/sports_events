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
        <form method="POST" action="{{ route('matches.store') }}">
            {{ csrf_field() }}
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h5><b>New Match</b></h5>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6"> 
                                    <label for="first_team_id">First Team</label> <strong class="validationSymbolRequired">*</strong>
                                    <select class="form-control" id="first_team_id" name="first_team_id" required>
                                        <option  value="{{null}}" >{{__('Select First Team')}}</option>
                                        @foreach ($teams as $team) 
                                            <option  value={{$team->id}} {{ old('first_team_id')}} >{{$team->name}}</option> 
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6"> 
                                    <label for="second_team_id">Second Team</label> <strong class="validationSymbolRequired">*</strong>
                                    <select class="form-control" id="second_team_id" name="second_team_id" required>
                                        <option  value="{{null}}" >{{__('Select Second Team')}}</option>
                                        @foreach ($teams as $team) 
                                            <option  value={{$team->id}} {{ old('second_team_id')}} >{{$team->name}}</option> 
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6"> 
                                    <label for="start_time">Start Time</label> <strong class="validationSymbolRequired">*</strong>
                                    <input type="time" step='1' class="form-control" id="start_time" name="start_time" required  value="{{ old('start_time') }}" autocomplete="off">
                                </div>
                                <div class="form-group col-md-6"> 
                                    <label for="end_time">End Time</label> <strong class="validationSymbolRequired">*</strong>
                                    <input type="time" step='1' class="form-control" id="end_time" name="end_time" required value="{{ old('end_time') }}" autocomplete="off">
                                </div> 
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6"> 
                                    <label for="event_id">Event</label> <strong class="validationSymbolRequired">*</strong>
                                    <select class="form-control" id="event_id" name="event_id" required>
                                        <option  value="{{null}}" >{{__('Select Event')}}</option>
                                        @foreach ($events as $event) 
                                            <option  value={{$event->id}} {{ old('event_id')}} >{{$event->name}}</option> 
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6"> 
                                    <label for="location_id">Venue</label> <strong class="validationSymbolRequired">*</strong>
                                    <select class="form-control" id="location_id" name="location_id" required>
                                        <option  value="{{null}}" >{{__('Select Venue')}}</option>
                                        @foreach ($locations as $location) 
                                            <option  value={{$location->id}} {{ old('location_id')}} >{{$location->venue}}</option> 
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6"> 
                                    <label for="type_id">Type</label> <strong class="validationSymbolRequired">*</strong>
                                    <select class="form-control" id="type_id" name="type_id" required>
                                        <option  value="{{null}}" >{{__('Select Type')}}</option>
                                        @foreach ($types as $type) 
                                            <option  value={{$type->id}} {{ old('type_id')}} >{{$type->name}}</option> 
                                        @endforeach
                                    </select>
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