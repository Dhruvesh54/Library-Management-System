@extends('master')

@section('title')
    Data Table
@endsection

@section('content')
    <div class="card-body px-0 pb-2">
        <div class="table-responsive p-0">
            <table class="table align-items-center mb-0 text-center" id="example"style="width:100%">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Barcode</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Book Name</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Topic</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Author</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Language</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Edition</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Edit</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Delete</th>
                    </tr>
                </thead>
                <tbody class="text-center" id="Tbody">
                    @if (count($data) > 0)
                        <tr>
                            @foreach ($data as $book)
                                {{-- <td>
                                        {{ $book->id }}
                                    </td> --}}
                                {{-- <td>
                                        {{ $book->book_code }}
                                    </td> --}}
                                <td>
                                    {{-- {{ $book->book_barcode }} --}}
                                    {!! DNS1D::getBarcodeHTML("$book->book_barcode", 'C93', 2, 50) !!}
                                    {{ $book->book_barcode }}
                                </td>
                                <td>
                                    {{ $book->book_name }}
                                </td>
                                <td>
                                    {{ $book->topic }}
                                </td>
                                <td>
                                    {{ $book->author }}
                                </td>
                                <td>
                                    {{ $book->language }}
                                </td>
                                <td>
                                    {{ $book->edition }}
                                </td>
                                {{-- <td>
                                        {{ $book->quantity }}
                                    </td> --}}
                                {{-- <td>
                                        {{ $book->status }}
                                    </td> --}}
                                <td class="align-middle text-center text-xm">
                                    <span class="badge badge-sm bg-warning"><a
                                            href="{{ URL::to('admin/') }}/edit_book/{{ $book->book_code }}"
                                            class="text-white">EDIT</a></span>
                                </td>
                                <td class="align-middle text-center  text-xm">
                                    <span class="badge badge-sm bg-danger">
                                        <a href="{{ URL::to('admin/') }}/delete_book/{{ $book->book_code }}"
                                            class="text-white">DELETE</a></span>
                                </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="9" style="color: red">NO data found...</td>
                    </tr>
                    @endif

                </tbody>
            </table>
        </div>
    </div>

    {{-- <table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>book_barcode</th>
                <th>book_name</th>
                <th>topic</th>
                <th>author</th>
                <th>edition</th>
                <th>language</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->book_barcode }}</td>
                    <td>{{ $item->book_name }}</td>
                    <td>{{ $item->topic }}</td>
                    <td>{{ $item->author }}</td>
                    <td>{{ $item->edition }}</td>
                    <td>{{ $item->language }}</td>

                </tr>
            @endforeach
        </tbody>

    </table> --}}
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
@endsection
