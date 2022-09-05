@extends('admin.layouts.master')

@section('title') schedule create @endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Create @endslot
        @slot('title') Schedule Management @endslot
    @endcomponent
    <div class="content-wrapper">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <form class="custom-validation" action="" id="custom-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Select AirLine</label>
                                                <select class="form-select" name="airline" required>
                                                    @foreach($airline as $row)
                                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Departure Date</label>
                                            <div class="input-group" >
                                                <input type="text" class="form-control docs-date" placeholder="yyyy-mm-dd"
                                                    data-date-format="yyyy-mm-dd" name="departure_date"
                                                    data-provide="datepicker" data-date-autoclose="true" required>
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div><!-- input-group -->
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Departure Time</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" data-provide="timepicker" name="departure_time" required>
                                                <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Return Date</label>
                                            <div class="input-group" >
                                                <input type="text" class="form-control docs-date" placeholder="yyyy-mm-dd"
                                                    data-date-format="yyyy-mm-dd" name="return_date"
                                                    data-provide="datepicker" data-date-autoclose="true" required>
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div><!-- input-group -->
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Return Time</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" data-provide="timepicker" name="return_time" required>
                                                <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 text-end">
                                    <button type="submite" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>    
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/datepicker/datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/admin/pages/schedule/index.js') }}"></script>
    <script>
        store = "{{route('admin.schedule.store')}}"
        list_url = "{{route('admin.schedule.index')}}"
    </script>
@endsection