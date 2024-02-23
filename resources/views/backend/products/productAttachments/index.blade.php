@extends('layouts.backend.master')
@section('title')
    {{ __($page_title ?? '-') }}
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('/assets/backend/datatables/jquery.dataTables.min.css') }}">
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
                        <h4 class="mb-sm-0 font-size-18">{{ __($page_title ?? '-') }}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __($section ?? '-') }}</a>
                                </li>
                                <li class="breadcrumb-item active">{{ __($page_title ?? '-') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            @include('dynamic.messages')
            <div class="row">
                <div class="col-sm-12 message"></div>
                <div class="col-sm-12 mb-2">
                    {!! $shortcut_buttons !!}
                  
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <!-- GETTING POST ID FOR AJAX CALL  -->
              
                <input type="hidden" id="productId" value ="{{ $productId }}" />
                <div class="col-12">
                
                    <div class="card">
                        <div class="card-body table-scroll">
                            <table class="table table-bordered data-table wrap" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Attachments</th>
                                        <th>Created </th>
                                        <th>Updated</th>
                                        <th>Status(is active?)</th>
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
    <script src="{{ asset('/assets/backend/datatables/jquery.dataTables.min.js') }}">  </script>
    <script type="text/javascript">
        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: route('productAttachment.show', $('#productId').val()),
                columns: [ 
                
                    {
                    data: 'attachment',
                    name: 'attachment'
                },
              
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'updatedAt',
                    name: 'updatedAt'
                }, 
                {
                    data: 'status',
                    name: 'status'
                },
             
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }, ],
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

        $(document).on('click', '.product_attachment_status', function() {
            var id     = $(this).attr('data-id');
            var status = $(this).val();
            $.ajax({
                type: 'GET',
                url: route('product.attachment.status'),
                data: {
                    id: id,
                    status: status
                },
                success: function(data) {

                    var result = JSON.parse(data);
                    var type = result.type;

                    if (status == 1) {
                        $('.product_attachment_status#switch' + id).attr('value', 0);
                    } else {
                        $('.product_attachment_status#switch' + id).attr('value', 1);
                    }
                    $('.message').html('<div class="alert alert-' + result.type +
                        ' alert-dismissible fade show" role="alert"><i class="mdi ' + result.icon +
                        ' me-2"></i>' + result.message +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>'
                    );
                }
            });
        });

        function trashRecord(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This record will be trashed!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Trash it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: route('productAttachment.destroy', id),
                        type: 'DELETE',
                        beforeSend: function() {
                            $.LoadingOverlay("show");
                        },
                        success: function(data) {
                            $.LoadingOverlay("hide");
                            let result = JSON.parse(data);
                            $('.message').html('<div class="alert alert-' + result.type +
                                ' alert-dismissible fade show" role="alert"><i class="mdi ' + result
                                .icon +
                                ' me-2"></i>' + result.message +
                                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>'
                            );

                            let table = $('.data-table').DataTable();
                            table.row('#' + id).remove().draw(false);
                        },
                        error: function(data) {
                            $.LoadingOverlay("hide");
                            $('.message').html(
                                '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="mdi mdi-check-all me-2"></i>' +
                                data.responseJSON.message +
                                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>'
                            );
                        }
                    });
                }
            })
        }
    </script>
@endpush