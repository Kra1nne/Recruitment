@extends('layouts/contentNavbarLayout')

@section('title', 'Employee Form')

@section('content')
  <div class="mt-4">
    <div class="card shadow-sm border-0" style="background-color: #ffffff;">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0 text-white">Create Employee</h5>
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
        <form action="{{ route('employee-add') }}" method="POST">
          @csrf

          <div class="row">
            <h5>Personal Details</h5>

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

            <h5>Employee Details</h5>

            <div class="col-md-6 mb-3">
              <label class="form-label">Department</label>
              <select name="department" class="form-select" required>
                <option value="">Select department</option>
                @foreach ($departmentList as $item)
                  <option value="{{ $item->id }}" {{ old('department') == $item->id ? 'selected' : '' }}>
                    {{ $item->dept_name }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Employee Number</label>
              <input type="text" name="emp_no" value="{{ old('emp_no') }}" class="form-control"
                placeholder="Enter employee number" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Position</label>
              <input type="text" name="position" value="{{ old('position') }}" class="form-control"
                placeholder="Enter position" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Salary</label>
              <input type="number" name="salary" value="{{ old('salary') }}" class="form-control"
                placeholder="Enter salary" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Work Status</label>
              <select name="work_status" class="form-select" required>
                <option value="">Select status</option>
                @foreach (['Full-time', 'Part-time', 'Contract', 'Internship'] as $status)
                  <option value="{{ $status }}" {{ old('work_status') == $status ? 'selected' : '' }}>
                    {{ $status }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Work Arrangement</label>
              <select name="work_arrangement" class="form-select" required>
                <option value="">Select arrangement</option>
                @foreach (['On-site', 'Remote', 'Hybrid'] as $arr)
                  <option value="{{ $arr }}" {{ old('work_arrangement') == $arr ? 'selected' : '' }}>
                    {{ $arr }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Employement Date</label>
              <input type="date" name="date" value="{{ old('date') }}" class="form-control" required>
            </div>

            <div class="d-flex justify-content-end">
              <button type="submit" class="btn btn-primary">
                Save Employee
              </button>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
