@extends('layouts/contentNavbarLayout')

@section('title', 'Create Job Posting')

@section('content')
  <div class="mt-4">
    <div class="card shadow-sm border-0" style="background-color: #ffffff;">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0 text-white">Update Job Posting</h5>
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
        <form action="{{ route('job-posting-update') }}" method="POST">
          @csrf
          <input type="hidden" value="{{ $jobDetails->id }}" name="id">
          <div class="row">
            <!-- Title -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Job Title</label>
              <input type="text" name="title" value="{{ $jobDetails->title }}" class="form-control"
                placeholder="Enter job title" required>
            </div>

            <!-- Company -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Company</label>
              <input type="text" name="company" value="{{ $jobDetails->company }}" class="form-control"
                placeholder="Enter company name" required>
            </div>

            <!-- Position -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Position</label>
              <input type="text" name="position" value="{{ $jobDetails->position }}" class="form-control"
                placeholder="Enter position" required>
            </div>

            <!-- Salary -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Salary</label>
              <input type="number" name="salary" value="{{ $jobDetails->salary }}" class="form-control"
                placeholder="Enter salary" required>
            </div>

            <!-- Work Status -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Work Status</label>
              <select name="work_status" class="form-select" required>
                <option value="">Select status</option>
                <option value="Full-time" {{ $jobDetails->work_status == 'Full-time' ? 'selected' : '' }}>Full-time
                </option>
                <option value="Part-time" {{ $jobDetails->work_status == 'Part-time' ? 'selected' : '' }}>Part-time
                </option>
                <option value="Contract" {{ $jobDetails->work_status == 'Contract' ? 'selected' : '' }}>Contract</option>
                <option value="Internship" {{ $jobDetails->work_status == 'Internship' ? 'selected' : '' }}>Internship
                </option>
              </select>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Work Arrangement</label>
              <select name="work_arrangement" class="form-select" required>
                <option value="">Select arrangement</option>
                <option value="On-site" {{ $jobDetails->work_arrangement == 'On-site' ? 'selected' : '' }}>On-site
                </option>
                <option value="Remote" {{ $jobDetails->work_arrangement == 'Remote' ? 'selected' : '' }}>Remote</option>
                <option value="Hybrid" {{ $jobDetails->work_arrangement == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
              </select>
            </div>

            <!-- Status -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Status</label>
              <select name="status" class="form-select" required>
                <option value="">Select status</option>
                <option value="Open" {{ $jobDetails->status == 'Open' ? 'selected' : '' }}>Open</option>
                <option value="Closed" {{ $jobDetails->status == 'Closed' ? 'selected' : '' }}>Closed</option>
                <option value="Paused" {{ $jobDetails->status == 'Paused' ? 'selected' : '' }}>Paused</option>
              </select>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Department</label>
              <select name="department" class="form-select" required>
                <option value="">Select Department</option>
                @foreach ($departmentList as $item)
                  <option value="{{ $item->id }}" {{ $jobDetails->department_id == $item->id ? 'selected' : '' }}>
                    {{ $item->dept_name }}</option>
                @endforeach
              </select>
            </div>

            <!-- Expiration Date -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Expiration Date</label>
              <input type="date" name="expired_at" value="{{ $jobDetails->expired_at }}" class="form-control"
                required>
            </div>

            <!-- Location -->
            <div class="col-md-12 mb-3">
              <label class="form-label">Location</label>
              <textarea name="location" class="form-control" rows="2" placeholder="Enter job location">{{ $jobDetails->location }}</textarea>
            </div>

            <!-- Description -->
            <div class="col-md-12 mb-3">
              <label class="form-label">Description</label>
              <textarea name="description" class="form-control" rows="4" placeholder="Enter job description">{{ $jobDetails->description }}</textarea>
            </div>
          </div>

          <!-- Submit -->
          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">
              Save Job Posting
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>
@endsection
