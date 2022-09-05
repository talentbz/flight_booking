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
                                        <div class="booking_no">
                                            <div class="row">
                                                <div class="mb-3 mt-4">
                                                    <h4>Booking Info</h4>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Booking Number</label>
                                                        <input type="text" class="form-control"  value="{{time()}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">AirLine</label>
                                                        <select class="form-select airline" name="air_line" required>
                                                            <option value="">Select</option>
                                                            @foreach($airline as $row)
                                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Booking Schedule</label>
                                                        <select class="form-select booking_schedule" name="" required>
                                                            <option value="">Select</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="trip_type">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Trip Type</label>
                                                        <select name="" class="form-select" required>
                                                            <option value="">Select</option>
                                                            <option value="1">Round Trip</option>
                                                            <option value="2">InRound</option>
                                                            <option value="3">OutRound</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="seat_section">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">InRound</label>
                                                        <a href="javascript:void(0)" class="start_seat_map">view seat map</a>
                                                        <input type="text" class="form-control" name="seat_no[]" readonly required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">OutRound</label>
                                                        <a href="javascript:void(0)">view seat map</a>
                                                        <input type="text" class="form-control" name="seat_no[]" readonly required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="customer_info">
                                            <div class="row">
                                                <div class="mb-3 mt-4">
                                                    <h4>Customer Info</h4>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Customer Email</label>
                                                        <input type="email" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Customer Phone</label>
                                                        <input type="text" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="payment_info">
                                            <div class="row">
                                                <div class="mb-3 mt-4">
                                                    <h4>Payment Info</h4>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Total Cost</label>
                                                        <input type="text" class="form-control" name="total_price" readonly="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Payment Method</label>
                                                        <select class="form-select">
                                                            <option value="1">Skrill</option>
                                                            <option value="2">PayStack</option>
                                                        </select>
                                                    </div>
                                                </div>
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
    <script>
        schedule = "{{route('admin.booking.schedule')}}";
        seat_map = "{{route('admin.booking.seat_map')}}";
    </script>
@endsection