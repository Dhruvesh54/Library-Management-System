@extends('master')

@section('title')
    Sign Up
@endsection

@section('content')
    <div class="page-header min-vh-100 p-5">
        @if (session()->has('error'))
            <div class="alert alert-danger" role="alert">
                <strong class="font-weight-bolder text-white">{{ session('error') }}</strong>
            </div>
        @endif
        <div class="container-fluid justify-content-center aling-items-center p-5 rounded shadow" style="width: 35rem">
            <div class="card card-plain">
                <div class="card-header bg-gradient-primary text-white">
                    <h4 class="font-weight-bolder text-white">Register</h4>
                    <p class="mb-0">Registrartio Details</p>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('student.add_user')}}" id="form1">
                        @csrf
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Enter Name</label>
                            <input type="text" name="name" id="name1" class="form-control"
                                value="{{ old('name') }}">
                        </div>
                        <span id="err_msg_name" style="color:red">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </span>

                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Enter Email</label>
                            <input type="text" name="email" id="email1" class="form-control"
                                value="{{ old('email') }}">
                        </div>
                        <span id="err_msg_email" style="color:red">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </span>

                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Enter Mobile Number</label>
                            <input type="text" name="mobile" id="mobile1" class="form-control"
                                value="{{ old('mobile') }}">
                        </div>
                        <span id="err_msg_mobile" style="color:red">
                            @error('mobile')
                                {{ $message }}
                            @enderror
                        </span>

                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Enter Password</label>
                            <input type="password" name="pwd" id="pwd1" class="form-control"
                                value="{{ old('pwd') }}">
                        </div>
                        <span id="err_msg_pwd" style="color:red">
                            @error('pwd')
                                {{ $message }}
                            @enderror
                        </span>
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Enter Confirm Password</label>
                            <input type="password" name="pwd_confirmation" id="pwd_confirmation1" class="form-control"
                                value="{{ old('pwd_confirmation') }}">
                        </div>
                        <span id="err_msg_pwd_confirm" style="color:red">
                            @error('pwd_confirmation')
                                {{ $message }}
                            @enderror
                        </span>
                        <div class="text-center">
                            <button type="submit"
                                class="btn btn-lg bg-gradient-primary btn-lg w-11 mt-2 mb-0">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection



    @section('script')
        <script>
            $(document).ready(function() {
                $('#name1').on('input', function(e) {
                    var inputValue = $(this).val();
                    if (!/^[A-Za-z]{0,10}$/.test(inputValue)) {
                        $('#err_msg_name').html('Please Enter Characters Only.');
                        $(this).val('');
                    } else {
                        $('#err_msg_name').html('');
                    }
                });


                $('#email1').on('blur', function(e) {
                    var inputValue = $(this).val();
                    if (!/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,5}$/.test(inputValue)) {
                        $('#err_msg_email').html("Please enter a valid email address");
                        $(this).val('');
                    } else {
                        $('#err_msg_email').html('');
                    }
                });
            });

            $('#mobile1').on('blur', function(e) {
                var inputValue = $(this).val();
                if (!/^[0-9]{10}$/.test(inputValue)) {
                    $('#err_msg_mobile').html("Please enter a valid mobile number only 10 digit");
                    $(this).val('');
                } else {
                    $('#err_msg_mobile').html('');
                }
            });

            $('#pwd1').on('blur', function(e) {
                var inputValue = $(this).val();
                if (!/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,20}$/.test(inputValue)) {
                    $('#err_msg_pwd').html(
                        "Password must include one lower case, one upper case letter and it must be 8 characters."
                    );
                    $(this).val('');
                } else {
                    $('#err_msg_pwd').html('');
                }
            });

            $('#pwd_confirmation1').on('blur', function(e) {
                var confirmValue = $(this).val();
                var passwordValue = $('#pwd1').val();

                if (confirmValue !== passwordValue) {
                    $('#err_msg_pwd_confirm').html("Passwords do not match.");
                    $(this).val('');
                } else {
                    $('#err_msg_pwd_confirm').html('');
                }
            });
        </script>
    @endsection
