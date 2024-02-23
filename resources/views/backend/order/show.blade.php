@extends('layouts.backend.master')
@section('title')
    {{ __('Order No# ' . $order->order_number . "'s Detail") }}
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('/assets/backend/datatables/jquery.dataTables.min.css') }}">
    <style>
        @media print {
            .invoice {
                font-size: 11px !important;
                overflow: hidden !important;
            }

            .invoice footer {
                position: absolute;
                bottom: 10px;
                page-break-after: always;
            }

            .invoice>div:last-child {
                page-break-before: always;
            }

            .nav-tabs,
            .order-detail-buttons,
            .message,
            .card-title,
            .card-title-desc,
            .action-buttons,
            .hidden-print {
                display: none !important;
            }
        }

        .ui-datepicker-inline.ui-datepicker.ui-widget.ui-widget-content.ui-helper-clearfix.ui-corner-all {
            width: 100%;
            margin-bottom: 13% !important;
        }

        table.ui-datepicker-calendar {
            border-collapse: separate;
        }

        .ui-datepicker-calendar td {
            border: 1px solid transparent;
        }

        .ui-datepicker .ui-datepicker-calendar .ui-state-highlight a {
            background: #743620 none;
            color: white;
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
                        <h4 class="mb-sm-0 font-size-18">{{ __('Order Detail') }}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('Orders') }}</a></li>
                                <li class="breadcrumb-item active">{{ __('Order Detail') }}</li>
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
                            @endif {{ __(Session::get('message')) }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif @if ($errors->any())
                        <div class="col-sm-12">
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="mdi mdi-block-helper me-2"></i> {{ __($error) }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <div class="col-sm-12 message"></div>
                    <div class="col-sm-12 mb-2 action-buttons">
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-primary">ALL ORDERS</a>
                    </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-10">
                                    <h4 class="card-title">{{ __('Order No# ' . $order->order_number . "'s Detail") }}
                                        &nbsp;
                                        @if (Auth::user()->role == 'customer' && $order->order_status[0]->title == 'new')
                                            <button title="ORDER STATUS"
                                                class="btn btn-sm btn-info pt-0 pb-0">{{ Str::of('Pending')->upper() }}</button>
                                        @else
                                            <button title="ORDER STATUS"
                                                class="btn btn-sm btn-info pt-0 pb-0">{{ @Str::of($order->order_status[0]->title)->upper() }}</button>
                                        @endif
                                    </h4>
                                    <p class="card-title-desc" style="color: #4928ff;">Payment via
                                        {{ Str::of($order->payment_method)->upper() . ' on ' . \Carbon\Carbon::parse($order->created_at)->format('M d, Y') . ' @ ' . \Carbon\Carbon::parse($order->created_at)->format('h:i A') . '. Customer: ' . json_decode(@$order->customer_details)->first_name . ' ' . json_decode($order->customer_details)->last_name ?? '' }}
                                    </p>
                                </div>
                                <div class="col-sm-2 text-end">
                                    @if (auth()->user()->role == 'customer' && $order->order_status[0]->title == 'new')
                                        <a href="javascript:void(0);" class="btn btn-danger btn-sm cancell-order"
                                            data-ordernumber="{{ $order->order_number }}">CANCELL ORDER</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link btn btn-outline-light active" data-bs-toggle="tab" href="#details"
                                        role="tab">
                                        <span class="d-block d-sm-none">DETAILS</span>
                                        <span class="d-none d-sm-block">DETAILS</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link btn btn-outline-light" data-bs-toggle="tab" href="#items"
                                        role="tab">
                                        <span class="d-block d-sm-none">ITEMS</span>
                                        <span class="d-none d-sm-block">ITEMS</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link btn btn-outline-light" data-bs-toggle="tab" href="#reciept"
                                        role="tab">
                                        <span class="d-block d-sm-none">RECIEPT</span>
                                        <span class="d-none d-sm-block">RECIEPT</span>
                                    </a>
                                </li>

                                @if (auth()->check() && (Auth::user()->roles->pluck('role_type')->toArray()[0] == 'Admin'))
                                    <li class="nav-item">
                                        <a class="nav-link btn btn-outline-light" data-bs-toggle="tab" href="#order_status"
                                            role="tab">
                                            <span class="d-block d-sm-none">ORDER STATUS</span>
                                            <span class="d-none d-sm-block">ORDER STATUS</span>
                                        </a>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a class="nav-link btn btn-outline-light" data-bs-toggle="tab" href="#order_history"
                                        role="tab">
                                        <span class="d-block d-sm-none">ORDER HISTORY</span>
                                        <span class="d-none d-sm-block">ORDER HISTORY</span>
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content p-3 mt-2 text-muted">
                                <div class="tab-pane active" id="details" role="tabpanel">
                                    <div id="gen-ques-accordion-1" class="accordion custom-accordion">
                                        <div class="mb-3">
                                            <a href="#general-collapseOne" class="accordion-list" data-bs-toggle="collapse"
                                                aria-expanded="true" aria-controls="general-collapseOne">
                                                <div>{{ __('GENERAL DETAILS') }}</div>
                                                <i class="mdi mdi-minus accor-plus-icon"></i>
                                            </a>
                                            <div id="general-collapseOne" class="collapse show"
                                                data-bs-parent="#gen-ques-accordion-1">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped mb-0 wrap">
                                                            <tbody>
                                                                <tr>
                                                                    <th>PAYMENT METHOD: </th>
                                                                    <td>{{ Str::of($order->payment_method)->upper() }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>PAYMENT STATUS: </th>
                                                                    <td>{{ Str::of($order->payment_status)->upper() }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>SUB TOTAL: </th>
                                                                    <td>${{ number_format($order->sub_total, 2) }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>SHIPPING CHARGES: </th>
                                                                    <td>&minus;
                                                                        ${{ number_format($order->shipping_charges, 2) }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>GRAND TOTAL: </th>
                                                                    <td><strong>${{ number_format($order->total, 2) }}</strong>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="customerDetailP" class="accordion custom-accordion">
                                        <div class="mb-3">
                                            <a href="#customerDetail" class="accordion-list collapsed"
                                                data-bs-toggle="collapse" aria-expanded="false"
                                                aria-controls="general-collapseTwo">
                                                <div>{{ __('CUSTOMER DETAILS') }}</div>
                                                <i class="mdi mdi-minus accor-plus-icon"></i>
                                            </a>
                                            <div id="customerDetail" class="collapse" data-bs-parent="#customerDetailP">
                                                <div class="card-body table-responsive">
                                                    <table class="table table-striped mb-0 wrap">
                                                        <tbody>
                                                            <?php $customer = json_decode($order->customer_details); ?>
                                                            <tr>
                                                                <th>FULL NAME :</th>
                                                                <td>{{ @$customer->first_name . ' ' . @$customer->last_name ?? '' }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>E-MAIL: </th>
                                                                <td><a
                                                                        href="mailto:{{ @$customer->email }}">{{ @$customer->email }}</a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="items" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table align-middle mb-0 table-nowrap">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col">Product</th>
                                                    <th scope="col">Product Desc</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($order->orderItems as $item)
                                                    <tr>
                                                        <th scope="row"><img src="{{ $item->image }}"
                                                                alt="product-img" title="product-img" class="avatar-md">
                                                        </th>
                                                        <td>
                                                            <h5 class="font-size-14 text-truncate"><a
                                                                    href="javascript:void(0);"
                                                                    class="text-dark">{{ __($item->name) }}</a></h5>
                                                            <p class="text-muted mb-0">
                                                                ${{ number_format($item->price, 2) }} x
                                                                {{ $item->quantity }} =
                                                                {{ number_format($item->price * $item->quantity, 2) }}
                                                                <br />
                                                                {{ $item->dates }}
                                                            </p>
                                                        </td>
                                                        <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                                                        @if (auth()->check() && auth()->user()->role == 'customer' && !in_array($order->status_id, [3, 6, 7]))
                                                            <td>
                                                                <a href="javascript:void(0);"
                                                                    data-itemid="{{ $item->id }}"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#quickViewModal"
                                                                    class="update-dates"><i
                                                                        class="fa fa-edit fa-2x text-danger"
                                                                        title="Add or Update Dates"></i></a>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3">No Item Found!</td>
                                                    </tr>
                                                @endforelse
                                                <tr>
                                                    <td colspan="2">
                                                        <h6 class="m-0 text-end">Sub Total:</h6>
                                                    </td>
                                                    <td>${{ number_format($order->sub_total, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <h6 class="m-0 text-end">Shipping Charges:</h6>
                                                    </td>
                                                    <td>${{ number_format($order->shipping_charges, 2) }}</td>
                                                </tr>

                                                <tr>
                                                    <td colspan="2">
                                                        <h6 class="m-0 text-end">Grand Total:</h6>
                                                    </td>
                                                    <td>${{ number_format($order->total, 2) }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="reciept" role="tabpanel">
                                    <div id="invoice">
                                        <div class="toolbar hidden-print" style="text-align: right;">
                                            <div style="padding-right: 1%;">
                                                <button id="printInvoice" onclick="Popup()" class="btn btn-danger"><i
                                                        class="fa fa-print"></i> Print</button>
                                            </div>
                                        </div>
                                        <div id="invoice" class="invoice overflow-auto"
                                            style="position: relative; background-color: #FFF; min-height: 680px; padding: 15px;">
                                            <div style="min-width: 600px">
                                                <header
                                                    style="padding: 10px 0; margin-bottom: 20px; border-bottom: 1px solid #3989c6;">
                                                    <div class="row row-format"
                                                        style="margin-right: auto; margin-left: auto;">
                                                        <div class="col border p-1" style="border: black solid 2px;">
                                                            <a href="javascript:void(0);">
                                                                <img src="{{ asset('assets/frontend/images/logos/reciept-logo.png') }}"
                                                                    data-holder-rendered="true" width="100" />
                                                            </a>
                                                            <div class="company-details">
                                                                <h6 class="name company-name"
                                                                    style="padding-top: 8px; margin-top: 0; margin-bottom: 0;">
                                                                    {{ config('app.name') }}</h6>
                                                                <div class="fonts-12" style="font-size: 12px;">Street 4,
                                                                    golden road new york</div>
                                                                <div class="fonts-12" style="font-size: 12px;">
                                                                    <strong>Tel:</strong> <a
                                                                        href="tel:123-456-7890">123-456-7890</a> <br>
                                                                    <strong>Email:</strong> <a
                                                                        href="mailto:info@example.com">info@example.com</a>
                                                                    <br> <strong>website:</strong><a
                                                                        href="http://www.example.com" target="_blank"
                                                                        rel="noopener noreferrer"> www.example.com</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col border company-details p-1"
                                                            style="border: black solid 2px;">
                                                            <h6 class="name" style="margin-top: 0; margin-bottom: 0;">
                                                                Shipping Address:</h6>
                                                            <div>
                                                                <?php $shipping = @json_decode($order->delivery_details); ?>
                                                                {{ @$shipping->address . ', State: ' . @$shipping->state . ', ' . @$shipping->city }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row row-format mt-1"
                                                        style="margin-right: auto; margin-left: auto;">
                                                        <div class="col border"
                                                            style="border: black solid 2px; padding:5px;">
                                                            <h6 class="name mb-0">Order No#</h6>
                                                            <div>{{ $order->order_number }}</div>
                                                        </div>
                                                        <div class="col border"
                                                            style="border: black solid 2px; padding:5px;">
                                                            <h6 class="name mb-0">Order Date</h6>
                                                            <div>{{ date('Y-m-d h:i:s A', strtotime($order->created_at)) }}
                                                            </div>
                                                        </div>
                                                        <div class="col border"
                                                            style="border: black solid 2px; padding:5px;">
                                                            <h6 class="name mb-0">Customer</h6>
                                                            <div>
                                                                {{ @json_decode($order->customer_details)->first_name . ' ' . json_decode($order->customer_details)->last_name }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </header>
                                                <main style="">
                                                    <table cellspacing="0" cellpadding="0"
                                                        style="width: 100%; border-collapse: collapse; border-spacing: 0; margin-bottom: 20px; border-color:#000;"
                                                        width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th
                                                                    style="padding: 3px; border: 1px solid #000; background: #eee; white-space: nowrap; font-weight: 400; font-size: 16px;">
                                                                    <strong>#</strong>
                                                                </th>
                                                                <th class="text-left"
                                                                    style="padding: 3px; border: 1px solid #000; background: #eee; white-space: nowrap; font-weight: 400; font-size: 16px;">
                                                                    <strong>ITEM</strong>
                                                                </th>
                                                                <th class="text-right"
                                                                    style="padding: 3px; border: 1px solid #000; background: #eee; white-space: nowrap; font-weight: 400; font-size: 16px;">
                                                                    <strong>PRICE</strong>
                                                                </th>
                                                                <th class="text-right"
                                                                    style="padding: 3px; border: 1px solid #000; background: #eee; white-space: nowrap; font-weight: 400; font-size: 16px;">
                                                                    <strong>QTY:</strong>
                                                                </th>
                                                                <th class="text-right"
                                                                    style="padding: 3px; border: 1px solid #000; background: #eee; white-space: nowrap; font-weight: 400; font-size: 16px;">
                                                                    <strong>Unit</strong>
                                                                </th>
                                                                <th class="text-right"
                                                                    style="padding: 3px; border: 1px solid #000; background: #eee; white-space: nowrap; font-weight: 400; font-size: 16px;">
                                                                    <strong>TOTAL</strong>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $counter = 1; ?>
                                                            @forelse($order->orderItems as $item)
                                                                <tr>
                                                                    <td class="no"
                                                                        style="padding: 3px; border: 1px solid #000; color: #000; font-size: 1.6em; background: #3989c6;">
                                                                        {{ $counter++ }}</td>
                                                                    <td class="text-left item-text-size"
                                                                        style="font-size: 1.2em; padding: 3px; background: #eee; border-bottom: 1px solid #000;">
                                                                        {{ $item->name }}</td>
                                                                    <td class="unit item-text-size"
                                                                        style="padding: 3px; border: 1px solid #000; text-align: right; font-size: 1.2em; background: #ddd;"
                                                                        align="right">
                                                                        ${{ number_format($item->price, 2) }}</td>
                                                                    <td class="qty item-text-size"
                                                                        style="padding: 3px; background: #eee; border: 1px solid #000; text-align: right; font-size: 1.2em;"
                                                                        align="right">x{{ $item->quantity }}</td>
                                                                    <td class="qty item-text-size"
                                                                        style="padding: 3px; background: #eee; border: 1px solid #000; text-align: right; font-size: 1.2em;"
                                                                        align="right">Item / Piece</td>
                                                                    <td class="total item-text-size"
                                                                        style="padding: 3px; border: 1px solid #000; text-align: right; font-size: 1.2em; background: #3989c6; color: #000;"
                                                                        align="right">
                                                                        ${{ number_format($item->total_amount, 2) }}</td>
                                                                </tr>
                                                            @empty
                                                            @endforelse
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="3"
                                                                    style="background: 0 0; border-bottom: none; white-space: nowrap; text-align: right; padding: 10px 20px; font-size: 1.2em; border-top: none; border: none;"
                                                                    align="right"></td>
                                                                <td colspan="2"
                                                                    style="background: 0 0; border-bottom: none; white-space: nowrap; text-align: right; padding: 10px 20px; font-size: 1.2em; border-top: none;"
                                                                    align="right">{{ __('SUBTOTAL') }}</td>
                                                                <td style="background: 0 0; border-bottom: none; white-space: nowrap; text-align: right; padding: 10px 20px; font-size: 1.2em; border-top: none;"
                                                                    align="right">
                                                                    ${{ number_format($order->sub_total, 2) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3"
                                                                    style="background: 0 0; border-bottom: none; white-space: nowrap; text-align: right; padding: 10px 20px; font-size: 1.2em; border-top: 1px solid #aaa; border: none;"
                                                                    align="right"></td>
                                                                <td colspan="2"
                                                                    style="background: 0 0; border-bottom: none; white-space: nowrap; text-align: right; padding: 10px 20px; font-size: 1.2em; border-top: 1px solid #aaa;"
                                                                    align="right">{{ __('DISCOUNT') }}</td>
                                                                <td style="background: 0 0; border-bottom: none; white-space: nowrap; text-align: right; padding: 10px 20px; font-size: 1.2em; border-top: 1px solid #aaa;"
                                                                    align="right">&minus;
                                                                    ${{ number_format(0, 2) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3"
                                                                    style="background: 0 0; border-bottom: none; white-space: nowrap; text-align: right; padding: 10px 20px; font-size: 1.2em; border-top: 1px solid #aaa; border: none;"
                                                                    align="right"></td>
                                                                <td colspan="2"
                                                                    style="background: 0 0; border-bottom: none; white-space: nowrap; text-align: right; padding: 10px 20px; font-size: 1.2em; border-top: 1px solid #aaa;"
                                                                    align="right">{{ __('DELIVERY CHARGES') }}</td>
                                                                <td style="background: 0 0; border-bottom: none; white-space: nowrap; text-align: right; padding: 10px 20px; font-size: 1.2em; border-top: 1px solid #aaa;"
                                                                    align="right">
                                                                    ${{ number_format($order->shipping_charges, 2) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3"
                                                                    style="background: 0 0; border-bottom: none; white-space: nowrap; text-align: right; padding: 10px 20px; color: #3989c6; font-size: 1.4em; border-top: 1px solid #3989c6; border: none;"
                                                                    align="right"></td>
                                                                <td colspan="2"
                                                                    style="background: 0 0; border-bottom: none; white-space: nowrap; text-align: right; padding: 10px 20px; color: #3989c6; font-size: 1.4em; border-top: 1px solid #3989c6;"
                                                                    align="right">{{ __('GRAND TOTAL') }}</td>
                                                                <td style="background: 0 0; border-bottom: none; white-space: nowrap; text-align: right; padding: 10px 20px; color: #3989c6; font-size: 1.4em; border-top: 1px solid #3989c6;"
                                                                    align="right">
                                                                    ${{ number_format($order->total, 2) }}
                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                    <div class="thanks"
                                                        style="margin-top: -100px; font-size: 2em; margin-bottom: 50px;">
                                                        {{ __('Thank you') }}!</div>
                                                    @if (isset($order->instructions))
                                                        <div class="notices"
                                                            style="padding-left: 6px; border-left: 6px solid #3989c6;">
                                                            <div>{{ __('ORDER INSTRUCTIONS') }}:</div>
                                                            <div class="notice" style="font-size: 1.2em;">
                                                                {{ __($order->instructions) }}</div>
                                                        </div>
                                                    @endif
                                                </main>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if (auth()->check() && (Auth::user()->roles->pluck('role_type')->toArray()[0] == 'Admin'))
                                    <div class="tab-pane" id="order_status" role="tabpanel">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4 class="card-title">{{ __('UPDATE ORDER STATUS') }}</h4>
                                                        <hr class="mt-1" />
                                                        <form id="updatePayment" class="needs-validation" method="POST"
                                                            action="{{ route('admin.order.update.status', $order->id) }}"
                                                            novalidate>
                                                            @csrf
                                                            <input type="hidden" name="order_id"
                                                                value="{{ $order->id }}" />
                                                            <div class="row">
                                                                <div class="col-sm-12 mb-3">
                                                                    <label class="form-label" for="order_status">Order
                                                                        Status</label>
                                                                    <select id="order_status" name="order_status"
                                                                        class="form-control" required>
                                                                        <option value="" selected disabled>Select
                                                                            Order
                                                                            Status</option>
                                                                        @forelse ($statuses as $status)
                                                                            <option value="{{ $status->id }}">
                                                                                {{ Str::of($status->title)->upper() }}
                                                                            </option>
                                                                        @empty
                                                                            <option value="" disabled>No Status
                                                                                Found!
                                                                            </option>
                                                                        @endforelse
                                                                    </select>
                                                                    <div class="invalid-feedback">Select Order Status</div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-12 mb-3">
                                                                    <label class="form-label"
                                                                        for="description">Description</label>
                                                                    <div>
                                                                        <textarea class="form-control" id="description" name="description" rows="3"
                                                                            placeholder="Enter description for user" required="required"></textarea>
                                                                        <div class="invalid-feedback">Enter Description
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <button id="updatePaymentBtn" class="btn btn-primary"
                                                                    type="submit">UPDATE STATUS</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6"></div>
                                        </div>
                                    </div>
                                @endif

                                <div class="tab-pane" id="order_history" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title">{{ __('ORDER HISTORY') }}</h4>
                                                    <hr class="mt-1" />
                                                    <div class="table-responsive">
                                                        <table style="width:100% !important;"
                                                            class="table table-bordered data-table wrap">
                                                            <thead>
                                                                <tr>
                                                                    <th>STATUS</th>
                                                                    <th>DESCRIPTION</th>
                                                                    <th>Created At</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
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
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('/assets/backend/datatables/jquery.dataTables.min.js') }}"></script>
    <script>
        $(function() {
            let id = "{{ $order->id }}";
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: route('admin.order.history', id),
                columns: [{
                    data: 'status',
                    name: 'status'
                }, {
                    data: 'description',
                    name: 'description'
                }, {
                    data: 'created',
                    name: 'created'
                }],
                responsive: true,
                'createdRow': function(row, data, dataIndex) {
                    $(row).attr('id', data.id);
                },
                "bDestroy": true,
            });
        });
        // $(document).find('#printInvoice').click(function() {

        // });

        function Popup() {
            var printContents = document.getElementById('invoice').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            return true;
        }
    </script>
    <script src="{{ asset('assets/backend/libs/parsleyjs/parsley.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/pages/form-validation.init.js') }}"></script>
    <!-- form mask -->
    <script src="{{ asset('assets/backend/libs/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
    <!-- form mask init -->
    <script src="{{ asset('assets/backend/js/pages/form-mask.init.js') }}"></script>
@endpush
