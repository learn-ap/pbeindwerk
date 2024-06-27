@extends('layouts.frontend')

@section('content')
    <main>
        <section>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div id="cart">
                        <div class="d-flex flex-column">
                            <div class="row py-3 border-bottom border-3 flex-nowrap">
                                <div class="col-2 text-center letter-spacing-2 fs-6 font-philos-reg">Images</div>
                                <div class="col-2 text-center letter-spacing-2 fs-6 font-philos-reg">Product Name</div>
                                <div class="col-2 text-center letter-spacing-2 fs-6 font-philos-reg">Price</div>
                                <div class="col-2 text-center letter-spacing-2 fs-6 font-philos-reg">Quantity</div>
                                <div class="col-2 text-center letter-spacing-2 fs-6 font-philos-reg">Total</div>
                                <div class="col-2 text-center letter-spacing-2 fs-6 font-philos-reg">Cancel</div>
                            </div>
                            @foreach ($cartItems as $item)
                                <div class="row py-3 border-bottom flex-nowrap">
                                    <div class="col-2 text-center d-flex align-items-center justify-content-center font-philos-reg">
                                        <img src="{{ $item->product->getFirstMediaUrl('product_images', 'thumb') }}" alt="{{ $item->product->name }}" class="img-fluid">
                                    </div>
                                    <div class="col-2 text-center d-flex align-items-center justify-content-center font-philos-reg">{{ $item->product->name }}</div>
                                    <div class="col-2 text-center d-flex align-items-center justify-content-center font-philos-reg mytext-darkred">€{{ number_format($item->product->price, 2) }}</div>
                                    <div class="col-2 text-center d-flex align-items-center justify-content-center font-philos-reg">
                                        <div class="border border-secondary-subtle p-2 d-flex align-items-center justify-content-center">
                                            <form action="{{ route('vineyard.cart.update', $item->id) }}" method="POST" class="d-flex align-items-center">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" name="quantity" value="{{ $item->quantity - 1 }}" class="btn btn-sm me-2" id="minus-btn">-</button>
                                                <span id="counter-value" class="mx-2 font-philos-reg">{{ $item->quantity }}</span>
                                                <button type="submit" name="quantity" value="{{ $item->quantity + 1 }}" class="btn btn-sm ms-2" id="plus-btn">+</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-2 text-center d-flex align-items-center justify-content-center font-philos-reg mytext-darkred">€{{ number_format($item->product->price * $item->quantity, 2) }}</div>
                                    <div class="col-2 text-center d-flex align-items-center justify-content-center font-philos-reg">
                                        <form action="{{ route('vineyard.cart.remove', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Cancel</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="text-center pt-3">
                        <div class="row justify-content-center align-items-center">
                            <div class="col letter-spacing-2 fs-4 font-philos-bold text-end">TOTAL</div>
                            <div class="col letter-spacing-2 fs-4 font-philos-bold mytext-darkred text-start">
                                €{{ number_format($cartItems->sum(fn($item) => $item->product->price * $item->quantity), 2) }}
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <form action="{{ route('vineyard.shop.checkout') }}" method="POST">
                                @csrf
                                <button type="submit" class="rounded-pill mybg-darkred text-white letter-spacing-2 font-philos-reg px-4 border-0 mt-3">Checkout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
