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
        <form action="ViewPages" method="POST" enctype="multipart/form-data" target="_BLANK">
            <div class="card-body">
                @csrf
                <div class="container">
                    <div class="row">
                        <label for="from" class="col-form-label">From</label>
                        <div class="col-md-2">
                            <input type="date" class="form-control input-sm" id="from" name="from">
                        </div>
                        <label for="from" class="col-form-label">To</label>
                        <div class="col-md-2">
                            <input type="date" class="form-control input-sm" id="to" name="to">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm" name="search" >Webview</button>
                <button type="submit" class="btn btn-primary btn-sm" name="exportPDF">PDF</button>
                <button type="submit" class="btn btn-primary btn-sm" name="exportExcel" >Excel</button>
            </div>
        </form>
    </div>
@endsection