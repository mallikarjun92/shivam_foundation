@extends('admin.layout.app')

@section('title', 'Edit Donation')
@section('header', 'Edit Donation')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Edit Donation - {{ $donation->urn }}</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.donations.update', $donation->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $donation->name) }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email', $donation->email) }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label>Phone</label>
                    <input type="text" class="form-control" name="phone" value="{{ old('phone', $donation->phone) }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label>PAN</label>
                    <input type="text" class="form-control" name="pan" value="{{ old('pan', $donation->pan) }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Pincode</label>
                    <input type="text" class="form-control" name="pincode" value="{{ old('pincode', $donation->pincode) }}">
                </div>
            </div>

            <div class="mb-3">
                <label>Address</label>
                <textarea class="form-control" name="address">{{ old('address', $donation->address) }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label>Amount</label>
                    <input type="number" step="0.01" class="form-control" name="amount" value="{{ old('amount', $donation->amount) }}" disabled>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Payment Method</label>
                    <input type="text" class="form-control" name="payment_method" value="{{ old('payment_method', $donation->payment_method) }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Status</label>
                    <select name="status" class="form-select">
                        <option value="pending" {{ $donation->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ $donation->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
            </div>

            {{-- Image Upload --}}
            {{-- <div class="mb-3">
                <label>Donation Image (Receipt / Proof)</label>
                <input type="file" name="image" class="form-control">

                @if($donation->image)
                    <div class="mt-2">
                        <p>Current Image:</p>
                        <img src="{{ Storage::url($donation->image) }}" width="180" class="border rounded">
                    </div>
                @endif
            </div> --}}

            {{-- Donor Image --}}
            <div class="mb-3">
                <label>Donor Image (Profile Photo)</label>
                <input type="file" name="donor_image" class="form-control">

                @if($donation->donor_image)
                    <div class="mt-2">
                        <p>Current Donor Image:</p>
                        <img src="{{ Storage::url($donation->donor_image) }}" width="150" class="rounded-circle border">
                    </div>
                @endif
            </div>

            <button class="btn btn-primary"><i class="bi bi-save"></i> Update</button>
            <a href="{{ route('admin.donations.index') }}" class="btn btn-secondary ms-2">Cancel</a>
        </form>
    </div>
</div>
@endsection
