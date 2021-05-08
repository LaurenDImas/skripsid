<div class="header-bottom">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Header Menu Wrapper-->
        <div class="header-navs header-navs-left" id="kt_header_navs">
            <!--begin::Tab Content-->
            <div class="tab-content">
                <!--begin::Tab Pane-->
                <div class="tab-pane py-5 p-lg-0 show active" id="kt_header_tab_1">
                    <!--begin::Menu-->
                    <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
                        <!--begin::Nav-->
                        <ul class="menu-nav">
                            <li class="menu-item {{ (request()->is('/')) ? 'menu-item-active ' : '' }}" aria-haspopup="true">
                                <a href="{{route('dashboards')}}" class="menu-link">
                                    <span class="menu-text">Dashboard</span>
                                </a>
                            </li>
                            
                            @role('Manager')
                            <li class="menu-item menu-item-submenu menu-item-rel {{ (request()->is('roles*') || request()->is('users*')) || (request()->is('projects*') || request()->is('applications*')) ? 'menu-item-active ' : '' }}" data-menu-toggle="click" aria-haspopup="true">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <span class="menu-text">Master Data</span>
                                    <span class="menu-desc"></span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                    <ul class="menu-subnav">
                                        <li class="menu-item {{ (request()->is('users*')) ? 'menu-item-active ' : '' }}" data-menu-toggle="hover" aria-haspopup="true">
                                            <a href="{{ route('users.index') }}" class="menu-link">
                                                <span class="svg-icon menu-icon">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <polygon points="0 0 24 0 24 24 0 24" />
                                                            <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                            <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <span class="menu-text">Users</span>
                                                <i class="menu-arrow"></i>
                                            </a>
                                        </li>
                                        
                                        <li class="menu-item {{ (request()->is('roles*')) ? 'menu-item-active ' : '' }}" data-menu-toggle="hover" aria-haspopup="true">
                                            <a href="{{ route('roles.index') }}" class="menu-link">
                                                <span class="svg-icon menu-icon">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"/>
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <span class="menu-text">Role</span>
                                                <i class="menu-arrow"></i>
                                            </a>
                                        </li>
                                        <li class="menu-item {{ (request()->is('projects*')) ? 'menu-item-active ' : '' }}" data-menu-toggle="hover" aria-haspopup="true">
                                            <a href="{{ route('projects.index') }}" class="menu-link">
                                                <span class="svg-icon menu-icon"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-02-01-052524/theme/html/demo1/dist/../src/media/svg/icons/Text/Bullet-list.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <path d="M10.5,5 L19.5,5 C20.3284271,5 21,5.67157288 21,6.5 C21,7.32842712 20.3284271,8 19.5,8 L10.5,8 C9.67157288,8 9,7.32842712 9,6.5 C9,5.67157288 9.67157288,5 10.5,5 Z M10.5,10 L19.5,10 C20.3284271,10 21,10.6715729 21,11.5 C21,12.3284271 20.3284271,13 19.5,13 L10.5,13 C9.67157288,13 9,12.3284271 9,11.5 C9,10.6715729 9.67157288,10 10.5,10 Z M10.5,15 L19.5,15 C20.3284271,15 21,15.6715729 21,16.5 C21,17.3284271 20.3284271,18 19.5,18 L10.5,18 C9.67157288,18 9,17.3284271 9,16.5 C9,15.6715729 9.67157288,15 10.5,15 Z" fill="#000000"/>
                                                        <path d="M5.5,8 C4.67157288,8 4,7.32842712 4,6.5 C4,5.67157288 4.67157288,5 5.5,5 C6.32842712,5 7,5.67157288 7,6.5 C7,7.32842712 6.32842712,8 5.5,8 Z M5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 C6.32842712,10 7,10.6715729 7,11.5 C7,12.3284271 6.32842712,13 5.5,13 Z M5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 C6.32842712,15 7,15.6715729 7,16.5 C7,17.3284271 6.32842712,18 5.5,18 Z" fill="#000000" opacity="0.3"/>
                                                    </g>
                                                </svg><!--end::Svg Icon--></span>
                                                <span class="menu-text">Project</span>
                                                <i class="menu-arrow"></i>
                                            </a>
                                        </li>
                                        <li class="menu-item {{ (request()->is('applications*')) ? 'menu-item-active ' : '' }}" data-menu-toggle="hover" aria-haspopup="true">
                                            <a href="{{ route('applications.index') }}" class="menu-link">
                                                <span class="svg-icon menu-icon"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-02-01-052524/theme/html/demo1/dist/../src/media/svg/icons/Text/Bullet-list.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <path d="M10.5,5 L19.5,5 C20.3284271,5 21,5.67157288 21,6.5 C21,7.32842712 20.3284271,8 19.5,8 L10.5,8 C9.67157288,8 9,7.32842712 9,6.5 C9,5.67157288 9.67157288,5 10.5,5 Z M10.5,10 L19.5,10 C20.3284271,10 21,10.6715729 21,11.5 C21,12.3284271 20.3284271,13 19.5,13 L10.5,13 C9.67157288,13 9,12.3284271 9,11.5 C9,10.6715729 9.67157288,10 10.5,10 Z M10.5,15 L19.5,15 C20.3284271,15 21,15.6715729 21,16.5 C21,17.3284271 20.3284271,18 19.5,18 L10.5,18 C9.67157288,18 9,17.3284271 9,16.5 C9,15.6715729 9.67157288,15 10.5,15 Z" fill="#000000"/>
                                                        <path d="M5.5,8 C4.67157288,8 4,7.32842712 4,6.5 C4,5.67157288 4.67157288,5 5.5,5 C6.32842712,5 7,5.67157288 7,6.5 C7,7.32842712 6.32842712,8 5.5,8 Z M5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 C6.32842712,10 7,10.6715729 7,11.5 C7,12.3284271 6.32842712,13 5.5,13 Z M5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 C6.32842712,15 7,15.6715729 7,16.5 C7,17.3284271 6.32842712,18 5.5,18 Z" fill="#000000" opacity="0.3"/>
                                                    </g>
                                                </svg><!--end::Svg Icon--></span>
                                                <span class="menu-text">Application</span>
                                                <i class="menu-arrow"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            
                            <li class="menu-item {{ (request()->is('new_assignments*')) ? 'menu-item-active ' : '' }}" aria-haspopup="true">
                                <a href="{{route('new_assignments.index')}}" class="menu-link">
                                    <span class="menu-text">New Assignment</span>
                                </a>
                            </li>
                            @endrole
                            
                            <li class="menu-item {{ (request()->is('schedule_activities*')) ? 'menu-item-active ' : '' }}" aria-haspopup="true">
                                <a href="{{route('schedule_activities.index')}}" class="menu-link">
                                    <span class="menu-text">Schedule of Activities</span>
                                </a>
                            </li>
                            <li class="menu-item {{ (request()->is('priorities*')) ? 'menu-item-active ' : '' }}" aria-haspopup="true">
                                <a href="{{route('priorities.index')}}" class="menu-link">
                                    <span class="menu-text">Agenda Prioritas </span>
                                    &nbsp;<i data-count="0" class="fas fa-bell"></i>
                                </a>
                            </li>
                            <li class="menu-item {{ (request()->is('forums*')) ? 'menu-item-active ' : '' }}" aria-haspopup="true">
                                <a href="{{route('forums.index')}}" class="menu-link">
                                    <span class="menu-text">Forum</span>
                                </a>
                            </li>
                        </ul>
                        <!--end::Nav-->
                    </div>
                    <!--end::Menu-->
                </div>
                <!--begin::Tab Pane-->
                <!--begin::Tab Pane-->
                <div class="tab-pane p-5 p-lg-0 justify-content-between" id="kt_header_tab_2">
                    <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center">
                        <!--begin::Actions-->
                        <a href="#" class="btn btn-light-success font-weight-bold mr-3 my-2 my-lg-0">Latest Orders</a>
                        <a href="#" class="btn btn-light-primary font-weight-bold my-2 my-lg-0">Customer Service</a>
                        <!--end::Actions-->
                    </div>
                    <div class="d-flex align-items-center">
                        <!--begin::Actions-->
                        <a href="#" class="btn btn-danger font-weight-bold my-2 my-lg-0">Generate Reports</a>
                        <!--end::Actions-->
                    </div>
                </div>
                <!--begin::Tab Pane-->
            </div>
            <!--end::Tab Content-->
        </div>
        <!--end::Header Menu Wrapper-->
    </div>
    <!--end::Container-->
</div>
