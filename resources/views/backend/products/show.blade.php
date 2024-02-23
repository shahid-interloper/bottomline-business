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
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped">
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $product->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>Weight</th>
                                    <td>{{ $product->weight ?? '' }} Kg.</td>
                                </tr>
                                <tr>
                                    <th>Color</th>
                                    <td>
                                        <h1 style="background-color:{{ $product->color }}; padding:20px; width: 100px;">
                                        </h1>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Dimensions (Cm.)</th>
                                    <td>
                                        @if (!empty($product->dimensions))
                                            @foreach (json_decode($product->dimensions) as $index => $dimen)
                                                {{ Str::ucfirst($index) . ' : ' . $dimen ?? '-' }} <br />
                                            @endforeach
                                        @else
                                            <p> N\A </p>
                                        @endif

                                    </td>
                                </tr>
                                <tr>
                                    <th>Sale Price </th>
                                    <td>${{ $product->sale_price ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>Retail Price </th>
                                    <td>${{ $product->retail_price ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>Shipping Charges</th>
                                    <td>${{ $product->shipping_charges ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>Quantity</th>
                                    <td>{{ $product->quantity ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>Stock Alert Quantity</th>
                                    <td>{{ $product->stock_alert_quantity ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>In Store? </th>
                                    <td>{{ $product->in_store == 1 ? 'Yes' : 'No' }}</td>
                                </tr>
                                <tr>
                                    <th>SKU</th>
                                    <td>{{ $product->sku ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{!! $product->description ?? '' !!}</td>
                                </tr>
                                <tr>
                                    <th colspan="2">SEO Data
                                        <hr />
                                    </th>
                                    <td>
                                        @foreach (json_decode($product->seodata) as $ind => $data)
                                <tr>
                                    <th>{{ Str::ucfirst(Str::replace('_', ' ', @$ind)) }}</th>
                                    <td>{{ $data ?? '-' }}</td>
                                </tr>
                                @endforeach
                                </td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{!! $product->added_by
                                        ? date('d-M-Y', strtotime($product->created_at)) .
                                            '<br />By: <span class="text-primary">' .
                                            $product->addedBy->first()->first_name .
                                            ' ' .
                                            $product->addedBy->first()->last_name .
                                            '</span>'
                                        : '' !!}</td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td>
                                        {{ isset($row->updated_by) ? date('d-M-Y', strtotime($row->updated_at)) . '<br /> By: <span class="text-primary">' . $row->updatedBy->first()->first_name . ' ' . $row->updatedBy->first()->last_name . '</span>' : '-' }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped">
                                <tr>
                                    <th colspan="2" class="text-center">Product Image</th>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center">
                                        <?php
                                        $imageName = Str::of($product->image)->replace(' ', '%20');
                                        if ($product->image) {
                                            $image = '<img src=' . asset('assets/frontend/images/products/' . $imageName) . ' class="avatar-xl" />';
                                        } else {
                                            $image = '<img src=' . asset('assets/backend/images/no-image.jpg') . ' class="avatar-xl" />';
                                        }
                                        echo $image;
                                        ?>
                                    </td>
                                </tr>
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
