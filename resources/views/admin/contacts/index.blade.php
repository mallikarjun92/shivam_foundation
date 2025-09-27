@extends('admin.layout.app')

@section('title', 'Manage Contact Messages')
@section('header', 'Contact Messages')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Messages</h5>
    </div>
    <div class="card-body">
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
                        <tr>
                            <td>{{ $message->name }}</td>
                            <td>{{ $message->email }}</td>
                            <td>{{ Str::limit($message->subject, 40) }}</td>
                            <td>{{ $message->created_at->format('d M Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.contacts.show', $message->id) }}" 
                                   class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i> View
                                </a>
                                <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" 
                                   class="btn btn-sm btn-primary">
                                    <i class="bi bi-reply"></i> Reply
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $messages->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
