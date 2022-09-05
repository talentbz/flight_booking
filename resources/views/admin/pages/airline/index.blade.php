@extends('admin.layouts.master')

@section('title') airline @endsection
@section('css')

@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') list @endslot
        @slot('title') Airlin Management @endslot
    @endcomponent
    <div class="content-wrapper">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="table-filter mb-3">
                        <a href="{{route('admin.airline.create')}}" class="btn btn-outline-primary waves-effect waves-light add-new"><i class="fas fa-plus"></i> Add Schedule</a> 
                    </div>
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 datatable">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Airline</th>
                                <th class="text-center">Status</th>           
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($airline as $key=>$row)
                            <tr>
                                <td class="text-center">{{$key+1}}</td>
                                <td>{{$row->name}} {{$row->departure_time}}</td>
                                <td>
                                    <div class="form-check form-switch form-switch-lg text-center">
                                        <input class="form-check-input price-status" type="checkbox" {{$row->status == 1 ? "checked" :""}} value="{{$row->id}}" >
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="{{route('admin.airline.edit', ['id' => $row->id])}}" class="btn btn-outline-primary btn-sm waves-effect waves-lightt"><i class="fas fa-pencil-alt"></i> Edit</button>
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
    <script src="{{ URL::asset('/assets/admin/pages/airline/index.js') }}"></script>
    <script>
        status_change = "{{route('admin.airline.status')}}"
    </script>
@endsection