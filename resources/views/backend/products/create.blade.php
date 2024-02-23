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
                        <h4 class="mb-sm-0 font-size-18"> {{ __($page_title ?? '-') }} </h4>
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
                <form class="needs-validation" method="POST" action="{{ route('product.store') }}"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">PRODUCT BASICS</div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="pname" class="form-label"> Product Name <i class="text-danger">*</i></label>
                                                <input type="text" class="form-control" onkeyup="myFunction()"
                                                    name="pname" id="pname" placeholder="Product name"
                                                    value="{{ old('pname') }}" required />
                                                <div class="invalid-feedback">
                                                    Please enter product name.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="slug" class="form-label"> Slug <i class="text-danger">*</i></label>
                                                <input placeholder="slug here" class="form-control" type="text"
                                                    name="slug" id="slug" value="{{ old('slug') }}" required />
                                                <div class="invalid-feedback">
                                                    Please select Slug
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="category" class="form-label"> Category <i class="text-danger">*</i></label>
                                                <select name="category" id="category" class="form-select select2" required>
                                                    <option value=""> Select Category </option>
                                                    @forelse ($categories as $cat)
                                                        <option value="{{ $cat->id }}"
                                                            {{ old('category') == $cat->id ? 'selected' : '' }}>
                                                            {{ $cat->title }} </option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select category
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="brand" class="form-label"> Brands <i class="text-danger">*</i></label>
                                                <select name="brand" id="brand" class="form-select select2" required>
                                                    <option value=""> Select Brand </option>
                                                    @forelse ($brands as $brand)
                                                        <option value="{{ $brand->id }}"
                                                            {{ old('brand') == $brand->id ? 'selected' : '' }}>
                                                            {{ $brand->name ?? '' }}
                                                        </option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select brand
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="product_type" class="form-label">Product Type </label>
                                                <select name="product_type" id="product_type" class="form-select select2"
                                                    onchange="toggleProductType(this.value)" required>
                                                    <option value="simple"
                                                        {{ old('product_type') == 'simple' ? 'selected' : 'selected' }}>
                                                        Simple Product</option>
                                                    <option value="variation"
                                                        {{ old('product_type') == 'variation' ? 'selected' : '' }}>
                                                        Variable Product</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select product type
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row simple-product">
                                        <div class="col-lg-3 mb-3">
                                            <div class="form-group">
                                                <label for="price" class="control-label">Price <i class="text-danger">*</i></label>
                                                <input type="text" class="form-control input-mask text-start"
                                                    name="price" id="price" value="{{ old('price') }}"
                                                    placeholder="Price"
                                                    data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'placeholder': '0'"
                                                    required />
                                                <div class="invalid-feedback">
                                                    Please enter valid price
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="quantity" class="form-label">Quantity <i class="text-danger qty-required">*</i></label>
                                                <input type="number" class="form-control" name="quantity" id="quantity"
                                                    placeholder="Quantity" value="{{ old('quantity') }}" min="0"
                                                    required />
                                                <div class="invalid-feedback">
                                                    Please enter Quantity.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="stock_alert_quantity" class="form-label">Stock Alert
                                                    Quantity <i class="text-danger qty-required">*</i></label>
                                                <input type="number" class="form-control" name="stock_alert_quantity"
                                                    id="stock_alert_quantity" placeholder="Stock Alert Quantity"
                                                    value="{{ old('stock_alert_quantity') }}" min="0" required />
                                                <div class="invalid-feedback">
                                                    Please enter Stock Alert Quantity.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="sku" class="form-label">SKU <i class="text-danger">*</i></label>
                                                <input type="text" class="form-control" name="sku" id="sku"
                                                    placeholder="product sku" value="{{ old('sku') }}" required />
                                                <div class="invalid-feedback">
                                                    Please enter product sku.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 product-discount">

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end card -->
                            {{-- <div class="card">
                                <div class="card-body">
                                    <div class="card-title">RELATED PRODUCTS</div>
                                    <hr />
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="related_products" class="form-label">Select Related Products</label>
                                            <input type="text" class="form-control" name="related_products" id="related_products"
                                                placeholder="Related Products" value="{{ old('related_products') }}" required />
                                            <div class="invalid-feedback">
                                                Please select related products.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <!-- end card -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        PRODUCT DESCRIPTION
                                        <hr />
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="short_description" class="form-label">Short
                                                    Description</label>
                                                <textarea class="form-control" name="short_description" id="short_description"
                                                    placeholder="Product Short Description">{{ old('short_description') }}</textarea>
                                                <div class="invalid-feedback">
                                                    Please enter product short description
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea class="form-control" name="description" id="description" placeholder="Product Description">{{ old('description') }}</textarea>
                                                <div class="invalid-feedback">
                                                    Please enter product description
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        SEO DATA
                                        <hr />
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label for="meta_title" class="form-label">Meta Title</label>
                                                        <input type="text" class="form-control" name="meta_title"
                                                            id="meta_title" placeholder="Meta Title here"
                                                            value="{{ old('meta_title') }}">
                                                        <div class="invalid-feedback">
                                                            Please enter valid meta title.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label for="meta_keywords" class="form-label">Meta
                                                            Keywords</label>
                                                        <input type="text" class="form-control" name="meta_keywords"
                                                            id="meta_keywords" value="{{ old('meta_keywords') }}"
                                                            placeholder="Meta Keywords" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="meta_description" class="form-label">Meta Description</label>
                                                <textarea class="form-control" name="meta_description" id="meta_description" cols="30" rows="5"
                                                    placeholder="Meta Description">{{ old('meta_description') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label for="post image" class="form-label">Featured Image </label>
                                                <input type="file" class="form-control" id="product_image"
                                                    name="product_image" />
                                                <div class="invalid-feedback">
                                                    Please upload valid image
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        checked name="is_active" id="is_active"
                                                        {{ old('is_active') == 1 ? 'checked' : '' }} />
                                                    <label class="form-check-label" for="is_active">Is
                                                        Active?</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 onsale">
                                            <div class="mb-3">
                                                <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                                    <input class="form-check-input" type="checkbox" value="yes"
                                                        name="on_sale" id="on_sale" onchange="toggleOnSale(this)"
                                                        {{ old('on_sale') == 'yes' ? 'checked' : '' }} />
                                                    <label class="form-check-label" for="on_sale">On
                                                        Sale?</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        name="is_featured" id="is_featured"
                                                        {{ old('is_featured') == 1 ? 'checked' : '' }} />
                                                    <label class="form-check-label" for="is_featured">Is Featured?</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 instore">
                                            <div class="mb-3">
                                                <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        name="in_store" id="in_store" onchange="checkInStore(this)"
                                                        {{ old('in_store') == 1 ? 'checked' : '' }} />
                                                    <label class="form-check-label" for="in_store">In
                                                        Store?</label>
                                                    <br />
                                                    <small class="text-primary">If you will check this option then Quantity
                                                        will be disabled.</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button class="btn btn-primary btn-sm" type="submit"> ADD PRODUCT </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/backend/libs/parsleyjs/parsley.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/pages/form-validation.init.js') }}"></script>
    <script src="{{ asset('assets/backend/libs/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/pages/form-mask.init.js') }}"></script>
    <script src="{!! url('assets/backend/tinymce/tinymce.min.js') !!}"></script>
    <script>
        tinymce.init({
            selector: 'textarea#description',
            height: 350
        });

        function myFunction() {
            var a = document.getElementById("pname").value;
            var b = a.toLowerCase().replace(/ /g, '-')
                .replace(/[^\w-]+/g, '');
            document.getElementById("slug").value = b;
        }

        function checkInStore(id) {
            if (id.checked == true) {
                $('#stock_alert_quantity').removeAttr('required');
                $('#quantity').removeAttr('required');
                $('.qty-required').html('');
                $('#stock_alert_quantity').val('');
                $('#quantity').val('');
            } else {
                $('#stock_alert_quantity').attr('required', 'required');
                $('#quantity').attr('required', 'required');
                $('.qty-required').html('*');
                $('#stock_alert_quantity').val('');
                $('#quantity').val('');
            }
        }

        function toggleProductType(ptype) {
            if (ptype == "simple") {
                $('.simple-product').load(route('product.get.simple.product.fields'));
                $('.onsale').removeClass('d-none');
                $('.instore').removeClass('d-none');
                $('#on_sale').prop('checked', false);
                $('#in_store').addClass('checked', false);
            } else if (ptype == "variation") {
                $('.simple-product').html('');
                $('.onsale').addClass('d-none');
                $('.instore').addClass('d-none');
                $('#on_sale').prop('checked', false);
                $('#in_store').addClass('checked', false);
            } else {
                $('.simple-product').html('Something went wrong, please try again!');
            }
        }

        function toggleOnSale(id) {
            if (id.checked == true) {
                $('.product-discount').load(route('product.get.product.discount.fields'));
            } else {
                $('.product-discount').html('');
            }
        }
    </script>
@endpush
