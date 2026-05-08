{{-- resources/views/errors/401.blade.php --}}
@extends('layouts/blankLayout')

@section('title', 'Unauthorized - 401')

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/page-misc.scss'])
@endsection

@section('content')
  <div class="container-xxl container-p-y">
    <div class="misc-wrapper">
      <h1 class="mb-2 mx-2">401</h1>
      <h4 class="mb-2 mx-2">Unauthorized 🔒</h4>
      <p class="mb-6 mx-2">Please login to continue.</p>

      <a href="{{ url('/login') }}" class="btn btn-primary">
        Login
      </a>

    </div>
  </div>
@endsection
