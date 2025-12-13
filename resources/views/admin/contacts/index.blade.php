@extends('admin.layout.app')

@section('title', 'Manage Contact Messages')
@section('header', 'Contact Messages')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Messages</h5>
    </div>
    <div class="card-body">
        <div class="btn-group me-2">
            <a href="{{ route('admin.contacts.index', ['filter' => 'all']) }}"
            class="btn btn-sm {{ $filter == 'all' ? 'btn-primary' : 'btn-outline-primary' }}">
            All
            </a>

            <a href="{{ route('admin.contacts.index', ['filter' => 'new']) }}"
            class="btn btn-sm {{ $filter == 'new' ? 'btn-success' : 'btn-outline-success' }}">
            New
            @if($unreadCount > 0)
                <span class="badge bg-light text-success">{{ $unreadCount }}</span>
            @endif
            </a>

            <a href="{{ route('admin.contacts.index', ['filter' => 'read']) }}"
            class="btn btn-sm {{ $filter == 'read' ? 'btn-secondary' : 'btn-outline-secondary' }}">
            Read
            </a>
        </div>
        @if($messages->isEmpty())
            <div class="text-center py-5">
                <i class="bi bi-envelope" style="font-size: 3rem; color: #6c757d;"></i>
                <p class="mt-3">No contact messages found.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $message)
                        <tr class="{{$message->is_new ? ' table-success' : ''}}">
                            <td>
                                @if($message->is_new)
                                    <span class="text-success me-1" style="font-size: 14px;">●</span>
                                    <strong>{{ $message->name }}</strong>
                                @else
                                    <span class="text-muted me-1" style="font-size: 14px;">○</span>
                                    {{ $message->name }}
                                @endif
                            </td>
                            <td>{{ $message->email }}</td>
                            <td>{{ Str::limit($message->subject, 40) }}</td>
                            <td>{{ $message->created_at->format('d M Y H:i') }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.contacts.show', $message->id) }}" class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i> View
                                    </a>
                                    <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-reply"></i> Reply
                                    </a>
                                    <form action="{{ route('admin.contacts.delete', $message->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this message?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{-- {{ $messages->links() }} --}}
                {{ $messages->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>
@endsection
