@extends('layouts/contentNavbarLayout')

@section('title', 'Department List')

@section('content')
  <main style="background:#ffffff;" class="p-3 rounded-3">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
      <div>
        <h5 class="fw-semibold mb-0">Departments</h5>
        <small class="text-muted">Manage all company departments</small>
      </div>
      <a href="{{ route('department-form') }}" class="btn btn-primary btn-sm d-flex align-items-center gap-1">
        <i class='bx bx-plus'></i> Add Department
      </a>
    </div>

    {{-- Stats Row --}}
    <div class="row g-3 mb-3">
      <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm p-3 text-center">
          <div class="text-muted small mb-1">Total Departments</div>
          <div class="fw-semibold fs-5">{{ $query->count() ?? 0 }}</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm p-3 text-center">
          <div class="text-muted small mb-1">Active</div>
          <div class="fw-semibold fs-5 text-success">{{ $activeCount ?? 0 }}</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm p-3 text-center">
          <div class="text-muted small mb-1">Inactive</div>
          <div class="fw-semibold fs-5 text-danger">{{ $inactiveCount ?? 0 }}</div>
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
        <form method="GET" action="{{ route('department-list') }}" class="d-flex gap-2 flex-wrap align-items-center">
          <div class="input-group input-group-sm" style="width:220px;">
            <span class="input-group-text bg-white"><i class='bx bx-search text-muted'></i></span>
            <input type="text" name="search" class="form-control border-start-0"
              placeholder="Search departments..." />
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
                <th class="small text-muted fw-semibold">Department</th>
                <th class="small text-muted fw-semibold">Employees</th>
                <th class="small text-muted fw-semibold">Status</th>
                <th class="small text-muted fw-semibold">Created</th>
                <th class="small text-muted fw-semibold text-end pe-3">Actions</th>
              </tr>
            </thead>
            <tbody>


              @forelse ($departmentList as $index => $item)
                <tr>
                  <td class="ps-3 text-muted small">{{ $index + 1 }}</td>
                  <td>
                    <div class="d-flex align-items-center gap-2">
                      <div
                        class="bg-primary bg-opacity-10 text-primary rounded-2 d-flex align-items-center justify-content-center"
                        style="width:34px;height:34px;">
                        <i class='bx bx-buildings'></i>
                      </div>
                      <div>
                        <div class="fw-semibold small">{{ $item->dept_name }}</div>
                        <div class="text-muted" style="font-size:11px;">{{ $item->description }}</div>
                      </div>
                    </div>
                  </td>
                  <td><span
                      class="badge text-bg-light text-dark border small">{{ $item->employees->count() ?? 0 }}</span>
                  </td>
                  <td><span class="badge rounded-pill text-bg-success">Active</span></td>
                  <td><span class="text-muted small">{{ date('M d, Y', strtotime($item->date)) }}</span></td>
                  <td class="text-end pe-3">
                    <div class="d-flex gap-1 justify-content-end">
                      <a href="{{ route('department-view', Crypt::encryptString($item->id)) }}"
                        class="btn btn-outline-secondary btn-sm"><i class='bx bx-show'></i></a>
                      <a href="{{ route('department-form-edit', Crypt::encryptString($item->id)) }}"
                        class="btn btn-outline-primary btn-sm"><i class='bx bx-edit'></i></a>
                      <form action="{{ route('department-delete', Crypt::encryptString($item->id)) }}" method="POST"
                        style="display:inline;">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm"
                          onclick="return confirm('Delete this department?')">
                          <i class='bx bx-trash'></i>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center">No Department</td>
                </tr>
              @endforelse


            </tbody>
          </table>
        </div>
      </div>

      <div class="card-footer bg-white d-flex justify-content-end align-items-center flex-wrap gap-2 py-2">
        {{ $departmentList->onEachSide(2)->links() }}
      </div>
    </div>
    </div>
  @endsection
