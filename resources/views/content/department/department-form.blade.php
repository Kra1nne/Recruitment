@extends('layouts/contentNavbarLayout')

@section('title', 'Department Form')

@section('content')
  <div class="mt-4">
    <div class="card shadow-sm border-0" style="background-color: #ffffff;">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0 text-white">Create Department</h5>
      </div>
      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
          {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      <div class="card-body p-5">
        <form action="{{ route('department-add') }}" method="POST">
          @csrf

          <!-- Department Name -->
          <div class="mb-3">
            <label for="name" class="form-label">Department Name</label>
            <input type="text" class="form-control" value="{{ old('name') }}" id="name" name="name"
              placeholder="Enter department name" required>
          </div>

          <!-- Description -->
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" placeholder="Enter the description..." id="description" name="description" rows="3"
              placeholder="Enter department description">{{ old('description') }}</textarea>
          </div>

          <!-- Date -->
          <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" value="{{ old('date') }}" name="date" required>
          </div>

          <!-- Submit Button -->
          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">
              Save Department
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>
@endsection
