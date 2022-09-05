@extends('admin.layouts.master')

@section('title') schedule create @endsection
@section('css')

@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Create @endslot
        @slot('title') Airlin Management @endslot
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
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label class="form-label">Air Line</label>
                                            <input type="text" class="form-control"  name="name">
                                        </div>
                                        <div class="mb-3 text-end">
                                            <button type="submite" class="btn btn-primary">Save</button>
                                        </div>
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
    <script src="{{ URL::asset('/assets/admin/pages/airline/index.js') }}"></script>
    <script>
        store = "{{route('admin.airline.store')}}"
        list_url = "{{route('admin.airline.index')}}"
    </script>
@endsection