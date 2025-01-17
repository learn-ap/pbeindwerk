<section id="slideshow">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ Vite::asset('resources/images/slideshow1.jpg') }}" class="d-block w-100" alt="slideshow-image-wines">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ Vite::asset('resources/images/slideshow2.jpg') }}" class="d-block w-100" alt="slideshow-image-wines">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                        data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</section>
