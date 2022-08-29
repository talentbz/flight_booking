@extends('admin.layouts.master')

@section('title') byDate @endsection
@section('css')

@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Price By Date @endslot
        @slot('title') Price Management @endslot
    @endcomponent
    <div class="content-wrapper">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 datatable">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Percentage</th>
                                <th class="text-center">Status</th>           
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($by_date as $key=>$row)
                                <tr>
                                    <td class="text-center">{{$key+1}}</td>
                                    <td>{{$row->seat_date}}</td>
                                    <td>{{$row->percentage}}</td>
                                    <td>
                                        <div class="form-check form-switch form-switch-lg text-center">
                                            <input class="form-check-input price-status" type="checkbox" {{$row->status == 1 ? "checked" :""}} value="{{$row->id}}" >
                                        </div>
                                    </td>
                                    <td class="text-center">
                                         <a href="javascript:void(0)" class="btn btn-outline-primary btn-sm waves-effect waves-lightt edit" data-id="{{$row->id}}" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fas fa-pencil-alt"></i> Edit</button>
                                    </td>
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
    <script src="{{ URL::asset('/assets/admin/pages/priceByDate/index.js') }}"></script>
    <script>
        store = "{{route('admin.price.date_store')}}"
        list_url = "{{route('admin.price.date_index')}}"
        status_change = "{{route('admin.price.date_status')}}"
    </script>
@endsection