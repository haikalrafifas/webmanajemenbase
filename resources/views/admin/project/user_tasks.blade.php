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
        <!-- Tombol Add -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTaskModal">
            <i class="bi bi-plus-circle"></i> Tambah Tugas
        </button>
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


<!-- Modal Add Tugas -->
<div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTaskModalLabel">Tambah Tugas Mingguan User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('assign.task') }}" id="taskForm">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user_id }}">

                    <!-- Pilih Minggu -->
                    <div class="mb-3">
                        <label for="week_number" class="form-label">Pilih Minggu</label>
                        <select name="week_number" id="week_number" class="form-select" required>
                            <option value="" selected disabled>Pilih Minggu</option>
                            @for ($w = 1; $w <= $project->week; $w++)
                                <option value="{{ $w }}">Minggu ke-{{ $w }}</option>
                            @endfor
                        </select>
                    </div>

                    <!-- Daftar Tugas sesuai minggu -->
                    <div class="mb-3">
                        <label for="task_select" class="form-label">Pilih Tugas</label>
                        <select name="task_id" id="task_select" class="form-select" required disabled>
                            <option value="" selected disabled>Pilih minggu terlebih dahulu</option>
                            @foreach ($allWeeklyTasks as $task)
                                <option value="{{ $task->id }}" data-week="{{ $task->week_number }}">
                                    Minggu {{ $task->week_number }} - {{ $task->task_description }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="taskForm">Simpan Tugas</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const addBtn = document.getElementById('add-task-btn');
    const taskList = document.getElementById('task-list');

    addBtn.addEventListener('click', function () {
        const taskInput = document.createElement('div');
        taskInput.classList.add('input-group', 'mb-2');
        taskInput.innerHTML = `<input type="text" name="task_descriptions[]" class="form-control" placeholder="Tugas lainnya" required>
        <button type="button" class="btn btn-danger btn-remove-task"><i class="bi bi-x-circle"></i></button>`;
        taskList.appendChild(taskInput);
    });

    taskList.addEventListener('click', function (e) {
        if (e.target.closest('.btn-remove-task')) {
            e.target.closest('.input-group').remove();
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const weekSelect = document.getElementById('week_number');
    const taskSelect = document.getElementById('task_select');

    // Saat minggu berubah
    weekSelect.addEventListener('change', function () {
        const week = this.value;

        // Reset opsi
        taskSelect.innerHTML = '<option value="" selected disabled>Pilih Tugas</option>';
        taskSelect.disabled = true; // default disabled dulu

        // Filter tugas sesuai minggu
        const allOptions = @json($allWeeklyTasks);
        let hasTask = false;
        allOptions.forEach(task => {
            if (task.week_number == week) {
                const option = document.createElement('option');
                option.value = task.id;
                option.textContent = task.task_description;
                taskSelect.appendChild(option);
                hasTask = true;
            }
        });

        // Aktifkan select kalau ada tugas
        if (hasTask) {
            taskSelect.disabled = false;
        }
    });
});
</script>
</body>
</html>
