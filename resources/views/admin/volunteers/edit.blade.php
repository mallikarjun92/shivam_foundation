@extends('admin.layout.app')

@section('title', 'Edit Volunteer')
@section('header', 'Edit Volunteer')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.volunteers.update', $volunteer) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name *</label>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" 
                               id="first_name" name="first_name" value="{{ old('first_name', $volunteer->first_name) }}" required>
                        @error('first_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name *</label>
                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" 
                               id="last_name" name="last_name" value="{{ old('last_name', $volunteer->last_name) }}" required>
                        @error('last_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email', $volunteer->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                               id="phone" name="phone" value="{{ old('phone', $volunteer->phone) }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="occupation" class="form-label">Occupation</label>
                <input type="text" class="form-control @error('occupation') is-invalid @enderror" 
                       id="occupation" name="occupation" value="{{ old('occupation', $volunteer->occupation) }}">
                @error('occupation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control @error('address') is-invalid @enderror" 
                          id="address" name="address" rows="2">{{ old('address', $volunteer->address) }}</textarea>
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control @error('city') is-invalid @enderror" 
                               id="city" name="city" value="{{ old('city', $volunteer->city) }}">
                        @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="state" class="form-label">State</label>
                        <input type="text" class="form-control @error('state') is-invalid @enderror" 
                               id="state" name="state" value="{{ old('state', $volunteer->state) }}">
                        @error('state')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="country" class="form-label">Country</label>
                        <input type="text" class="form-control @error('country') is-invalid @enderror" 
                               id="country" name="country" value="{{ old('country', $volunteer->country) }}">
                        @error('country')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="zip_code" class="form-label">Zip Code</label>
                        <input type="text" class="form-control @error('zip_code') is-invalid @enderror" 
                               id="zip_code" name="zip_code" value="{{ old('zip_code', $volunteer->zip_code) }}">
                        @error('zip_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="skills" class="form-label">Skills</label>
                <textarea class="form-control @error('skills') is-invalid @enderror" 
                          id="skills" name="skills" rows="2">{{ old('skills', $volunteer->skills) }}</textarea>
                @error('skills')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="interests" class="form-label">Interests</label>
                <textarea class="form-control @error('interests') is-invalid @enderror" 
                          id="interests" name="interests" rows="2">{{ old('interests', $volunteer->interests) }}</textarea>
                @error('interests')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="introduction" class="form-label">Introduction</label>
                <textarea class="form-control @error('introduction') is-invalid @enderror" 
                          id="introduction" name="introduction" rows="2">{{ old('introduction', $volunteer->introduction) }}</textarea>
                @error('introduction')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="testimonial" class="form-label">Testimonial</label>
                <textarea class="form-control @error('testimonial') is-invalid @enderror" 
                          id="testimonial" name="testimonial" rows="2">{{ old('testimonial', $volunteer->testimonial) }}</textarea>
                @error('testimonial')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="availability" class="form-label">Availability</label>
                <input type="text" class="form-control @error('availability') is-invalid @enderror" 
                       id="availability" name="availability" value="{{ old('availability', $volunteer->availability) }}">
                @error('availability')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="previous_experience" class="form-label">Previous Experience</label>
                <textarea class="form-control @error('previous_experience') is-invalid @enderror" 
                          id="previous_experience" name="previous_experience" rows="3">{{ old('previous_experience', $volunteer->previous_experience) }}</textarea>
                @error('previous_experience')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="photo" class="form-label">Volunteer Photo</label>
                @if($volunteer->photo)
                    <div class="mb-2">
                        <img src="{{ $volunteer->photo_url }}" alt="Current Photo" 
                             class="img-thumbnail" width="150">
                        <div class="form-text">Current photo</div>
                    </div>
                @endif
                <input type="file" class="form-control @error('photo') is-invalid @enderror" 
                       id="photo" name="photo" accept="image/*">
                @error('photo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Upload a new profile photo (JPEG, PNG, JPG, GIF - max 2MB)</div>
            </div>
            
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="active" name="active" value="1" 
                    {{ old('active', $volunteer->active) ? 'checked' : '' }}>
                <label class="form-check-label" for="active">Active Volunteer</label>
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.volunteers.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Volunteer</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    ClassicEditor
        .create(document.querySelector('#introduction'), {
            ckfinder: {
                // Pass CSRF token in query so Laravel doesn’t block it
                uploadUrl: "{{ route('admin.blogs.upload-image') }}?_token={{ csrf_token() }}"
            }
        })
        .catch(error => {
            console.error(error);
        });
</script>
<script>
    ClassicEditor
        .create(document.querySelector('#testimonial'), {
            ckfinder: {
                // Pass CSRF token in query so Laravel doesn’t block it
                uploadUrl: "{{ route('admin.blogs.upload-image') }}?_token={{ csrf_token() }}"
            }
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endpush