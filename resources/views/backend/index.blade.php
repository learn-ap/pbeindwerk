@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        {{-- Inhoud die je wilt toevoegen aan de content sectie --}}
         @include('partials.cards')
        {{-- @include('partials.charts') --}}
        {{-- @include('partials.datatable') --}}
    </div>
@endsection
