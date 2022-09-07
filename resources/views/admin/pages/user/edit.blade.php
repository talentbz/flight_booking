@extends('admin.layouts.master')

@section('title') user edit @endsection
@section('css')
<link rel="stylesheet" href="{{ URL::asset('/assets/admin/pages/user/style.css')}}" rel="stylesheet" type="text/css" >
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Edit @endslot
        @slot('title') User Management @endslot
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
                                <div class="picture-container">
                                    <div class="picture">
                                        <img src="{{ isset($user->avatar) ? asset('/uploads/user').'/'.($user->avatar):asset('/images/admin/user-profile.jpg') }}" class="picture-src" id="wizardPicturePreview" title="">
                                        <input type="file" id="wizard-picture" name="file" class="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name" value="{{$user->name}}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="text" class="form-control" name="email" value="{{$user->email}}" required>
                                        </div>
                                    </div>  
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Phone</label>
                                            <input type="text" class="form-control" name="phone" value="{{$user->phone}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">User Role</label>
                                            <select class="form-select" name="role" required>
                                                <option value="">Select</option>
                                                <option value="1" {{$user->role == 1 ? "selected" : ""}}>Admin</option>
                                                <option value="2" {{$user->role == 2 ? "selected" : ""}}>Agent</option>
                                            </select>
                                        </div>
                                    </div> 
                                    <div class="mb-3 text-end">
                                        <button type="submite" class="btn btn-primary">Save</button>
                                    </div>
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
    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/admin/pages/user/index.js') }}"></script>
    <script>
        store = "{{route('admin.user.update', ['id' => $user->id])}}"
        list_url = "{{route('admin.user.index')}}"
    </script>
@endsection
