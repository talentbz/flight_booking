@extends('admin.layouts.master')

@section('title') schedule @endsection
@section('css')

@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') list @endslot
        @slot('title') User Management @endslot
    @endcomponent
    <div class="content-wrapper">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="table-filter mb-3">
                        <a href="{{route('admin.user.create')}}" class="btn btn-outline-primary waves-effect waves-light add-new"><i class="fas fa-plus"></i> Add User</a> 
                    </div>
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 datatable">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">User Type</th>
                                <th class="text-center">Status</th>           
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user as $key=>$row)
                            <tr>
                                <td class="text-center">{{$key+1}}</td>
                                <td class="text-center">
                                    @if($row->avatar)
                                        <img src="{{URL::asset('/uploads/user')}}{{'/'}}{{$row->avatar}}" class="rounded-circle" width='30' alt="">
                                    @else
                                        <img src="{{ Avatar::create($row->name)->toBase64() }}" width='30' alt="">   
                                    @endif
                                </td>
                                <td class="text-center">{{$row->name}}</td>
                                <td class="text-center">{{$row->email}}</td>
                                <td class="text-center">
                                    @if($row->role == 1)
                                    <span class="badge badge-pill badge-soft-success font-size-12">Admin</span>
                                    @else
                                    <span class="badge badge-pill badge-soft-warning font-size-12">Agent</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="form-check form-switch form-switch-lg text-center">
                                        <input class="form-check-input price-status" type="checkbox" {{$row->status == 1 ? "checked" :""}} value="{{$row->id}}" >
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="{{route('admin.user.edit', ['id' => $row->id])}}" class="btn btn-outline-primary btn-sm waves-effect waves-lightt"><i class="fas fa-pencil-alt"></i> Edit</button>
                                    <a href="javsciript::void(0)" class="btn btn-outline-primary btn-sm waves-effect waves-lightt ms-1 reset-password" data-bs-toggle="modal"
                                                data-bs-target="#myModal">Rest Password</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>   
    <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Reset Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form class="custom-validation" action="" id="rest-form">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <div>
                                        <input type="password" id="pass2" class="form-control" name="password" required />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Confirm password</label>
                                    <div>
                                        <input type="password" class="form-control" required data-parsley-equalto="#pass2" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light save_button">Save</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->    
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/admin/pages/user/index.js') }}"></script>
    <script>
        store = "{{route('admin.user.store')}}"
        list_url = "{{route('admin.user.index')}}"
        status_change = "{{route('admin.user.status')}}"
        reset_password = "{{route('admin.user.reset_password', ['id' => $row->id])}}"
    </script>
@endsection