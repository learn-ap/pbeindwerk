@extends('layouts.admin')

@section('title', 'Users')

@section('content')
    <div class="container mt-5">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center">
                <i class="fas fa-table me-1 display-6"></i>
                <p class="display-6 m-0 mx-2">All Users</p>
            </div>
            <div class="card-body">
                <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Add New User</a>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <table id="users" class="table table-bordered text-center">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Deleted At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td style="vertical-align: middle;">
                                @if ($user->getFirstMediaUrl('profile_images', 'thumb'))
                                    <img src="{{ $user->getFirstMediaUrl('profile_images', 'thumb') }}" alt="{{ $user->name }}" width="50" style="display: block; margin: 0 auto;">
                                @else
                                    <img src="https://via.placeholder.com/50" alt="No Image" width="50" style="display: block; margin: 0 auto;">
                                @endif
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->roles->pluck('name')->first() }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->deleted_at }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton{{ $user->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $user->id }}">
                                        @if($user->deleted_at)
                                            <!-- Als de gebruiker verwijderd is -->
                                            <li>
                                                <form action="{{ route('users.restore', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="dropdown-item"><i class="fas fa-undo"></i> Restore</button>
                                                </form>
                                            </li>
                                        @else
                                            <!-- Als de gebruiker niet verwijderd is -->
                                            @can('view users')
                                                <li><a class="dropdown-item" href="{{ route('users.show', $user->id) }}"><i class="fas fa-eye"></i> View</a></li>
                                            @endcan
                                            @can('edit users')
                                                <li><a class="dropdown-item" href="{{ route('users.edit', $user->id) }}"><i class="fas fa-edit"></i> Edit</a></li>
                                            @endcan
                                            @can('delete users')
                                                <li>
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item"><i class="fas fa-trash-alt"></i> Delete</button>
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
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
