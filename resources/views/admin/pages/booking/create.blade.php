@extends('admin.layouts.master')

@section('title') booking create @endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/assets/admin/pages/booking/style.css')}}" rel="stylesheet" type="text/css" >
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Create @endslot
        @slot('title') Booking Management @endslot
    @endcomponent
    <div class="content-wrapper">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <form class="custom-validation" action="" id="custom-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                @include('admin.pages.booking.seatmap')
                            </div>
                            <div class="col-md-6">
                                <div class="right-setting">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Booking Number</label>
                                                <input type="text" class="form-control"  readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Seat Number</label>
                                                <input type="text" class="form-control" name="seat_no[]" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Customer Full Name</label>
                                                <input type="text" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Customer Phone</label>
                                                <input type="text" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Select Payment Status</label>
                                                <select class="form-control">
                                                    <option value="1">Paid</option>
                                                    <option value="2">Unpaid</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Total Cost</label>
                                                <input type="text" class="form-control" name="total_price" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Booking Date</label>
                                                <div class="input-group" id="datepicker2">
                                                    <input type="text" class="form-control" placeholder="yyyy-mm-dd"
                                                        data-date-format="yyyy-mm-dd" data-date-container='#datepicker2'
                                                        data-provide="datepicker" data-date-autoclose="true" required>
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Seat Type</label>
                                                <input type="text" class="form-control"  readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Customer Email</label>
                                                <input type="email" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Number of Guests</label>
                                                <input type="number" class="form-control" name="guest" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Payment Method</label>
                                                <select class="form-control">
                                                    <option value="1">Skrill</option>
                                                    <option value="2">Payout</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 text-end">
                                            <button type="submite" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>    
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/datepicker/datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>
    <!-- form advanced init -->
    <script src="{{ URL::asset('/assets/js/pages/form-advanced.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/admin/pages/booking/index.js') }}"></script>
@endsection