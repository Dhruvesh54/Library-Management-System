@extends('admin.master')

@section('title')
    Issued Book
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        <strong class="font-weight-bold text-white"> {{ session('success') }}</strong>
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        <strong class="font-weight-bolder text-white"> {{ session('success') }}</strong>
                    </div>
                @endif
                {{-- <div class="col-6 p-4">
                    <div class="input-group input-group-outline">
                        <label class="form-label ">Search here...</label>
                        <input type="search" class="form-control" name="search" id="search" />
                    </div>
                </div> --}}
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Manage Books</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 text-center">
                                <thead>
                                    <tr>
                                        {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        #</th> --}}
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            student name</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            book name</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Book Barcode</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            author</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Status</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Issued Date</th>

                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Due Date</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Fine</th>

                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody class="text-center" id="Tbody">
                                    @if (count($issued_book_data) > 0)
                                        <tr>
                                            @foreach ($issued_book_data as $key => $issued_book_data)
                                                <td>
                                                    {{ $student_data_arr[$key]->name }}
                                                </td>
                                                <td>
                                                    {{ $issuedBookData[$key]->book_name }}
                                                </td>
                                                <td>
                                                    {{-- {!! DNS1D::getBarcodeHTML("{{$issuedBookData[$key]->book_barcode}}", 'C93', 2, 50) !!} --}}
                                                    {{$issuedBookData[$key]->book_barcode}}
                                                </td>
                                                <td>
                                                    {{ $issuedBookData[$key]->author }}
                                                </td>
                                                <td>
                                                    {{ $issued_book_data->status }}
                                                </td>
                                                <td>
                                                    {{ $formattedCreatedAtDate }}
                                                </td>
                                                <td>
                                                    {{ $formattedDueDate }}
                                                </td>
                                                <td>
                                                    {{ $fine }}
                                                </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9" style="color: red">No books are issued...</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- <a class="btn bg-gradient-primary text-center" href="{{ route('admin.add_book') }}" type="button">Add
                Dealer</a> --}}
            </div>
        </div>
    </div>
@endsection
