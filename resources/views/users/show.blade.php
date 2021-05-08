
{{-- Extends layout --}}
@extends('layouts.app')

{{-- Content --}}
@section('content')
<!--begin::Entry-->
<!--begin::Card-->
<!--begin::Card-->
<div class="card card-custom gutter-b example example-compact">
    <div class="card-header">
        <h3 class="card-title">{{ $pageDescription}}</h3> 
        <div class="card-toolbar">
            <!--begin::Button-->
            <a href="{{url($permissionName.'/'.$data->id.'/edit')}}" class="btn btn-success font-weight-bolder">
                <span class="svg-icon svg-icon-md">
                    <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-02-01-052524/theme/html/demo7/dist/../src/media/svg/icons/Code/Backspace.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>
                                <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>
                            </g>
                        </svg>
                    <!--end::Svg Icon-->
                </span>
                Edit Data User
            </a>
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
        <table class="table table-striped1 table-bordered table-hover table-checkable">
            <tr>
                <th width="7%">Nama</th>
                <th width="1%" class="text-center">:</th>
                <th width="18%" >{{ $data->name }}</th>
            </tr>
            <tr>
                <th width="7%">Email</th>
                <th width="1%" class="text-center">:</th>
                <th width="18%">{{ $data->email }}</th>
            </tr>
            <tr>
                <th width="7%">Roles</th>
                <th width="1%" class="text-center">:</th>
                <th width="18%">
                    @if(!empty($data->getRoleNames()))
                        @foreach($data->getRoleNames() as $v)
                            <label class="badge badge-success">{{  $v }}</label>
                        @endforeach
                    @endif
                </th>
            </tr>
        </table>
    </div>
    <!--end::Form-->
</div>
<!--end::Card-->
<!--end::Card-->
<!--end::Entry-->
@endsection
