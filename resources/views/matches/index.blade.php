@extends('layouts.app')
@include('layouts.navbar')
@section('content')
    <div class="container-fluid">
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
            <div class="col">
                <div class="card"> 
                    <div class="card-body"> 
                        <div class='row'> 
                            <button type="btn btn-primary"><a href="{{route('matches.create')}}"> Create</a></button>
                            <div class="table-responsive">
                                <table class="table table-striped table-sm " id="dataTable-matches">
                                    <thead> 
                                        <tr>
                                            <th>Event</th>
                                            <th>First Team</th>
                                            <th>Second Team</th>
                                            <th>Venue</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('layouts.scripts')
<script type="text/javascript">
    $(document).ready(function() { 
        var dataTable = $("#dataTable-matches").DataTable({
        "language" : {"lengthMenu":"<label>Show:_MENU_</label>  entries"},
        "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
            order: [[0, 'asc']],
            saveState: false,
                ajax: {
                    headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "POST",
                    url: "{{route('matches.fetchAll') }}",
                    }, 
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(response) {
                        console.log('Error ' + response);
                    },
            columns: [
                {data: 'event', name: 'event'}, 
                {data: 'first_team', name: 'first_team'}, 
                {data: 'second_team', name: 'second_team'}, 
                {data: 'venue', name: 'venue'},
                {data: 'start_time', name: 'start_time'},
                {data: 'end_time', name: 'end_time'},
            ],
        }); 
    });
</script>
@endsection 
