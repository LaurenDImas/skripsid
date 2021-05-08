@extends('layouts.app')

{{-- Content --}}
@section('content')
<!--begin::Entry-->
<!--begin::Card-->
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
<div class="card card-custom">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label$">{{ $pageDescription}}</h3>
        </div>
        <div class="card-toolbar">
            @can(''.$permissions.'-create')
                <a href="{{ route(''.$permissionName.'.create') }}" class="btn btn-primary font-weight-bolder">
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
                    </span>New Record
                </a>
            @endcan
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered table-hover table-checkable kt_datatable" id="kt_datatable" style="margin-top: 13px !important">
        </table>
        </div>
    </div>
</div>
<!--end::Card-->
<!--end::Entry-->
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
        ajax: "{{ route('roles.index') }}",
        language:{
            paginate:{
                previous:"&laquo;",
                next:"&raquo;"
            },search:"_INPUT_",
            searchPlaceholder:"Search..."
        },
        columns: [
            {
                title: "No", 
                data:"rownum",
                name:"rownum",
                width:"5px",
                searchable:false,
                orderable:true
            },
            {
                title: "Nama", 
                data: 'name', 
                name: 'name'
            },
            { 
                title: "Actions", 
                data: 'action', 
                name: 'action', 
                width:"5px",
                orderable: false, 
                searchable: false
            },
        ]
    });
}); 
</script>
@endsection
