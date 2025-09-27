@extends('admin.layout.app')

@section('title', 'Manage Donations')
@section('header', 'Donations List')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Donations</h5>
    </div>
    <div class="card-body">
        @if($donations->isEmpty())
            <div class="text-center py-5">
                <i class="bi bi-cash-coin" style="font-size: 3rem; color: #6c757d;"></i>
                <p class="mt-3">No donations found.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>URN</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($donations as $donation)
                        <tr>
                            <td>{{ $donation->urn }}</td>
                            <td>{{ $donation->name }}</td>
                            <td>{{ $donation->email }}</td>
                            <td>₹{{ number_format($donation->amount, 2) }}</td>
                            <td>
                                <span class="badge {{ $donation->status === 'completed' ? 'bg-success' : 'bg-warning' }}">
                                    {{ ucfirst($donation->status) }}
                                </span>
                            </td>
                            <td>{{ $donation->created_at->format('d M Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.donations.show', $donation->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i> View
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $donations->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
