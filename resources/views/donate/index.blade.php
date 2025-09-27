@extends('layouts.app')

@section('title', 'Donate - Vishvam Foundation')

@section('content')
    
    <div class="hero-wrap" style="background-image: url('{{ asset('images/bg_2.jpg') }}');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-7 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
             <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="{{ url('/') }}">Home</a></span> <span>Donate</span></p>
            <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Make a Donation</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-10">
            <div class="wrapper">
              <div class="row no-gutters">
                <div class="col-md-12">
                  <div class="contact-wrap w-100 p-md-5 p-4">
                    <h3 class="mb-4">Donation Form</h3>
                    
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('donate.store') }}" id="donationForm">
                      @csrf
                      
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="label" for="name">Full Name *</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Your Name" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="label" for="email">Email Address *</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="label" for="phone">Phone Number *</label>
                            <input type="tel" class="form-control" name="phone" id="phone" placeholder="Your Phone Number" value="{{ old('phone') }}" required>
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="label" for="amount">Donation Amount (₹) *</label>
                            <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount in INR" value="{{ old('amount') }}" min="1" required>
                            @error('amount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="label" for="pan">PAN Number (For 80G)</label>
                            <input type="text" class="form-control" name="pan" id="pan" placeholder="e.g., ABCDE1234F" value="{{ old('pan') }}" maxlength="10">
                            <small class="form-text text-muted">Required for tax exemption certificate</small>
                            @error('pan')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="label" for="payment_method">Payment Method *</label>
                            <select class="form-control" name="payment_method" id="payment_method" required>
                              <option value="">Select Payment Method</option>
                              <option value="upi" {{ old('payment_method') == 'upi' ? 'selected' : '' }}>UPI</option>
                              <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                              <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                              <option value="debit_card" {{ old('payment_method') == 'debit_card' ? 'selected' : '' }}>Debit Card</option>
                            </select>
                            @error('payment_method')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="label" for="address">Address</label>
                            <textarea class="form-control" name="address" id="address" placeholder="Your complete address" rows="3">{{ old('address') }}</textarea>
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="label" for="pincode">Pincode</label>
                            <input type="text" class="form-control" name="pincode" id="pincode" placeholder="6-digit pincode" value="{{ old('pincode') }}" maxlength="6">
                            @error('pincode')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <input type="submit" value="Proceed to Donate" class="btn btn-primary">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // PAN number validation
    const panInput = document.getElementById('pan');
    if (panInput) {
        panInput.addEventListener('input', function(e) {
            this.value = this.value.toUpperCase();
        });
    }

    // Pincode validation
    const pincodeInput = document.getElementById('pincode');
    if (pincodeInput) {
        pincodeInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/\D/g, '');
        });
    }
});
</script>
@endpush