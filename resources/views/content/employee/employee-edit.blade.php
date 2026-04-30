@extends('layouts/contentNavbarLayout')

@section('title', 'Employee Form')

@section('content')
  <div class="mt-4">
    <div class="card shadow-sm border-0" style="background-color: #ffffff;">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0 text-white">Edit Employee</h5>
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
        <form action="{{ route('employee-update') }}" method="POST">
          @csrf

          <div class="row">
            <!-- Title -->
            <input type="hidden" name="id" value="{{ $employeeData->id }}">
            <input type="hidden" name="person_id" value="{{ $employeeData->person->id }}">
            <h5>Personal Details</h5>
            <div class="col-md-4 mb-3">
              <label class="form-label">First Name</label>
              <input type="text" name="first_name" value="{{ $employeeData->person->first_name }}" class="form-control"
                placeholder="Enter first name" required>
            </div>

            <div class="col-md-4 mb-3">
              <label class="form-label">Middle Name</label>
              <input type="text" name="middle_name" value="{{ $employeeData->person->middle_name }}"
                class="form-control" placeholder="Enter middle name" required>
            </div>

            <div class="col-md-4 mb-3">
              <label class="form-label">Last Name</label>
              <input type="text" name="last_name" class="form-control" value="{{ $employeeData->person->last_name }}"
                placeholder="Enter last name" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Gender</label>
              <select name="gender" class="form-select" required>
                <option value="">Select gender</option>
                <option value="M" {{ $employeeData->person->gender == 'M' ? 'selected' : '' }}>M</option>
                <option value="F" {{ $employeeData->person->gender == 'F' ? 'selected' : '' }}>F</option>
              </select>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Brth Date</label>
              <input type="date" name="birth_date" value="{{ $employeeData->person->birth_date }}"
                class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Blood Type</label>
              <select name="blood_type" class="form-select" required>
                <option value="">Select blood type</option>
                <option value="A+" {{ $employeeData->person->blood_type == 'A+' ? 'selected' : '' }}>A+</option>
                <option value="A-" {{ $employeeData->person->blood_type == 'A-' ? 'selected' : '' }}>A-</option>
                <option value="B+" {{ $employeeData->person->blood_type == 'B+' ? 'selected' : '' }}>B+</option>
                <option value="B-" {{ $employeeData->person->blood_type == 'B+' ? 'selected' : '' }}>B-</option>
                <option value="AB+" {{ $employeeData->person->blood_type == 'AB+' ? 'selected' : '' }}>AB+</option>
                <option value="AB-" {{ $employeeData->person->blood_type == 'AB-' ? 'selected' : '' }}>AB-</option>
                <option value="O+" {{ $employeeData->person->blood_type == 'O+' ? 'selected' : '' }}>O+</option>
                <option value="O-" {{ $employeeData->person->blood_type == 'O-' ? 'selected' : '' }}>O-</option>
              </select>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Phone Number</label>
              <input type="text" name="phone_number" value="{{ $employeeData->person->phone_number }}"
                class="form-control" placeholder="Enter phone number" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Email</label>
              <input type="text" name="email" value="{{ $employeeData->person->email }}" class="form-control"
                placeholder="Enter email" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Address</label>
              <input type="text" name="address" class="form-control" value="{{ $employeeData->person->address }}"
                placeholder="Enter address" required>
            </div>


            <h5>Employee Details</h5>
            <!-- Position -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Department</label>
              <select name="department" class="form-select" required>
                <option value="">Select department</option>
                @foreach ($departmentList as $item)
                  <option value="{{ $item->id }}"
                    {{ $employeeData->department->id == $item->id ? 'selected' : '' }}>{{ $item->dept_name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Employee Number</label>
              <input type="text" name="emp_no" value="{{ $employeeData->employee_id }}" class="form-control"
                placeholder="Enter employee number" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Position</label>
              <input type="text" name="position" value="{{ $employeeData->position }}" class="form-control"
                placeholder="Enter position" required>
            </div>

            <!-- Salary -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Salary</label>
              <input type="number" value="{{ $employeeData->salary }}" name="salary" class="form-control"
                placeholder="Enter salary" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Work Status</label>
              <select name="work_status" class="form-select" required>
                <option value="">Select status</option>
                <option value="Full-time" {{ $employeeData->work_status == 'Full-time' ? 'selected' : '' }}>Full-time
                </option>
                <option value="Part-time" {{ $employeeData->work_status == 'Part-time' ? 'selected' : '' }}>Part-time
                </option>
                <option value="Contract" {{ $employeeData->work_status == 'Contract' ? 'selected' : '' }}>Contract
                </option>
                <option value="Internship" {{ $employeeData->work_status == 'Internship' ? 'selected' : '' }}>Internship
                </option>
              </select>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Work Arrangement</label>
              <select name="work_arrangement" class="form-select" required>
                <option value="">Select arrangement</option>
                <option value="On-site" {{ $employeeData->work_arrangement == 'On-site' ? 'selected' : '' }}>On-site
                </option>
                <option value="Remote" {{ $employeeData->work_arrangement == 'Remote' ? 'selected' : '' }}>Remote
                </option>
                <option value="Hybrid" {{ $employeeData->work_arrangement == 'Hybrid' ? 'selected' : '' }}>Hybrid
                </option>
              </select>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Employement Date</label>
              <input type="date" name="date" value="{{ $employeeData->start_date }}" class="form-control"
                required>
            </div>

            <!-- Submit -->
            <div class="d-flex justify-content-end">
              <button type="submit" class="btn btn-primary">
                Save Employee
              </button>
            </div>

        </form>
      </div>
    </div>
  </div>
@endsection
