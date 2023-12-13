@extends('admin.master')

@section('title')
    Edit Student
@endsection

@section('content')
    <div class="page-header min-vh-100 p-5">
        <div class="container-fluid justify-content-center aling-items-center p-5 rounded shadow" style="width: 70rem">
            <div class="card card-plain">
                <div class="card-header bg-gradient-primary text-white">
                    <h4 class="font-weight-bolder text-white">Update Student</h4>
                    <p class="mb-0">Update Student</p>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.update_student_method') }}" id="form1">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label for="" class="text-bold">Email:</label>
                            </div>
                            <div class="col-12">
                                <div class="input-group input-group-outline mb-3">
                                    <input type="text" name="email" id="email1" class="form-control"
                                        value="{{$student_data->email }}" readonly>
                                </div>
                            </div>
                        </div>

                        <label class="form-label">Name</label>
                        <div class="input-group input-group-outline mb-3">
                            <input type="text" name="name" id="name1" class="form-control"
                                value="{{ $student_data->name }}">
                        </div>
                        <span style="color:red">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </span>

                        <label class="form-label">Mobile No.</label>
                        <div class="input-group input-group-outline mb-3">
                            <input type="text" name="mobile" id="mobile1" class="form-control"
                                value="{{ $student_data->mobile }}">
                        </div>
                        <span style="color:red">
                            @error('mobile')
                                {{ $message }}
                            @enderror
                        </span>

                        <div class="text-center">
                            <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-11 mt-4 mb-0">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
