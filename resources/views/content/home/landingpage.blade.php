@extends('layouts/homePageLayout')

@section('title', 'Home Page')

@section('content')


  {{-- ══════════════════════════════════════
     NAVBAR
══════════════════════════════════════ --}}
  <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top shadow-sm">
    <div class="container">

      {{-- Logo (Left) --}}
      <a class="navbar-brand d-flex align-items-center gap-2 fw-bold fs-4" href="#">
        <span class="app-brand-logo demo">@include('_partials.macros')</span>
        <span class="text-primary">Empathra</span>
      </a>

      {{-- Toggler --}}
      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mainNav">

        {{-- Center Links --}}
        <ul class="navbar-nav mx-auto gap-1">
          <li class="nav-item">
            <a class="nav-link fw-semibold text-primary active" href="{{ route('home') }}">
              <i class="bi bi-house-door me-1"></i>Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-semibold text-secondary" href="{{ route('jobs') }}">
              <i class="bi bi-briefcase me-1"></i>Jobs
            </a>
          </li>
        </ul>

        {{-- Login (Right) --}}
        @if (Auth::user())
          <div class="d-flex">
            <a href="{{ route('logout-process') }}" class="btn btn-primary fw-semibold px-4">
              <i class="bi bi-box-arrow-in-left me-1"></i>Logout
            </a>
          </div>
        @else
          <div class="d-flex">
            <a href="{{ route('login') }}" class="btn btn-primary fw-semibold px-4">
              <i class="bi bi-box-arrow-in-right me-1"></i>Login
            </a>
          </div>
        @endif


      </div>
    </div>
  </nav>

  {{-- ══════════════════════════════════════
     HERO
══════════════════════════════════════ --}}
  <section class="bg-white py-5" style="margin-top: 80px; margin-botton: 100px">
    <div class="container py-4">
      <div class="row align-items-center g-5">

        {{-- Left: Text --}}
        <div class="col-lg-6 text-center text-lg-start">
          <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary px-3 py-2 mb-3 fs-6 fw-normal">
            <i class="bi bi-stars me-1"></i> Smart Recruitment, Simplified
          </span>
          <h1 class="display-4 fw-bold lh-sm mb-3 text-dark">
            Hire with <span class="text-primary">Empathy.</span><br>
            Hire with <span class="text-primary">Speed.</span>
          </h1>
          <p class="lead text-secondary mb-4">
            This system is an online recruitment platform that puts people first —
            streamlining hiring so you can focus on building the right team.
          </p>
          <div class="d-flex gap-3 justify-content-center justify-content-lg-start flex-wrap">
            <a href="#" class="btn btn-primary btn-lg fw-semibold px-5">
              Get Started Free
            </a>
          </div>
        </div>

        {{-- Right: Illustration Card --}}
        <div class="col-lg-6 d-flex justify-content-center">
          <div class="rounded-4 p-4 shadow-sm border text-center w-100 bg-primary bg-opacity-10" style="max-width:420px;">
            <i class="bi bi-people-fill mb-3 d-block text-primary" style="font-size:5rem;"></i>
            <h5 class="fw-bold mb-1 text-dark">Your next great hire is here</h5>
            <p class="text-muted small mb-3">Over 5,000 companies already trust Empathra to build their dream teams.</p>
            <div class="d-flex justify-content-center gap-3">
              <div class="text-center">
                <div class="fw-bold fs-5 text-primary">50k+</div>
                <div class="text-muted small">Candidates</div>
              </div>
              <div class="vr"></div>
              <div class="text-center">
                <div class="fw-bold fs-5 text-primary">5k+</div>
                <div class="text-muted small">Companies</div>
              </div>
              <div class="vr"></div>
              <div class="text-center">
                <div class="fw-bold fs-5 text-primary">98%</div>
                <div class="text-muted small">Satisfaction</div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
    <div class="py-3 mt-10">
      <div class="container text-center  text-dark fw-semibold fs-6">
        <i class="bi bi-shield-check me-2"></i>
        Trusted by HR teams in 20+ countries &nbsp;·&nbsp;
        <i class="bi bi-lightning-charge-fill me-2 ms-2"></i>
        Average time-to-hire reduced by 40% &nbsp;·&nbsp;
        <i class="bi bi-award me-2 ms-2"></i>
        #1 Recruitment Platform 2024
      </div>
    </div>
  </section>

  <section class="bg-white py-5">
    <div class="container py-3">
      <div class="text-center mb-5">
        <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary px-3 py-2 mb-2">
          Why Empathra?
        </span>
        <h2 class="fw-bold text-dark">Everything you need to hire better</h2>
        <p class="text-muted mx-auto" style="max-width:520px;">
          From job posting to offer letter, Empathra handles your entire recruitment workflow in one seamless platform.
        </p>
      </div>

      <div class="row g-4">

        <div class="col-md-6 col-lg-4">
          <div class="card border-0 shadow-sm h-100 rounded-4 p-2">
            <div class="card-body">
              <div
                class="rounded-3 d-inline-flex align-items-center justify-content-center mb-3 p-3 bg-primary bg-opacity-10">
                <i class="bi bi-person-check fs-3 text-primary"></i>
              </div>
              <h5 class="fw-bold text-dark">Smart Candidate Matching</h5>
              <p class="text-muted small mb-0">Our platform ranks candidates based on skills, experience, and role
                requirements — so you only review the most relevant applicants.</p>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="card border-0 shadow-sm h-100 rounded-4 p-2">
            <div class="card-body">
              <div
                class="rounded-3 d-inline-flex align-items-center justify-content-center mb-3 p-3 bg-primary bg-opacity-10">
                <i class="bi bi-calendar2-check fs-3 text-primary"></i>
              </div>
              <h5 class="fw-bold text-dark">Automated Scheduling</h5>
              <p class="text-muted small mb-0">Eliminate back-and-forth emails. Candidates self-schedule interviews based
                on your team's real-time availability.</p>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="card border-0 shadow-sm h-100 rounded-4 p-2">
            <div class="card-body">
              <div
                class="rounded-3 d-inline-flex align-items-center justify-content-center mb-3 p-3 bg-primary bg-opacity-10">
                <i class="bi bi-bar-chart-line fs-3 text-primary"></i>
              </div>
              <h5 class="fw-bold text-dark">Hiring Analytics</h5>
              <p class="text-muted small mb-0">Track every stage of your pipeline with real-time dashboards. Know exactly
                where candidates are and act faster.</p>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="card border-0 shadow-sm h-100 rounded-4 p-2">
            <div class="card-body">
              <div
                class="rounded-3 d-inline-flex align-items-center justify-content-center mb-3 p-3 bg-primary bg-opacity-10">
                <i class="bi bi-chat-dots fs-3 text-primary"></i>
              </div>
              <h5 class="fw-bold text-dark">Candidate Messaging</h5>
              <p class="text-muted small mb-0">Communicate with all your applicants in one place. Send updates,
                reminders, and offer letters without leaving the platform.</p>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="card border-0 shadow-sm h-100 rounded-4 p-2">
            <div class="card-body">
              <div
                class="rounded-3 d-inline-flex align-items-center justify-content-center mb-3 p-3 bg-primary bg-opacity-10">
                <i class="bi bi-globe fs-3 text-primary"></i>
              </div>
              <h5 class="fw-bold text-dark">Multi-Platform Posting</h5>
              <p class="text-muted small mb-0">Publish your job openings to 30+ job boards simultaneously with a single
                click. Reach more talent, faster.</p>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="card border-0 shadow-sm h-100 rounded-4 p-2">
            <div class="card-body">
              <div
                class="rounded-3 d-inline-flex align-items-center justify-content-center mb-3 p-3 bg-primary bg-opacity-10">
                <i class="bi bi-shield-lock fs-3 text-primary"></i>
              </div>
              <h5 class="fw-bold text-dark">Data Privacy & Security</h5>
              <p class="text-muted small mb-0">GDPR-compliant and enterprise-grade security. Candidate data is always
                protected, encrypted, and under your control.</p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  {{-- ══════════════════════════════════════
     HOW IT WORKS
══════════════════════════════════════ --}}
  <section class="py-5 bg-primary bg-opacity-10">
    <div class="container py-3">
      <div class="text-center mb-5">
        <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary px-3 py-2 mb-2">
          How It Works
        </span>
        <h2 class="fw-bold text-dark">Hire in 3 simple steps</h2>
      </div>

      <div class="row g-4 text-center">
        <div class="col-md-4">
          <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 bg-primary"
            style="width:64px;height:64px;">
            <span class="text-white fw-bold fs-4">1</span>
          </div>
          <h5 class="fw-bold text-dark">Post Your Job</h5>
          <p class="text-muted small">Create a compelling job listing in minutes using our guided builder and publish it
            across all major job boards.</p>
        </div>
        <div class="col-md-4">
          <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 bg-primary"
            style="width:64px;height:64px;">
            <span class="text-white fw-bold fs-4">2</span>
          </div>
          <h5 class="fw-bold text-dark">Review Top Applicants</h5>
          <p class="text-muted small">Browse the most qualified candidates for your role. Review, shortlist, and schedule
            interviews — all in one place.</p>
        </div>
        <div class="col-md-4">
          <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 bg-primary"
            style="width:64px;height:64px;">
            <span class="text-white fw-bold fs-4">3</span>
          </div>
          <h5 class="fw-bold text-dark">Make the Offer</h5>
          <p class="text-muted small">Send offer letters, and onboard your new hire — all without
            leaving this website.</p>
        </div>
      </div>
    </div>
  </section>

  {{-- ══════════════════════════════════════
     TESTIMONIALS
══════════════════════════════════════ --}}
  <section class="bg-white py-5">
    <div class="container py-3">
      <div class="text-center mb-5">
        <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary px-3 py-2 mb-2">
          Testimonials
        </span>
        <h2 class="fw-bold text-dark">What our users say</h2>
      </div>

      <div class="row g-4">
        <div class="col-md-4">
          <div class="card border-0 shadow-sm rounded-4 h-100 p-2">
            <div class="card-body">
              <div class="mb-3 text-primary">
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
              </div>
              <p class="text-muted small mb-3">"This system cut our hiring time in half. The candidate matching is
                incredibly accurate — we're finding better-fit applicants than ever before."</p>
              <div class="d-flex align-items-center gap-2">
                <div
                  class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white bg-primary"
                  style="width:38px;height:38px;">SA</div>
                <div>
                  <div class="fw-semibold small text-dark">Sarah A.</div>
                  <div class="text-muted" style="font-size:0.75rem;">HR Director, NovaTech</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card border-0 shadow-sm rounded-4 h-100 p-2">
            <div class="card-body">
              <div class="mb-3 text-primary">
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
              </div>
              <p class="text-muted small mb-3">"The automated scheduling alone saved our recruiters 10 hours a week. It's
                genuinely the most thoughtful platform we've used."</p>
              <div class="d-flex align-items-center gap-2">
                <div
                  class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white bg-primary"
                  style="width:38px;height:38px;">MR</div>
                <div>
                  <div class="fw-semibold small text-dark">Marco R.</div>
                  <div class="text-muted" style="font-size:0.75rem;">Talent Lead, BrightScale</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card border-0 shadow-sm rounded-4 h-100 p-2">
            <div class="card-body">
              <div class="mb-3 text-primary">
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
              </div>
              <p class="text-muted small mb-3">"As a startup, we needed something fast and affordable. This system
                delivered
                both. We hired our first 15 employees through it."</p>
              <div class="d-flex align-items-center gap-2">
                <div
                  class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white bg-primary"
                  style="width:38px;height:38px;">JL</div>
                <div>
                  <div class="fw-semibold small text-dark">Jana L.</div>
                  <div class="text-muted" style="font-size:0.75rem;">CEO, Loopify</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- ══════════════════════════════════════
     CTA BANNER
══════════════════════════════════════ --}}
  <section class="py-5 bg-primary">
    <div class="container text-center py-3">
      <h2 class="fw-bold text-white mb-3">Start hiring smarter today</h2>
      <p class="text-white mb-4 opacity-75">
        Join thousands of companies using this system to find the right people, faster.
      </p>
      <div class="d-flex justify-content-center gap-3 flex-wrap">
        <a href="#" class="btn btn-outline-light fw-semibold px-5 py-2">
          Request a Demo
        </a>
      </div>
    </div>
  </section>

@endsection
