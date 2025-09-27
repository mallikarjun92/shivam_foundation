<div class="form-group">
    <input type="text" class="form-control" name="name" placeholder="Your Name" value="{{ old('name') }}" required>
    @error('name')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="form-group">
    <input type="email" class="form-control" name="email" placeholder="Your Email" value="{{ old('email') }}" required>
    @error('email')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="form-group">
    <input type="text" class="form-control" name="subject" placeholder="Subject" value="{{ old('subject') }}" required>
    @error('subject')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="form-group">
    <textarea name="message" cols="30" rows="7" class="form-control" placeholder="Message" required>{{ old('message') }}</textarea>
    @error('message')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary py-3 px-5">Send Message</button>
</div>