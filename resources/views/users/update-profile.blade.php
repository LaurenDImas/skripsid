    
{{-- Extends layout --}}
@extends('layouts.app')

{{-- Content --}}
@section('content')
<!--begin::Entry-->
<!--begin::Card-->
<!--begin::Card-->


@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
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

    <!--begin::Form-->
    {!! Form::model($data, ['method' => 'PATCH', 'route' => ['update-profile.update', $data->id], 'files' => true]) !!}
    <div class="card-body">
            
            <div class="form-group">
                <label for="name">Name
                <span class="text-danger">*</span></label>
                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label>Email address
                <span class="text-danger">*</span></label>
                {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password
                <span class="text-danger">*</span></label>
                {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
            </div>
            
            <div class="form-group">
                <label for="exampleInputPassword1">Confirm Password
                <span class="text-danger">*</span></label>
                {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
            </div>
            
            <div class="form-group">
                <label>Photo
                    <span class="text-danger">*</span></label>
                    <input type="file" name="photo" class="form-control">
                    <label for="" class="text-muted">Maksimal 5 MB, File JPG/PNG</label>
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
