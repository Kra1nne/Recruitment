@extends('layouts/contentNavbarLayout')

@section('title', 'Account Form')

@section('content')
  <div class="mt-4">
    <div class="card shadow-sm border-0" style="background-color: #ffffff;">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0 text-white">Create Account</h5>
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
        <form action="{{ route('account-add') }}" method="POST">
          @csrf

          <!-- Username -->
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}"
              placeholder="Enter username" required>
          </div>

          <!-- Password -->
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password"
              required>
          </div>

          <!-- Confirm Password -->
          <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
              placeholder="Confirm password" required>
          </div>

          <!-- Employee Selection -->
          <div class="mb-3">
            <label for="person_id" class="form-label">Select Employee</label>
            <select class="form-select" id="person_id" name="person_id" required>
              <option value="">-- Select Employee --</option>
              @foreach ($employees as $employee)
                <option value="{{ $employee->person_id }}"
                  {{ old('person_id') == $employee->person_id ? 'selected' : '' }}>
                  {{ $employee->person->first_name }} {{ $employee->person->middle_name[0] }}
                  {{ $employee->person->last_name }} - {{ $employee->employee_id }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="employee_id" class="form-label">Select Role</label>
            <select class="form-select" id="role" name="role" required>
              <option value="">-- Select Role --</option>
              <option value="Admin">Admin</option>
              <option value="Hr">Hr</option>
              <option value="Employee">Employee</option>
            </select>
          </div>

          <!-- Submit Button -->
          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">
              Save Account
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>
@endsection
