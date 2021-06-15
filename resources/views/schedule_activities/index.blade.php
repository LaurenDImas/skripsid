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
            "new":    "Daily Assignments",
            "priority": "Priority Assignments"
        };
        $(function () {
            var table     = $('.kt_datatable');
            var dataTable = table.DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('schedule_activities.index') }}",
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
                        searchable:true,
                        orderable:false
                    },
                    {
                        title: "Application", 
                        data: 'new_assignment.application.name', 
                        width:"20%",
                        name: 'new_assignment.application.name', 
                        searchable:true,
                        orderable:false
                    },
                    { 
                        title: "Actions", 
                        data: 'action', 
                        name: 'action', 
                        width:"1%",
                        orderable: false, 
                        searchable: false
                    },
                ]
            });
        }); 
        
    </script>
    <script>
        var switchStatus = false;
        $('body').on('change','.status',function (e) {
            e.preventDefault();
            var status;
            if ($(this).is(':checked')) {
                status = 1;
            } else {
                status = 0
            }
            var new_assignment_id = $(this).data("new_assignment_id"),
                user_id = $(this).data("user_id"),
                id = $(this).data("id");
                console.log(status);
            $.ajax({
                url : '{{ url('api/status_ass') }}',
                type: 'POST',
                dataType: "JSON",
                data: {
                    "id" : id,
                    "status" : status,
                    "new_assignment_id" : new_assignment_id,
                    "user_id" : user_id
                },
                beforeSend: function (xhr) {
                },
                success: function(res){
                    var data = res.data;
                },
                error: function(e){
                    swal.fire('Oops','Terjadi kesalahan','error');  
                }
            })
        });
    </script>
@endsection
