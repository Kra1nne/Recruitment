@extends('layouts/homePageLayout')

@section('title', 'Jobs Page')

@section('content')
  <div class="min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top shadow-sm">
      <div class="container">

        {{-- Logo (Left) --}}
        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold fs-4" href="#">
          <span class="app-brand-logo demo">@include('_partials.macros')</span>
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
          @if (Auth::user())
            <div class="d-flex">
              <a href="{{ route('logout-process') }}" class="btn btn-primary fw-semibold px-4">
                <i class="bi bi-box-arrow-in-left me-1"></i>Logout
              </a>
            </div>
          @else
            <div class="d-flex">
              <a href="{{ route('login') }}" class="btn btn-primary fw-semibold px-4">
                <i class="bi bi-box-arrow-in-right me-1"></i>Login
              </a>
            </div>
          @endif

        </div>
      </div>
    </nav>

    <section class="container">
      <div class="d-flex justify-content-between align-items-center mb-3 mt-5 flex-wrap gap-2">
        <div>
          <h5 class="fw-semibold mb-0 ">Job Listings</h5>
          <small class="text-muted">List of the active available jobs</small>
        </div>
      </div>
      <form method="GET" action="{{ route('jobs') }}">
        <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap gap-2 py-3">
          <div class="d-flex gap-2 flex-wrap">

            <!-- Search -->
            <div class="input-group input-group-sm" style="width:220px;">
              <span class="input-group-text bg-white">
                <i class='bx bx-search text-muted'></i>
              </span>
              <input type="text" name="search" value="{{ request('search') }}" class="form-control border-start-0"
                placeholder="Search jobs..." />
            </div>

            <!-- Type -->
            <select name="type" class="form-select form-select-sm" style="width:auto;">
              <option value="">All types</option>
              <option value="Full-time" {{ request('type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
              <option value="Contract" {{ request('type') == 'Contract' ? 'selected' : '' }}>Contract</option>
              <option value="Contract" {{ request('type') == 'Internship' ? 'selected' : '' }}>Internship</option>
              <option value="Contract" {{ request('type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
            </select>

            <!-- Submit -->
            <button type="submit" class="btn btn-sm btn-primary">Filter</button>

            <!-- Clear -->
            @if (request()->hasAny(['search', 'department', 'type']))
              <a href="{{ route('jobs') }}" class="btn btn-sm btn-outline-danger">Clear</a>
            @endif

          </div>
        </div>
      </form>
      <div class="card-body d-flex flex-column gap-3 pt-3">

        {{-- Job Card 1 --}}
        @forelse ($jobList as $item)
          <a href="{{ route('jobs-form', Crypt::encryptString($item->id)) }}"
            class="border rounded-3 p-3 text-decoration-none shadow">
            <div class="d-flex gap-3 align-items-start">

              <div class="w-100">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                  <div>
                    <div class="d-flex align-items-center gap-2 mb-1">
                      <h6 class="fw-semibold mb-0">{{ $item->title }}</h6>
                      <span class="badge text-bg-warning rounded-pill text-dark">{{ $item->status }}</span>
                    </div>
                    <p class="text-muted small mb-0">{{ $item->company }} &middot; {{ $item->location }}</p>
                  </div>
                  <span class="fw-semibold small">₱{{ number_format($item->salary, 2) }} / mo</span>
                </div>
                <div class="d-flex flex-wrap gap-2 mt-2">
                  <span class="badge rounded-pill text-bg-success">{{ $item->work_status }}</span>
                  <span class="badge rounded-pill text-bg-primary">{{ $item->work_arrangement }}</span>
                </div>
                <p class="text-muted small mt-2 mb-0">
                  {{ $item->description }}
                </p>
                <hr class="my-2" />
                <div class="d-flex justify-content-between align-items-end flex-wrap gap-2">
                  <div class="d-flex flex-wrap gap-3">
                    <span class="text-muted small d-flex align-items-center gap-1"><i
                        class='bx bx-time-five'></i>{{ $item->created_at->diffForHumans() }}</span>
                  </div>
                </div>
              </div>
            </div>
          </a>
        @empty
          <div class="mt-5">
            <h5 class="text-center lead">No Job Listing</h5>
          </div>
        @endforelse
      </div>
      <div class="card-footer bg-white d-flex justify-content-end align-items-center flex-wrap gap-2 py-2">
        {{ $jobList->onEachSide(2)->links() }}
      </div>
    </section>

  </div>
@endsection
