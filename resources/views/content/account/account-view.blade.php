@extends('layouts/contentNavbarLayout')

@section('title', 'Account View')

@section('content')
  <div class="flex-grow-1">
    <div class="row">
      <div class="col-md-12">

        {{-- Header Card --}}
        <div class="card mb-4">
          <div class="card-body d-flex align-items-center gap-4">
            <div class="avatar avatar-xl">
              <span class="avatar-initial rounded-circle bg-label-primary fs-3">JC</span>
            </div>
            <div class="flex-grow-1">
              <h5 class="mb-1">{{ $employeeData->person->first_name }} {{ $employeeData->person->middle_name[0] }}
                {{ $employeeData->person->last_name }}</h5>
              <p class="text-muted mb-2">{{ $employeeData->position }} · {{ $employeeData->department->dept_name }}</p>
              <span class="badge bg-label-success">Active</span>
              <span class="badge bg-label-secondary ms-1">{{ $employeeData->work_arrangement }}</span>
              <span class="badge bg-label-secondary ms-1">{{ $employeeData->work_status }}</span>
            </div>
            <div class="text-end">
              <small class="text-muted d-block">{{ $employeeData->employee_id }}</small>
              <small class="text-muted">Hired {{ date('M, d Y', strtotime($employeeData->start_date)) }}</small>
            </div>
          </div>
        </div>

        {{-- User Details --}}
        <div class="card mb-4">
          <div class="card-body">
            <h6 class="text-uppercase text-muted small mb-4">Account Details</h6>
            <div class="row g-3">
              <div class="col-md-6">
                <p class="text-muted small mb-1">Email</p>
                <p class="fw-medium mb-0">{{ $employeeData->person->email }}</p>
              </div>
              <div class="col-md-6">
                <p class="text-muted small mb-1">Username</p>
                <p class="fw-medium mb-0">{{ $employeeData->person->user->username }}</p>
              </div>
              <div class="col-md-6">
                <p class="text-muted small mb-1">Role</p>
                <p class="fw-medium mb-0">{{ $employeeData->person->user->role }}</p>
              </div>
              <div class="col-md-6">
                <p class="text-muted small mb-1">Password</p>
                <p class="fw-medium mb-0">****************</p>
              </div>
              <div class="col-md-6">
                <p class="text-muted small mb-1">Date Created</p>
                <p class="fw-medium mb-0">{{ date('M d, Y', strtotime($employeeData->person->user->created_at)) }}</p>
              </div>
            </div>
          </div>
        </div>

        {{-- Personal Details --}}
        <div class="card mb-4">
          <div class="card-body">
            <h6 class="text-uppercase text-muted small mb-4">Personal Details</h6>
            <div class="row g-3">
              <div class="col-md-6">
                <p class="text-muted small mb-1">Full name</p>
                <p class="fw-medium mb-0">{{ $employeeData->person->first_name }}
                  {{ $employeeData->person->middle_name }}
                  {{ $employeeData->person->last_name }}</p>
              </div>
              <div class="col-md-6">
                <p class="text-muted small mb-1">Date of birth</p>
                <p class="fw-medium mb-0">{{ $employeeData->person->birth_date }}</p>
              </div>
              <div class="col-md-6">
                <p class="text-muted small mb-1">Gender</p>
                <p class="fw-medium mb-0">{{ $employeeData->person->gender }}</p>
              </div>
              <div class="col-md-6">
                <p class="text-muted small mb-1">Nationality</p>
                <p class="fw-medium mb-0">Filipino</p>
              </div>
              <div class="col-md-6">
                <p class="text-muted small mb-1">Email address</p>
                <p class="fw-medium mb-0">{{ $employeeData->person->email }}</p>
              </div>
              <div class="col-md-6">
                <p class="text-muted small mb-1">Phone number</p>
                <p class="fw-medium mb-0">{{ $employeeData->person->phone_number }}</p>
              </div>
              <div class="col-12">
                <p class="text-muted small mb-1">Home address</p>
                <p class="fw-medium mb-0">{{ $employeeData->person->address }}</p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
@endsection
