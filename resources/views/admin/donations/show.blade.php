@extends('admin.layout.app')

@section('title', 'Donation Details')
@section('header', 'Donation Information')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Donation URN: {{ $donation->urn }}</h5>
    </div>
    <div class="card-body">
        <p><strong>Name:</strong> {{ $donation->name }}</p>

        @if($donation->donor_image)
            <p><strong>Donor Image:</strong></p>
            <img src="{{ Storage::url($donation->donor_image) }}" class="rounded-circle mb-3" width="150">
        @endif

        <p><strong>Email:</strong> {{ $donation->email }}</p>
        <p><strong>Phone:</strong> {{ $donation->phone }}</p>
        <p><strong>PAN:</strong> {{ $donation->pan ?? 'N/A' }}</p>
        <p><strong>Address:</strong> {{ $donation->address ?? 'N/A' }}</p>
        <p><strong>Pincode:</strong> {{ $donation->pincode ?? 'N/A' }}</p>
        <p><strong>Amount:</strong> ₹{{ number_format($donation->amount, 2) }}</p>
        <p><strong>Payment Method:</strong> {{ $donation->payment_method ?? 'N/A' }}</p>
        <p><strong>Transaction ID (UTR):</strong> {{ $donation->transaction_id ?? 'Pending' }}</p>
        <p><strong>Status:</strong> 
            <span class="badge {{ $donation->status === 'completed' ? 'bg-success' : 'bg-warning' }}">
                {{ ucfirst($donation->status) }}
            </span>
        </p>

        @if($donation->image)
            <p><strong>Donation Image:</strong></p>
            <img src="{{ Storage::url($donation->image) }}" class="img-fluid rounded mb-3" width="250">
        @endif
        
        <p><strong>Created At:</strong> {{ $donation->created_at->format('d M Y H:i') }}</p>

        <a href="{{ route('admin.donations.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Donations
        </a>
    </div>
</div>
@endsection
