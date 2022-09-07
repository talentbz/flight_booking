@extends('admin.layouts.master')

@section('title') Baggage @endsection
@section('css')

@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Baggage @endslot
        @slot('title') Price Management @endslot
    @endcomponent
    <div class="content-wrapper">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <form class="custom-validation" action="" id="custom-form">
                        @csrf
                        <input type="hidden" name="id" value="{{$baggage->id}}">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Price (USD)</label>
                                            <input type="number" class="form-control" name="price" value="{{$baggage->price}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Weight (Kg)</label>
                                            <input type="number" class="form-control" name="weight" value="{{$baggage->weight}}" required>
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
    <script src="{{ URL::asset('/assets/admin/pages/baggage/index.js') }}"></script>
    <script>
        store = "{{route('admin.price.baggage_store')}}"
    </script>
@endsection