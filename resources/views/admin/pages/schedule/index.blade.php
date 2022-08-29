@extends('admin.layouts.master')

@section('title') schedule @endsection
@section('css')

@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') list @endslot
        @slot('title') Schedule Management @endslot
    @endcomponent
    <div class="content-wrapper">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="table-filter mb-3">
                        <a href="{{route('admin.schedule.create')}}" class="btn btn-outline-primary waves-effect waves-light add-new"><i class="fas fa-plus"></i> Add Schedule</a> 
                    </div>
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 datatable">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Departure Date</th>
                                <th class="text-center">Return Date</th>
                                <th class="text-center">Status</th>           
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($schedule as $key=>$row)
                            <tr>
                                <td class="text-center">{{$key+1}}</td>
                                <td>{{$row->departure_date}} {{$row->departure_time}}</td>
                                <td>{{$row->return_date}} {{$row->return_time}}</td>
                                <td>
                                    <div class="form-check form-switch form-switch-lg text-center">
                                        <input class="form-check-input price-status" type="checkbox" {{$row->status == 1 ? "checked" :""}} value="{{$row->id}}" >
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="{{route('admin.schedule.edit', ['id' => $row->id])}}" class="btn btn-outline-primary btn-sm waves-effect waves-lightt"><i class="fas fa-pencil-alt"></i> Edit</button>
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
    <script src="{{ URL::asset('/assets/admin/pages/schedule/index.js') }}"></script>
    <script>
        store = "{{route('admin.schedule.store')}}"
        list_url = "{{route('admin.schedule.index')}}"
        status_change = "{{route('admin.schedule.status')}}"
    </script>
@endsection