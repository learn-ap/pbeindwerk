@extends('layouts.admin')

@section('title', 'All Categories')

@section('content')
    <div class="container mt-5">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center">
                <i class="fas fa-table me-1 display-6"></i>
                <p class="display-6 m-0 mx-2">All Categories</p>
            </div>
            <div class="card-body">
                <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Add New Category</a>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <table id="categories" class="table table-bordered text-center">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Created At</th>
                        <th>Deleted At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->created_at ? $category->created_at->format('Y-m-d H:i:s') : 'N/A' }}</td>
                            <td>{{ $category->deleted_at ? $category->deleted_at->format('Y-m-d H:i:s') : 'N/A' }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="actionMenu{{ $category->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="actionMenu{{ $category->id }}">
                                        @if($category->deleted_at)
                                            <!-- Als de categorie verwijderd is -->
                                            @can('delete categories')
                                                @if ($category->trashed())
                                                    <li>
                                                        <form action="{{ route('categories.restore', $category->id) }}" method="POST">
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
                                            <!-- Als de categorie niet verwijderd is -->
                                            @can('edit categories')
                                                <li><a class="dropdown-item" href="{{ route('categories.edit', $category->id) }}"><i
                                                            class="fas fa-edit"></i> Edit</a></li>
                                            @endcan
                                            @can('delete categories')
                                                <li>
                                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
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
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
