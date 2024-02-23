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
                <form class="needs-validation" method="POST" action="{{ route('users.update', $user->id) }}"
                    enctype="multipart/form-data" novalidate>
                    <div class="row">
                        @csrf
                        @method('PUT')


                        <div class="col-sm-9">
                            <div class="card">
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label for="page" class="form-label">Roles</label>
                                        <select class="form-select select2" data-placeholder="Choose Roles" multiple id="role"
                                            name="roles[]" required focus>
                                            @forelse ($roles as $role)
                                                <option value="{{ $role }}"
                                                    @if (in_array($role, $userRole)) {{ 'selected' }} @endif>
                                                    {{ $role }}</option>
                                            @empty
                                                <option disabled value="">No Role Found!</option>
                                            @endforelse
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select role.
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">First Name</label>
                                                <input type="text" class="form-control" name="first_name" id="first_name"
                                                    placeholder="First Name"
                                                    value="{{ old('first_name', $user->first_name) }}" required
                                                    onkeyup="myFunction();" />
                                                <div class="invalid-feedback">
                                                    Please enter valid name.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="last name" class="form-label">Last name</label>
                                                <input type="text" class="form-control" name="last_name" id="last_name"
                                                    placeholder="last Name"
                                                    value="{{ old('last_name', $user->last_name) }}" required>
                                                <div class="invalid-feedback">
                                                    Please enter valid slug.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="Email" class="form-label">Email</label>
                                                <input type="email" class="form-control" name="email" id="email"
                                                    placeholder="Email Here" value="{{ old('email', $user->email) }}"
                                                    required>
                                                <div class="invalid-feedback">
                                                    Please enter valid email.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="Phone" class="form-label">Phone</label>
                                                <input type="number" class="form-control" name="phone" id="phone"
                                                    placeholder="Phone Here" value="{{ old('phone', $user->phone) }}"
                                                    required>
                                                <div class="invalid-feedback">
                                                    Please enter valid phone.
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
                                        <div class="col-lg-12 mb-3">
                                            <div class="form-group">
                                                <label for="image" class="control-label">User image</label>
                                                <input type="file" class="form-control" name="image"
                                                    id="image" />
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label">Current Image</label>
                                                @if (isset($user->image))
                                                    <img src="{{ asset('assets/frontend/images/users/' . $user->image) }}"
                                                        class="form-control img-thumbnail" alt="">
                                                @else
                                                    <br />
                                                    <img class="img-thumbnail" width="100%"
                                                        src="{{ asset('assets/backend/images/no-image.jpg') }}"
                                                        class="form-control img-thumbnail" alt="no-image">
                                                @endif
                                            </div>

                                        </div>


                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-12 mb-5">
                                <button type="submit" class="btn btn-primary">UPDATE USER</button>
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
@endpush
