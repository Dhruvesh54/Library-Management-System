@extends('admin.master')

@section('title')
    Edit Book
@endsection

@section('content')
    <div class="page-header min-vh-100 p-5">
        <div class="container-fluid justify-content-center aling-items-center p-5 rounded shadow" style="width: 70rem">
            <div class="card card-plain">
                <div class="card-header bg-gradient-primary text-white">
                    <h4 class="font-weight-bolder text-white">Update Book</h4>
                    <p class="mb-0">Update Book Detalis</p>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.update_book_method') }}" id="form1">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label for="" class="text-bold">Book Code:</label>
                            </div>
                            <div class="col-12">
                                <div class="input-group input-group-outline mb-3">
                                    <input type="text" name="book_code" id="book_code1" class="form-control"
                                        value="{{$book_data->book_code }}" readonly>
                                </div>
                            </div>
                        </div>

                        <label class="form-label">Enter Book Name</label>
                        <div class="input-group input-group-outline mb-3">
                            <input type="text" name="name" id="topic1" class="form-control"
                                value="{{ $book_data->book_name }}">
                        </div>
                        <span style="color:red">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </span>

                        <label class="form-label">Enter Book Topic</label>
                        <div class="input-group input-group-outline mb-3">
                            <input type="text" name="topic" id="topic1" class="form-control"
                                value="{{ $book_data->topic }}">
                        </div>
                        <span style="color:red">
                            @error('topic')
                                {{ $message }}
                            @enderror
                        </span>

                        <label class="form-label">Enter Book Author Name</label>
                        <div class="input-group input-group-outline mb-3">
                            <input type="text" name="author" id="author1" class="form-control"
                                value="{{ $book_data->author }}">
                        </div>
                        <span style="color:red">
                            @error('author')
                                {{ $message }}
                            @enderror
                        </span>

                        <label class="form-label">Enter Book Edition</label>
                        <div class="input-group input-group-outline mb-3">
                            <input type="text" name="edition" id="edition1" class="form-control"
                                value="{{ $book_data->edition }}">
                        </div>
                        <span style="color:red">
                            @error('edition')
                                {{ $message }}
                            @enderror
                        </span>
                        {{-- <label class="form-label">Enter Book Quantity</label>
                        <div class="input-group input-group-outline mb-3">
                            <input type="text" name="quantity" id="quantity1" class="form-control"
                                value="{{ $book_data->quantity }}">
                        </div>
                        <span style="color:red">
                            @error('quantity')
                                {{ $message }}
                            @enderror
                        </span> --}}

                        <label class="form-label">Enter Book Language</label>
                        <div class="input-group input-group-outline mb-3">
                            <input type="text" name="language" id="language1" class="form-control"
                                value="{{ $book_data->language }}">
                        </div>
                        <span style="color:red">
                            @error('language')
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
