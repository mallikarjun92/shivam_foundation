@extends('admin.layout.app')

@section('title', 'Edit Enrollment')
@section('header', 'Edit Enrollment')

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('admin.programs-enrollments.update', $enrollment) }}" method="POST">
            @csrf
            @method('PUT')

            <h5 class="mb-4">Personal Information</h5>

            <div class="mb-3">
                <label class="form-label">Full Name *</label>
                <input type="text" name="name" required
                       value="{{ old('name', $enrollment->name) }}"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Email *</label>
                <input type="email" name="email" required
                       value="{{ old('email', $enrollment->email) }}"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Phone *</label>
                <input type="text" name="phone" required
                       value="{{ old('phone', $enrollment->phone) }}"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Date of Birth</label>
                <input type="date" name="dob"
                       value="{{ old('dob', optional($enrollment->dob)->format('Y-m-d')) }}"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Country</label>
                <input type="text" name="country"
                       value="{{ old('country', $enrollment->country) }}"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">State</label>
                <input type="text" name="state"
                       value="{{ old('state', $enrollment->state) }}"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Gender</label>
                <select name="gender" class="form-select">
                    <option value="" selected>-- Select --</option>
                    <option value="male" {{ old('gender', $enrollment->gender) == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender', $enrollment->gender) == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ old('gender', $enrollment->gender) == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Program Type *</label>
                <select name="program_type" class="form-select" required>
                    <option value="yoga" {{ old('program_type', $enrollment->program_type) == 'yoga' ? 'selected' : '' }}>Yoga</option>
                    <option value="meditation" {{ old('program_type', $enrollment->program_type) == 'meditation' ? 'selected' : '' }}>Meditation</option>
                    <option value="workshop" {{ old('program_type', $enrollment->program_type) == 'workshop' ? 'selected' : '' }}>Workshop</option>
                    <option value="others" {{ old('program_type', $enrollment->program_type) == 'others' ? 'selected' : '' }}>Others</option>
                </select>
            </div>

            <hr>

            <h5 class="mb-4">Payment Details</h5>

            <div class="mb-3">
                <label class="form-label">Payment Status</label>
                <select name="payment_status" class="form-select">
                    <option value="pending" {{ old('payment_status', $enrollment->payment_status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ old('payment_status', $enrollment->payment_status) == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="failed" {{ old('payment_status', $enrollment->payment_status) == 'failed' ? 'selected' : '' }}>Failed</option>
                    <option value="" {{ old('payment_status', $enrollment->payment_status) == null ? 'selected' : '' }}>None</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Payment ID / Transaction ID (UTR)</label>
                <input type="text" name="payment_id"
                       value="{{ old('payment_id', $enrollment->payment_id) }}"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Payment Method</label>
                <input type="text" name="payment_method"
                       value="{{ old('payment_method', $enrollment->payment_method) }}"
                       class="form-control">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Amount</label>
                    <input type="number" step="0.01" name="payment_amount"
                           value="{{ old('payment_amount', $enrollment->payment_amount) }}"
                           class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Currency</label>
                    <input type="text" name="payment_currency"
                           value="{{ old('payment_currency', $enrollment->payment_currency) }}"
                           class="form-control">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Remarks</label>
                <textarea name="remarks" rows="3" class="form-control">{{ old('remarks', $enrollment->remarks) }}</textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.programs-enrollments.index') }}" class="btn btn-secondary">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    Update Enrollment
                </button>
            </div>

        </form>

    </div>
</div>

@endsection