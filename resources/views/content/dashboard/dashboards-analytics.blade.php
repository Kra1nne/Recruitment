@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('content')
  <main style="background:#ffffff;" class="p-3 rounded-3">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
      <div>
        <h5 class="fw-semibold mb-0">Dashboard</h5>
        <small class="text-muted">Manage all company assests</small>
      </div>
    </div>

    {{-- Stats Row --}}
    <div class="row g-3 mb-3">
      <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm p-3 text-center">
          <div class="text-muted small mb-1">Total Departments</div>
          <div class="fw-semibold fs-5">{{ $departmantCount ?? 0 }}</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm p-3 text-center">
          <div class="text-muted small mb-1">Total Job Postings</div>
          <div class="fw-semibold fs-5 text-success">{{ $jobCount ?? 0 }}</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm p-3 text-center">
          <div class="text-muted small mb-1">Total Applicants</div>
          <div class="fw-semibold fs-5 text-danger">{{ $applicantsCount ?? 0 }}</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm p-3 text-center">
          <div class="text-muted small mb-1">Total Employees</div>
          <div class="fw-semibold fs-5">{{ $employeeCount ?? 0 }}</div>
        </div>
      </div>
    </div>

    <div class="card border-0 shadow-sm">

      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th class="ps-3 small text-muted fw-semibold">#</th>
                <th class="small text-muted fw-semibold">Name</th>
                <th class="small text-muted fw-semibold">Work Arragement</th>
                <th class="small text-muted fw-semibold">Work Status</th>
                <th class="small text-muted fw-semibold">Position</th>
                <th class="small text-muted fw-semibold">Date</th>
                <th class="small text-muted fw-semibold">Status</th>
              </tr>
            </thead>
            <tbody>


              @forelse ($applicants as $index => $item)
                <tr>
                  <td class="ps-3 text-muted small">{{ $index + 1 }}</td>
                  <td>
                    <div class="d-flex align-items-center gap-2">
                      <div
                        class="bg-primary bg-opacity-10 text-primary rounded-2 d-flex align-items-center justify-content-center"
                        style="width:34px;height:34px;">
                        <i class='bx bx-user'></i>
                      </div>
                      <div>
                        <div class="fw-semibold small">{{ $item->person->first_name }} {{ $item->person->middle_name[0] }}
                          {{ $item->person->last_name }}</div>
                        <div class="text-muted" style="font-size:11px;">{{ $item->person->email }}</div>
                      </div>
                    </div>
                  </td>
                  <td><span class="small">{{ $item->job->work_arrangement }}</span></td>
                  <td><span class="small">{{ $item->job->work_status }}</span></td>
                  <td><span class="small">{{ $item->job->position }}</span></td>
                  <td><span class="text-muted small">{{ date('M d, Y', strtotime($item->date)) }}</span></td>
                  <td><span class="badge rounded-pill {{ $item->applicantStatus() }}">{{ $item->status }}</span></td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="text-center">No Applicants</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      <div class="card-footer bg-white d-flex justify-content-end align-items-center flex-wrap gap-2 py-2">
        {{ $applicants->onEachSide(2)->links() }}
      </div>
    </div>
    </div>
  @endsection
