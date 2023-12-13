@extends('admin.master')

@section('title')
    Add Book
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Manage Users</div>
            <div class="card-body">
                {{-- {{ $dataTable->table() }} --}}

                <table id="user-table" class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <!-- Add other columns as needed -->
                        </tr>
                    </thead>
                </table>

                {{-- <table class="data-table">
                    <thead>
                        <tr>
                            <th>id</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table> --}}
            </div>
        </div>
    </div>
@endsection

@section('script')

<script>
    console.log("dhruvesh");
</script>
    {{-- <script>
        $(document).ready(function() {
            $('#user-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "/get_user",
                    type: 'GET',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'barcode',
                        name: 'barcode',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'edit',
                        name: 'edit',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'delete',
                        name: 'delete',
                        orderable: false,
                        searchable: false
                    },
                    // Add other columns as needed
                ],
            });
        });
    </script> --}}
@endsection
