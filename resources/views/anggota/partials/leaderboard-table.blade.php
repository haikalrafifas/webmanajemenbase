<div class="table-responsive">
  <table class="table table-hover align-middle text-center">
    <thead class="table-light">
      <tr>
        <th>#</th>
        <th>Nama</th>
        <th>Total Poin</th>
      </tr>
    </thead>
    <tbody>
      @forelse($leaderboard as $index => $entry)
        <tr>
          <td>
            @if($index == 0)
              <span class="fw-bold text-warning">{{ $index + 1 }}</span>
            @else
              {{ $index + 1 }}
            @endif
          </td>
          <td class="text-start">
            @if($index == 0)
              <i class="bi bi-star-fill text-warning me-1"></i>
            @endif
            {{ $entry->user->name }}
          </td>
          <td>{{ $entry->total_score }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="3" class="text-muted">Belum ada data.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
