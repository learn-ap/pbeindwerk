@extends('layouts.frontend')

@section('content')
    <main>
        <section class="row col-lg-8 offset-lg-2" id="shoppagelist">
            <div class="d-lg-flex">
                <div class="col">
                    <div id="shoplist" class="row">
                        @foreach ($products as $product)
                            <div class="col-3 p-lg-3">
                                <div class="shopimage d-flex justify-content-center">
                                    <a href="{{ route('vineyard.shopdetail', $product->id) }}">
                                        @if($product->getFirstMediaUrl('product_images'))
                                            <img alt="{{ $product->name }}" class="img-fluid" src="{{ $product->getFirstMediaUrl('product_images') }}" style="max-width: 260px; max-height: 350px;">
                                        @else
                                            <img alt="{{ $product->name }}" class="img-fluid" src="https://placehold.co/260x350">
                                        @endif
                                    </a>
                                </div>
                                <div class="shopinfo col px-3">
                                    <a class="fs-5 font-philos-reg text-decoration-none text-dark fs-5 font-philos-reg letter-spacing-2"
                                       href="{{ route('vineyard.shopdetail', $product->id) }}">
                                        {{ $product->name }}
                                    </a>
                                    <br> <!-- Voeg een line break toe om de naam en prijs onder elkaar te plaatsen -->
                                    <a class="price fs-3 mytext-darkred font-philos-bold text-decoration-none letter-spacing-2"
                                       href="{{ route('vineyard.shopdetail', $product->id) }}">
                                        €{{ $product->price }}
                                    </a>
                                    <p class="productintro m-0 fs-7 pt-2 mytext-grey font-philos-reg">
                                        {{ Str::limit($product->description, 100, '...') }}
                                    </p>
                                    <div class="d-flex justify-content-center justify-content-lg-start">
                                        <form action="{{ route('vineyard.cart.add', $product->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="rounded-pill text-decoration-none mybg-darkred text-white letter-spacing-2 font-philos-reg px-4 py-2 border-0 mt-3">
                                                ADD
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
