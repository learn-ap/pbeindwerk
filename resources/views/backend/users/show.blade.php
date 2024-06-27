@extends('layouts.admin')

@section('title', 'User Details')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">User Details</h1>
        <div class="card">
            <div class="card-header">
                {{ $user->name }}
            </div>
            <div class="card-body">
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Role:</strong> {{ $user->roles->pluck('name')->first() }}</p>
                <p><strong>Created At:</strong> {{ $user->created_at }}</p>
                <p><strong>Deleted At:</strong> {{ $user->deleted_at }}</p>
                @if ($user->getFirstMediaUrl('profile_images'))
                    <img src="{{ $user->getFirstMediaUrl('profile_images') }}" alt="{{ $user->name }}" width="200">
                @else
                    <p>No Image</p>
                @endif
            </div>
            <div class="card-footer">
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
@endsection

