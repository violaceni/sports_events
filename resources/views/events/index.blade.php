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
                            <table class="table table-striped table-sm " id="dataTable-events">
                                <thead> 
                                    <tr>
                                        <th>Title</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Description</th>
                                        <th>Category</th>
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
        var dataTable = $("#dataTable-events").DataTable({
        "language" : {"lengthMenu":"<label>Show:_MENU_</label>  entries"},
        "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
            order: [[0, 'asc']],
            saveState: false,
                ajax: {
                    headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "POST",
                    url: "{{route('events.fetchAll') }}",
                    }, 
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(response) {
                        console.log('Error ' + response);
                    },
            columns: [
                {data: 'name', name: 'name',
                    render: function(data, type, row) {
                        return "<a href='/events/getDetails/" + row.id+ "'>" + data + '</a>';;
                    },
                },
                {data: 'start_date', name: 'start_date'}, 
                {data: 'end_date', name: 'end_date'},   
                {data: 'description', name: 'description'},   
                {data: 'category_id', name: 'category_id',
                    render: function(data, type, row) {
                        data = row.category.name;
                        return data;
                    },
                },
            ],
        }); 
    });
</script>
@endsection 
