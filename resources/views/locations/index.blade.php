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
                        <div class="table-responsive">
                            <table class="table table-striped table-sm " id="dataTable-locations">
                                <thead> 
                                    <tr>
                                        <th>Venue</th>
                                        <th>City</th>
                                        <th>Country</th>
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
        var dataTable = $("#dataTable-locations").DataTable({
        "language" : {"lengthMenu":"<label>Show:_MENU_</label>  entries"},
        "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
            order: [[0, 'asc']],
            saveState: false,
                ajax: {
                    headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "POST",
                    url: "{{route('locations.fetchAll') }}",
                    }, 
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(response) {
                        console.log('Error ' + response);
                    },
            columns: [
                {data: 'venue', name: 'venue'},
                {data: 'city', name: 'city'}, 
                {data: 'country', name: 'country'}, 

            ],
        }); 
    });
</script>
@endsection 
