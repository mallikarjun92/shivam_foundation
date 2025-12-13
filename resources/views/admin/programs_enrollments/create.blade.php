@extends('admin.layout.app')

@section('title', 'Create Enrollment')
@section('header', 'Create New Enrollment')

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('admin.programs-enrollments.store') }}" method="POST">
            @csrf

            <h5 class="mb-4">Personal Information</h5>

            <div class="mb-3">
                <label class="form-label">Full Name *</label>
                <input type="text" name="name" required
                       value="{{ old('name') }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Email *</label>
                <input type="email" name="email" required
                       value="{{ old('email') }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Phone *</label>
                <input type="text" name="phone" required
                       value="{{ old('phone') }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Date of Birth</label>
                <input type="date" name="dob"
                       value="{{ old('dob') }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Country</label>
                <input type="text" name="country"
                       value="{{ old('country') }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">State</label>
                <input type="text" name="state"
                       value="{{ old('state') }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Gender</label>
                <select name="gender" class="form-select">
                    <option value="">-- Select --</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Program Type *</label>
                <select name="program_type" required class="form-select">
                    <option value="yoga">Yoga</option>
                    <option value="meditation">Meditation</option>
                    <option value="workshop">Workshop</option>
                    <option value="others">Others</option>
                </select>
            </div>

            <hr>

            <h5 class="mb-4">Payment Information</h5>

            <div class="mb-3">
                <label class="form-label">Payment Status</label>
                <select name="payment_status" class="form-select">
                    <option value="">None</option>
                    <option value="pending">Pending</option>
                    <option value="paid">Paid</option>
                    <option value="failed">Failed</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Payment ID / Transaction ID (UTR)</label>
                <input type="text" name="payment_id"
                       value="{{ old('payment_id') }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Payment Method</label>
                <input type="text" name="payment_method"
                       value="{{ old('payment_method') }}" class="form-control">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Amount</label>
                    <input type="number" step="0.01" name="payment_amount"
                           value="{{ old('payment_amount') }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Currency</label>
                    <input type="text" name="payment_currency"
                           value="{{ old('payment_currency') }}" class="form-control">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Remarks</label>
                <textarea name="remarks" rows="3"
                          class="form-control">{{ old('remarks') }}</textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.programs-enrollments.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Create Enrollment</button>
            </div>
        </form>

    </div>
</div>

@endsection