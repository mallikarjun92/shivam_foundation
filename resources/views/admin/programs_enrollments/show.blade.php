@extends('admin.layout.app')

@section('title', 'Enrollment Details')
@section('header', 'Enrollment Details')

@section('content')

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Enrollment Information</h5>
    </div>

    <div class="card-body">

        <div class="mb-3">
            <strong>Name:</strong>
            <p>{{ $enrollment->name }}</p>
        </div>

        <div class="mb-3">
            <strong>Email:</strong>
            <p>{{ $enrollment->email }}</p>
        </div>

        <div class="mb-3">
            <strong>Phone:</strong>
            <p>{{ $enrollment->phone }}</p>
        </div>

        <div class="mb-3">
            <strong>Date of Birth:</strong>
            <p>{{ $enrollment->dob ? $enrollment->dob->format('M d, Y') : '-' }}</p>
        </div>

        <div class="mb-3">
            <strong>Country:</strong>
            <p>{{ $enrollment->country ?? '-' }}</p>
        </div>

        <div class="mb-3">
            <strong>State:</strong>
            <p>{{ $enrollment->state ?? '-' }}</p>
        </div>

        <div class="mb-3">
            <strong>Gender:</strong>
            <p>{{ ucfirst($enrollment->gender) ?? '-' }}</p>
        </div>

        <div class="mb-3">
            <strong>Program Type:</strong>
            <p class="badge bg-info text-dark text-uppercase">{{ $enrollment->program_type }}</p>
        </div>

        <hr>

        <h5 class="mt-3">Payment Information</h5>

        <div class="mb-3">
            <strong>Status:</strong>
            <p>{{ $enrollment->payment_status ?? 'Not Paid' }}</p>
        </div>

        <div class="mb-3">
            <strong>Payment ID / Transaction ID (UTR):</strong>
            <p>{{ $enrollment->payment_id ?? '-' }}</p>
        </div>

        <div class="mb-3">
            <strong>Payment Method:</strong>
            <p>{{ $enrollment->payment_method ?? '-' }}</p>
        </div>

        <div class="mb-3">
            <strong>Amount:</strong>
            <p>
                {{ $enrollment->payment_amount 
                    ? $enrollment->payment_currency . ' ' . number_format($enrollment->payment_amount, 2) 
                    : '-' 
                }}
            </p>
        </div>

        <div class="mb-3">
            <strong>Remarks:</strong>
            <p>{{ $enrollment->remarks ?? '-' }}</p>
        </div>

        <hr>

        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.programs-enrollments.index') }}" class="btn btn-secondary">
                Back
            </a>

            <a href="{{ route('admin.programs-enrollments.edit', $enrollment) }}" class="btn btn-primary">
                Edit
            </a>
        </div>

    </div>
</div>

@endsection