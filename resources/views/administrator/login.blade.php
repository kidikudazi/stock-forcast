<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{ env('APP_NAME') }}</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
        <meta name="description" content=""/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="author" content="Piggisty Limited" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="shortcut icon" href="{{ asset('pigisty-logo.png') }}">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/vendors.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/style.css') }}" />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
            integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
            crossorigin="anonymous"
        />
        <style>
            .help-block {
                color: #dd4b39;
            }

            .has-error {
                color: #dd4b39;
            }
        </style>
    </head>

    <body class="bg-white">
        <div class="app">
            <div class="app-wrap">
                <div class="app-contant">
                    <div class="bg-white">
                        <div class="container-fluid p-0">
                            <div class="row no-gutters">
                                <div class="col-sm-6 col-lg-5 col-xxl-3 align-self-center order-2 order-sm-1">
                                    <div class="d-flex align-items-center h-100-vh">
                                        <div class="login p-50">
                                            <h1 class="mb-2">{{ env('APP_NAME') }}</h1>
                                            <p>Welcome back, please login to your account.</p>
                                            <form method="POST" id="login-form" class="mt-3 mt-sm-5">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="control-label {{ $errors->has('email') ? 'has-error' : '' }}">Email</label>
                                                            <input type="text" name="email" id="email" class="form-control" placeholder="mail@address.com" value="{{ old('email') }}"/>
                                                            @if ($errors->has('email'))
                                                                <strong class="help-block">{{ $errors->first('email') }}</strong>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="control-label {{ $errors->has('password') ? 'has-error' : '' }}">Password</label>
                                                            <input type="password" name="password" id="password" class="form-control" placeholder="Password"/>
                                                            @if ($errors->has('password'))
                                                                <strong class="help-block">{{ $errors->first('password') }}</strong>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="d-block d-sm-flex align-items-center">
                                                            <a href="{{ url('/') }}" class="ml-auto">Forgot Password ?</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <button id="login-btn" class="btn btn-primary text-uppercase">Login</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xxl-9 col-lg-7 bg-gradient o-hidden order-1 order-sm-2">
                                    <div class="row align-items-center h-100">
                                        <div class="col-7 mx-auto ">
                                            <img class="img-fluid" src="" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/admin/js/vendors.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/app.js') }}"></script>
        <script src="{{ asset('assets/js/toastr/toastr.js') }}"></script>
        <script>
            @if(Session::has('success'))
                window.addEventListener('load', () => {
                    toastr.success('{{ session('success') }}', 'Success');
                });

                window.setTimeout(()=> {
                    @php session()->forget('success'); @endphp
                }, 8000);
            @endif

            @if(Session::has('error'))
                window.addEventListener('load', () => {
                    toastr.error('{{ session('error') }}', 'Error');
                });

                window.setTimeout(()=> {
                    @php session()->forget('success'); @endphp
                }, 8000);
            @endif

            jQuery.validator.addMethod("customemail", function(value, element) {
                return /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value);
            }, "Please enter a valid email address.");

			$("#login-form").validate({
				rules: {
					email: {
						required: true,
						customemail: true,
					},
					password: { required: true },
				},
				messages: {
					email: {
						required: "Enter your email address.",
					},
					password: "Enter your password.",
				},
				errorClass: "help-block",
				errorElement: "strong",
				onfocus: true,
				onblur: true,
				highlight: function(element) {
					$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
				},
				unhighlight: function (element) {
					$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
				},
				errorPlacement: function (error, element) {
					if(element.parent('.input-group').length) {
						error.insertAfter(element.parent());
						return false;
					} else {
						error.insertAfter(element);
						return false;
					}
				}
			});

            $("body").on("submit", "#login-form", function() {
            	$("#login-btn").attr('disabled', true).html(`<i class="fa fa-spin fa-spinner"></i>`)
        	});
        </script>
    </body>
</html>
