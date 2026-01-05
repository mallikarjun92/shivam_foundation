@extends('admin.layout.app')

@section('title', 'Database Migrations')
@section('header', 'Database Migrations')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Migration Management</h5>
    </div>

    <div class="card-body">

        <div class="alert alert-info">
            <i class="bi bi-info-circle"></i>
            Run or rollback migrations without terminal access.
            <strong>Each action requires a passcode.</strong>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Status</th>
                    <th>Migration</th>
                    <th>Batch</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($migrationStatus as $migration)
                    <tr
                        data-migration="{{ $migration['migration'] }}"
                        data-filename="{{ $migration['filename'] }}"
                    >
                        <td>
                            @if($migration['status'] === 'Migrated')
                                <span class="badge bg-success">Migrated</span>
                            @else
                                <span class="badge bg-warning">Pending</span>
                            @endif
                        </td>

                        <td>
                            <small class="text-muted">{{ $migration['filename'] }}</small><br>
                            {{ $migration['migration'] }}
                        </td>

                        <td>
                            {{ $migration['batch'] ?: '-' }}
                        </td>

                        <td>
                            @if($migration['status'] === 'Pending')
                                <button class="btn btn-success btn-sm btn-run">
                                    <i class="bi bi-play-circle"></i> Run
                                </button>
                            @else
                                <button class="btn btn-warning btn-sm btn-rollback">
                                    <i class="bi bi-arrow-counterclockwise"></i> Rollback
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

{{-- PASSCODE MODAL --}}
<div class="modal fade" id="passcodeModal" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="bi bi-shield-lock"></i> Confirm Migration
                </h5>
                <button type="button" class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p class="text-muted mb-2">
                    Enter migration passcode to proceed.
                </p>

                <input type="password"
                       id="migrationPasscode"
                       class="form-control"
                       placeholder="Passcode"
                       autocomplete="off">

                <div id="passcodeError"
                     class="text-danger small mt-2 d-none">
                    Invalid passcode
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    Cancel
                </button>
                <button class="btn btn-danger"
                        id="confirmPasscode">
                    Confirm
                </button>
            </div>

        </div>
    </div>
</div>

{{-- RESULT MODAL --}}
<div class="modal fade" id="resultsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Result</h5>
                <button type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body" id="resultsContent"></div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    let pendingAction = null;
    let passcodeModal = new bootstrap.Modal(
        document.getElementById('passcodeModal')
    );

    function askPasscode(action) {
        pendingAction = action;
        document.getElementById('migrationPasscode').value = '';
        document.getElementById('passcodeError').classList.add('d-none');
        passcodeModal.show();
    }

    document.getElementById('confirmPasscode').addEventListener('click', function () {
        const passcode = document.getElementById('migrationPasscode').value.trim();

        if (!passcode) {
            document.getElementById('passcodeError').textContent = 'Passcode required';
            document.getElementById('passcodeError').classList.remove('d-none');
            return;
        }

        passcodeModal.hide();

        if (typeof pendingAction === 'function') {
            pendingAction(passcode);
            pendingAction = null;
        }
    });

    // RUN MIGRATION
    document.querySelectorAll('.btn-run').forEach(btn => {
        btn.addEventListener('click', function () {
            const row = this.closest('tr');
            const migration = row.dataset.migration;
            const filename  = row.dataset.filename;

            askPasscode((passcode) => {
                fetch('{{ route("admin.maintenance.run-migration") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        migration,
                        filename,
                        passcode
                    })
                })
                .then(res => res.json())
                .then(showResult);
            });
        });
    });

    // ROLLBACK MIGRATION
    document.querySelectorAll('.btn-rollback').forEach(btn => {
        btn.addEventListener('click', function () {
            const row = this.closest('tr');
            const migration = row.dataset.migration;
            const filename  = row.dataset.filename;

            askPasscode((passcode) => {
                fetch('{{ route("admin.maintenance.rollback-migration") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        migration,
                        filename,
                        passcode
                    })
                })
                .then(res => res.json())
                .then(showResult);
            });
        });
    });

    function showResult(data) {
        let html = '';

        if (data.success) {
            html = `<div class="alert alert-success">${data.message}</div>`;
            setTimeout(() => location.reload(), 1200);
        } else {
            html = `<div class="alert alert-danger">${data.message}</div>`;
        }

        document.getElementById('resultsContent').innerHTML = html;
        new bootstrap.Modal(document.getElementById('resultsModal')).show();
    }

});
</script>
@endpush