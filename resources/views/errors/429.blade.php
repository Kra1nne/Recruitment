{{-- 429.blade.php --}}
@extends('layouts/blankLayout')

@section('title', 'Too Many Requests - 429')

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/page-misc.scss'])
@endsection

@section('content')
  <div class="container-xxl container-p-y">
    <div class="misc-wrapper">
      <h1 class="mb-2 mx-2">429</h1>
      <h4 class="mb-2 mx-2">Too Many Requests 🚦</h4>
      <p class="mb-6 mx-2">
        You are sending requests too quickly. Please wait a moment.
      </p>

      <a href="{{ url('/') }}" class="btn btn-primary">
        Back to Home
      </a>

    </div>
  </div>
@endsection
