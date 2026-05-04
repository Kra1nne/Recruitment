@extends('layouts/contentNavbarLayout')

@section('title', 'Job Assessment')

@section('content')
  <div class="mt-4">
    <div class="card shadow-sm border-0" style="background-color: #ffffff;">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0 text-white">Send Job Assessment</h5>
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
        <form action="{{ route('job-assessment-send') }}" method="POST">
          @csrf

          <!-- Candidate Name -->
          <input type="text" name="id" value="{{ $applicant->id }}" hidden>
          <div class="mb-3">
            <label for="candidate_name" class="form-label">Candidate Name</label>
            <input type="text" class="form-control" id="candidate_name"
              value="{{ $applicant->person->first_name }} {{ $applicant->person->middle_name[0] }} {{ $applicant->person->last_name }}"
              name="candidate_name" value="{{ old('candidate_name') }}" placeholder="Enter candidate name" required>
          </div>

          <!-- Assessment Type -->
          <div class="mb-3">
            <label for="assessment_type" class="form-label">Assessment Type</label>
            <select class="form-select" id="assessment_type" name="assessment_type" required>
              <option value="">-- Select Assessment Type --</option>
              <option value="Technical Exam">Technical Exam</option>
              <option value="Interview">Interview</option>
              <option value="Practical Test">Practical Test</option>
              <option value="Online Exam">Online Exam</option>
            </select>
          </div>

          <!-- Date -->
          <div class="mb-3">
            <label for="date" class="form-label">Date and Time</label>
            <input type="datetime-local" class="form-control" id="date" name="date" required>
          </div>

          <!-- Place -->
          <div class="mb-3">
            <label for="place" class="form-label">Place / Location / Platform Use</label>
            <input type="text" class="form-control" id="place" name="place"
              placeholder="Enter location or meeting link" required>
          </div>

          <!-- Notes -->
          <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea class="form-control" id="notes" name="notes" rows="3"
              placeholder="Additional instructions or details"></textarea>
          </div>

          <!-- Submit Button -->
          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">
              Send Assessment
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>
@endsection
