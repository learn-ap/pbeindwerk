{{--via de admincontroller krijgen de cards hun data--}}

<div class="container mt-5">
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <span class="display-6">Users</span>
                    <i class="fas fa-users display-6"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <span class="h5">{{ $userCount }} Users</span>
                    <a class="small text-white stretched-link" href="{{ route('users.index') }}">View Details</a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <span class="display-6">Products</span>
                    <i class="fas fa-box-open display-6"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <span class="h5">{{ $productCount }} Products</span>
                    <a class="small text-white stretched-link" href="{{ route('products.index') }}">View Details</a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <span class="display-6">Categories</span>
                    <i class="fas fa-tags display-6"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <span class="h5">{{ $categoryCount }} Categories</span>
                    <a class="small text-white stretched-link" href="{{ route('categories.index') }}">View Details</a>
                </div>
            </div>
        </div>
    </div>
</div>

