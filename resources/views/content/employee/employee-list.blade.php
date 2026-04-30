@extends('layouts/contentNavbarLayout')

@section('title', 'Employee List')

@section('content')
  <main style="background:#ffffff;" class="p-3 rounded-3">
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
      <div>
        <h5 class="fw-semibold mb-0">Employee</h5>
        <small class="text-muted">Manage all company employee</small>
      </div>
      <a href="{{ route('employee-form') }}" class="btn btn-primary btn-sm d-flex align-items-center gap-1">
        <i class='bx bx-plus'></i> Add Employee
      </a>
    </div>
    <div class="card-body p-0">
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
      <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap gap-2 py-3">
        <form method="GET" action="{{ route('employee-list') }}" class="d-flex gap-2 flex-wrap align-items-center">
          <div class="input-group input-group-sm" style="width:220px;">
            <span class="input-group-text bg-white"><i class='bx bx-search text-muted'></i></span>
            <input type="text" name="search" class="form-control border-start-0"
              placeholder="Search employee number..." />
          </div>
          <button class="btn btn-sm btn-outline-danger {{ $isSearch ? 'd-block' : 'd-none' }}"
            id="closeMark">Clear</button>
        </form>
      </div>
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th class="ps-3 small text-muted fw-semibold">#</th>
              <th class="small text-muted fw-semibold">Name</th>
              <th class="small text-muted fw-semibold">Employees #</th>
              <th class="small text-muted fw-semibold">Department</th>
              <th class="small text-muted fw-semibold">Position</th>
              <th class="small text-muted fw-semibold">Created</th>
              <th class="small text-muted fw-semibold text-end pe-3">Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($employeeList as $idex => $item)
              <tr>
                <td class="ps-3 text-muted small">{{ $idex + 1 }}</td>
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
                <td><span class="small">{{ $item->employee_id }}</span></td>
                <td><span class="small">{{ $item->department->dept_name }}</span></td>
                <td><span class="small">{{ $item->position }}</span></td>
                <td><span class="text-muted small">{{ date('M d, Y', strtotime($item->created_at)) }}</span></td>
                <td class="text-end pe-3">
                  <div class="d-flex gap-1 justify-content-end">
                    <a href="#" class="btn btn-outline-secondary btn-sm"><i class='bx bx-show'></i></a>
                    <a href="{{ route('employee-edit', Crypt::encryptString($item->id)) }}"
                      class="btn btn-outline-primary btn-sm"><i class='bx bx-edit'></i></a>
                    <form action="{{ route('employee-delete', $item->id) }}" method="POST" class="d-inline">
                      @csrf @method('DELETE')
                      <button type="submit" class="btn btn-outline-danger btn-sm"
                        onclick="return confirm('Delete this employee?')">
                        <i class='bx bx-trash'></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="text-center">No employee</td>
              </tr>
            @endforelse

          </tbody>
        </table>
      </div>
    </div>

    <div class="bg-white d-flex justify-content-end align-items-center flex-wrap gap-2 py-2">
      {{ $employeeList->onEachSide(2)->links() }}
    </div>
    </div>
  </main>
@endsection
