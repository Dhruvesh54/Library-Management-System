@extends('admin.master')

@section('title')
    Add Book
@endsection

@section('content')
    <div class="page-header min-vh-100 p-5">
        <div class="container-fluid justify-content-center aling-items-center p-5 rounded shadow" style="width: 70rem">
            <div class="card card-plain">
                <div class="card-header bg-gradient-primary text-white">
                    <h4 class="font-weight-bolder text-white">Add Book</h4>
                    <p class="mb-0">Add Book Detalis</p>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.add_book_method') }}" id="form1">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label for="" class="text-bold">Book Code:</label>
                            </div>
                            <div class="col-12">
                                <div class="input-group input-group-outline mb-3">
                                    <input type="text" name="book_code" id="book_code1" class="form-control"
                                        value="{{ $bookCode }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Enter Book Name</label>
                            <input type="text" name="name" id="topic1" class="form-control"
                                value="{{ old('name') }}">
                        </div>
                        <span style="color:red">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </span>

                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Enter Book Topic</label>
                            <input type="text" name="topic" id="topic1" class="form-control"
                                value="{{ old('topic') }}">
                        </div>
                        <span style="color:red">
                            @error('topic')
                                {{ $message }}
                            @enderror
                        </span>

                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Enter Book Author Name</label>
                            <input type="text" name="author" id="author1" class="form-control"
                                value="{{ old('author') }}">
                        </div>
                        <span style="color:red">
                            @error('author')
                                {{ $message }}
                            @enderror
                        </span>

                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Enter Book Edition</label>
                            <input type="text" name="edition" id="edition1" class="form-control"
                                value="{{ old('edition') }}">
                        </div>
                        <span style="color:red">
                            @error('edition')
                                {{ $message }}
                            @enderror
                        </span>
                        {{-- <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Enter Book Quantity</label>
                            <input type="text" name="quantity" id="quantity1" class="form-control"
                                value="{{ old('quantity') }}">
                        </div>
                        <span style="color:red">
                            @error('quantity')
                                {{ $message }}
                            @enderror
                        </span> --}}

                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Enter Book Language</label>
                            <input type="text" name="language" id="language1" class="form-control"
                                value="{{ old('language') }}">
                        </div>
                        <span style="color:red">
                            @error('language')
                                {{ $message }}
                            @enderror
                        </span>


                        <div class="text-center">
                            <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-11 mt-4 mb-0">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection