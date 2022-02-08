<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ env('APP_NAME') }} | Profile</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    @include('layouts.admin.styles')
</head>

<body>
    <div class="app">
        <div class="app-wrap">
            @include('layouts.admin.navbar')
            <div class="app-container">
                @include('layouts.admin.sidebar')
                <div class="app-main" id="main">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 m-b-30">
                                <div class="d-block d-sm-flex flex-nowrap align-items-center">
                                    <div class="page-title mb-2 mb-sm-0">
                                        <h1>Account Settings</h1>
                                    </div>
                                    <div class="ml-auto d-flex align-items-center">
                                        <nav>
                                            <ol class="breadcrumb p-0 m-b-0">
                                                <li class="breadcrumb-item">
                                                    <a href="{{ url('administrator/home') }}"><i class="ti ti-home"></i></a>
                                                </li>
                                                <li class="breadcrumb-item active text-primary" aria-current="page">Profile</li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row account-contant">
                            <div class="col-12">
                                <div class="card card-statistics">
                                    <div class="card-body p-0">
                                        <div class="row no-gutters">
                                            <div class="col-xl-3 pb-xl-0 pb-5 border-right">
                                                <div class="page-account-profil pt-5">
                                                    <div class="profile-img text-center rounded-circle">
                                                        <div class="pt-5">
                                                            <div class="bg-img m-auto">
                                                                <img src="{{ $admin->avatar ?? asset('assets/admin/img/user.png') }}" class="img-fluid" alt="users-avatar">
                                                            </div>
                                                            <div class="profile pt-4">
                                                                <h4 class="mb-1">{{ $admin->fullname }}</h4>
                                                                <p class="text-muted">Administrator</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-5 col-md-6 col-12 border-t border-right">
                                                <div class="page-account-form">
                                                    <div class="form-titel border-bottom p-3">
                                                        <h5 class="mb-0 py-2">Edit Your Personal Information</h5>
                                                    </div>
                                                    <div class="p-4">
                                                        <form action="{{ url('administrator/update/profile') }}" id="profile" method="POST">
                                                            @csrf
                                                            <div class="form-row">
                                                                <div class="form-group col-md-12">
                                                                    <label for="name">Name</label>
                                                                    <input type="text" class="form-control" name="name" id="name" value="{{ $admin->name }}">
                                                                </div>
                                                                <div class="form-group col-md-12">
                                                                    <label for="phone">Phone Number</label>
                                                                    <input type="text" class="form-control" name="phone" id="phone" value="{{ $admin->phone }}">
                                                                </div>
                                                                <div class="form-group col-md-12">
                                                                    <label for="email">Email</label>
                                                                    <input type="email" class="form-control" name="email" id="email1" value="{{ $admin->email }}" readonly>
                                                                </div>
                                                            </div>
                                                            <button id="profile_btn" type="submit" class="btn btn-primary">Update Information</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-6 border-t col-12">
                                                <div class="page-account-form">
                                                    <div class="form-titel border-bottom p-3">
                                                        <h5 class="mb-0 py-2">Change Password</h5>
                                                    </div>
                                                    <div class="p-4">
                                                        <form action="{{ url('administrator/update/password') }}" id="password" method="POST">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="old_password">Old Password:</label>
                                                                <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Old password">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="new_password">New Password:</label>
                                                                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New password">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="confirm_password">Confirm Password:</label>
                                                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm password">
                                                            </div>                                                           
                                                            <button id="password_btn" type="submit" class="btn btn-primary">Save & Update</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.admin.footer')
        </div>
    </div>
    @include('layouts.admin.scripts')
    <script>
        $("#profile").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                },
                phone: {
                    required: true,
                    min: 0,
                    minlength: 11,
                },
            },
            messages: {
                name: {
                    required: "Enter your name.",
                    minlength: "Minimum of {0} characters allowed."
                },                
                phone: {
                    require: "Enter your phone number.",
                    minlength: "Minimum of {0} characters allowed.",                    
                }
            },
            errorClass: "help-block",
            errorElement: "strong",
            onfocus:true,
            onblur:true,
            highlight:function(element){
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            unhighlight:function(element){
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            },
            errorPlacement:function(error, element){
                if(element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                    return false;
                } else {
                    error.insertAfter(element);
                    return false;
                }
            },
        });

        $("#password").validate({
            rules: {
                old_password: {
                    required: true
                },
                new_password: {
                    required: true,
                    minlength: 8,
                    maxlength: 50,
                },
                confirm_password: {
                    minlength: 8,
                    equalTo: "#new_password",
                }
            },
            messages: {
                old_password: "Enter your old password.",
                new_password: {
                    required: "Enter your new password.",
                    minlength: "Minimum of {0} characters allowed.",
                    maxlength: "Maximum of {0} characters allowed.",
                },
                confirm_password: "Password does not match.",
            },
            errorClass: "help-block",
            errorElement: "strong",
            onfocus:true,
            onblur:true,
            highlight:function(element){
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            unhighlight:function(element){
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            },
            errorPlacement:function(error, element){
                if(element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                    return false;
                } else {
                    error.insertAfter(element);
                    return false;
                }
            },
        });

        $('body').on('submit', '#profile', function(){
            $('#profile_btn').prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Updating Profile');
        });

        $('body').on('submit', '#password', function(){
            $('#password_btn').prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Updating Password');
        });
    </script>
</body>
</html>