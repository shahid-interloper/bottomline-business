@extends('layouts.backend.master')
@push('styles')
    <style>
        .container-fluid {
            margin-top: 100px;
        }
    </style>
@endpush
@section('page-content')
    <div class="container-fluid">
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
        {{-- {{ dd($data) }} --}}
        <div class="row">
            <div class="col-sm-12">
                <div class="crypto-buy-sell-nav">
                    <div class="card">
                        <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#social" role="tab">
                                    Logos Favicon
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#contacts" role="tab">
                                    Contacts
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#classLocation" role="tab">
                                    Class Location
                                </a>
                            </li>

                        </ul>
                        <div class="tab-content crypto-buy-sell-nav-content p-4">
                            <div class="tab-pane active" id="social" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">
                                        @if (Session::has('message'))
                                            <div class="col-sm-12">
                                                <div class="alert alert-{{ Session::get('type') }} alert-dismissible fade show"
                                                    role="alert">
                                                    @if (Session::get('type') == 'danger')
                                                        <i class="mdi mdi-block-helper me-2"></i>
                                                    @else
                                                        <i class="mdi mdi-check-all me-2"></i>
                                                    @endif
                                                    {{ __(Session::get('message')) }}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close"></button>
                                                </div>
                                            </div>
                                        @endif
                                        <strong> LOGOS & FAV ICONS </strong>
                                        <hr />
                                        <strong> Header Logo </strong>
                                        <form class="needs-validation" method="POST"
                                            action="{{ route('web.logos.process') }}" enctype="multipart/form-data"
                                            novalidate>
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <div class="mb-3">
                                                        <input type="file" class="form-control" name="logo"
                                                            id="logo" placeholder="Facebook Link#" required>
                                                        <div class="invalid-feedback">
                                                            Please enter valid Image.
                                                        </div>
                                                        @error('image')
                                                            <span class="text-danger"> {{ $message }} </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="mb-3">
                                                        <input type="text" class="form-control" name="image_name"
                                                            id="image_name" placeholder="Enter Image name">
                                                    </div>
                                                </div>
                                                @if (isset($logo))
                                                    <div class="col-sm-3">
                                                        <img class="img-thumbnail" width="70"
                                                            src="{{ asset('assets/frontend/images/logos/' . $logo['logo']) }}"
                                                            alt="no-image">
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <button class="btn btn-primary" name="update_header_logo" value="true"
                                                    type="submit">Submit</button>
                                            </div>
                                        </form>
                                        <hr />
                                        <strong> Footer Logo </strong>
                                        <form class="needs-validation" method="POST"
                                            action="{{ route('web.logos.process') }}" enctype="multipart/form-data"
                                            novalidate>
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <div class="mb-3">
                                                        <input type="file" class="form-control" name="footer"
                                                            id="footer" placeholder="Facebook Link#" required>
                                                        <div class="invalid-feedback">
                                                            Please enter valid Image.
                                                        </div>
                                                        @error('image')
                                                            <span class="text-danger"> {{ $message }} </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="mb-3">
                                                        <input type="text" class="form-control" name="image_name"
                                                            id="image_name" placeholder="Enter Image name">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    @if (isset($footer))
                                                        <div class="mb-3">
                                                            <img class="img-thumbnail" width="70"
                                                                src="{{ asset('assets/frontend/images/logos/' . $footer['footer']) }}"
                                                                alt="no-image">
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div>
                                                <button class="btn btn-primary" name="update_footer_logo" value="true"
                                                    type="submit">Submit</button>
                                            </div>
                                        </form>
                                        <hr />
                                        <strong> Fav icon </strong>
                                        <form class="needs-validation" method="POST"
                                            action="{{ route('web.logos.process') }}" enctype="multipart/form-data"
                                            novalidate>
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <div class="mb-3">
                                                        <input type="file" class="form-control" name="favicon"
                                                            id="favicon" placeholder="Facebook Link#" required>
                                                        <div class="invalid-feedback">
                                                            Please enter valid Image.
                                                        </div>
                                                        @error('image')
                                                            <span class="text-danger"> {{ $message }} </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="mb-3">
                                                        <input type="text" class="form-control" name="image_name"
                                                            id="image_name" placeholder="Enter image name">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    @if (isset($favicon))
                                                        <div class="mb-3">
                                                            <img class="img-thumbnail" width="70"
                                                                src="{{ asset('assets/frontend/images/logos/' . $favicon['favicon']) }}"
                                                                alt="no-image">
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div>
                                                <button class="btn btn-primary" name="update_fav_logo" value="true"
                                                    type="submit">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="contacts" role="tabpanel">
                                <div class="tab-pane active" id="social" role="tabpanel">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <strong> CONTACT INFORMATION </strong>
                                                </div>
                                            </div>
                                            @csrf
                                            <div class="row mt-5">
                                                <form class="needs-validation mt-3" method="POST"
                                                    action="{{ route('contactInfo.process') }}"
                                                    enctype="multipart/form-data" novalidate>
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="email1"> Email 1 ( <strong> Contact form
                                                                        Email </strong> ) </label>
                                                                <input type="email" name="email1" class="form-control"
                                                                    value="{{ $contact->email1 ?? '' }}"
                                                                    placeholder="Enter Email 1" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="email1"> Email 2 ( <strong> Contact form
                                                                        Email </strong> ) </label>
                                                                <input type="email" name="email2" class="form-control"
                                                                    placeholder="Enter Email 1"
                                                                    value="{{ $contact->email2 ?? '' }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="number"> Number 1 </label>
                                                                <input type="text" name="number1" class="form-control"
                                                                    placeholder="Enter Number"
                                                                    value="{{ $contact->number1 ?? '' }}" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="number"> Number 2 </label>
                                                                <input type="text" name="number2" class="form-control"
                                                                    placeholder="Enter Number"
                                                                    value="{{ $contact->number2 ?? '' }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="email"> Email <strong> ( Contact us Queries
                                                                        Received on this email ) </strong> </label>
                                                                <input type="email" name="contact_us_queries_email"
                                                                    class="form-control" placeholder="Enter Email"
                                                                    value="{{ $contact->contact_us_queries_email ?? '' }}"
                                                                    required />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="whatsapp"> Whatsapp </label>
                                                                <input type="text" name="whatsapp"
                                                                    class="form-control" placeholder="Enter Number"
                                                                    value="{{ $contact->whatsapp ?? '' }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="address"> Address </label>
                                                                <textarea class="form-control" name="address" id="address" cols="30" rows="3" required>{{ $contact->address ?? '' }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="desc"> Description </label>
                                                                <textarea class="form-control" name="desc" id="desc" cols="30" rows="3">{{ $contact->desc ?? '' }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3">
                                                        <button class="btn btn-primary" name="contactInfo" value="true"
                                                            type="submit">Submit</button>
                                                    </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="tab-pane" id="classLocation" role="tabpanel">
                                <div class="tab-pane active" id="classLocation" role="tabpanel">
                                    <div class="card">
                                        <div class="card-body">
                                            @csrf
                                            <div class="row">
                                                <form class="needs-validation mt-3" method="POST"
                                                    action="{{ route('class.location.process') }}"
                                                    enctype="multipart/form-data" novalidate>
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="classLocation"> ( <strong> Add Class Location </strong> ) </label>
                                                                <input type="text" name="classLocation" class="form-control"
                                                                    value="{{ @$classLocation->classLocation ?? '' }}"
                                                                    placeholder="Enter Class Location" required />
                                                            </div>
                                                        </div>
                                                        <div class="mt-3">
                                                            <button class="btn btn-primary" type="submit">Submit</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/backend/libs/parsleyjs/parsley.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/pages/form-validation.init.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@endpush
