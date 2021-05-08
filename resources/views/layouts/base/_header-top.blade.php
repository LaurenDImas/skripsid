<div class="header-top">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Left-->
        <div class="d-none d-lg-flex align-items-center mr-3">
            <!--begin::Logo-->
            <a href="index.html" class="mr-20">
                <img alt="Logo" src="{{asset('assets/media/logos/logo-letter-9.png')}}" class="max-h-35px" />
            </a>
            <!--end::Logo-->
            <!--begin::Tab Navs(for desktop mode)-->
            <h5 class="text-white my-1" style="letter-spacing: 1.5px; font-weight: 700">Daily Work Reports</h5>
            <!--begin::Tab Navs-->
        </div>
        <!--end::Left-->
        <!--begin::Topbar-->
         <div class="topbar bg-primary">
            <div class="dropdown">        
                <div class="topbar-item" data-toggle="dropdown" data-offset="0px,0px">
                    <div class="btn btn-icon btn-hover-transparent-white w-sm-auto d-flex align-items-center btn-lg px-2">
                        <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                        <span class=" font-weight-bolder font-size-base d-none d-md-inline mr-3">{{isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email}}</span>
                        <img alt="Laravel" src="{{asset('assets/media/icons/user.png')}}" width="40">  
                    </div>
                </div>
                <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg p-0 mt-3">
                    <div class="d-flex align-items-center justify-content-between flex-wrap p-8 bgi-size-cover bgi-no-repeat rounded-top" style="background-image: url({{url('assets/media/bg/bg-5.jpg')}})">
                        <div class="d-flex align-items-center mr-2">
                                <img alt="Laravel" src="{{asset('assets/media/icons/user.png')}}" width="40">
                            <div class="text-white m-0 flex-grow-1 ml-3 mr-3 font-size-h5">{{isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email}}</div>
                        </div>
                    </div>


                    <div class="navi navi-spacer-x-0 pt-5">
                        <a href="#" class="navi-item px-8">
                            <div class="navi-link">
                                <div class="navi-icon mr-2">
                                    <i class="flaticon2-calendar-3 text-success"></i>
                                </div>
                                <div class="navi-text">
                                    <div class="font-weight-bold">
                                        My Profile
                                    </div>
                                    <div class="text-muted">
                                        Account settings and more
                                        <span class="label label-light-danger label-inline font-weight-bold">update</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="navi-separator mt-3"></div>
                        <div class="navi-footer  px-8 py-5">
                            <a  class="btn btn-light-primary font-weight-bold"   href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <!--end::Topbar-->
    </div>
    
    <!--end::Container-->
</div>