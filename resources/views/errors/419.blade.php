{{-- 419.blade.php --}}
@extends('layouts/blankLayout')

@section('title', 'Page Expired - 419')

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/page-misc.scss'])
@endsection

@section('content')
  <div class="container-xxl container-p-y">
    <div class="misc-wrapper">
      <h1 class="mb-2 mx-2">419</h1>
      <h4 class="mb-2 mx-2">Page Expired ⌛</h4>
      <p class="mb-6 mx-2">
        Your session has expired. Please refresh and try again.
      </p>

      <a href="{{ url()->current() }}" class="btn btn-primary">
        Refresh Page
      </a>

    </div>
  </div>
@endsection
