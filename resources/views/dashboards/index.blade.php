@extends('layouts.app')


@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                Dashboard
            </div>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-6">
                        <!--begin::Stats Widget 22-->
                        <div class="card card-custom bg-primary card-stretch gutter-b" style="background-position: right top; background-size: 30% auto; background-image: url(/metronic/theme/html/demo1/dist/assets/media/svg/shapes/abstract-3.svg)">
                            <!--begin::Body-->
                            <div class="card-body my-4">
                                <div class="row">
                                    <div class="col-12">
                                        <h1 class="text-center mb-5 text-white" ><b>New Daily Assignment</b></h1>
                                    </div>
                                    <div class="col-6 mt-5">
                                        <a href="#" class="card-title font-weight-bolder text-white font-size-h6 mb-4 text-hover-state-dark d-block">Selesai</a>
                                        <div class="font-weight-bold text-white font-size-sm">
                                        <span class="font-size-h2 mr-2">87</span></div>
                                    </div>
                                    <div class="col-6 mt-5">
                                        <a href="#" class="card-title font-weight-bolder text-white font-size-h6 mb-4 text-hover-state-dark d-block">Belum Selesai</a>
                                        <div class="font-weight-bold text-white font-size-sm">
                                        <span class="font-size-h2 mr-2">87</span></div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Stats Widget 22-->
                    </div>
                    <div class="col-xl-6">
                        <!--begin::Stats Widget 23-->
                        <div class="card card-custom bg-info card-stretch gutter-b">
                            <!--begin::Body-->
                            <div class="card-body my-4">
                                <div class="row">
                                    <div class="col-12">
                                        <h1 class="text-center mb-5 text-white" ><b>Priority</b></h1>
                                    </div>
                                    <div class="col-6 mt-5">
                                        <a href="#" class="card-title font-weight-bolder text-white font-size-h6 mb-4 text-hover-state-dark d-block">Selasai</a>
                                        <div class="font-weight-bold text-white font-size-sm">
                                        <span class="font-size-h2 mr-2">87</span></div>
                                    </div>
                                    <div class="col-6 mt-5">
                                        <a href="#" class="card-title font-weight-bolder text-white font-size-h6 mb-4 text-hover-state-dark d-block">Belum Selesai</a>
                                        <div class="font-weight-bold text-white font-size-sm">
                                        <span class="font-size-h2 mr-2">87</span></div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Stats Widget 23-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection