@extends('admin.layout.app')

@section('title', 'Message Details')
@section('header', 'View Message')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Message from {{ $message->name }}</h5>
    </div>
    <div class="card-body">
        <p><strong>Name:</strong> {{ $message->name }}</p>
        <p><strong>Email:</strong> <a href="mailto:{{ $message->email }}">{{ $message->email }}</a></p>
        <p><strong>Subject:</strong> {{ $message->subject }}</p>
        <p><strong>Company:</strong> {{ $message->company ?? 'N/A' }}</p>
        <p><strong>Phone:</strong> {{ $message->phone ?? 'N/A' }}</p>
        <p><strong>Message:</strong></p>
        <div class="border p-3 rounded bg-light mb-3">
            {{ $message->message }}
        </div>
        <p><strong>IP Address:</strong> {{ $message->ip_address }}</p>
        <p><strong>User Agent:</strong> {{ $message->user_agent }}</p>
        <p><strong>Received At:</strong> {{ $message->created_at->format('d M Y H:i') }}</p>

        <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" 
           class="btn btn-primary">
            <i class="bi bi-reply"></i> Reply
        </a>
        <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Messages
        </a>
        <form action="{{ route('admin.contacts.delete', $message->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this message?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-bg btn-danger">
                <i class="bi bi-trash"></i> Delete
            </button>
        </form>
    </div>
</div>
@endsection
