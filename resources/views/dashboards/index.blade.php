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
                                        <h1 class="text-center mb-5 text-white" ><b>Daily Assignment</b></h1>
                                    </div>
                                    <div class="col-4 mt-5">
                                        <a href="#" class="card-title font-weight-bolder text-center text-white font-size-h6 mb-4 text-hover-state-dark d-block">Hold</a>
                                        <div class="font-weight-bold text-center text-white font-size-sm">
                                        <span class="font-size-h2">{{ number_format($data->new_hold)}}</span></div>
                                    </div>
                                    <div class="col-4 mt-5">
                                        <a href="#" class="card-title font-weight-bolder text-center text-white font-size-h6 mb-4 text-hover-state-dark d-block">On Progress</a>
                                        <div class="font-weight-bold text-center text-white font-size-sm">
                                        <span class="font-size-h2">{{ number_format($data->new_progress)}}</span></div>
                                    </div>
                                    <div class="col-4 mt-5">
                                        <a href="#" class="card-title font-weight-bolder text-center text-white font-size-h6 mb-4 text-hover-state-dark d-block">Completed</a>
                                        <div class="font-weight-bold text-center text-white font-size-sm">
                                        <span class="font-size-h2">{{ number_format($data->new_completed)}}</span></div>
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
                                        <h1 class="text-center mb-5 text-white" ><b>Priority Assignment</b></h1>
                                    </div>
                                    <div class="col-4 mt-5">
                                        <a href="#" class="card-title font-weight-bolder text-center text-white font-size-h6 mb-4 text-hover-state-dark d-block">Hold</a>
                                        <div class="font-weight-bold text-center text-white font-size-sm">
                                        <span class="font-size-h2">{{ number_format($data->priority_hold)}}</span></div>
                                    </div>
                                    <div class="col-4 mt-5">
                                        <a href="#" class="card-title font-weight-bolder text-center text-white font-size-h6 mb-4 text-hover-state-dark d-block">On Progress</a>
                                        <div class="font-weight-bold text-center text-white font-size-sm">
                                        <span class="font-size-h2">{{ number_format($data->priority_progress)}}</span></div>
                                    </div>
                                    <div class="col-4 mt-5">
                                        <a href="#" class="card-title font-weight-bolder text-center text-white font-size-h6 mb-4 text-hover-state-dark d-block">Completed</a>
                                        <div class="font-weight-bold text-center text-white font-size-sm">
                                        <span class="font-size-h2">{{ number_format($data->priority_completed)}}</span></div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Stats Widget 23-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card card-custom">
                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="card-label">
                                        Basic Calendar
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div id="kt_calendar" class="mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $( document ).ready(function() {
        $.ajax({
            url : '{{ url('calender') }}',
            type: 'GET',
            beforeSend: function (xhr) {
            },
            success: function(res){
                var data =  res.data;
                var todayDate = moment().startOf('day');
                var YM = todayDate.format('YYYY-MM');
                var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
                var TODAY = todayDate.format('YYYY-MM-DD');
                var TODAY = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

                var calendarEl = document.getElementById('kt_calendar');

                

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list' ],
                    themeSystem: 'bootstrap',

                    isRTL: KTUtil.isRTL(),

               

                    height: 800,
                    contentHeight: 780,
                    aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

                    nowIndicator: true,
                    now: TODAY + 'T09:25:00', // just for demo

                    views: {
                        dayGridMonth: { buttonText: 'month' },
                        timeGridWeek: { buttonText: 'week' },
                        timeGridDay: { buttonText: 'day' }
                    },

                    defaultView: 'dayGridMonth',
                    defaultDate: TODAY,

                    editable: true,
                    eventLimit: true, // allow "more" link when too many events
                    navLinks: true,

                    events: data,

                    eventRender: function(info) {
                        var element = $(info.el);

                        if (info.event.extendedProps && info.event.extendedProps.description) {
                            if (element.hasClass('fc-day-grid-event')) {
                                element.data('content', info.event.extendedProps.description);
                                element.data('placement', 'top');
                                KTApp.initPopover(element);
                            } else if (element.hasClass('fc-time-grid-event')) {
                                element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                            } else if (element.find('.fc-list-item-title').lenght !== 0) {
                                element.find('.fc-list-item-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                            }
                        }
                    }
                });
                calendar.render();
            },
            error: function(e){
                swal.fire('Oops','Terjadi kesalahan','error');  
            }
        })
    });
</script>
@endsection