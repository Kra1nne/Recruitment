@extends('layouts/homePageLayout')

@section('title', 'Jobs Page')

@section('content')


  <div class="min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top shadow-sm">
      <div class="container">

        {{-- Logo (Left) --}}
        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold fs-4" href="#">
          <span class="app-brand-logo demo">@include('_partials.macros')</span>
          <span class="text-primary">Empathra</span>
        </a>

        {{-- Toggler --}}
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">

          {{-- Center Links --}}
          <ul class="navbar-nav mx-auto gap-1">
            <li class="nav-item">
              <a class="nav-link fw-semibold text-secondary" href="{{ route('home') }}">
                <i class="bi bi-house-door me-1"></i>Home
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-semibold text-primary active" href="{{ route('jobs') }}">
                <i class="bi bi-briefcase me-1"></i>Jobs
              </a>
            </li>
          </ul>

          {{-- Login (Right) --}}
          <div class="d-flex">
            <a href="{{ route('login') }}" class="btn btn-primary fw-semibold px-4">
              <i class="bi bi-box-arrow-in-right me-1"></i>Login
            </a>
          </div>

        </div>
      </div>
    </nav>

    <section class="container">
      <a href="{{ route('jobs') }}" class="btn btn-outline-secondary mt-5">Back </a>

      <div class="p-5">
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
        <form action="{{ route('job-applicant-add') }}" method="POST">
          @csrf

          <div class="row">
            <h5>Personal Details</h5>
            <input type="text" value="{{ $decrypted_id }}" name="job_id" hidden>
            <div class="col-md-4 mb-3">
              <label class="form-label">First Name</label>
              <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control"
                placeholder="Enter first name" required>
            </div>

            <div class="col-md-4 mb-3">
              <label class="form-label">Middle Name</label>
              <input type="text" name="middle_name" value="{{ old('middle_name') }}" class="form-control"
                placeholder="Enter middle name" required>
            </div>

            <div class="col-md-4 mb-3">
              <label class="form-label">Last Name</label>
              <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control"
                placeholder="Enter last name" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Gender</label>
              <select name="gender" class="form-select" required>
                <option value="">Select gender</option>
                <option value="M" {{ old('gender') == 'M' ? 'selected' : '' }}>M</option>
                <option value="F" {{ old('gender') == 'F' ? 'selected' : '' }}>F</option>
              </select>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Brth Date</label>
              <input type="date" name="birth_date" value="{{ old('birth_date') }}" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Blood Type</label>
              <select name="blood_type" class="form-select" required>
                <option value="">Select blood type</option>
                @foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $type)
                  <option value="{{ $type }}" {{ old('blood_type') == $type ? 'selected' : '' }}>
                    {{ $type }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Phone Number</label>
              <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="form-control"
                placeholder="Enter phone number" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Email</label>
              <input type="text" name="email" value="{{ old('email') }}" class="form-control"
                placeholder="Enter email" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Address</label>
              <input type="text" name="address" value="{{ old('address') }}" class="form-control"
                placeholder="Enter address" required>
            </div>



            <div class="d-flex justify-content-end mt-4">
              <button type="submit" class="btn btn-primary">
                Submit Application
              </button>
            </div>

          </div>
        </form>
      </div>
    </section>
  </div>


@endsection
