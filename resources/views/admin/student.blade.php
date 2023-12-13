@extends('admin.master')

@section('title')
    Manage Book
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
                            <h6 class="text-white text-capitalize ps-3">Manage Student</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 text-center" id="user-table">

                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            name</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            email </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            mobile</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Edit</th>
                                        {{-- <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Delete</th> --}}

                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>


                            </table>
                        </div>
                    </div>
                </div>
                {{-- <a class="btn bg-gradient-primary text-center" href="{{ route('admin.add_book') }}" type="button">Add
                    Book</a> --}}
            </div>
        </div>
    </div>
@endsection

@section('footer')
@endsection


@section('script')
    <script>
        $('#user-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.student') }}",
                type: 'GET',
            },
            columns: [{
                    data: 'name',
                    name: 'name',
                },
                {
                    data: 'email',
                    name: 'email',
                },
                {
                    data: 'mobile',
                    name: 'mobile',
                },
                {
                    data: 'edit',
                    name: 'edit',
                    orderable: false,
                    searchable: false,
                }
                // {
                //     data: 'delete',
                //     name: 'delete',
                //     orderable: false,
                //     searchable: false,
                // },
                // {
                //     data: 'action',
                //     name: 'action',
                //     orderable: false,
                //     searchable: false,
                // },
                // {
                //     data: 'action'
                //     name: 'action'
                //     orderable: false,
                //     searchable: false,
                // }
            ],

        });
    </script>
@endsection
