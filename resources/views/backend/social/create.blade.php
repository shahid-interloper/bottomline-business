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
                                <li class="breadcrumb-item active">{{ __($page_title ?? '-') }} </li>
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
                @if ($errors->any())
                    <div class="col-sm-12">
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="mdi mdi-block-helper me-2"></i>
                                {{ __($error) }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endforeach
                    </div>
                @endif
                <div class="col-sm-12 message"></div>
                <div class="col-sm-12 mb-2">
                    {!! $shortcut_buttons !!}
                </div>
                <form class="needs-validation" method="POST" action="{{ route('socialIcons.store') }}"
                    enctype="multipart/form-data" novalidate>
                    <div class="row">
                        @csrf
                        <div class="col-sm-9">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Name</label>
                                                <input type="text" class="form-control" name="key" id="key"
                                                    placeholder="Enter Unique Name Here" value="{{ old('key') }}"
                                                    required />
                                                <div class="invalid-feedback">
                                                    Please enter valid Name.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="slug" class="form-label">Link</label>
                                                <input type="url" class="form-control" name="link" id="link"
                                                    placeholder="Url:Link Here" value="{{ old('link') }}" required>
                                                <div class="invalid-feedback">
                                                    Please enter valid Link url.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="Class"> Class </label>
                                                <input type="text" class="form-control" name="class" id="class"
                                                    placeholder="Enter Class Name" value="{{ old('Class') }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="order" class="form-label">Sort Order</label>
                                                <input type="number" value="1" min="0" class="form-control"
                                                    name="order" id="order" placeholder="Sorting Order"
                                                    value="{{ old('order', 1) }}" required>
                                                <div class="invalid-feedback">
                                                    Please enter valid Sort Order.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 mb-5">
                                            <button type="submit" class="btn btn-primary"> CREATE </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card -->
                        </div> <!-- end col -->
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 mb-3">
                                            <div class="form-group">
                                                <label for="image" class="control-label"> Icon image </label>
                                                <input type="file" class="form-control" name="image" id="image"
                                                    required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
        function myFunction() {

            var a = document.getElementById("title").value;

            var b = a.toLowerCase().replace(/ /g, '-')
                .replace(/[^\w-]+/g, '');
            console.log(b);
            document.getElementById("slug").value = b;

            // document.getElementById("slug-target-span").innerHTML = b;
        }
    </script>
@endpush
