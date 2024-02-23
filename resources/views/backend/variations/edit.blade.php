@extends('layouts.backend.master')
@section('title')
    {{ __($page_title ?? '-') }}
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('/assets/backend/datatables/jquery.dataTables.min.css') }}">
    <style>
        .avatar-sm {
            width: auto !important;
        }
    </style>
@endpush
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
                <form class="needs-validation" method="POST"
                    action="{{ route('product.variation.update', $variation->id) }}" enctype="multipart/form-data"
                    novalidate>
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Brand</th>
                                                        <th>Is Active</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>{{ $variation->products->name ?? '' }}</td>
                                                        <td>{{ $variation->products->brand->name ?? '' }}</td>
                                                        <td>{{ $variation->products->is_active == 1 ? 'Yes' : '' }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">VARIATION BASICS</div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="pname" class="form-label"> Product Name <i
                                                        class="text-danger">*</i></label>
                                                <input type="text" class="form-control" onkeyup="myFunction()"
                                                    name="pname" id="pname" placeholder="Product name"
                                                    value="{{ old('pname', $variation->name) }}" required />
                                                <div class="invalid-feedback">
                                                    Please enter product name.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="slug" class="form-label"> Slug <i
                                                        class="text-danger">*</i></label>
                                                <input placeholder="slug here" class="form-control" type="text"
                                                    name="slug" id="slug"
                                                    value="{{ old('slug', $variation->slug) }}" required />
                                                <div class="invalid-feedback">
                                                    Please select Slug
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 mb-3">
                                            <div class="form-group">
                                                <label for="price" class="control-label">Price <i
                                                        class="text-danger">*</i></label>
                                                <input type="text" class="form-control input-mask text-start"
                                                    name="price" id="price"
                                                    value="{{ old('price', $variation->price) }}" placeholder="Price"
                                                    data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'placeholder': '0'"
                                                    required />
                                                <div class="invalid-feedback">
                                                    Please enter valid price
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="quantity" class="form-label">Quantity <i
                                                        class="text-danger qty-required">*</i></label>
                                                <input type="number" class="form-control" name="quantity" id="quantity"
                                                    placeholder="Quantity"
                                                    value="{{ old('quantity', $variation->quantity) }}" min="0"
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
                                                    value="{{ old('stock_alert_quantity', $variation->stock_alert_quantity) }}"
                                                    min="0" required />
                                                <div class="invalid-feedback">
                                                    Please enter Stock Alert Quantity.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="sku" class="form-label">SKU <i
                                                        class="text-danger">*</i></label>
                                                <input type="text" class="form-control" name="sku" id="sku"
                                                    placeholder="product sku" value="{{ old('sku', $variation->sku) }}"
                                                    required />
                                                <div class="invalid-feedback">
                                                    Please enter product sku.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 product-discount">
                                            @if ($variation->is_onsale == 1)
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="discount_type" class="form-label">Discount Type
                                                            </label>
                                                            <select name="discount_type" id="discount_type"
                                                                class="form-select select2" required>
                                                                <option value="" selected>Select Discount Type
                                                                </option>
                                                                <option value="fixed"
                                                                    {{ $variation->discount_type == 'fixed' ? 'selected' : '' }}>
                                                                    Fixed</option>
                                                                <option value="percent"
                                                                    {{ $variation->discount_type == 'percent' ? 'selected' : '' }}>
                                                                    Percent %</option>
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                Please select discount type
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 mb-3">
                                                        <div class="form-group">
                                                            <label for="discount_amount" class="control-label">Discount (
                                                                % |
                                                                $)</label>
                                                            <input type="text"
                                                                class="form-control input-mask text-start"
                                                                name="discount_amount" id="discount_amount"
                                                                value="{{ old('discount_amount', $variation->discount_amount) }}"
                                                                placeholder="Discount % | $"
                                                                data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'placeholder': '0'"
                                                                required />
                                                            <div class="invalid-feedback">
                                                                Please enter valid discount amount
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        PRODUCT DESCRIPTION
                                        <hr />
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea class="form-control" name="description" id="description" placeholder="Product Description">{!! old('description', json_decode($variation->description)) !!}</textarea>
                                                <div class="invalid-feedback">
                                                    Please enter product description
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- end card -->
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
                                                            value="{{ old('meta_title', json_decode($variation->seodata)->meta_title) }}">
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
                                                            id="meta_keywords"
                                                            value="{{ old('meta_keywords', json_decode($variation->seodata)->meta_keywords) }}"
                                                            placeholder="Meta Keywords" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="meta_description" class="form-label">Meta Description</label>
                                                <textarea class="form-control" name="meta_description" id="meta_description" cols="30" rows="5"
                                                    placeholder="Meta Description">{{ old('meta_description', json_decode($variation->seodata)->meta_description) }}</textarea>
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
                                        <div class="col-sm-12 text-center">
                                            <div class="mb-3">
                                                <label class="form-label">Current Image</label>
                                                <img src="{{ asset('assets/frontend/images/variations/' . Str::of($variation->thumbnail)->replace(' ', '%20')) }}"
                                                    class="form-control img-thumbnail"
                                                    style="display:inline-block; width:auto;" alt="">
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
                                                        {{ old('on_sale') == 'yes' ? 'checked' : '' }}
                                                        {{ $variation->is_onsale == 1 ? 'checked' : '' }} />
                                                    <label class="form-check-label" for="on_sale">On
                                                        Sale?</label>
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
                        <div class="col-lg-12 mb-3">
                            <button class="btn btn-primary btn-sm" type="submit"> UPDATE VARIATION</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-lg-12" id="variationListMessages">
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body table-scroll">
                            <div class="card-title">LIST OF VARIATIONS</div>
                            <hr />
                            <table class="table table-bordered data-table wrap" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th style="width: 20%;">Price</th>
                                        <th>Quantity</th>
                                        <th>SKU</th>
                                        <th>Added By</th>
                                        <th>Updated By</th>
                                        <th>Status(is active?)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
    <script src="{{ asset('/assets/backend/datatables/jquery.dataTables.min.js') }}"></script>
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

        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    type: 'POST',
                    url: route('product.variation.index'),
                    data: {
                        id: {{ $variation->products->id }}
                    }
                },
                columns: [{
                    data: 'id',
                    name: 'id'
                }, {
                    data: 'image',
                    name: 'image'
                }, {
                    data: 'name',
                    name: 'name'
                }, {
                    data: 'price',
                    name: 'price'
                }, {
                    data: 'quantity',
                    name: 'quantity'
                }, {
                    data: 'sku',
                    name: 'sku'
                }, {
                    data: 'added',
                    name: 'added'
                }, {
                    data: 'updated',
                    name: 'updated'
                }, {
                    data: 'is_active',
                    name: 'is_active'
                }, {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }],
                responsive: true,
                'createdRow': function(row, data, dataIndex) {
                    $(row).attr('id', data.id);
                },
                "order": [
                    [0, "desc"]
                ],
                "bDestroy": true,
            });
        });

        $(document).ready(function() {
            let instore = "{{ $variation->in_store }}";
            if (instore == 1) {
                $('#in_store').trigger('click');
            }
        });

        $(document).on('click', '.status', function() {
            var id = $(this).attr('data-id');
            var is_active = $(this).val();
            $.ajax({
                type: 'POST',
                url: route('product.variation.update.status'),
                data: {
                    id: id,
                    is_active: is_active
                },
                success: function(data) {

                    var result = JSON.parse(data);
                    var type = result.type;

                    if (is_active == 1) {
                        $('.status#switch' + id).attr('value', 0);
                    } else {
                        $('.status#switch' + id).attr('value', 1);
                    }
                    $('#variationListMessages').html('<div class="alert alert-' + result.type +
                        ' alert-dismissible fade show" role="alert"><i class="mdi ' + result.icon +
                        ' me-2"></i>' + result.message +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>'
                    );
                }
            });
        });
    </script>
@endpush
