@extends('admin.master')


@section('title')
    demo
@endsection

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">Manage Users</div>
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>
</div>
    {{-- <div class="container">
        <div class="card">
            <div class="card-header">Manage Users</div>
            <div class="card-body">
                <table id="user-table" class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div> --}}
@endsection


@section('script')
<script>
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
        // $(document).ready(function() {
        //     $('#user-table').DataTable({
        //         processing: true,
        //         serverSide: true,
        //         ajax: {
        //             url: "/get_user",
        //             type: 'GET',
        //         },
        //         columns: [
        //             {
        //                 data: 'name',
        //                 name: 'name'
        //             },
        //             {
        //                 data: 'email',
        //                 name: 'email'
        //             },
                
        //             // Add other columns as needed
        //         ],
        //     });
        // });
    </script>
@endsection
