<!--begin::Header Mobile-->
@include('layouts.base._header-mobile')
<!--end::Header Mobile-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="d-flex flex-row flex-column-fluid page">
        <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
            <!--begin::Header-->
            <div id="kt_header" class="header flex-column header-fixed">
                <!--begin::Top-->
                @include('layouts.base._header-top')
                <!--end::Top-->
                <!--begin::Bottom-->
                @include('layouts.base._header-bottom')
                <!--end::Bottom-->
            </div>
            <!--end::Header-->
            <!--begin::Content-->
            @include('layouts.base._content')
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <!--end::Content-->
    <!--begin::Footer-->
    @include('layouts.base._footer')
</div>