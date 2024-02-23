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
                <form class="needs-validation" method="POST" action="{{ route('categoryTypes.update', $cateType->id) }}"
                    enctype="multipart/form-data" novalidate>
                    <div class="row">
                        @csrf
                        @method('PUT')
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" class="form-control" name="name" id="name"
                                                    placeholder="Name here" value="{{ old('name', $cateType->name) }}" required
                                                    onkeyup="myFunction();">
                                                <div class="invalid-feedback">
                                                    Please enter valid name.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="slug" class="form-label">Slug</label>
                                                <input type="text" class="form-control" name="slug" id="slug"
                                                    placeholder="Slug here" value="{{ old('slug', $cateType->slug) }}" required>
                                                <div class="invalid-feedback">
                                                    Please enter valid Slug.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="slug" class="form-label">Sorting Order</label>
                                                <input type="number" value="1" min="0" class="form-control"
                                                    name="order" id="order" placeholder="Page Order"
                                                    value="{{ old('order', $cateType->order) }}" required>
                                                <div class="invalid-feedback">
                                                    Please enter valid Order.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label for="link" class="form-label">Page Link</label>
                                                <input type="text" class="form-control" name="link" id="link"
                                                    placeholder="Link here" value="{{ old('link', $cateType->link) }}" />
                                                <div class="invalid-feedback">
                                                    Please enter valid link.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card -->
                        </div> <!-- end col -->
                        <div class="col-sm-12 mb-5">
                            <button type="submit" class="btn btn-primary">UPDATE CATEGORY TYPE</button>
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
    <script type="text/javascript">
        function myFunction() {
            var a = document.getElementById("name").value;
            var b = a.toLowerCase().replace(/ /g, '-')
                .replace(/[^\w-]+/g, '');
            document.getElementById("slug").value = b;
        }
    </script>
@endpush
