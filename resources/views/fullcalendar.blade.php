@extends('layouts.app')
@include('layouts.navbar')
<div class="container">
    <div class="response"></div>
    <div id='calendar'></div>
</div>
<!-- Modal -->
<div class="modal fade" id="new-event-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header"> <h4>Add new Event</h4></div>
            <div class="modal-body">
                <form action="{{ route('events.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div>
                        <div class="form-row">
                            <div class="form-group col-md-6"> 
                                <label for="name">Title</label> <strong class="validationSymbolRequired">*</strong> 
                                <input type="text" class="form-control" id="name" name="name" required value="{{ old('name') }}">
                            </div>
                            <div class="form-group col-md-6"> 
                                <label for="category">Category</label> <strong class="validationSymbolRequired">*</strong> 
                                <select type="text" class="form-control" id="category_id" name="category_id">
                                    <option  value="{{null}}" >{{__('Select Category')}}</option>
                                    @foreach ($categories as $category)
                                        <option  value="{{$category->id}}" {{ old('category_id')}}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6"> 
                                <label for="start_date">Start Date</label> <strong class="validationSymbolRequired">*</strong> 
                                <input type="datetime-local" class="form-control" id="start_date" name="start_date" required value="{{ old('start_date') }}">
                            </div>
                            <div class="form-group col-md-6"> 
                                <label for="end_date">End Date</label> <strong class="validationSymbolRequired">*</strong> 
                                <input type="datetime-local" class="form-control" id="end_date" name="end_date" required value="{{ old('end_date') }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6"> 
                                <label for="status">Status</label> <strong class="validationSymbolRequired">*</strong> 
                                <select type="text" class="form-control" id="status_id" name="status_id">
                                    <option  value="{{null}}" >{{__('Select Status')}}</option>
                                    @foreach ($statuses as $status)
                                        <option  value="{{$status->id}}" {{ old('status_id')}}>{{$status->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6"> 
                                <label for="description" id="description">Description</label> <strong class="validationSymbolRequired">*</strong> 
                                <textarea name="description" id="" cols="60" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="yes" >save</button>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{asset('js/app.js')}}"></script>
<script>
    $(document).ready(function () {      
        var calendar = $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listWeek'
            },
            defaultDate: '2020-10-11',
            navLinks: true,
            eventLimit: true,
            events:
            { 
                url: '/events',
                error: function() 
                {
                    alert("error");
                },
                success: function()
                { 
                    console.log("successfully loaded");
                }
            },
           
        });
        $(".fc-day").click(function(){   
            $('#new-event-modal').modal('show');
       });
       
    });

    </script>