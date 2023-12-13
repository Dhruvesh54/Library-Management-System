@extends('student.master')

@section('title')
    Issued
@endsection

@section('content')
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
            <div class="col-6 p-4">
                <div class="input-group input-group-outline">
                    <label class="form-label ">Search here...</label>
                    <input type="search" class="form-control" name="search" id="search" />
                </div>
            </div>
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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Title</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Author</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        IssueDate</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        DueDate</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Fine</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Action</th>

                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody class="text-center" id="Tbody">
                                @if (count($issuedBookData) > 0)
                                    {{-- @foreach ($issued_books_data as $book) --}}
                                        <tr>
                                            @foreach ($issuedBookData as $bookData)
                                                <td>
                                                    {{ $bookData->book_name }}
                                                </td>
                                                <td>
                                                    {{ $bookData->author }}
                                                </td>
                                                <td>
                                                    {{ $formattedCreatedAtDate }}
                                                </td>
                                                <td>{{ $formattedDueDate }}</td>
                                                <td>{{ $fine }}</td>
                                                @if ($issued_books_data1->status == 'issued')
                                                    <td class="align-middle text-center  text-xm">
                                                        <span class="badge badge-sm bg-success">
                                                            <a href="{{ URL::to('student/') }}/return_issued_book/{{ $bookData->book_code }}"
                                                                class="text-white">Return</a></span>
                                                    </td>
                                                @endif

                                        </tr>
                                    @endforeach
                                {{-- @endforeach --}}
                            @else
                                <tr>
                                    <td colspan="9" style="color: red">NO data found...</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <a class="btn bg-gradient-primary text-center" href="{{ route('student.issue_book') }}" type="button">Issue Book</a>
        </div>
    </div>
    </div>
@endsection

