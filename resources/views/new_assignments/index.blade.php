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
            <div class="card-toolbar">
                <!--begin::Button-->
                <a href="{{route($permissionName.'.create')}}" class="btn btn-primary font-weight-bolder">
                <span class="svg-icon svg-icon-md">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24" />
                            <circle fill="#000000" cx="9" cy="15" r="6" />
                            <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>New Record</a>
                <!--end::Button-->
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
        $(function () {
            var table     = $('.kt_datatable');
            var dataTable = table.DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('new_assignments.index') }}",
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
                    {
                        title: "Deadline", 
                        data: 'id', 
                        width:"20%",
                        name: 'id',
                        render:function(id, e, t, n) {
                            return t.date ;
                        },
                    },
                    {
                        title: "Assignment", 
                        data: 'assignment', 
                        width:"20%", 
                        name: 'assignment',  
                        render:function(assignment, e, t, n) {
                            var data = '<div class="form-group data-status" data-id='+t.id+' data-type=0>'
                                            +'<select class="status form-control assignment" style="width:100%" required="" name="status">'
                                            +selectedAssignment(t.assignment)
                                            +'</select>'
                                        +'</div>';
                            return data;
                        }
                    },
                    {
                        title: "Project", 
                        data: 'application.project.name', 
                        width:"20%",
                        name: 'application.project.name'
                    },
                    {
                        title: "Application", 
                        data: 'application.name', 
                        width:"20%",
                        name: 'application.name'
                    },
                    {
                        title: "Status Pekerjaan", 
                        data: 'status', 
                        width:"20%",
                        name: 'status',
                        render:function(status, e, t, n) {
                            var data = '<div class="form-group data-status" data-id='+t.id+' data-type=1>'
                                            +'<select class="status form-control" style="width:100%" required="" name="status">'
                                            +selected(t.status)
                                            +'</select>'
                                        +'</div>';
                            return data;
                        }
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

        function selected(status){
            var html = "";
            if(status == 0){
                html ='<option value="0" selected>Hold</option>'
                        +'<option value="1">On Progress</option>'
                        +'<option value="2">Completed</option>';
            }else if(status == 1){
                html ='<option value="0">Hold</option>'
                        +'<option value="1" selected>On Progress</option>'
                        +'<option value="2">Completed</option>';
            }else if(status == 2){
                html ='<option value="0">Hold</option>'
                        +'<option value="1">On Progress</option>'
                        +'<option value="2" selected>Completed</option>';
            }
            return html;
            
        }
        function selectedAssignment(status){
            var html = "";
            // alert(status);
            if(status == "new"){
                html ='<option value="new" selected>New Daily Assignment</option>'
                        +'<option value="priority">Priority</option>';
            }else if(status == "priority"){
                html ='<option value="new">New Daily Assignment</option>'
                        +'<option value="priority" selected>Priority</option>';
            }
            return html;    
        }

        
        $('body').on('change','.status',function (e) {
            e.preventDefault();
            var status = $(this).val(),
                id = $(this).closest('.data-status').data("id"),
                type = $(this).closest('.data-status').data("type");
                // console.log(id);
                // console.log(status);
            $.ajax({
                url : '{{ url('api/status_assignment') }}',
                type: 'POST',
                dataType: "JSON",
                data: {
                    "id" : id,
                    "status" : status,
                    "type" : type
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
