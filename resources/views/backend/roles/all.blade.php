@extends('layouts.backend.master')
@section('title')
    {{ __('All Roles') }}
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('/assets/backend/datatable/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/backend/datatable/dataTables.bootstrap4.min.css') }}">
    <style>
        .avatar-sm {
            width: auto !important;
        }
    </style>
@endpush
@section('page-content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">{{ __('All Roles') }}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('Roles') }}</a></li>
                                <li class="breadcrumb-item active">{{ __('All Roles') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                @if (Session::has('message'))
                    <div class="col-sm-12">
                        <div class="alert alert-{{ Session::get('type') }} alert-dismissible fade show" role="alert">
                            @if (Session::get('type') == 'danger')
                                <i class="mdi mdi-block-helper me-2"></i>
                            @else
                                <i class="mdi mdi-check-all me-2"></i>
                            @endif
                            {{ __(Session::get('message')) }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
                <div class="col-sm-12 message"></div>
                <div class="col-sm-12 mb-2">
                    {!! $shortcut_buttons !!}
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-scroll">
                            <table class="table table-bordered data-table wrap">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Role</th>
                                        <th style="width: 30%;">Permissions</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('/assets/backend/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/assets/backend/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: route('roles.index'),
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'permissions',
                        name: 'permissions'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                responsive: true,
                'createdRow': function(row, data, dataIndex) {
                    $(row).attr('id', data.id);
                },
                "order": [
                    [0, "desc"]
                ],
                "bDestroy": true,
            });
        });

        function trashRecord (id) {
            Swal.fire({
                title: "Are you sure?",
                text: "Record will be moved to trash",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#34c38f",
                cancelButtonColor: "#f46a6a",
                confirmButtonText: "Yes, delete it!"
            }).then(function(data) {
                if (data.value) {
                    $.ajax({
                        type: 'DELETE',
                        url: route('roles.destroy', id),
                        dataType: 'json',
                        success: function(result) {
                            $('.message').html('<div class="alert alert-' + result.type +
                                ' alert-dismissible fade show" role="alert"><i class="mdi ' + result
                                .icon +
                                ' me-2"></i>' + result.message +
                                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>'
                            );

                            let table = $('.data-table').DataTable();
                            table.row('#' + id).remove().draw(false);
                        }
                    });
                }
            })
        }
    </script>
@endpush
