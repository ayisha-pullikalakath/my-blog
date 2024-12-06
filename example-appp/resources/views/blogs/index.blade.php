@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary fw-bold">Blog Management</h1>
        <a href="{{ route('blogs.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i> Create New Blog
        </a>
    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Card Grid with Hover Effects -->
    <div class="row g-4">
        @forelse($blogs as $blog)
        <div class="col-md-4">
            <div class="card shadow-sm rounded-3 h-100">
                <!-- Blog Image -->
                @if($blog->image)
                <img src="{{ asset('storage/' . $blog->image) }}" class="card-img-top" alt="{{ $blog->title }}">
                @else
                <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Placeholder Image">
                @endif

                <!-- Card Body -->
                <div class="card-body">
                    <h5 class="card-title fw-bold text-truncate">{{ $blog->title }}</h5>
                    <p class="text-muted small mb-3">
                        Status: 
                        <span class="badge {{ $blog->status ? 'bg-success' : 'bg-danger' }}">
                            {{ $blog->status ? 'Enabled' : 'Disabled' }}
                        </span>
                    </p>
                    <p>{{ Str::limit(strip_tags(str_replace('<br>', "\n", $blog->content)), 100, '...') }}</p>
                </div>

                <!-- Card Footer with Button Hover Effects -->
                <div class="card-footer bg-white border-0 d-flex justify-content-between">
                    <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-warning btn-sm rounded-3 px-3">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>
                    <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm rounded-3 px-3" onclick="return confirm('Are you sure?')">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <p class="text-center text-muted">No blogs found.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Card Title Styling */
    .card-title {
        font-size: 1.25rem;
        font-weight: 600;
    }

    /* Card Image Styling */
    .card-img-top {
        height: 200px;
        object-fit: cover;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        transition: transform 0.3s ease;
    }

    /* Hover effect for the image */
    .card-img-top:hover {
        transform: scale(1.05);
    }

    /* Card Body Styling */
    .card-body {
        padding: 1.5rem;
    }

    .card-body .card-text {
        font-size: 1rem;
        color: #6c757d;
    }

    /* Card Footer Styling */
    .card-footer {
        font-size: 0.9rem;
        padding: 1rem;
    }

    .card-footer .btn {
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    /* Button Hover Effects */
    .card-footer .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Adjusting margin of the cards for consistent spacing */
    .card {
        border: none;
        border-radius: 10px;
    }

    /* Styling for badges */
    .badge {
        font-size: 0.85rem;
    }

    /* Responsive Image Handling */
    @media (max-width: 768px) {
        .card-img-top {
            height: 150px;
        }
    }

    /* Card Hover Effect */
    .card:hover {
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    /* Styling for the success message */
    .alert {
        font-size: 0.9rem;
        padding: 1rem;
    }

    /* Spacing for the card footer and content */
    .card-footer {
        background-color: #fff;
        border-top: 1px solid #eee;
    }
</style>
@endpush
