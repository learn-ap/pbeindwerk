<section class="text-center" id="featured">
    <div class="row">
        <div class="py-5">
            <h2 class="fs-2 font-philos-bold letter-spacing-7">
                <span class="fs-1 font-pinyon letter-spacing-2 mytext-green">Vineyard</span><br>
                FEATURED WINES
            </h2>
            <div class="hr-lines">
                <img src="{{ Vite::asset('resources/images/iconglasses.png') }}" alt="icon glasses">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="row">
                @foreach ($featuredProducts as $product)
                    <div class="col-12 col-lg-3">
                        <a href="{{ route('vineyard.shopdetail', $product->id) }}">
                            @if($product->getFirstMediaUrl('product_images', 'featured'))
                                <img class="w-100 img-fluid" src="{{ $product->getFirstMediaUrl('product_images', 'featured') }}" alt="{{ $product->name }}">
                            @else
                                <img class="w-100 img-fluid" src="https://placehold.co/300x375" alt="{{ $product->name }}" width="300" height="375">
                            @endif
                        </a>
                        <div>
                            <p class="font-philos-reg mytext-grey letter-spacing-2 m-0 fs-5 pt-3">{{ $product->name }}</p>
                            <p class="font-philos-reg mytext-grey letter-spacing-2 m-0">{{ $product->category->name }}</p>
                            <p class="font-philos-bold mytext-green fs-2 m-0">€{{ $product->price }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                <a href="{{ route('vineyard.shoplist') }}"
                  class="rounded-pill text-decoration-none mybg-darkred text-white letter-spacing-2 font-philos-reg px-4 py-2 border-0 mt-3">
                    View All
                </a>
            </div>
        </div>
    </div>
</section>
