@extends('layouts.backend.master')
@section('title') {{ __($page_title ?? '-') }} @endsection
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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __($section ?? '-') }}</a></li>
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
                <form class="needs-validation" method="POST" action="{{route('banners.store')}}" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="heading_oneBrown" class="form-label">Heading One</label>
                                                <input type="text" class="form-control" name="heading[one]" id="heading_oneBrown"
                                                    placeholder="Heading One" value="{{old('heading.one')}}" />
                                                <div class="invalid-feedback">
                                                    Please enter valid heading one.
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="heading_oneWhite" class="form-label">Heading One(White)</label>
                                                <input type="text" class="form-control" name="heading[oneWhite]" id="heading_oneWhite"
                                                    placeholder="Heading One (White)" value="{{old('heading.oneWhite')}}" />
                                                <div class="invalid-feedback">
                                                    Please enter valid heading one.
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="heading_two" class="form-label">Heading Two</label>
                                                <input type="text" class="form-control" name="heading[two]" id="heading_two"
                                                    placeholder="Heading Two here" value="{{old('heading.two')}}" >
                                                <div class="invalid-feedback">
                                                    Please enter valid heading two.
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="heading_two" class="form-label">Heading Three</label>
                                                <input type="text" class="form-control" name="heading[three]" id="heading_two"
                                                    placeholder="Heading Three here" value="{{old('heading.three')}}" >
                                                <div class="invalid-feedback">
                                                    Please enter valid heading two.
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea rows="4" class="form-control" name="description" id="description"
                                                    placeholder="Description here" >{{old('description')}}</textarea>
                                                <div class="invalid-feedback">
                                                    Please enter valid description.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-3">
                                                <label for="btn_title" class="form-label">Button Title One</label>
                                                <input type="text" class="form-control" name="buttons[title1]" id="btn_title"
                                                    placeholder="Button Title here" value="{{old('button.title1')}}" >
                                                <div class="invalid-feedback">
                                                    Please enter valid button title.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="mb-3">
                                                <label for="btn_link" class="form-label">Button Link One</label>
                                                <input type="text" class="form-control" name="buttons[link1]" id="btn_link"
                                                    placeholder="Button Link here" value="{{old('buttons.link1')}}" >
                                                <div class="invalid-feedback">
                                                    Please enter valid button link.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-3">
                                                <label for="btn_title" class="form-label">Button Title Two</label>
                                                <input type="text" class="form-control" name="buttons[title2]" id="btn_title"
                                                    placeholder="Button Title here" value="{{old('button.title2')}}" >
                                                <div class="invalid-feedback">
                                                    Please enter valid button title.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="mb-3">
                                                <label for="btn_link" class="form-label">Button Link Two</label>
                                                <input type="text" class="form-control" name="buttons[link2]" id="btn_link"
                                                    placeholder="Button Link here" value="{{old('buttons.link2')}}" >
                                                <div class="invalid-feedback">
                                                    Please enter valid button link.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label for="page" class="form-label">Page <i class="text-danger">*</i></label>
                                                <select class="form-select select2" id="page_id" name="page_id" required>
                                                    <option selected disabled value="">Select Page</option>
                                                    @forelse ($pages as $page)
                                                        <option value="{{$page->id}}">{{ $page->name ?? '' }}</option>
                                                    @empty
                                                        <option value="">No Page Found!</option>
                                                    @endforelse
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select page
                                                </div>
                                            </div>
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
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Image <i class="text-danger"></i></label>
                                                <input type="file" class="form-control" id="image" name="image"/>
                                                <div class="invalid-feedback">
                                                    Please upload valid image
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label for="image_name" class="form-label">Banner Image Name</label>
                                                <input type="text" class="form-control" placeholder="Enter Valid Image Name" id="image_name" name="image_name" value="{{old('image_name')}}"/>
                                                <div class="invalid-feedback">
                                                    Please enter validate image name
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <button class="btn btn-primary" type="submit">ADD BANNER</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
@endsection

@push('scripts')
	<script src="{{asset('assets/backend/libs/parsleyjs/parsley.min.js')}}"></script>
	<script src="{{asset('assets/backend/js/pages/form-validation.init.js')}}"></script>
@endpush
