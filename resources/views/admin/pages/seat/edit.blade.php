@extends('admin.layouts.master')

@section('title') admin @endsection
@section('css')

@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Seat Type @endslot
        @slot('title') Seat @endslot
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
                                    @foreach($seat_type as $row)
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <input type="hidden" name="id[]" value="{{$row->id}}">
                                            <label class="form-label">{{$row->name}}</label>
                                            <input type="number" class="form-control" name="price[]" value="{{$row->price}}" required>
                                        </div>
                                    </div>  
                                    @endforeach
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
    <script src="{{ URL::asset('/assets/admin/pages/seat/index.js') }}"></script>
    <script>
        store = "{{route('admin.seat.store')}}"
    </script>
@endsection