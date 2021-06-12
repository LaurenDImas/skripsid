
{{-- Extends layout --}}
@extends('layouts.app')


@section('content')
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
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $pageDescription}}</h3>
        </div>
        <!--begin::Form-->
        {!! Form::open(array('route' => ''.$permissionName.'.store','method'=>'POST', 'files' => true)) !!}
            <div class="card-body">
                <div class="col-12">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2 d-flex align-items-center">
                                <label>Alarm</label>
                            </div>
                            <div class="col-md-10"> 
                                <div class="input-group date">
                                    <input type="time" name="alarm" class="form-control" value="{{ date("G:i:s", strtotime( $data->alarm ))}}" />
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
                                <label for="exampleSelect1">Description</label> 
                            </div>
                            <div class="col-md-10">
                                <textarea name="description" id="note"> {!! $data->description   !!}</textarea>
                            </div>
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
@endsection
@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js" type="text/javascript"></script>
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'activity' );
    CKEDITOR.replace( 'note' );
</script>
@endsection
