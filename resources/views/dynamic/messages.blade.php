@if (Session::has('message'))
    <div class="row">
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
    </div>
@endif
@if ($errors->any())
    <div class="row">
        <div class="col-sm-12">
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-block-helper me-2"></i>
                    {{ __($error) }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endforeach
        </div>
    </div>
@endif
