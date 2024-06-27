@extends('layouts.admin')

@section('title', 'All Products')

@section('content')
    <div class="container mt-5">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center">
                <i class="fas fa-table me-1 display-6"></i>
                <p class="display-6 m-0 mx-2">All Products</p>
            </div>
            <div class="card-body">
                <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add New Product</a>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <table id="products" class="table table-bordered text-center">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Created At</th>
                        <th>Deleted At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td style="vertical-align: middle;">
                                @if ($product->getFirstMediaUrl('product_images'))
                                    <img src="{{ $product->getFirstMediaUrl('product_images', 'thumb') }}"
                                         alt="{{ $product->name }}" width="50" style="display: block; margin: 0 auto;">
                                @else
                                    <img src="https://via.placeholder.com/65x100" alt="No Image" width="65" height="100">
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ Str::words($product->description, 5, '...') }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->category ? $product->category->name : 'No Category' }}</td>
                            <td>{{ $product->created_at ? $product->created_at->format('Y-m-d H:i:s') : 'N/A' }}</td>
                            <td>{{ $product->deleted_at ? $product->deleted_at->format('Y-m-d H:i:s') : 'N/A' }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="actionMenu"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="actionMenu">
                                        @if($product->deleted_at)
                                            <!-- Als het product verwijderd is -->
                                            @can('delete products')
                                                @if ($product->trashed())
                                                    <li>
                                                        <form action="{{ route('products.restore', $product->id) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="dropdown-item"><i class="fas fa-undo"></i>
                                                                Restore
                                                            </button>
                                                        </form>
                                                    </li>
                                                @endif
                                            @endcan
                                        @else
                                            <!-- Als het product niet verwijderd is -->
                                            @can('view products')
                                                <li><a class="dropdown-item" href="{{ route('products.show', $product->id) }}"><i
                                                            class="fas fa-eye"></i> View</a></li>
                                            @endcan
                                            @can('edit products')
                                                <li><a class="dropdown-item" href="{{ route('products.edit', $product->id) }}"><i
                                                            class="fas fa-edit"></i> Edit</a></li>
                                            @endcan
                                            @can('delete products')
                                                <li>
                                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item"><i class="fas fa-trash"></i>
                                                            Delete
                                                        </button>
                                                    </form>
                                                </li>
                                            @endcan
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- Pagination links -->
                <div class="d-flex justify-content-center">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
