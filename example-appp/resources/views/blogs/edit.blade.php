@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Edit Blog</h2>
        </div>
        <div class="card-body">
            <!-- Error Messages -->
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Blog Form -->
            <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <!-- Title and Status -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $blog->title) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="1" {{ $blog->status ? 'selected' : '' }}>Enabled</option>
                            <option value="0" {{ !$blog->status ? 'selected' : '' }}>Disabled</option>
                        </select>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $blog->description) }}</textarea>
                </div>

                <!-- Content -->
                <div class="mb-3">
                    <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="content" name="content" rows="5" required>{{ old('content', $blog->content) }}</textarea>
                </div>

                <!-- Image Upload with Preview -->
                <div class="mb-3">
                    <label for="image" class="form-label">Image <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*" onchange="previewImage(event)">
                    
                    <!-- Image Preview -->
                    @if ($blog->image)
                        <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" class="img-thumbnail mt-2" style="max-width: 200px;">
                    @else
                        <img id="image-preview" class="img-thumbnail mt-2 d-none" style="max-width: 200px;">
                    @endif
                </div>

                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">Update Blog</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
<script>
    // Initialize CKEditor
    CKEDITOR.replace('content');

    // Image Preview Function
    function previewImage(event) {
        const preview = document.getElementById('image-preview');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = '#';
            preview.classList.add('d-none');
        }
    }
</script>
@endsection
<style>
    /* Styling for the container */
.container {
    max-width: 800px;
    margin-top: 40px;
}

/* Card styling */
.card {
    border-radius: 10px;
    border: none;
}

/* Header styling */
.card-header {
    background-color: #007bff;
    color: white;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

/* Error Message Styling */
.alert {
    font-size: 0.9em;
    padding: 1rem;
}

/* Form control styling */
.form-control {
    border-radius: 8px;
}

/* Button Styling */
.btn-lg {
    padding: 12px 24px;
    font-size: 1.1em;
    border-radius: 8px;
}

/* Image preview styling */
#image-preview {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
}

/* Spacing between fields */
.mb-3 {
    margin-bottom: 1.5rem;
}

/* Optional: Adding space between button and the form */
.d-grid {
    margin-top: 20px;
}

/* Label styling */
.form-label {
    font-weight: 600;
}
</style>