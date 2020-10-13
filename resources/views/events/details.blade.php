@extends('layouts.app')
@include('layouts.navbar')
@section('content')
<h4  class="card-title theme-font" style="color: #fff">Event Details</h4>
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
        <form method="POST" action="{{ route('events.update', $event->id) }}">
            {{ csrf_field() }}
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h5><b>Edit Event</b></h5>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6"> 
                                    <label for="title">Title</label> <strong class="validationSymbolRequired">*</strong>
                                    <input type="text" class="form-control" id="name" name="name" required value="{{ old('name', $event->name) }}">
                                </div>
                                <div class="form-group col-md-6"> 
                                    <label for="category_id">Category</label> <strong class="validationSymbolRequired">*</strong>
                                    <select class="form-control" id="category_id" name="category_id" required>
                                        @foreach ($categories as $category) 
                                            <option @if($category->id == $event->category_id) selected @endif value={{$category->id}} >{{$category->name}}</option> 
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6"> 
                                    <label for="start_date">Start Date</label> <strong class="validationSymbolRequired">*</strong>
                                    <input type="datetime-local" class="form-control" id="start_date" name="start_date" required  value="{{old('start_date')?? date('Y-m-d\TH:i', strtotime($event->start_date)) }}" class="@error('start_date') is-invalid @enderror" autocomplete="off">
                                </div>
                                <div class="form-group col-md-6"> 
                                    <label for="end_date">End Date</label> <strong class="validationSymbolRequired">*</strong>
                                    <input type="datetime-local" class="form-control" id="end_date" name="end_date" required value="{{old('end_date')?? date('Y-m-d\TH:i', strtotime($event->end_date)) }}" class="@error('end_date') is-invalid @enderror" autocomplete="off">
                                </div> 
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6"> 
                                    <label for="status_id">Status</label> <strong class="validationSymbolRequired">*</strong>
                                    <select class="form-control" id="status_id" name="status_id" required>
                                        @foreach ($statuses as $status) 
                                            <option @if($status->id == $event->status_id) selected @endif value={{$status->id}}> {{$status->name}} </option>    
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6"> 
                                    <label for="description" id="description">Description</label> <strong class="validationSymbolRequired">*</strong> 
                                    <textarea name="description" id="" cols="60" rows="3">{{old('description', $event->description) }}</textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-3"></div>
                                <div class="col-md-3"></div>
                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">Do you want to delete this event?
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" id="yes" >yes</button>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">no</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="form-group"> 
                                    <div class="row">
                                        <div class="form-group" >
                                            <button type="button"  onclick="window.location='{{url('/events/index')}}'"  class="btn btn-success">close</button>
                                            <button type="submit" id="save" class="btn btn-primary"> save</button >
                                            <form method="DELETE" >
                                                <button type="button"  id="cancella"  onclick="window.location='{{url('#')}}'"  class="btn btn-danger">delete</button>
                                            </form>
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
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{asset('js/app.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#cancella").click(function(){
            $('#deleteModal').modal('show');
            
        });
        $("#yes").click(function(){  
            $.ajax({
                url:"{{route('events.delete', $event->id)}}",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    id: {{$event->id}},
                },
                method: 'POST',
                success:function(response){
                    $('#exampleModal').modal('hide'); 
                    window.location.href ='{{url('events/index')}}';
                    console.log(response);
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });
});
</script>