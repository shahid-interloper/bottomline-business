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
                                <li class="breadcrumb-item"><a href="javascript: void(0);"> {{ __($section ?? '-') }} </a>
                                </li>
                                <li class="breadcrumb-item active"> {{ __($page_title ?? '-') }} </li>
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
                <form class="needs-validation" method="POST"
                    action="{{ route('productAttachment.update', $productAttachment->id) }}" enctype="multipart/form-data"
                    novalidate>
                    <div class="row">
                        @csrf
                        @method('PUT')

                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label"> Update Attachment </label>
                                                <input type="file" name="product_attachment" class="form-control" />
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label"> Current Attachment </label>
                                                <div>
                                                    @php
                                                        $ext = pathinfo($productAttachment->attachment, PATHINFO_EXTENSION);
                                                    @endphp
                                                    @if ($ext == 'pdf')
                                                        <a href="{{ asset('assets/frontend/images/product-attachments/' . $productAttachment->attachment) }} "
                                                            download title="click to download"> {{ $productAttachment->attachment }} </a>
                                                    @elseif(in_array($ext, ['jpeg', 'png','jpg']))
                                                        <img width='70'
                                                            src="{{ asset('assets/frontend/images/product-attachments/' . $productAttachment->attachment) }}"
                                                            class='img-thumbnail' alt="no-image" />
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 mb-5">
                            <button type="submit" class="btn btn-primary btn btn-sm"> UPDATE ATTACHMENT </button>
                        </div>
                    </div>
                </form>
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
@endsection
