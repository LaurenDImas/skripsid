
{{-- Extends layout --}}
@extends('layouts.app')

{{-- Content --}}
@section('content')
<!--begin::Entry-->
<!--begin::Card-->
<!--begin::Card-->
<div class="card card-custom">
        <div class="card-header">
        <h3 class="card-title">{{ $pageDescription}}</h3> 
        <div class="card-toolbar">
            <!--begin::Button-->
            <a href="{{route($permissionName.'.index')}}" class="btn btn-primary font-weight-bolder ml-2">
                <span class="svg-icon svg-icon-md">
                    <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-02-01-052524/theme/html/demo7/dist/../src/media/svg/icons/Code/Backspace.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path d="M8.42034438,20 L21,20 C22.1045695,20 23,19.1045695 23,18 L23,6 C23,4.8954305 22.1045695,4 21,4 L8.42034438,4 C8.15668432,4 7.90369297,4.10412727 7.71642146,4.28972363 L0.653241109,11.2897236 C0.260966303,11.6784895 0.25812177,12.3116481 0.646887666,12.7039229 C0.648995955,12.7060502 0.651113791,12.7081681 0.653241109,12.7102764 L7.71642146,19.7102764 C7.90369297,19.8958727 8.15668432,20 8.42034438,20 Z" fill="#000000" opacity="0.3"/>
                                <path d="M12.5857864,12 L11.1715729,10.5857864 C10.7810486,10.1952621 10.7810486,9.56209717 11.1715729,9.17157288 C11.5620972,8.78104858 12.1952621,8.78104858 12.5857864,9.17157288 L14,10.5857864 L15.4142136,9.17157288 C15.8047379,8.78104858 16.4379028,8.78104858 16.8284271,9.17157288 C17.2189514,9.56209717 17.2189514,10.1952621 16.8284271,10.5857864 L15.4142136,12 L16.8284271,13.4142136 C17.2189514,13.8047379 17.2189514,14.4379028 16.8284271,14.8284271 C16.4379028,15.2189514 15.8047379,15.2189514 15.4142136,14.8284271 L14,13.4142136 L12.5857864,14.8284271 C12.1952621,15.2189514 11.5620972,15.2189514 11.1715729,14.8284271 C10.7810486,14.4379028 10.7810486,13.8047379 11.1715729,13.4142136 L12.5857864,12 Z" fill="#000000"/>
                            </g>
                        </svg>
                    <!--end::Svg Icon-->
                </span>
                Back to menu
            </a>
            <!--end::Button-->
        </div>
    </div>
    <!--begin::Form-->
    <div class="card-body"> 
         <table class="table  table-hover">
            <tr>
                <th width="7%">Date</th>
                <th width="1%" class="text-center">:</th>
                <th width="18%" >{{ date("d-m-Y", strtotime($data->newAssignment->date)) }}</th>
                <th width="7%">Project</th>
                <th width="1%" class="text-center">:</th>
                <th width="18%" >{{ $data->newAssignment->application->project->name }}</th>
            </tr>
            <tr>
                <th width="7%">Aplikasi</th>
                <th width="1%" class="text-center">:</th>
                <th width="18%" >{{ $data->newAssignment->application->name }}</th>
                <th width="7%">Alarm Pengingat</th>
                <th width="1%" class="text-center">:</th>
                <th width="18%" >{{ date("h:i:s", strtotime($data->newAssignment->alarm)) }}</th>
            </tr>
            <tr>
                <th width="7%">Programmer</th>
                <th width="1%" class="text-center">:</th>
                <th width="18%" >{{$userData->user->name}}
                </th>
                <th width="7%">File</th>
                <th width="1%" class="text-center">:</th>
                <th width="18%" >
                    @if (isset($data->newAssignment->file))
                        @foreach (json_decode($data->newAssignment->file) as $key => $picture)
                            <a href="{{Storage::url($picture)}}" class="delete" download="">
                            {{basename($picture)}}
                            &nbsp;<i class="flaticon-download"></i></a>
                        
                            <br>
                        @endforeach
                    @endif
                </th>
            </tr>
        </table>
        
        <hr>
        <div class="card-toolbar mb-5">
            <!--begin::Button-->
            <a href="#" class="btn btn-success font-weight-bolder ml-2"  data-toggle="modal" data-target=".forumModal">
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
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="table-responsive mt-5">
            <table class="table table-bordered table-hover table-checkable kt_datatable" id="kt_datatable" style="width: 10%">
            </table>
        </div>
    </div>
    <!--end::Form-->
</div>

<div class="modal fade forumModal" id="forumModal" tabindex="-1" role="dialog" aria-labelledby="forumLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="forumLabel">Modal Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="add_data">
                    <input type="hidden" name="new_assignment_id" value="{{$data->new_assignment_id}}">
                    <input type="hidden" name="project_id" value="{{$data->newAssignment->application->project->id}}">
                    <input type="hidden" name="application_id" value="{{$data->newAssignment->application->id}}">
                {{-- {!! Form::model($data, ['method' => 'PATCH','files' => true, 'route' => [$permissionName . '.update']]) !!} --}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2 d-flex align-items-center">
                                            <label>Tanggal</label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="input-group date">
                                                <input type="text" class="form-control" name="date"  readonly="readonly" id="kt_datepicker_3" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="la la-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2 d-flex align-items-center">
                                            <label for="exampleSelect1">Kendala</label> 
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" name="constraint" placeholder="Ada/Tidak" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="row">
                                    <div class="col-md-2 d-flex align-items-center">
                                        <label for="exampleSelect1">Aktivitas</label> 
                                    </div>
                                    <div class="col-md-10">
                                            <textarea name="activity" id="activity"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2 d-flex align-items-center">
                                            <label for="exampleSelect1">Note</label> 
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="note" id="note"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2 d-flex align-items-center">
                                            <label>Jam Kerja</label>
                                        </div>
                                        <div class="col-md-10"> 
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="input-group date">
                                                        <input type="time" name="hour_start" class="form-control" value="" />
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <i class="la la-calendar"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="input-group date">
                                                        <input type="time" name="hour_end" class="form-control" value="" />
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <i class="la la-calendar"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2 d-flex align-items-center">
                                            <label for="exampleSelect1">Selesai ? </label> 
                                        </div>
                                        <div class="col-md-10">
                                            <span class="switch switch-icon">
                                                <label>
                                                <input type="checkbox"    name="status" class="status1" value="0"/>
                                                <span></span>
                                                </label>
                                            </span>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2 d-flex align-items-center">
                                            <label for="exampleSelect1">File </label> 
                                        </div>
                                        <div class="col-md-10">
                                            <div class="clone-form">
                                                <div class="input-group control-group increment mb-3">
                                                    <input type="file" name="file[]" class="form-control name">
                                                    <div class="input-group-btn"> 
                                                        <button class="btn btn-success add-detail" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clone">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary font-weight-bold forum-submit">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!--end::Card-->
<!--end::Card-->
<!--end::Entry-->
@endsection
@section('styles')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('scripts')

<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js" type="text/javascript"></script>
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'activity' );
    CKEDITOR.replace( 'note' );
</script>
<script>
    
$(function () {
    $(document).ready(function() {
    var table     = $('.kt_datatable');
    var dataTable = table.DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: "{{ url('priorities/show/') }}" + {{$data->new_assignment_id}},
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
                title: "Tanggal", 
                data: 'date', 
                width:"20%",
                name: 'date'
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
                    var checked = (status == 1) ? "checked" : "";
                    var data = '<span class="switch switch-icon">'
                                +'<label>'
                                        +'<input type="checkbox" '+checked+' data-id="'+t.id+'" data-new_assignment_id="'+t.new_assignment_id+'" data-user_id="'+t.user.id+'"  name="status" class="status" />'
                                +'<span></span>'
                                +'</label>'
                            +'</span>';
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
<script>
    

    $('#project_id').select2({placeholder: "Choose an project"});
    $('#kt_datepicker_3').datepicker({
        todayBtn: "linked",
        clearBtn: true,
        todayHighlight: true,
        format: 'dd/mm/yyyy'

    });
    
    $(document).ready(function() {
         $('body').on('change','.status1',function (e) {
            e.preventDefault();
            var status;
            if ($(this).is(':checked')) {
                status = 1;
            } else {
                status = 0
            }
            $(this).val(status);
        });

        $(".add-detail").click(function(){ 
            var clone = $('clone');
            var html = $(".clone-form").eq(0)
                    .clone()
                    .insertAfter(".clone-form:last")
                    .find('.name')
                    .val('')
                    .end()
                    .find('.btn')
                    .addClass('btn-danger')
                    .removeClass('add-detail')
                    .text('Delete');
        });
        $("body").on("click",".btn-danger",function(){ 
            $(this).parents(".increment").remove();
        });
   
        // var form2 = $("#add-detail");

         var form2 = $("#add_data");
        form2.validate({
            errorClass: "my-error-class",
            validClass: "my-valid-class",
            onkeyup: false,
            rules: {
                // 'hour_start' : {
                //     required: true
                // },
                
                // 'hour_end' : {
                //     required: true
                // }            
            },
            messages : {
            },
            highlight: function(element) {
            $(element).removeClass('is-valid').addClass('is-invalid');
            },
            unhighlight: function(element) {
            $(element).removeClass('is-invalid').addClass('is-valid');
            }
        });
        
		$("body").on('click', '.btn-edit-record', function(e) {
            e.preventDefault();
            $('.forumModal').modal('show');
            var dataUrl = $(this).data('url');
            $.ajax({
                url : dataUrl,
                success: function(e){
                    var data = e.results;
                    console.log(data[0]['longitude']);
                    $('#kt_modal_4').modal('show');
                    $('#sebaran_id').val(data[0]['id']);
                    $('#longitude').val(data[0]['longitude']);
                    $('#latitude').val(data[0]['latitude']);
                    
                } ,
                errorr: function(){
                    swall('Gagal','Data tidak ada','error');
                }
            })
        })

        $('.forum-submit').click(function(e){
            e.preventDefault();
            if (!form2.valid()) {
                return;
            }
            var token = $("meta[name='csrf-token']").attr("content"),
                formData = new FormData($("#add_data")[0]);
                
                formData.append('note', CKEDITOR.instances['note'].getData());
                formData.append('activity', CKEDITOR.instances['activity'].getData());
                $.ajax({
                    url : '{{ route('schedule_activities.store') }}',
                    method:'post',
                    data: formData,              
                    processData: false,
                contentType: false,
                headers : {'X-CSRF-TOKEN':token},
                beforeSend:function(){
                    swal.fire({
                        type : 'info',
                        title: 'Harap menunggu',
                        text: 'Sedang menyimpan data',
                        showCancelButton: false,
                        showConfirmButton: false,
                        allowOutsideClick : false,
                        allowEscapeKey : false,
                        allowEnterKey : false
                    })
                },
                success:function(data)
                {                        
                    swal.fire('berhasil','berhasil meyimpan data','success');
                    $('#forumModal').modal('toggle');             
                    $('.kt_datatable').DataTable().ajax.reload();
                    $("#add_data")[0].reset();
                     CKEDITOR.instances['note'].setData('');
                      CKEDITOR.instances['activity'].setData('');
                }
            })
        });
    });
    
    

    
</script>
@endsection