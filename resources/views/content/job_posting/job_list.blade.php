@extends('layouts/contentNavbarLayout')

@section('title', 'Job List')

@section('content')
  <section class="card border-0 shadow-sm p-3 ">
    <div class="rounded-3">

      {{-- Page Header --}}
      <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <div>
          <h5 class="fw-semibold mb-0 ">Job Listings</h5>
          <small class="text-muted">Manage all open positions</small>
        </div>
        <a href="{{ route('job-posting-form') }}" class="btn btn-primary btn-sm d-flex align-items-center gap-1">
          <i class='bx bx-plus'></i> Add Job
        </a>
      </div>

      <div class="">
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

        <form method="GET" action="{{ route('job-posting') }}">
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
                <a href="{{ route('job-posting') }}" class="btn btn-sm btn-outline-danger">Clear</a>
              @endif

            </div>
          </div>
        </form>

        <div class="card-body d-flex flex-column gap-3 pt-3">

          {{-- Job Card 1 --}}
          @forelse ($jobList as $item)
            <div class="border rounded-3 p-3">
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
                      <span class="text-muted small d-flex align-items-center gap-1"><i class='bx bx-user-check'></i>
                        {{ $item->applicants->count() ?? 0 }}
                        applicants</span>
                    </div>
                    <div class="d-flex flex-column flex-sm-row gap-2">
                      <a href="#" class="btn btn-outline-primary btn-sm d-flex align-items-center gap-1"><i
                          class='bx bx-show'></i>
                        View</a>
                      <a href="{{ route('job-posting-edit', Crypt::encryptString($item->id)) }}"
                        class="btn btn-outline-primary btn-sm d-flex align-items-center gap-1"><i class='bx bx-edit'></i>
                        Edit</a>
                      <form action="{{ route('job-posting-delete', $item->id) }}" method="post" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1"><i
                            class='bx bx-trash'></i> Delete</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @empty
            <div class="mt-5">
              <h5 class="text-center lead">No Job Listing</h5>
            </div>
          @endforelse
        </div>
        <div class="card-footer bg-white d-flex justify-content-end align-items-center flex-wrap gap-2 py-2">
          {{ $jobList->onEachSide(2)->links() }}
        </div>
      </div>

    </div>
  </section>
@endsection
