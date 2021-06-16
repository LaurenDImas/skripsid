@extends('layouts.app')


@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">{{ $pageDescription }}</h3>
            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-checkable kt_datatable" id="kt_datatable">
                </table>
            </div>
            <!--end: Datatable-->
        </div>
    </div>
@endsection
@section('styles')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('scripts')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script>
        var items = {
            "new":    "New Daily Assessment",
            "priority": "Priority"
        };
        $(function () {
            var table     = $('.kt_datatable');
            var dataTable = table.DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('priorities.index') }}",
                language:{
                    paginate:{
                        previous:"&laquo;",
                        next:"&raquo;"
                    },
                    search:"_INPUT_",
                    searchPlaceholder:"Search..."
                },
                columns: [
                    {
                        title: "No", 
                        data:"rownum",
                        name:"rownum",
                        width:"1%",
                        searchable:false,
                        orderable:true
                    },
                   
                    @if(Auth::user()->role_id == 3)
                        {
                            title: "Programmer", 
                            data: 'user.name', 
                            width:"20%",
                            name: 'user.name'
                        },
                    @endif
                    {
                        title: "Due Date", 
                        data: 'id', 
                        width:"20%",
                        name: 'id',
                        render:function(id, e, t, n) {
                            return t.new_assignment.date;
                        },
                    },
                    {
                        title: "Assignment", 
                        data: 'new_assignment.assignment', 
                        width:"20%",
                        name: 'assignment', 
                        searchable:true,
                        orderable:false,
                        render:function(assignment) {
                            return items[assignment];
                        },
                    },
                    {
                        title: "Institute", 
                        data: 'new_assignment.application.project.name', 
                        width:"20%",
                        name: 'new_assignment.application.project.name',
                        searchable:false,
                        orderable:false
                    },
                    {
                        title: "Application", 
                        data: 'new_assignment.application.name', 
                        width:"20%",
                        name: 'new_assignment.application.name',
                        searchable:false,
                        orderable:false
                    },
                    { 
                        title: "Actions", 
                        data: 'action', 
                        name: 'action', 
                        width:"1%",
                        orderable: false, 
                        searchable: false
                    }
                ]
            });
        }); 
    </script>
@endsection
