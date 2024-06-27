@extends('layouts.admin')

@section('title', 'View Product')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">View Product</h1>
        <div class="card">
            <div class="card-header">
                {{ $product->name }}
            </div>
            <div class="card-body">
                @if ($product->getFirstMediaUrl('product_images'))
                    <img src="{{ $product->getFirstMediaUrl('product_images') }}" alt="{{ $product->name }}" width="300" height="380">
                @else
                    <img src="https://picsum.photos/300/380" alt="Placeholder Image" width="300" height="380">
                @endif
                <h5 class="card-title">Price: €{{ number_format($product->price * 0.85, 2) }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">Category: {{ $product->category->name }}</h6>
                <p class="card-text">{{ $product->description }}</p>
            </div>
            <div class="card-footer text-muted">
                Created at: {{ $product->created_at->format('Y-m-d H:i:s') }}
                @if($product->deleted_at)
                    <br>Deleted at: {{ $product->deleted_at->format('Y-m-d H:i:s') }}
                @endif
            </div>
        </div>
        <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    </div>
@endsection
