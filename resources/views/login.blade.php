@extends('master')

@section('title')
    Login
@endsection

@section('content')
    <div class="page-header min-vh-100 p-5">
        <div class="container-fluid justify-content-center aling-items-center p-5 rounded shadow" style="width: 35rem">
            <div class="card card-plain">
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        <strong class="font-weight-bolder text-white"> {{ session('success') }}</strong>
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        <strong class="font-weight-bolder text-white"> {{ session('success') }}</strong>
                    </div>
                @endif
                <div class="card-header bg-gradient-primary text-white">
                    <h4 class="font-weight-bolder text-white">Login</h4>
                    <p class="mb-0">Login Details</p>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('student.login_authentication_method') }}" id="form1">
                        @csrf

                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Enter Email</label>
                            <input type="text" name="em" id="email1" class="form-control"
                                value="{{ old('em') }}">
                        </div>
                        <span style="color:red">
                            @error('em')
                                {{ $message }}
                            @enderror
                        </span>

                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Enter Password</label>
                            <input type="text" name="pwd" id="pwd1" class="form-control"
                                value="{{ old('pwd') }}">
                        </div>
                        <span style="color:red">
                            @error('pwd')
                                {{ $message }}
                            @enderror
                        </span>
                        {{-- <a href="{{ URL::to('/') }}/Registratiom" class="btn text-white bg-gradient-primary">Create account</a> --}}
                        <a href="{{ route('student.registratiom') }}" class="btn text-white bg-gradient-primary">Create
                            account</a>
                        <div class="text-center">
                            <button type="submit"
                                class="btn btn-lg bg-gradient-primary btn-lg w-11 mt-2 mb-0">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
