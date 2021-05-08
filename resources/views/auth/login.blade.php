@extends('layouts.app-login')

@section('content')
    <div class="d-flex flex-column flex-root">
        <!--begin::Loginblade-->
        <div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
            <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url({{asset('assets/media/bg/bg-3.jpg')}})">
                <div class="login-form text-center p-7 position-relative overflow-hidden">
                    <!--begin::Login Header-->
                    <div class="d-flex flex-center mb-15">
                        <a href="#">
                            <img src="{{asset('assets/media/logos/logo-letter-13.png')}}" class="max-h-75px" alt="" />
                        </a>
                    </div>
                    <!--end::Login Header-->
                    <!--begin::Login Sign in form-->
                    <div class="login-signin">
                        <div class="mb-20">
                            <h3>Sign In To Admin</h3>
                            <div class="text-muted font-weight-bold">Enter your details to login to your account:</div>
                        </div>
                        <form class="form" id="kt_login_signin_form" method="POST">
                            @csrf
                            <div class="form-group mb-5">
                                <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Email" name="email" id="email"  />
                            </div>
                            <div class="form-group mb-5">
                                <input class="form-control h-auto form-control-solid py-4 px-8" type="password" placeholder="Password" name="password" id="password" />
                            </div>
                            <button class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4" type="button" id="kt_login_signin_submit">Sign In</button>
                        </form>
                    </div>
                    <!--end::Login Sign in form-->
                </div>
            </div>
        </div>
        <!--end::Login-->
    </div>
@endsection
@section('scripts')
    <script>
        "use strict";

        // Class Definition
        var KTLogin = function() {
            var _login;

            var _showForm = function(form) {
                var cls = 'login-' + form + '-on';
                var form = 'kt_login_' + form + '_form';

                _login.removeClass('login-forgot-on');
                _login.removeClass('login-signin-on');
                _login.removeClass('login-signup-on');

                _login.addClass(cls);

                KTUtil.animateClass(KTUtil.getById(form), 'animate__animated animate__backInUp');
            }

            var _handleSignInForm = function() {
                var validation;

                // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
                validation = FormValidation.formValidation(
                    KTUtil.getById('kt_login_signin_form'),
                    {
                        fields: {
                            username: {
                                validators: {
                                    notEmpty: {
                                        message: 'Username is required'
                                    }
                                }
                            },
                            password: {
                                validators: {
                                    notEmpty: {
                                        message: 'Password is required'
                                    }
                                }
                            }
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            submitButton: new FormValidation.plugins.SubmitButton(),
                            //defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
                            bootstrap: new FormValidation.plugins.Bootstrap()
                        }
                    }
                );

                $('#kt_login_signin_submit').on('click', function (e) {
                    e.preventDefault();
                    var email = $("#email").val();
                    var password = $("#password").val();
                    var token = $("meta[name='csrf-token']").attr("content");
                    validation.validate().then(function(status) {
                        if (status == 'Valid') {
                            $.ajax({

                                url: "{{ route('login.check_login') }}",
                                type: "POST",
                                dataType: "JSON",
                                cache: false,
                                data: {
                                    "email": email,
                                    "password": password,
                                    "_token": token
                                },

                                success:function(response){

                                    if (response.success) {

                                        Swal.fire({
                                            type: 'success',
                                            title: 'Login Berhasil!',
                                            text: 'Anda akan di arahkan dalam 3 Detik',
                                            timer: 3000,
                                            showCancelButton: false,
                                            showConfirmButton: false
                                        })
                                            .then (function() {
                                                window.location.href = "{{ route('dashboards') }}";
                                            });

                                    } else {

                                        console.log(response.success);

                                        Swal.fire({
                                            type: 'error',
                                            title: 'Login Gagal!',
                                            text: 'silahkan coba lagi!'
                                        });

                                    }

                                    console.log(response);

                                },

                                error:function(response){

                                    Swal.fire({
                                        type: 'error',
                                        title: 'Opps!',
                                        text: 'server error!'
                                    });

                                    console.log(response);

                                }
                            });

                            swal.fire({
                                text: "All is cool! Now you submit this form",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn font-weight-bold btn-light-primary"
                                }
                            }).then(function() {
                                $('#kt_login_signin_form').submit();
                            });
                        } else {
                            swal.fire({
                                text: "Sorry, looks like there are some errors detected, please try again.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn font-weight-bold btn-light-primary"
                                }
                            }).then(function() {
                                KTUtil.scrollTop();
                            });
                        }
                    });
                });

              
            }
        
            // Public Functions
            return {
                // public functions
                init: function() {
                    _login = $('#kt_login');

                    _handleSignInForm();
                }
            };
        }();

        // Class Initialization
        jQuery(document).ready(function() {
            KTLogin.init();
        });

    </script>
@endsection
