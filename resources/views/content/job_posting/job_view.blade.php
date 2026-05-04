@extends('layouts/contentNavbarLayout')

@section('title', 'Job View')

@section('content')
  <main style="background:#ffffff;" class="p-3 rounded-3">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
      <div>
        <h5 class="fw-semibold mb-0">Applicants</h5>
        <small class="text-muted">Manage all job applicants</small>
      </div>
      <a href="{{ route('job-form', $job_id) }}" class="btn btn-primary btn-sm d-flex align-items-center gap-1">
        <i class='bx bx-plus'></i> Add Applicant
      </a>
    </div>

    <div class="card border-0 shadow-sm">
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

      @if (session('warning'))
        <div class="alert alert-warning alert-dismissible fade show">
          {{ session('warning') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap gap-2 py-3">
        <form method="GET" action="{{ route('job-view', $job_id) }}" class="d-flex gap-2 flex-wrap align-items-center">
          <div class="input-group input-group-sm" style="width:220px;">
            <span class="input-group-text bg-white"><i class='bx bx-search text-muted'></i></span>
            <input type="text" name="search" class="form-control border-start-0" placeholder="Search applicant..." />
          </div>
          <button class="btn btn-sm btn-outline-danger {{ $isSearch ? 'd-block' : 'd-none' }}"
            id="closeMark">Reload</button>
        </form>
      </div>

      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th class="ps-3 small text-muted fw-semibold">#</th>
                <th class="small text-muted fw-semibold">Name</th>
                <th class="small text-muted fw-semibold">Phone #</th>
                <th class="small text-muted fw-semibold">Status</th>
                <th class="small text-muted fw-semibold">Applied Date</th>
                <th class="small text-muted fw-semibold text-end pe-3">Actions</th>
              </tr>
            </thead>
            <tbody>

              @forelse ($jobApplicants as $index => $item)
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
                  <td><span class="badge text-bg-light text-dark border small">{{ $item->person->phone_number }}</span>
                  </td>
                  <td><span class="badge rounded-pill {{ $item->applicantStatus() }}">{{ $item->status }}</span>
                    @if (!empty($item->latestApplicantLogs?->assessment_type))
                      <span class="badge rounded-pill text-bg-secondary">
                        {{ $item->latestApplicantLogs->assessment_type }}
                      </span>
                    @endif
                  </td>
                  <td><span class="text-muted small"></span>{{ $item->date }}</td>
                  <td class="text-end pe-3">
                    @if ($item->status == 'Apply')
                      <div class="d-flex gap-1 justify-content-end">
                        <a href="{{ route('job-assessment', Crypt::encryptString($item->id)) }}"
                          class="btn btn-outline-primary btn-sm"><i class='bx bx-edit'></i></a>
                        <form action="{{ route('job-accepted', Crypt::encryptString($item->id)) }}" method="POST"
                          style="display:inline;">
                          @csrf
                          <button type="submit" class="btn btn-outline-success btn-sm"
                            onclick="return confirm('Accept this applicant?')">
                            <i class='bx bx-check'></i>
                          </button>
                        </form>
                        <form action="{{ route('job-reject', Crypt::encryptString($item->id)) }}" method="POST"
                          style="display:inline;">
                          @csrf
                          <button type="submit" class="btn btn-outline-danger btn-sm"
                            onclick="return confirm('Reject this applicant?')">
                            <i class='bx bx-trash'></i>
                          </button>
                        </form>
                      </div>
                    @endif
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center">No Applicant</td>
                </tr>
              @endforelse


            </tbody>
          </table>
        </div>
      </div>

      <div class="card-footer bg-white d-flex justify-content-end align-items-center flex-wrap gap-2 py-2">
        {{ $jobApplicants->onEachSide(2)->links() }}
      </div>
    </div>
    </div>
  @endsection
