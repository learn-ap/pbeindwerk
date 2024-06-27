@extends('layouts.frontend')

@section('content')
    <main>
        <section class="row">
            <div class="d-lg-flex col-lg-8 offset-lg-2">
                <div class="col-lg-8 p-2 p-lg-0" id="productimg">
                    @if($product->getFirstMediaUrl('product_images', 'shopdetail'))
                        <img alt="{{ $product->name }}" class="img-fluid" src="{{ $product->getFirstMediaUrl('product_images', 'shopdetail') }}">
                    @else
                        <img alt="{{ $product->name }}" class="img-fluid" src="https://placehold.co/870x1160">
                    @endif
                </div>
            </div>
            <div class="col-lg-8 offset-lg-2 p-3">
                <div id="productname">
                    <h4 class="fs-5 font-philos-reg letter-spacing-2">{{ $product->name }}</h4>
                </div>
                <p class="m-0 price fs-3 py-3 mytext-darkred font-philos-bold text-decoration-none letter-spacing-2">
                    € {{ $product->price }}
                </p>
                <p class="productintro m-0 fs-7 pb-4 mytext-grey font-philos-reg myborder-bottom-dotted-grey">
                    Type: {{ $product->category->name }}
                </p>
                <div class="d-flex py-3 myborder-bottom-dotted-grey">
                    <div class="pe-2 align-self-center">
                        <p class="font-philos-reg fs-7 m-0">
                            Share Link:
                        </p>
                    </div>
                    <div class="d-flex">
                        <div class="me-3">
                            <a href=""><i class="fa fa-facebook m-0 mytext-grey"></i></a>
                        </div>
                        <div class="me-3">
                            <a href=""><i class="fa fa-twitter m-0 mytext-grey"></i></a>
                        </div>
                        <div class="me-3">
                            <a href=""><i class="fa fa-google m-0 mytext-grey"></i></a>
                        </div>
                        <div class="me-3">
                            <a href=""><i class="fa fa-pinterest m-0 mytext-grey"></i></a>
                        </div>
                    </div>
                </div>
                <div class="py-3">
                    <form action="{{ route('vineyard.cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="rounded-pill text-decoration-none mybg-darkred text-white letter-spacing-2 font-philos-reg px-4 py-2 border-0 mt-3">
                            ADD TO CART
                        </button>
                    </form>
                </div>
                <div class="border border-2 py-3 px-4">
                    <h5 class="letter-spacing-2 fs-7 font-philos-reg border-bottom border-1 py-2">
                        PRODUCT DESCRIPTION
                    </h5>
                    <p class="m-0 fs-7 font-philos-reg">
                        {{ $product->description }}
                    </p>
                </div>
            </div>
        </section>
    </main>
@endsection

