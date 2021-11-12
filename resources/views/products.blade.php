@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
{{--                {!! $products !!}--}}
                @include('Products.List',['products'=>$products])
            </div>
        </div>
    </div>
@endsection

