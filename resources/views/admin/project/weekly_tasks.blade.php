<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Base Engineering</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
    <!-- Navbar -->
    @include('admin.partials.navbar')

    <div class="container mt-4">
        <h4>Proyek: {{ $project->nama_project }}</h4>

        <!-- Tabs -->
        <ul class="nav nav-tabs" id="projectTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="detail-tab" data-bs-toggle="tab" data-bs-target="#detail" type="button" role="tab">
                    Detail Proyek
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="task-tab" data-bs-toggle="tab" data-bs-target="#task" type="button" role="tab">
                    Tugas Mingguan
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="member-tab" data-bs-toggle="tab" data-bs-target="#member" type="button" role="tab">
                    Anggota Proyek
                </button>
            </li>
        </ul>

        <div class="tab-content mt-3" id="projectTabContent">
            <!-- Detail Proyek -->
            <div class="tab-pane fade show active" id="detail" role="tabpanel">
                <div class="card">
                    <div class="card-header">Detail Proyek</div>
                    <div class="card-body">
                        <p><strong>Nama Proyek:</strong> {{ $project->nama_project }}</p>
                        <p><strong>Deskripsi:</strong> {{ $project->deskripsi ?? '-' }}</p>
                        <p><strong>Dibuat pada:</strong> {{ $project->created_at->format('d M Y') }}</p>
                        <p><strong>Update terakhir:</strong> {{ $project->updated_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>

            <!-- Tugas Mingguan -->
            <div class="tab-pane fade" id="task" role="tabpanel">
                <!-- Tombol Add -->
                <div class="d-flex justify-content-end mb-3 mt-3">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTaskModal">
                        <i class="bi bi-plus-circle"></i> Tambah Tugas Mingguan
                    </button>
                </div>

                <!-- Modal Tambah Tugas -->
                <div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addTaskModalLabel">Tambah Tugas Mingguan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('admin.project.weekly.tasks.store', $project->id) }}" id="taskForm">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="week_number" class="form-label">Pilih Minggu</label>
                                        <select name="week_number" id="week_number" class="form-select" required>
                                            <option value="">-- Pilih Minggu --</option>
                                            @for ($i = 1; $i <= $project->week; $i++)
                                                <option value="{{ $i }}">Minggu {{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Daftar Tugas</label>
                                        <div id="task-list">
                                            <div class="input-group mb-2">
                                                <input type="text" name="task_descriptions[]" class="form-control" placeholder="Tugas 1" required>
                                                <button type="button" class="btn btn-danger btn-remove-task"><i class="bi bi-x-circle"></i></button>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-secondary" id="add-task-btn">
                                            <i class="bi bi-plus-circle"></i> Tambah Baris Tugas
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" form="taskForm">Simpan Semua Tugas</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabel tugas yang sudah ada -->
                <div class="card mb-4">
                    <div class="card-header">Tugas Mingguan Tersimpan</div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tugas</th>
                                    <th>Tanggal Dimulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Deskripsi</th>
                                    <th>Dibuat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($project->weeklyTasks as $i => $task)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $task->task_description }}</td>
                                    <td>{{ \Carbon\Carbon::parse($task->week_start_date)->translatedFormat('d F Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($task->week_end_date)->translatedFormat('d F Y') }}</td>
                                    <td>{{ $task->task_description }}</td>
                                    <td>{{ $task->created_at->diffForHumans() }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Belum ada tugas mingguan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Anggota Proyek -->
            <div class="tab-pane fade" id="member" role="tabpanel">
                <div class="card mt-3">
                    <div class="card-header">Anggota Projek</div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($project_user as $i => $project)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $project->user->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.project.weekly.tasks.user_task', $project->id)}}" class="btn btn-sm btn-primary">Tugas</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">Belum ada anggota proyek.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const addBtn = document.getElementById('add-task-btn');
            const taskList = document.getElementById('task-list');

            if (addBtn) {
                addBtn.addEventListener('click', function () {
                    const taskInput = document.createElement('div');
                    taskInput.classList.add('input-group', 'mb-2');
                    taskInput.innerHTML = `
                        <input type="text" name="task_descriptions[]" class="form-control" placeholder="Tugas lainnya" required>
                        <button type="button" class="btn btn-danger btn-remove-task"><i class="bi bi-x-circle"></i></button>`;
                    taskList.appendChild(taskInput);
                });
            }

            if (taskList) {
                taskList.addEventListener('click', function (e) {
                    if (e.target.closest('.btn-remove-task')) {
                        e.target.closest('.input-group').remove();
                    }
                });
            }
        });
    </script>
</body>
</html>
