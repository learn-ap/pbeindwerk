@extends('layouts.frontend')

@section('content')
    <main>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <div id="checkout">
                            <div class="border border-dark border-2 border-top-0 border-start-0 border-end-0">
                                <p class="letter-spacing-2 text-center fs-3 font-philos-bold m-0 mytext-green py-3">YOUR ORDER</p>
                            </div>
                            <div class="d-flex">
                                <div class="col-6">
                                    <p class="font-philos-reg m-0 py-3">PRODUCT</p>
                                </div>
                                <div class="col-6 d-flex justify-content-end py-3">
                                    <p class="font-philos-reg m-0">TOTAL</p>
                                </div>
                            </div>
                            @foreach ($cartItems as $item)
                                <div class="d-flex">
                                    <div class="col-6 py-3">
                                        <p class="letter-spacing-2 m-0 font-philos-reg">{{ $item->product->name }} x {{ $item->quantity }}</p>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end py-3">
                                        <p class="mytext-darkred letter-spacing-2 font-philos-bold m-0">€{{ number_format($item->product->price * $item->quantity, 2) }}</p>
                                    </div>
                                </div>
                            @endforeach
                            <div class="d-flex border border-dark border-2 border-bottom-0 border-start-0 border-end-0 py-3">
                                <div class="col-6 py-3">
                                    <p class="letter-spacing-2 m-0 font-philos-reg">ORDER TOTAL</p>
                                </div>
                                <div class="col-6 d-flex justify-content-end py-3">
                                    <p class="mytext-darkred letter-spacing-2 font-philos-bold m-0">€{{ number_format($cartItems->sum(fn($item) => $item->product->price * $item->quantity), 2) }}</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('vineyard.orders.prepare') }}" type="button" class="rounded-pill mybg-darkred text-white letter-spacing-2 font-philos-reg px-4 border-0 mt-3 text-decoration-none">GO PAY</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
