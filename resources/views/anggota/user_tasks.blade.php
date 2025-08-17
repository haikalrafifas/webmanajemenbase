<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Base Engineering - Tugas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
<!-- Navbar -->
@include('admin.partials.navbar')

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Tugas Mingguan User</h4>
    </div>

    <!-- Tabs -->
    <ul class="nav nav-tabs mt-3" id="taskTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="this-week-tab" data-bs-toggle="tab" data-bs-target="#this-week" type="button" role="tab">Tugas Minggu Ini</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="all-tasks-tab" data-bs-toggle="tab" data-bs-target="#all-tasks" type="button" role="tab">Seluruh Tugas Mingguan</button>
        </li>
    </ul>

    <div class="tab-content mt-3" id="taskTabsContent">
        <!-- Tab: Tugas Minggu Ini -->
        <div class="tab-pane fade show active" id="this-week" role="tabpanel">
            @php
                $today = \Carbon\Carbon::today();
                $thisWeekTasks = $weeklyTasks->filter(fn($t) => $today->between($t->week_start_date, $t->week_end_date));
            @endphp

            <div class="card mb-4">
                <div class="card-header">Tugas Minggu Ini ({{ $thisWeekTasks->count() }})</div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light text-center">
                            <tr>
                                <th>No</th>
                                <th>Minggu ke</th>
                                <th>Tanggal Dimulai</th>
                                <th>Deadline</th>
                                <th>Deskripsi Tugas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($thisWeekTasks as $i => $task)
                                <tr class="text-center">
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $task->week_number }}</td>
                                    <td>{{ \Carbon\Carbon::parse($task->week_start_date)->format('d M Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($task->week_end_date)->format('d M Y') }}</td>
                                    <td class="text-start">{{ $task->task_description }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Tidak ada tugas untuk minggu ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tab: Seluruh Tugas Mingguan -->
        <div class="tab-pane fade" id="all-tasks" role="tabpanel">
            @php
                $tasksByWeek = $weeklyTasks->groupBy('week_number');
            @endphp

            @foreach ($tasksByWeek as $week => $tasks)
                <div class="card mb-3">
                    <div class="card-header">Minggu ke-{{ $week }}</div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Dimulai</th>
                                    <th>Deadline</th>
                                    <th>Deskripsi Tugas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $i => $task)
                                    <tr class="text-center">
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ \Carbon\Carbon::parse($task->week_start_date)->format('d M Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($task->week_end_date)->format('d M Y') }}</td>
                                        <td class="text-start">{{ $task->task_description }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
