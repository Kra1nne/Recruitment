{{-- resources/views/errors/500.blade.php --}}
@extends('layouts/blankLayout')

@section('title', 'Server Error - 500')

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/page-misc.scss'])
@endsection

@section('content')
  <div class="container-xxl container-p-y">
    <div class="misc-wrapper">
      <h1 class="mb-2 mx-2">500</h1>
      <h4 class="mb-2 mx-2">Internal Server Error 💥</h4>
      <p class="mb-6 mx-2">Something went wrong on our server.</p>

      <a href="{{ url('/') }}" class="btn btn-primary">
        Back to Home
      </a>

    </div>
  </div>
@endsection
