@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($userOrders as $order)
            <div class="row justify-content-center mb-4">
                <div class="col-md-8">
                    <div class="card float-right">
                        <div class="row">
                            <div class="col-sm-5">
                                <img class="d-block w-100" src="{{ $order->product->image }}" alt="">
                            </div>
                            <div class="col-sm-7">
                                <div class="card-block">
                                    <h4 class="card-title">{{ $order->product->title }}</h4>
                                    <p>Price: ${{ $order->price }}</p>
                                    <p>Store: {{ $order->product->store->name }}</p>
                                    <p>variations: </p>
                                    @php
                                        $value = json_decode($order->variations,true);
                                    @endphp
                                    <ul>
                                        @if(isset($value['color']) && !empty($value['color']))
                                            <li> Color: {{ $value['color']['title'] }}</li>
                                        @endif
                                        @if(isset($value['size']) && !empty($value['size']))
                                            <li> Size: {{ $value['size']['title'] }}</li>
                                        @endif
                                        @if(isset($value['type']) && !empty($value['type']))
                                            <li> Type: {{ $value['type']['title'] }}</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

