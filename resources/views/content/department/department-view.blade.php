@extends('layouts/contentNavbarLayout')

@section('title', 'Department View')

@section('content')
  <main style="background:#ffffff;" class="p-3 rounded-3">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
      <div>
        <h5 class="fw-semibold mb-0">Department</h5>
        <small class="text-muted">List of the employees in the company departments</small>
      </div>
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
        <form method="GET" action="{{ route('department-view', $encrypted_id) }}"
          class="d-flex gap-2 flex-wrap align-items-center">
          <div class="input-group input-group-sm" style="width:220px;">
            <span class="input-group-text bg-white"><i class='bx bx-search text-muted'></i></span>
            <input type="text" name="search" class="form-control border-start-0"
              placeholder="Search employee Id..." />
          </div>
          <button class="btn btn-sm btn-outline-danger {{ $isSearch ? 'd-block' : 'd-none' }}"
            id="closeMark">Clear</button>
        </form>
      </div>

      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th class="ps-3 small text-muted fw-semibold">#</th>
                <th class="small text-muted fw-semibold">Name</th>
                <th class="small text-muted fw-semibold">Position</th>
                <th class="small text-muted fw-semibold">Salary</th>
                <th class="small text-muted fw-semibold">Employee #</th>
                <th class="small text-muted fw-semibold">Status</th>
                <th class="small text-muted fw-semibold">Created</th>
              </tr>
            </thead>
            <tbody>


              @forelse ($departmentEmployee as $index => $item)
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
                  <td class="text-muted small">{{ $item->position }}</td>
                  <td class="text-muted small">₱ {{ number_format($item->salary, 2) }} /Monthly</td>
                  <td><span class="badge text-bg-light text-dark border small">{{ $item->employee_id }}</span>
                  </td>
                  <td><span class="badge rounded-pill text-bg-success">Active</span></td>
                  <td><span class="text-muted small">{{ date('M d, Y', strtotime($item->created_at)) }}</span></td>
                  {{-- <td class="text-end pe-3">
                    <div class="d-flex gap-1 justify-content-end">
                      <form action="#" method="POST" style="display:inline;">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm"
                          onclick="return confirm('Remove this employee?')">
                          <i class='bx bx-trash'></i>
                        </button>
                      </form>
                    </div>
                  </td> --}}
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="text-center">No Employee</td>
                </tr>
              @endforelse


            </tbody>
          </table>
        </div>
      </div>

      <div class="card-footer bg-white d-flex justify-content-end align-items-center flex-wrap gap-2 py-2">
        {{ $departmentEmployee->onEachSide(2)->links() }}
      </div>
    </div>
    </div>
  @endsection
