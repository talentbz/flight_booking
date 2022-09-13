@extends('admin.layouts.master')

@section('title') Booking List @endsection
@section('css')

@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') List @endslot
        @slot('title') Booking Management @endslot
    @endcomponent
    <div class="content-wrapper">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="table-filter mb-3">
                        <a href="{{route('admin.booking.create')}}" class="btn btn-outline-primary waves-effect waves-light add-new"><i class="fas fa-plus"></i> Add Booking</a> 
                    </div>
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 datatable">
                        <thead>
                            <tr>
                                <th class="text-center">Booking No</th>
                                <th class="text-center">AirLine</th>
                                <th class="text-center">Trip type</th>
                                <th class="text-center">Departure Date</th>
                                <th class="text-center">Return Date</th>           
                                <th class="text-center">Departure Seat</th>           
                                <th class="text-center">Return Seat</th>           
                                <th class="text-center">Customer Name</th>
                                <th class="text-center">Payment Type</th>
                                <th class="text-center">Total Price</th>
                                <th class="text-center">Agent</th>
                                <th class="text-center">Booking Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($booking as $row)
                            <tr>
                                <td>{{$row->booking_no}}</td>
                                <td>{{$row->air_line_name}}</td>
                                <td class="text-center">
                                    @if($row->trip_type == 1)
                                    <span class="badge badge-pill badge-soft-success font-size-12">Round Trip</span>
                                    @elseif($row->trip_type == 2)
                                    <span class="badge badge-pill badge-soft-primary font-size-12">OutBound</span>
                                    @else
                                    <span class="badge badge-pill badge-soft-info font-size-12">InBound</span>
                                    @endif
                                </td>
                                <td>{{$row->start_date}}</td>
                                <td>{{$row->return_date}}</td>
                                <td>
                                    @forelse(json_decode($row->start_seat) as $s_seat)
                                        {{$s_seat}},   
                                    @empty
                                    
                                    @endforelse
                                </td>
                                <td>
                                    @forelse(json_decode($row->return_seat) as $r_seat)
                                        {{$r_seat}},  
                                    @empty
                                        
                                    @endforelse
                                </td>
                                <td>{{$row->user_name}}</td>
                                <td>
                                    @if($row->payment_type == 1)
                                    <span class="badge badge-pill badge-soft-success font-size-12">Skrill</span>
                                    @elseif($row->payment_type == 2)
                                    <span class="badge badge-pill badge-soft-primary font-size-12">PayStack</span>
                                    @else
                                    <span class="badge badge-pill badge-soft-info font-size-12">Cash</span>
                                    @endif
                                </td>
                                <td>{{$row->cost}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->created_at}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<!-- sample modal content -->
<div id="editModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Percentage Edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form class="custom-validation" action="" id="custom-form">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" id="price-name" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Seat Type</label>
                                <input type="text" class="form-control" id="seat-type" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Percentage</label>
                                <input type="number" class="form-control" id="percentage" name="percentage" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submite" class="btn btn-primary waves-effect waves-light">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->        
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/admin/pages/priceByCount/index.js') }}"></script>
    <script>
        store = "{{route('admin.price.count_store')}}"
        list_url = "{{route('admin.price.count_index')}}"
        status_change = "{{route('admin.price.count_status')}}"
    </script>
@endsection