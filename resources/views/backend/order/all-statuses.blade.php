@extends('layouts.backend.master')
@section('title')
    {{ __('All Statuses') }}
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('/assets/backend/datatables/jquery.dataTables.min.css') }}">
@endpush
@section('page-content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">{{ __('All Statuses') }}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('Statuses') }}</a></li>
                                <li class="breadcrumb-item active">{{ __('All Statuses') }}</li>
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
                            @endif {{ __(Session::get('message')) }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif @if ($errors->any())
                        <div class="col-sm-12">
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="mdi mdi-block-helper me-2"></i> {{ __($error) }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <div class="col-sm-12 message"></div>
                    <div class="col-sm-12 mb-2">
                        <a href="{{ route('admin.all.orders.statuses') }}" class="btn btn-sm btn-primary">ALL STATUSES</a>
                    </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-sm-12 message-block" style="display: none;">
                    <div class="card">
                        <div class="card-body">
                            <form class="needs-validation" method="POST"
                                action="{{ route('admin.update.orders.statuses.process') }}" novalidate>
                                @csrf
                                <input type="hidden" name="id" id="messageId" />
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Message</label>
                                            <textarea class="form-control" name="message" id="message" placeholder="Enter message here" rows="3" required></textarea>
                                            <div class="invalid-feedback">
                                                Please enter valid message.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button class="btn btn-primary" type="submit">UPDATE MESSAGE</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end card -->
                </div> <!-- end col -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table class="table table-bordered data-table wrap">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Status Title</th>
                                        <th>Message</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('/assets/backend/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/backend/libs/parsleyjs/parsley.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/pages/form-validation.init.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: route('admin.all.orders.statuses'),
                columns: [{
                    data: 'id',
                    name: 'id'
                }, {
                    data: 'title',
                    name: 'title'
                }, {
                    data: 'message',
                    name: 'message'
                }, {
                    data: 'created_at',
                    name: 'created_at'
                }, {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }, ],
                responsive: true,
                'createdRow': function(row, data, dataIndex) {
                    $(row).attr('id', data.id);
                },
                "bDestroy": true,
            });
        });
        $(document).on('click', '.edit', function() {
            $.ajax({
                url: route('admin.edit.orders.statuses'),
                data: {
                    id: $(this).data('id')
                },
                dataType: "json",
                beforeSend: function() {
                    $('body').addClass('loading');
                },
                success: function(response) {
                    $('body').removeClass('loading');
                    $('.message-block').removeAttr('style');
                    $('#message').html(response.message);
                    $('#messageId').val(response.id);
                },
                error: function() {
                    $('body').removeClass('loading');
                    $('.message-block').attr('style', 'display:none');
                    // alert('Error Occured!');
                }
            });
        });
    </script>
@endpush