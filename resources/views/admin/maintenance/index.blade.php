<!-- resources/views/admin/maintenance/index.blade.php -->
@extends('admin.layout.app')

@section('title', 'System Maintenance')
@section('header', 'System Maintenance')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Storage & Symlink Maintenance</h5>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('results'))
            <div class="alert alert-info">
                <h6>Operation Results:</h6>
                <ul class="mb-0">
                    @foreach(session('results') as $result)
                        <li>{{ $result }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Storage Directories</h6>
                    </div>
                    <div class="card-body">
                        <p>Create required storage directories for file uploads.</p>
                        <div id="storageStatus" class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <div class="spinner-border spinner-border-sm me-2" role="status"></div>
                                <span>Checking storage status...</span>
                            </div>
                        </div>
                        <form action="{{ route('admin.maintenance.fix-storage') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-folder-plus"></i> Fix Storage Directories
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Storage Symlink</h6>
                    </div>
                    <div class="card-body">
                        <p>Create symbolic link to make stored files accessible from web.</p>
                        <div id="symlinkStatus" class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <div class="spinner-border spinner-border-sm me-2" role="status"></div>
                                <span>Checking symlink status...</span>
                            </div>
                        </div>
                        <form action="{{ route('admin.maintenance.fix-symlink') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-link-45deg"></i> Fix Symlink
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-light">
                <h6 class="mb-0">Troubleshooting</h6>
            </div>
            <div class="card-body">
                <h6>Common Issues:</h6>
                <ul>
                    <li>If symlink doesn't work on your hosting, files will be stored but may not be accessible through the web</li>
                    <li>Some shared hosts disable the symlink() function for security reasons</li>
                    <li>If you can't create symlinks, you may need to configure your web server to serve files from storage/app/public</li>
                </ul>
                
                <h6>Manual Solution:</h6>
                <p>If the buttons above don't work, you can manually create these directories via FTP:</p>
                <pre class="bg-light p-3">
/storage/app/public/hero
/storage/app/public/events
/storage/app/public/galleries
/storage/app/public/volunteers
/storage/app/public/blogs
                </pre>
                
                <p>Set permissions to 755 for these directories.</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Check initial status
    checkStatus();
    
    // Check status every 30 seconds
    setInterval(checkStatus, 30000);
    
    function checkStatus() {
        fetch('{{ route("admin.maintenance.status") }}')
            .then(response => response.json())
            .then(data => {
                updateStorageStatus(data);
                updateSymlinkStatus(data);
            })
            .catch(error => {
                console.error('Error checking status:', error);
            });
    }
    
    function updateStorageStatus(data) {
        const storageStatus = document.getElementById('storageStatus');
        let html = '';
        
        // Check each directory
        let allExist = true;
        let allWritable = true;
        
        for (const [name, info] of Object.entries(data)) {
            if (name !== 'symlink') {
                if (!info.exists) allExist = false;
                if (!info.writable) allWritable = false;
                
                html += `<div class="d-flex justify-content-between align-items-center mb-1">
                    <span>${name}:</span>
                    <span>
                        ${info.exists ? 
                            '<span class="badge bg-success">Exists</span>' : 
                            '<span class="badge bg-danger">Missing</span>'}
                        ${info.writable ? 
                            '<span class="badge bg-success ms-1">Writable</span>' : 
                            '<span class="badge bg-danger ms-1">Not Writable</span>'}
                    </span>
                </div>`;
            }
        }
        
        // Add summary
        html = `<div class="mb-2">
            <strong>Overall Status:</strong>
            ${allExist ? 
                '<span class="badge bg-success ms-2">All Directories Exist</span>' : 
                '<span class="badge bg-danger ms-2">Some Directories Missing</span>'}
            ${allWritable ? 
                '<span class="badge bg-success ms-2">All Writable</span>' : 
                '<span class="badge bg-danger ms-2">Some Not Writable</span>'}
        </div>` + html;
        
        storageStatus.innerHTML = html;
    }
    
    function updateSymlinkStatus(data) {
        const symlinkStatus = document.getElementById('symlinkStatus');
        const symlink = data.symlink;
        
        let html = '';
        
        if (symlink.exists) {
            if (symlink.is_link && symlink.correct) {
                html = `<div class="text-success">
                    <i class="bi bi-check-circle-fill"></i> Symlink is properly configured
                </div>`;
            } else if (symlink.is_link && !symlink.correct) {
                html = `<div class="text-warning">
                    <i class="bi bi-exclamation-triangle-fill"></i> Symlink exists but points to wrong location
                    <div class="small text-muted">Points to: ${symlink.points_to}</div>
                </div>`;
            } else {
                html = `<div class="text-danger">
                    <i class="bi bi-x-circle-fill"></i> Public/storage exists but is not a symlink
                </div>`;
            }
        } else {
            html = `<div class="text-danger">
                <i class="bi bi-x-circle-fill"></i> Symlink does not exist
            </div>`;
        }
        
        symlinkStatus.innerHTML = html;
    }
});
</script>
@endpush