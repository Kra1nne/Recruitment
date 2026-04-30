@extends('layouts/contentNavbarLayout')

@section('title', 'Account Logs')

@section('content')
  <main style="background:#ffffff;" class="p-3 rounded-3">
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
      <div>
        <h5 class="fw-semibold mb-0">Logs</h5>
        <small class="text-muted">Manage all company logs</small>
      </div>
    </div>
    <div class="card-body p-0">

      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th class="ps-3 small text-muted fw-semibold">#</th>
              <th class="small text-muted fw-semibold">Name</th>
              <th class="small text-muted fw-semibold">Ip Address</th>
              <th class="small text-muted fw-semibold">Table</th>
              <th class="small text-muted fw-semibold">Description</th>
              <th class="small text-muted fw-semibold">Actions</th>
              <th class="small text-muted fw-semibold">Date</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($logs as $index => $item)
              <tr>
                <td class="ps-3 text-muted small">{{ $index + 1 }}</td>
                <td class="text-muted small">{{ $item->user->person->first_name }} {{ $item->user->person->middle_name }}
                  {{ $item->user->person->last_name }}</td>
                <td class="text-muted small">{{ $item->ip_address }}</td>
                <td class="text-muted small">{{ $item->table }}</td>
                <td class="text-muted small">{{ $item->description }}</td>
                <td class="text-muted small">{{ $item->action }}</td>
                <td class="text-muted small">{{ date('M y, D', strtotime($item->created_at)) }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="text-center">No Logs</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
    <div class="bg-white d-flex justify-content-end align-items-center flex-wrap gap-2 py-2">
      {{ $logs->onEachSide(2)->links() }}
    </div>
    </div>
  </main>
@endsection
