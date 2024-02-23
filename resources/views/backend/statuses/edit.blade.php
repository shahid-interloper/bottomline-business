@extends('layouts.backend.master')
@section('title')
    {{ __($page_title ?? '-') }}
@endsection
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
                <form class="needs-validation" method="POST" action="{{ route('statuses.update', $status->id) }}" novalidate>
                    <div class="row">
                        @csrf
                        @method('PUT')
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-6 col-md-12">
                                            <div class="mb-3">
                                                <label for="type" class="form-label">Status Type</label>
                                                <input type="text" value="{{ $status->type }}" class="form-control" readonly/>
                                                {{-- <select name="type" id="type" class="form-select select2" required>
                                                    <option value="" selected disabled>Select Status Type</option>
                                                    <option value="company" {{ ($status->type == "company") ? 'selected' : '' }}>Company</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Select valid status type
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-6 col-md-12">
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Title</label>
                                                <input type="text" class="form-control" name="title" id="title"
                                                    placeholder="Title here" value="{{ old('title', $status->title) }}" readonly />
                                                <div class="invalid-feedback">
                                                    Please enter valid title.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-6 col-md-12">
                                            <div class="mb-3">
                                                <label for="message" class="form-label">Message</label>
                                                <textarea class="form-control" placeholder="Enter message for status here" name="message" id="message" rows="5"
                                                    required>{{ old('message', $status->message) }}</textarea>
                                                <div class="invalid-feedback">
                                                    Please enter valid message.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card -->
                        </div> <!-- end col -->
                        <div class="col-sm-12 mb-5">
                            <button type="submit" class="btn btn-primary">UPDATE STATUS</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/backend/libs/parsleyjs/parsley.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/pages/form-validation.init.js') }}"></script>
@endpush
