{{-- resources/views/errors/403.blade.php --}}
@extends('layouts/blankLayout')

@section('title', 'Forbidden - 403')

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/page-misc.scss'])
@endsection

@section('content')
  <div class="container-xxl container-p-y">
    <div class="misc-wrapper">
      <h1 class="mb-2 mx-2">403</h1>
      <h4 class="mb-2 mx-2">Access Denied 🚫</h4>
      <p class="mb-6 mx-2">You don't have permission to access this page.</p>

      <a href="{{ url('/') }}" class="btn btn-primary">
        Back to Home
      </a>

    </div>
  </div>
@endsection
