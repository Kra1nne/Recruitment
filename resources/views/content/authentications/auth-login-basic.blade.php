@extends('layouts/blankLayout')

@section('title', 'Login Basic - Pages')

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
@endsection

@section('content')
  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card px-sm-6 px-0">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <a href="{{ url('/') }}" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">@include('_partials.macros')</span>
                <span class="app-brand-text demo text-heading fw-bold">{{ config('variables.templateName') }}</span>
              </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-1">Welcome to {{ config('variables.templateName') }}! 👋</h4>
            @if ($errors->any())
              <div class="alert alert-danger alert-dismissible fade show">
                {{ $errors->first() }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              </div>
            @endif
            <form id="formAuthentication" class="mb-6" action="{{ route('login-process') }}" method="post">
              @csrf
              <div class="mb-3">
                <label for="email" class="form-label">Username</label>
                <input type="text" class="form-control" value="{{ old('username') }}" id="username" name="username"
                  placeholder="Enter your username" autofocus />
              </div>
              <div class="mb-3 form-password-toggle">
                <label class="form-label" for="password">Password</label>
                <div class="input-group input-group-merge">
                  <input type="password" value="{{ old('password') }}" id="password" class="form-control" name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password" />
                  <span class="input-group-text cursor-pointer"><i class="icon-base bx bx-hide"></i></span>
                </div>
              </div>
              <div class="mb-3">
                <div class="d-flex justify-content-between">
                  <div class="form-check mb-0">
                    <input class="form-check-input" type="checkbox" id="remember-me" />
                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                  </div>
                  {{-- <a href="{{ url('forgot-password-basic') }}">
                    <span>Forgot Password?</span>
                  </a> --}}
                </div>
              </div>
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
              </div>
              <div class="mb-3 text-center">
                <span class="text-muted">or</span>
              </div>

              <div class="d-grid">
                <a href="#" class="btn btn-outline-danger d-flex align-items-center justify-content-center gap-2">
                  <i class="bx bxl-google"></i>
                  <span>Sign in with Google</span>
                </a>
              </div>
            </form>
          </div>
        </div>
        <!-- /Register -->
      </div>
    </div>
  </div>
@endsection
