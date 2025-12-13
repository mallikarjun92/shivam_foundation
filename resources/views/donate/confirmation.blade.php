@extends('layouts.app')

@section('title', 'Donation Confirmation - Vishvam Foundation')

@section('content')
    
    <div class="hero-wrap" style="background-image: url('{{ asset('images/bg_2.jpg') }}');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-7 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
             <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">
                 <span class="mr-2"><a href="{{ url('/') }}">Home</a></span> 
                 <span class="mr-2"><a href="{{ route('donate.index') }}">Donate</a></span> 
                 <span>Confirmation</span>
             </p>
            <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Donation Confirmation</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-10">
            <div class="card shadow">
              <div class="card-header bg-success text-white text-center">
                <h4 class="mb-0">Donation Submitted Successfully!</h4>
              </div>
              <div class="card-body">
                
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <div class="row">
                  <div class="col-md-6">
                    <div class="donation-details">
                      <h5>Donation Details</h5>
                      <table class="table table-sm">
                        <tr>
                          <th>Reference Number:</th>
                          <td><strong class="text-primary">{{ $donation->urn }}</strong></td>
                        </tr>
                        <tr>
                          <th>Name:</th>
                          <td>{{ $donation->name }}</td>
                        </tr>
                        <tr>
                          <th>Email:</th>
                          <td>{{ $donation->email }}</td>
                        </tr>
                        <tr>
                          <th>Phone:</th>
                          <td>{{ $donation->phone }}</td>
                        </tr>
                        <tr>
                          <th>Amount:</th>
                          <td>₹{{ number_format($donation->amount, 2) }}</td>
                        </tr>
                        <tr>
                          <th>Payment Method:</th>
                          <td>{{ ucfirst(str_replace('_', ' ', $donation->payment_method)) }}</td>
                        </tr>
                        <tr>
                          <th>Status:</th>
                          <td>
                            <span class="badge badge-{{ $donation->status == 'completed' ? 'success' : 'warning' }}">
                              {{ ucfirst($donation->status) }}
                            </span>
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div>
                  
                  <div class="col-md-6 text-center">
                    <h5>Scan QR Code for Payment</h5>
                    <div class="qr-code-container mb-3">
                      <img src="{{ asset('images/qr-code.jpg') }}" alt="Payment QR Code" class="img-fluid" style="max-width: 200px; border: 1px solid #ddd; padding: 10px; border-radius: 5px;">
                    </div>
                    <p class="text-muted">Scan this QR code using your UPI app to complete the payment</p>
                    
                    <div class="upi-id bg-light p-2 rounded mt-3">
                      <strong>UPI ID:</strong> welfare@ybl
                    </div>
                  </div>
                </div>

                <hr>

                @if($donation->status == 'pending')
                <div class="transaction-form mt-4">
                  <h5 class="text-center">Complete Your Donation</h5>
                  <p class="text-center text-muted">After making the payment, please enter your UTR number (or bank transaction number) below:</p>
                  
                  <div class="row justify-content-center">
                    <div class="col-md-8">
                      <form method="POST" action="{{ route('donate.update-transaction', $donation->id) }}">
                        @csrf
                        <div class="form-group">
                          <label for="utr_number"><strong>UTR Number *</strong></label>
                          <input type="text" class="form-control" name="utr_number" id="utr_number" 
                                 placeholder="Enter your UTR (Unique Transaction Reference) number" 
                                 required pattern="[A-Za-z0-9]+" title="Please enter a valid UTR number">
                          <small class="form-text text-muted">You can find the UTR number in your bank transaction details or payment confirmation message</small>
                          @error('utr_number')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                        <div class="text-center">
                          <button type="submit" class="btn btn-primary btn-lg">Submit UTR Number</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                @else
                <div class="completed-donation mt-4">
                  <div class="alert alert-success text-center">
                    <h5>🎉 Donation Completed Successfully!</h5>
                    <p class="mb-1">Thank you for your generous donation of <strong>₹{{ number_format($donation->amount, 2) }}</strong></p>
                    <p class="mb-1">Your UTR Number: <strong>{{ $donation->transaction_id }}</strong></p>
                    <p class="mb-0">You will receive a confirmation email with your tax exemption certificate (if applicable).</p>
                  </div>
                  
                  <div class="text-center mt-3">
                    <a href="{{ route('donate.index') }}" class="btn btn-outline-primary">Make Another Donation</a>
                    <a href="{{ url('/') }}" class="btn btn-outline-secondary">Return to Home</a>
                  </div>
                </div>
                @endif

                <div class="payment-instructions mt-5">
                  <h5 class="text-center mb-4">Payment Instructions</h5>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="card mb-4">
                        <div class="card-header bg-light">
                          <h6 class="mb-0">📱 UPI Payment</h6>
                        </div>
                        <div class="card-body">
                          <ol class="pl-3">
                            <li>Open your UPI app (Google Pay, PhonePe, Paytm, etc.)</li>
                            <li>Tap on "Scan QR Code"</li>
                            <li>Scan the QR code shown above</li>
                            <li>Enter amount: <strong>₹{{ number_format($donation->amount, 2) }}</strong></li>
                            <li>Add note: <code>Donation {{ $donation->urn }}</code></li>
                            <li>Complete the payment</li>
                          </ol>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-md-6">
                      <div class="card mb-4">
                        <div class="card-header bg-light">
                          <h6 class="mb-0">🏦 Bank Transfer</h6>
                        </div>
                        <div class="card-body">
                          <p><strong>Account Name:</strong> Vishvam Foundation</p>
                          <p><strong>Account Number:</strong> 1234567890</p>
                          <p><strong>IFSC Code:</strong> SBIN0000123</p>
                          <p><strong>Bank:</strong> State Bank of India</p>
                          <p><strong>Reference:</strong> <code>{{ $donation->urn }}</code></p>
                          <p><strong>Amount:</strong> ₹{{ number_format($donation->amount, 2) }}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="alert alert-info">
                    <h6>ℹ️ Important Notes:</h6>
                    <ul class="mb-0">
                      <li>Please keep your UTR number safe for future reference</li>
                      <li>80G tax exemption certificate will be emailed within 7 working days</li>
                      <li>For any queries, email us at <strong>	info@vishvamfoundation.org</strong></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

@endsection

@push('styles')
<style>
.qr-code-container {
    padding: 15px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    display: inline-block;
}

.upi-id {
    font-family: monospace;
    font-size: 1.1rem;
}

.badge-warning {
    background-color: #ffc107;
    color: #212529;
}

.badge-success {
    background-color: #28a745;
}

.form-control {
    border-radius: 0.25rem;
    border: 1px solid #ced4da;
}

.btn-primary {
    background-color: #f8b739;
    border-color: #f8b739;
}

.btn-primary:hover {
    background-color: #e6a532;
    border-color: #e6a532;
}
</style>
@endpush