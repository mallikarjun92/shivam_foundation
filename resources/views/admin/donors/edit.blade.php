@extends('admin.layout.app')

@section('title', 'Edit Featured Donor')
@section('header', 'Edit Donor')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.donors.update', $donor) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- NAME -->
            <div class="mb-3">
                <label class="form-label">Donor Name</label>
                <input type="text" name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $donor->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- AMOUNT -->
            <div class="mb-3">
                <label class="form-label">Donated Amount (INR)</label>
                <input type="number" step="0.01" name="amount"
                       class="form-control @error('amount') is-invalid @enderror"
                       value="{{ old('amount', $donor->amount) }}">
                @error('amount')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- DONATED DATE -->
            <div class="mb-3">
                <label class="form-label">Donation Date & Time</label>
                <input type="datetime-local" name="donated_at"
                       class="form-control @error('donated_at') is-invalid @enderror"
                       value="{{ old('donated_at', $donor->donated_at ? $donor->donated_at->format('Y-m-d\TH:i') : '') }}">
                @error('donated_at')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- CURRENT IMAGE -->
            @if($donor->image)
            <div class="mb-3">
                <label class="form-label d-block">Current Image</label>
                <img src="{{ asset('storage/' . $donor->image) }}" alt="Donor Image" class="img-thumbnail" width="150">
            </div>
            @endif

            <!-- NEW IMAGE -->
            <div class="mb-3">
                <label class="form-label">Replace Image</label>
                <input type="file" name="image" accept="image/*"
                       class="form-control @error('image') is-invalid @enderror">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- PUBLISHED -->
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="published" name="published" value="1"
                       {{ $donor->published ? 'checked' : '' }}>
                <label for="published" class="form-check-label">Publish Donor</label>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.donors.index') }}" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-primary">Update Donor</button>
            </div>
        </form>
    </div>
</div>
@endsection
