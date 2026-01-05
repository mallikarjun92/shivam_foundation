<!-- Floating Social Toggle -->
<div class="social-toggle-wrapper">

    <!-- Social Icons Container -->
    <div id="socialIcons" class="social-icons-collapsed show">
        {{-- <a href="https://wa.me/917892284158" target="_blank" class="float-icon whatsapp">
            <span class="icon-whatsapp"></span>
        </a> --}}
        <a href="https://wa.me/+918748980053" target="_blank" class="float-icon whatsapp">
            <span class="icon-whatsapp"></span>
        </a>
        {{-- <a href="https://facebook.com" target="_blank" class="float-icon facebook">
            <span class="icon-facebook"></span>
        </a> --}}
        <a href="https://www.instagram.com/vishvamfoundation?igsh=MW9naGxmN3YxN29idw==" target="_blank" class="float-icon instagram">
            <span class="icon-instagram"></span>
        </a>
        <a href="https://www.facebook.com/share/1BAusGNv1Q/" target="_blank" class="float-icon facebook">
            <span class="icon-facebook"></span>
        </a>
        <a href="https://www.youtube.com/@vishvamfoundationhassan" target="_blank" class="float-icon youtube">
            <span class="icon-youtube"></span>
        </a>
        <a href="mailto:info@vishvamfoundation.org" class="float-icon email">
            <span class="icon-envelope"></span>
        </a>
        {{-- https://www.youtube.com/@vishvamfoundationhassan --}}
    </div>
    
    
    <!-- Toggle Button -->
    <button id="socialToggleBtn" class="social-toggle-btn">
        <span class="icon-chain"></span>
    </button>
</div>
@push('scripts')
<script>
    document.getElementById('socialToggleBtn').addEventListener('click', function () {
        document.getElementById('socialIcons').classList.toggle('show');
    });
</script>
@endpush