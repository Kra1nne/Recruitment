<nav aria-label="breadcrumb mb-3">
  <ol class="breadcrumb align-items-center mb-0">

    @foreach ($breadcrumbs as $breadcrumb)
      <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}">

        @if (!$loop->last)
          <a href="{{ $breadcrumb['link'] }}" class="text-decoration-none">
            {{ $breadcrumb['name'] }}
          </a>
        @else
          <span>
            {{ $breadcrumb['name'] }}
          </span>
        @endif

      </li>

      {{-- Separator (Remix Icon) --}}
      @if (!$loop->last)
        <li class="mx-2 text-muted d-flex align-items-center">
          <i class="bx bx-chevron-right"></i>
        </li>
      @endif
    @endforeach

  </ol>
</nav>
