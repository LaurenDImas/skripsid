    
{{-- Extends layout --}}
@extends('layouts.app')

{{-- Content --}}
@section('content')
<!--begin::Entry-->
<!--begin::Card-->
<!--begin::Card-->


@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
<div class="card card-custom gutter-b">
    <div class="card-header">
        <h3 class="card-title">{{ $pageDescription}}</h3> 
        <div class="card-toolbar">
            <!--begin::Button-->
            <a href="{{route($permissionName.'.index')}}" class="btn btn-primary font-weight-bolder">
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
    {!! Form::model($data, ['method' => 'PATCH','files' => true, 'route' => [$permissionName . '.update', $data->id]]) !!}
     <div class="card-body">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="exampleSelect1">Assignment
                        <span class="text-danger">*</span>
                    </label>    
                    {!! Form::select('assignment', ["new"=>"New Daily Assignment","priority"=>"Priority"],null, 
                                    array('class' => 'form-control',"id"=>"assignment","style"=>"width:100%", "required")) !!}
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Due Date
                        <span class="text-danger">*</span>
                    </label>
                    <div class="input-group date">
                        <input type="text" class="form-control" name="date" readonly="readonly" id="kt_datepicker_3" value="{{ date("d-m-Y", strtotime($data->date)) }}" required />
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="la la-calendar"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">        
                <div class="form-group">
                    <label for="exampleSelect1">Institute
                        <span class="text-danger">*</span>
                    </label>    
                    {!! Form::select('project_id', 
                                    $project,null, 
                                    array('class' => 'form-control project_id',"id"=>"project_id","style"=>"width:100%","required")) !!}
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="exampleSelect1">Application
                        <span class="text-danger">*</span>
                    </label>    
                    {!! Form::select('application_id', $application,null, 
                                    array('class' => 'form-control',"id"=>"application_id","style"=>"width:100%","required")) !!}
                </div>
            </div>
           <div class="col-6">        

                <div class="form-group">
                    <label for="exampleSelect1">Programmer
                        <span class="text-danger">*</span>
                    </label>    
                    <select name="user_id[]" id="user_id" class="form-control" multiple required>
                        <option value=""></option>
                        @foreach ($user as $val)
                                <option value="{{ $val->id }}" 
                                    @if (in_array($val->id, $userId )) selected @endif
                                    > {{$val->name }}</option>
                            
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12">
                <label for="">File</label>
                @if (isset($data->file))
                    @foreach (json_decode($data->file) as $key => $picture)
                        <br>
                            <img src="{{Storage::url($picture)}}" alt="" width="50" height="50">
                            <a href="{{Storage::url($picture)}}" class="delete" download="">
                            {{basename($picture)}}
                            <i class="flaticon-download"></i></a>
                        
                            <a href="{{ route('new_assignments-delete', [basename($picture), $data->id]) }}" class="delete" onclick="return confirm('Are you sure you want to delete this item?');">
                            <i class="flaticon-delete"></i></a>
                            <input type="hidden" name="file_hidden[]" value="{{$picture}}">
                        <br>
                    @endforeach
                @endif
                <div class="clone-form">
                    <div class="input-group control-group increment mb-3">
                        <input type="file" name="file[]" class="form-control name">
                        <div class="input-group-btn"> 
                            <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                        </div>
                    </div>
                </div>
                <div class="clone">
                </div>
            </div>
        </div>
        
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary mr-2">Submit</button>
        <button type="reset" class="btn btn-secondary">Cancel</button>
    </div>
    {!! Form::close() !!}
    <!--end::Form-->
</div>
<!--end::Card-->
<!--end::Card-->
<!--end::Entry-->
@endsection

@section('scripts')

<script>
    $('#user_id').attr('multiple', 'multiple');
    $("#user_id" + " option")[0].remove();

    $('#user_id').select2({
        placeholder: "Choose an user",
        width:"100%",
        multiple: true
    });
    $('#project_id').select2({placeholder: "Choose an project"});
    $('#kt_datepicker_3').datepicker({
        todayBtn: "linked",
        clearBtn: true,
        todayHighlight: true,
        format: 'dd/mm/yyyy'

    });

    $("#project_id").on('change',function(){
        var project_id = $("#project_id").val();
        $.ajax({
            url : '{{ url('api/application') }}/' + project_id,
            dataType : 'json',
            success: function(e){
                var data = e.data;
                $("#application_id").html('<option value="">Select an application</option>');
                $("#application_id").val("");
                $("#application_id").select2({"data":data}).trigger("change");
                $("#application_id").attr("disabled", false);
            } ,
            errorr: function(){
                swall('Gagal','Data ada','error');
            }
        })
    });
    $(document).ready(function() {
        $(".btn-success").click(function(){ 
            var clone = $('clone');
            var html = $(".clone-form").eq(0)
                    .clone()
                    .insertAfter(".clone-form:last")
                    .find('.name')
                    .val('')
                    .end()
                    .find('.btn')
                    .addClass('btn-danger')
                    .removeClass('btn-success')
                    .text('Delete');
        });
        $("body").on("click",".btn-danger",function(){ 
            $(this).parents(".increment           ").remove();
        });
    });
    
</script>
@endsection