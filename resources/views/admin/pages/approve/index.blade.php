@extends('admin.layouts.master')

@section('title') approve @endsection
@section('css')

@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') list @endslot
        @slot('title') Approve Management @endslot
    @endcomponent
    <div class="content-wrapper">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 datatable">
                        <thead>
                            <tr>
                                <th class="text-center">AirLine</th>
                                <th class="text-center">Trip type</th>
                                <th class="text-center">Departure Date</th>
                                <th class="text-center">Return Date</th>           
                                <th class="text-center">Departure Seat</th>           
                                <th class="text-center">Return Seat</th>           
                                <th class="text-center">Customer Name</th>
                                <th class="text-center">Total Price</th>
                                <th class="text-center">Agent</th>
                                <th class="text-center">Approve Date</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($approve as $row)
                            <tr>
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
                                <td>{{$row->cost}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->created_at}}</td>
                                <td>
                                    <div class="form-check form-switch form-switch-lg text-center">
                                        <input class="form-check-input price-status" type="checkbox" {{$row->status == 1 ? "checked disabled" :""}} value="{{$row->id}}">
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>   
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/admin/pages/approve/index.js') }}"></script>
    <script>
        status_change = "{{route('admin.approve.status')}}"
    </script>
@endsection