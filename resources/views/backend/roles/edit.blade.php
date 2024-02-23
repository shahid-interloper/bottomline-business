@extends('layouts.backend.master')
@section('title')
    {{ __($page_title ?? '-') }}
@endsection
@section('styles')
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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('Roles') }}</a></li>
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
                <form class="needs-validation" method="POST" action="{{ route('roles.update', $role->id) }}"
                    enctype="multipart/form-data" novalidate>
                    <div class="row">
                        @csrf
                        @method('PUT')
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Role Name</label>
                                                <input type="text" class="form-control" readonly placeholder="Name here"
                                                    value="{{ $role->name }}" required>
                                                <div class="invalid-feedback">
                                                    Please enter valid name.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            @forelse($permissions as $permission)
                                            <div class="col-sm-3">
                                                    <div class="form-check form-check-primary mb-2">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="permission_id{{ $permission->id }}" name="permissions[]"
                                                            value="{{ $permission->id }}"
                                                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                                        <label class="form-check-label"
                                                            for="permission_id{{ $permission->id }}">{{ $permission->name }}</label>
                                                    </div>
                                                </div>
                                            @empty
                                                {{ 'No Permissions Found!' }}
                                            @endforelse

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card -->
                        </div> <!-- end col -->
                        <div class="col-sm-12 mb-5">
                            <button type="submit" class="btn btn-primary">UPDATE ROLE</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/backend/libs/parsleyjs/parsley.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/pages/form-validation.init.js') }}"></script>
@endsection
