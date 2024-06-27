<header class="row">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <div class="col-lg-8 offset-lg-2">
                <div class="row mx-1 mx-lg-0">

                    <!-- Top section of the navbar -->
                    <div class="d-flex justify-content-between py-2 py-lg-5">
                        <div class="col-lg-4 align-self-center">
                            .
                        </div>
                        <div class="col-lg-4 d-none d-lg-block text-center">
                            <!-- Update home link -->
                            <a class="navbar-brand logo m-0" href="{{ route('vineyard.home') }}">VINEYARD</a>
                        </div>
                        <div class="col-lg-4 d-flex justify-content-end align-self-center" id="navbaricons">
                            <a href="{{ route('vineyard.cart') }}"><i class="bi bi-cart fontsize-icons"></i></a>
                        </div>
                    </div>
                    <div id="navbardesktopline" class="border-top border-light-subtle d-none d-lg-block">
                        <!-- Only a border line for desktop format -->
                    </div>

                    <!-- Lower section of the navbar, some items are only visible in mobile format here -->
                    <div class="d-flex">
                        <div id="navbaremptydiv" class="col-1 d-lg-none">
                            <!-- Empty div to center the title on mobile -->
                        </div>
                        <div class="col-10 col-lg-12 d-lg-none d-flex justify-content-center">
                            <!-- Update home link -->
                            <a class="navbar-brand logo m-0" href="{{ route('vineyard.home') }}">VINEYARD</a>
                        </div>

                        <div class="col-1 col-lg-12 d-flex justify-content-end justify-content-lg-center">
                            <!-- Only visible on mobile format => HAMBURGER-->
                            <button aria-controls="navbarOffcanvas" aria-expanded="false" aria-label="Toggle navigation"
                                    class="navbar-toggler border-0 p-0 d-lg-none" data-bs-target="#navbarOffcanvas"
                                    data-bs-toggle="offcanvas" type="button">
                                <span class="navbar-toggler-icon "></span>
                            </button>

                            <div>
                                <div aria-labelledby="navbarOffcanvasLabel" class="offcanvas offcanvas-end"
                                     id="navbarOffcanvas" tabindex="-1">
                                    <div class="offcanvas-header">
                                        <h5 class="offcanvas-title logo" id="navbarOffcanvasLabel">Vineyard</h5>
                                        <button aria-label="Close" class="btn-close text-reset"
                                                data-bs-dismiss="offcanvas" type="button"></button>
                                    </div>
                                    <div class="offcanvas-body">
                                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                            <li class="nav-item">
                                                <a aria-current="page" class="nav-link active pe-5" href="{{ route('vineyard.home') }}">Home</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link pe-5" href="{{ route('vineyard.shoplist') }}">Shop</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pt-3 border-bottom border-light-subtle d-lg-none">
                        <!-- Only a border line -->
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
